<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HeadhuntingController extends Controller
{
    /**
     * Display the headhunting dashboard.
     */
    public function index()
    {
        $stats = [
            'total_candidates' => Candidate::count(),
            'recent_candidates' => Candidate::where('created_at', '>=', now()->subDays(30))->count(),
            'total_employers' => Employer::count(),
            'pending_employers' => Employer::where('status', 'pending')->count(),
            'total_blogs' => \App\Models\Article::count(),
            'recent_blogs' => \App\Models\Article::where('created_at', '>=', now()->subDays(30))->count(),
        ];

        // Get chart data for the last 12 months
        $chartData = $this->getChartData();

        return view('admin.headhunting.index', compact('stats', 'chartData'));
    }

    /**
     * Get chart data for candidates, employers, and blogs.
     */
    private function getChartData()
    {
        $months = [];
        $candidateData = [];
        $employerData = [];
        $blogData = [];

        // Get data for last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $candidateData[] = Candidate::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $employerData[] = Employer::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $blogData[] = \App\Models\Article::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'labels' => $months,
            'candidates' => $candidateData,
            'employers' => $employerData,
            'blogs' => $blogData,
        ];
    }

    /**
     * Display the list of all candidates.
     */
    public function candidates(Request $request)
    {
        $query = Candidate::with('user');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }

        $candidates = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.headhunting.candidates', compact('candidates'));
    }

    /**
     * Display a candidate's full details.
     */
    public function showCandidate($id)
    {
        $candidate = Candidate::with([
            'user',
            'education',
            'experience',
            'certifications',
            'portfolio',
            'languages',
            'references'
        ])->findOrFail($id);

        return view('admin.headhunting.candidate-show', compact('candidate'));
    }

    /**
     * Update the candidate's password.
     */
    public function updateCandidatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $candidate = Candidate::findOrFail($id);
        $user = User::findOrFail($candidate->user_id);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Delete a candidate account.
     */
    public function destroyCandidate($id)
    {
        $candidate = Candidate::findOrFail($id);
        $user = User::find($candidate->user_id);

        // Delete candidate and related data
        $candidate->education()->delete();
        $candidate->experience()->delete();
        $candidate->certifications()->delete();
        $candidate->portfolio()->delete();
        $candidate->languages()->delete();
        $candidate->references()->delete();
        $candidate->delete();

        // Delete user account
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.headhunting.candidates')->with('status', 'candidate-deleted');
    }

    // ========================
    // EMPLOYER METHODS
    // ========================

    /**
     * Display the list of all employers.
     */
    public function employers(Request $request)
    {
        $query = Employer::with('user');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $employers = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.headhunting.employers', compact('employers'));
    }

    /**
     * Display an employer's full details.
     */
    public function showEmployer($id)
    {
        $employer = Employer::with([
            'user',
            'locations',
            'teamMembers',
            'media'
        ])->findOrFail($id);

        return view('admin.headhunting.employer-show', compact('employer'));
    }

    /**
     * Approve an employer account.
     */
    public function approveEmployer($id)
    {
        $employer = Employer::findOrFail($id);
        
        $employer->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.headhunting.employers')->with('status', 'employer-approved');
    }

    /**
     * Reject an employer account.
     */
    public function rejectEmployer($id)
    {
        $employer = Employer::findOrFail($id);
        
        $employer->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('admin.headhunting.employers')->with('status', 'employer-rejected');
    }

    /**
     * Update the employer's password.
     */
    public function updateEmployerPassword(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $employer = Employer::findOrFail($id);
        $user = User::findOrFail($employer->user_id);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Delete an employer account.
     */
    public function destroyEmployer($id)
    {
        $employer = Employer::findOrFail($id);
        $user = User::find($employer->user_id);

        // Delete employer and related data
        $employer->locations()->delete();
        $employer->teamMembers()->delete();
        $employer->media()->delete();
        $employer->delete();

        // Delete user account
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.headhunting.employers')->with('status', 'employer-deleted');
    }

    // ========================
    // BLOG METHODS
    // ========================

    /**
     * Display the list of all blog articles.
     */
    public function blogs(Request $request)
    {
        $query = \App\Models\Article::with('user');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.headhunting.blogs', compact('articles'));
    }

    /**
     * Delete a blog article.
     */
    public function destroyBlog($id)
    {
        $article = \App\Models\Article::findOrFail($id);

        // Delete featured image
        if ($article->featured_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($article->featured_image);
        }

        // Delete related data
        $article->reactions()->delete();
        $article->comments()->delete();
        $article->delete();

        return redirect()->route('admin.headhunting.blogs')->with('status', 'blog-deleted');
    }
}

