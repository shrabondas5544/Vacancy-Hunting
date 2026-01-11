<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Middleware is handled in routes
    }
    /**
     * Redirect to dashboard
     */
    public function index()
    {
        return redirect()->route('employer.dashboard');
    }

    /**
     * Show employer dashboard with dummy statistics
     */
    public function dashboard()
    {
        // Dummy statistics - will be built properly later
        $stats = [
            'total_jobs' => 0,
            'active_jobs' => 0,
            'total_applications' => 0,
            'pending_applications' => 0,
        ];

        return \Inertia\Inertia::render('Employer/Dashboard', [
            'stats' => $stats
        ]);
    }

    /**
     * Show job listing with filters
     */
    public function postJob(Request $request)
    {
        $query = auth()->user()->employer->jobs()->latest();

        // Apply filters
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('field_type')) {
            $query->where('field_type', $request->field_type);
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobs = $query->get();
        
        return \Inertia\Inertia::render('Employer/PostJob', [
            'jobs' => $jobs,
            'filters' => [
                'search' => $request->get('search'),
                'field_type' => $request->get('field_type'),
                'job_type' => $request->get('job_type'),
                'status' => $request->get('status'),
            ]
        ]);
    }

    /**
     * Show job creation form
     */
    public function createJob()
    {
        return \Inertia\Inertia::render('Employer/CreateJob');
    }

    /**
     * Store a newly created job
     */
    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'field_type' => 'required|string',
            'job_type' => 'required|string',
            'deadline' => 'nullable|date',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string',
            'salary_range' => 'nullable|string',
        ]);

        auth()->user()->employer->jobs()->create([
            'title' => $request->title,
            'field_type' => $request->field_type,
            'job_type' => $request->job_type,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location' => $request->location,
            'salary_range' => $request->salary_range,
            'status' => 'active'
        ]);

        return redirect()->route('employer.post-job')->with('success', 'Job posted successfully!');
    }

    /**
     * Show job details
     */
    public function showJob($id)
    {
        $job = auth()->user()->employer->jobs()->findOrFail($id);
        return \Inertia\Inertia::render('Employer/ShowJob', [
            'job' => $job
        ]);
    }

    /**
     * Delete a job
     */
    public function destroyJob($id)
    {
        $job = auth()->user()->employer->jobs()->findOrFail($id);
        $job->delete();

        return redirect()->route('employer.post-job')->with('success', 'Job deleted successfully!');
    }
}
