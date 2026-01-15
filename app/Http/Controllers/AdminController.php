<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginView()
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator', 'chairman'])) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (in_array(Auth::user()->role, ['admin', 'moderator', 'chairman'])) {
                // Check if admin is active in admin_users table
                $adminUser = \App\Models\AdminUser::where('email', Auth::user()->email)->first();
                
                if ($adminUser && !$adminUser->is_active) {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Your admin account has been deactivated. Please contact the super administrator.',
                    ]);
                }
                
                // Update last login timestamp
                if ($adminUser) {
                    $adminUser->updateLastLogin();
                }
                
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'You exist, but you do not have authorized access.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboardView()
    {
        $user = Auth::user();
        
        // Fetch admin user permissions from admin_users table
        $adminUser = \App\Models\AdminUser::where('email', $user->email)->first();
        
        // Determine if super admin or pass permissions
        $isSuperAdmin = $adminUser && $adminUser->is_super_admin;
        $permissions = $adminUser ? $adminUser->permissions : [];
        
        return view('admin.dashboard', [
            'isSuperAdmin' => $isSuperAdmin,
            'permissions' => $permissions
        ]);
    }

    public function profileView()
    {
        return view('admin.profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }

    // Corporate Workshop Module
    public function corporateWorkshop()
    {
        return view('admin.corporate-workshop.index');
    }

    // Career Counselling Module
    public function careerCounselling()
    {
        return view('admin.career-counselling.index');
    }

    // Skill Development Module
    public function skillDevelopment()
    {
        return view('admin.skill-development.index');
    }

    // People Empowerment Module
    public function peopleEmpowerment()
    {
        return view('admin.people-empowerment.index');
    }

    // Consultancy & Advisory Module
    public function consultancyAdvisory()
    {
        return view('admin.consultancy-advisory.index');
    }

    // ===== ADMIN USER MANAGEMENT =====
    
    // Show all admin users
    public function manageAdmins()
    {
        $adminUsers = \App\Models\AdminUser::orderBy('created_at', 'desc')->get();
        return view('admin.manage-admins.index', compact('adminUsers'));
    }

    // Show create admin form
    public function createAdminForm()
    {
        $modules = \App\Models\AdminUser::getAvailableModules();
        return view('admin.manage-admins.create', compact('modules'));
    }

    // Store new admin user
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admin_users,email|unique:users,email',
            'password' => 'required|min:8',
            'permissions' => 'nullable|array',
            'is_super_admin' => 'nullable|boolean',
        ]);

        $isSuperAdmin = $request->has('is_super_admin') && $request->is_super_admin;

        // Build permissions array (ignore if super admin)
        $permissions = [];
        if (!$isSuperAdmin && $request->has('permissions')) {
            foreach ($request->permissions as $module) {
                $permissions[$module] = true;
            }
        }

        // 1. Create in Users table (for Login)
        $user = \App\Models\User::create([
            'name' => 'Admin User',
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'admin',
        ]);

        // 2. Create in AdminUsers table (for Permissions)
        \App\Models\AdminUser::create([
            'user_id' => $user->id, // Track the user for cascade delete
            'email' => $request->email,
            'password' => $request->password, // Will be hashed by mutator
            'permissions' => $permissions,
            'is_active' => true,
            'is_super_admin' => $isSuperAdmin,
        ]);

        return redirect()->route('admin.manage-admins.index')->with('success', 'Admin user created successfully!');
    }

    // Toggle admin user active/inactive status
    public function toggleAdminStatus($id)
    {
        $admin = \App\Models\AdminUser::findOrFail($id);
        $admin->update(['is_active' => !$admin->is_active]);

        $status = $admin->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Admin user {$status} successfully!");
    }

    // Delete admin user
    public function deleteAdmin($id)
    {
        $admin = \App\Models\AdminUser::findOrFail($id);
        
        // Prevent deleting super admin
        if ($admin->is_super_admin) {
            return back()->with('error', 'Cannot delete super admin!');
        }

        // Delete from Users table first (Login)
        \App\Models\User::where('email', $admin->email)->delete();

        // Delete from AdminUsers table (Permissions)
        $admin->delete();
        
        return back()->with('success', 'Admin user deleted successfully!');
    }
}
