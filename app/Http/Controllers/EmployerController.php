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
            'experience_level' => 'nullable|string',
            'deadline' => 'required|date',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string',
            'division' => 'nullable|string',
            'vacancies' => 'nullable|integer|min:1',
            'salary_range' => 'nullable|string',
            'educational_qualifications' => 'nullable|string',
            'experience' => 'nullable|string',
            'required_skills' => 'nullable|string',
            'job_benefits' => 'nullable|string',
        ]);

        auth()->user()->employer->jobs()->create([
            'title' => $request->title,
            'field_type' => $request->field_type,
            'job_type' => $request->job_type,
            'experience_level' => $request->experience_level,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location' => $request->location,
            'division' => $request->division,
            'vacancies' => $request->vacancies,
            'salary_range' => $request->salary_range,
            'educational_qualifications' => $request->educational_qualifications,
            'experience' => $request->experience,
            'required_skills' => $request->required_skills,
            'job_benefits' => $request->job_benefits,
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

    /**
     * Show all jobs posted by other companies with filters
     */
    public function otherJobs(Request $request)
    {
        // Get all jobs from all employers
        $query = \App\Models\Job::with('employer')->latest();

        // Apply filters
        if ($request->filled('company_type')) {
            $query->whereHas('employer', function($q) use ($request) {
                $q->where('company_type', $request->company_type);
            });
        }

        if ($request->filled('ownership_type')) {
            $query->whereHas('employer', function($q) use ($request) {
                $q->where('ownership_type', $request->ownership_type);
            });
        }

        if ($request->filled('field_type')) {
            $query->where('field_type', $request->field_type);
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        $jobs = $query->get();

        return \Inertia\Inertia::render('Employer/OtherJobs', [
            'jobs' => $jobs,
            'filters' => [
                'company_type' => $request->get('company_type'),
                'ownership_type' => $request->get('ownership_type'),
                'field_type' => $request->get('field_type'),
                'job_type' => $request->get('job_type'),
            ]
        ]);
    }
}
