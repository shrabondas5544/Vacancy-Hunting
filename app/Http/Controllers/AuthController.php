<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show Register Form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle Login Logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if Employer is approved
            if ($user->role === 'employer') {
                $employer = $user->employer;
                if (!$employer || $employer->status !== 'approved') {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    
                    if ($employer && $employer->status === 'rejected') {
                        return back()->withErrors(['email' => 'Your account has been rejected by admin.']);
                    }
                    
                    return back()->withErrors(['email' => 'Your account is pending approval. Please wait for admin to approve your account.']);
                }
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle Registration Logic
    public function register(Request $request)
    {
        // 1. Basic Validation
        $request->validate([
            'role' => ['required', Rule::in(['candidate', 'employer', 'admin'])],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Role Specific Validation
        if ($request->role === 'candidate') {
            $request->validate([
                'name' => 'required|string|max:255',
                'experience' => 'nullable|integer',
                'skills_text' => 'nullable|string',
            ]);
        } elseif ($request->role === 'employer') {
            $request->validate([
                'company_name' => 'required|string|max:255',
                'company_type' => 'required|string',
                'contact_number' => 'required|string',
                'establishment_year' => 'nullable|integer|min:1800|max:' . date('Y'),
                'company_ownership' => ['nullable', Rule::in(['private', 'public'])],
                'employee_count' => ['nullable', Rule::in(['1-20', '20-50', '50-100', '100-300', '300-1000', '1000+'])],
                'company_address' => 'nullable|string',
                'trade_license_no' => 'nullable|string|max:255',
                'website_url' => 'nullable|url|max:255',
            ]);
        } elseif ($request->role === 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
        }

        // 3. Database Transaction to ensure data integrity
        DB::transaction(function () use ($request) {
            
            // Create Base User
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Create Profile based on Role
            if ($request->role === 'candidate') {
                Candidate::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'experience_years' => $request->experience,
                    'skills' => $request->skills_text,
                    'interested_in' => $request->job_type ?? [], // Casts array automatically
                ]);
            } elseif ($request->role === 'employer') {
                Employer::create([
                    'user_id' => $user->id,
                    'company_name' => $request->company_name,
                    'company_type' => $request->company_type,
                    'contact_number' => $request->contact_number,
                    'company_description' => $request->company_description,
                    'establishment_year' => $request->establishment_year,
                    'company_ownership' => $request->company_ownership,
                    'employee_count' => $request->employee_count,
                    'company_address' => $request->company_address,
                    'trade_license_no' => $request->trade_license_no,
                    'website_url' => $request->website_url,
                    'status' => 'pending', // Default status
                ]);
            } elseif ($request->role === 'admin') {
                Admin::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                ]);
            }
            
            // Auto-login for candidates and admins only
            // Employers must wait for approval before logging in
            if ($request->role !== 'employer') {
                Auth::login($user);
            }
        });

        // Redirect based on role
        if ($request->role === 'employer') {
            return redirect()->route('login')->with('employer_pending', 'Your account has been created! It is currently Pending Approval from admin. You will be able to login once approved.');
        }

        return redirect('/dashboard');
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}