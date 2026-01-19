<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmployerApproved;
use Illuminate\Support\Facades\Mail;

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
            'total_jobs' => \App\Models\Job::count(),
            'active_jobs' => \App\Models\Job::where('status', 'active')->count(),
            'recent_jobs' => \App\Models\Job::where('created_at', '>=', now()->subDays(30))->count(),
        ];

        // Get chart data for the last 12 months
        $chartData = $this->getChartData();
        
        // Get job field distribution for pie chart
        $jobsByField = \App\Models\Job::selectRaw('field_type, COUNT(*) as count')
            ->groupBy('field_type')
            ->pluck('count', 'field_type')
            ->toArray();
        
        $stats['jobs_by_field'] = $jobsByField;

        return view('admin.headhunting.index', compact('stats', 'chartData'));
    }

    /**
     * Get chart data for candidates, employers, and job posts.
     */
    private function getChartData()
    {
        $months = [];
        $candidateData = [];
        $employerData = [];
        $jobData = [];

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
            
            $jobData[] = \App\Models\Job::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'labels' => $months,
            'candidates' => $candidateData,
            'employers' => $employerData,
            'jobs' => $jobData,
        ];
    }

    /**
     * Display the list of all candidates.
     */
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

        // Month filter
        if ($request->has('month') && $request->month) {
            $query->whereMonth('created_at', $request->month);
        }

        // Year filter
        if ($request->has('year') && $request->year) {
            $query->whereYear('created_at', $request->year);
        }

        // Get available years for filter (database years + defaults from 2023)
        $dbYears = Candidate::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
            
        $currentYear = date('Y');
        $defaultYears = range($currentYear, 2023); // 2023 to Current Year
        
        $years = array_unique(array_merge($dbYears, $defaultYears));
        rsort($years); // Sort descending

        $candidates = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.headhunting.candidates', compact('candidates', 'years'));
    }

    /**
     * Export candidates to CSV (opens in Excel).
     */
    /**
     * Export candidates to Excel (.xlsx).
     */
    /**
     * Export candidates to Excel (.xlsx).
     */
    public function exportCandidates(Request $request)
    {
        $month = $request->get('month');
        $search = $request->get('search');
        
        // Build query
        $query = Candidate::with('user');
        
        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }
        
        // Apply month filter
        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        // Apply year filter
        if ($request->has('year') && $request->year) {
            $query->whereYear('created_at', $request->year);
        }
        
        $candidates = $query->orderBy('created_at', 'desc')->get();
        
        // Generate filename
        $monthName = $month ? date('F', mktime(0, 0, 0, $month, 1)) : 'all';
        $filename = 'candidates_' . strtolower($monthName) . '_' . date('Y-m-d') . '.xlsx';
        
        // Prepare data for XLSX
        $data = [
            [
                'Name', 'Email', 'Phone', 'Joining Date', 
                'Professional Summary', 'Experience Years', 'Skills', 'Interested In',
                'Street', 'City', 'State', 'Zip Code', 'Country',
                'Date of Birth', 'Gender', 'Pronouns',
                'LinkedIn', 'GitHub', 'Portfolio', 'Twitter', 'Facebook', 'Instagram'
            ] // Header row
        ];
        
        foreach ($candidates as $candidate) {
            $data[] = [
                $candidate->name ?? 'N/A',
                $candidate->user->email ?? 'N/A',
                $candidate->phone ?? 'N/A',
                $candidate->created_at->format('M d, Y'),
                
                $candidate->professional_summary ?? '',
                $candidate->experience_years ?? '',
                $candidate->skills ?? '',
                is_array($candidate->interested_in) ? implode(', ', $candidate->interested_in) : ($candidate->interested_in ?? ''),
                
                $candidate->street ?? '',
                $candidate->city ?? '',
                $candidate->state ?? '',
                $candidate->zip_code ?? '',
                $candidate->country ?? '',
                
                $candidate->date_of_birth ? $candidate->date_of_birth->format('Y-m-d') : '',
                $candidate->gender ?? '',
                $candidate->pronouns ?? '',
                
                $candidate->linkedin_url ?? '',
                $candidate->github_url ?? '',
                $candidate->portfolio_url ?? '',
                $candidate->twitter_url ?? '',
                $candidate->facebook_url ?? '',
                $candidate->instagram_url ?? ''
            ];
        }
        
        // Generate and stream XLSX
        return response()->streamDownload(function() use ($data) {
            $xlsx = \Shuchkin\SimpleXLSXGen::fromArray($data);
            $xlsx->downloadAs(null); // Passing null to downloadAs creates output string but streamDownload handles output buffering
            // Actually streamDownload expects us to echo content. 
            // SimpleXLSXGen::downloadAs outputs headers and echo content, which conflicts with streamDownload.
            // We should use saveAs('php://output') or implicit string conversion if supported, 
            // but downloadAs headers might conflict.
            // Let's use standard output without Laravel helper if needed, or use proper method.
            // Inspecting SimpleXLSXGen docs: $xlsx->downloadAs('filename.xlsx') sends headers and exits.
            // We want raw content. $xlsx->__toString() returns raw content.
            echo $xlsx;
        }, $filename);
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

        // Month filter
        if ($request->has('month') && $request->month) {
            $query->whereMonth('created_at', $request->month);
        }

        // Year filter
        if ($request->has('year') && $request->year) {
            $query->whereYear('created_at', $request->year);
        }

        // Get available years for filter (database years + defaults from 2023)
        $dbYears = Employer::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
            
        $currentYear = date('Y');
        $defaultYears = range($currentYear, 2023); // 2023 to Current Year
        
        $years = array_unique(array_merge($dbYears, $defaultYears));
        rsort($years); // Sort descending

        $employers = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.headhunting.employers', compact('employers', 'years'));
    }

    /**
     * Export employers to Excel (.xlsx).
     */
    public function exportEmployers(Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');
        $search = $request->get('search');
        $status = $request->get('status');
        
        // Build query
        $query = Employer::with('user');
        
        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }
        
        // Apply status filter
        if ($status) {
            $query->where('status', $status);
        }
        
        // Apply month filter
        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        // Apply year filter
        if ($year) {
            $query->whereYear('created_at', $year);
        }
        
        $employers = $query->orderBy('created_at', 'desc')->get();
        
        // Generate filename
        $dateStr = $month ? date('F', mktime(0, 0, 0, $month, 1)) : 'all';
        if ($year) $dateStr .= '_' . $year;
        $filename = 'employers_' . strtolower($dateStr) . '_' . date('Y-m-d') . '.xlsx';
        
        // Prepare data for XLSX
        $data = [
            [
                'Company Name', 'Email', 'Contact Number', 'Status', 'Joining Date', 'Approved Date',
                'Type', 'Description', 'Establishment Year', 'Ownership', 'Employee Count', 'Trade License No',
                'Address', 'Street', 'City', 'State', 'Zip Code', 'Country',
                'Website', 'LinkedIn', 'Twitter', 'Facebook', 'Instagram', 'YouTube',
                'Products & Services', 'Company History', 'Employee Benefits', 'Company Values', 'Media Count'
            ] // Header row
        ];
        
        foreach ($employers as $employer) {
            $data[] = [
                $employer->company_name ?? 'N/A',
                $employer->user->email ?? 'N/A',
                $employer->contact_number ?? 'N/A',
                ucfirst($employer->status),
                $employer->created_at->format('M d, Y'),
                $employer->approved_at ? $employer->approved_at->format('M d, Y') : 'N/A',
                
                $employer->company_type ?? '',
                $employer->company_description ?? '',
                $employer->establishment_year ?? '',
                $employer->company_ownership ?? '',
                $employer->employee_count ?? '',
                $employer->trade_license_no ?? '',
                
                $employer->company_address ?? '',
                $employer->street ?? '',
                $employer->city ?? '',
                $employer->state ?? '',
                $employer->zip_code ?? '',
                $employer->country ?? '',
                
                $employer->website_url ?? '',
                $employer->linkedin_url ?? '',
                $employer->twitter_url ?? '',
                $employer->facebook_url ?? '',
                $employer->instagram_url ?? '',
                $employer->youtube_url ?? '',
                
                $employer->products_services ?? '',
                is_array($employer->company_history) ? json_encode($employer->company_history) : ($employer->company_history ?? ''),
                is_array($employer->employee_benefits) ? implode(', ', $employer->employee_benefits) : ($employer->employee_benefits ?? ''),
                is_array($employer->company_values) ? implode(', ', $employer->company_values) : ($employer->company_values ?? ''),
                $employer->media()->count()
            ];
        }
        
        // Generate and stream XLSX
        return response()->streamDownload(function() use ($data) {
            $xlsx = \Shuchkin\SimpleXLSXGen::fromArray($data);
            echo $xlsx;
        }, $filename);
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

        // Send approval email
        try {
            Mail::to($employer->user->email)->send(new EmployerApproved($employer));
        } catch (\Exception $e) {
            // Log error but don't stop execution
            \Illuminate\Support\Facades\Log::error('Failed to send employer approval email: ' . $e->getMessage());
        }

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
    // JOB POSTS METHODS
    // ========================

    /**
     * Display the list of all job posts.
     */
    public function jobs(Request $request)
    {
        $query = \App\Models\Job::with(['employer.user']);

        // Single search field for company name, email, or phone
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('employer', function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by field type
        if ($request->has('field_type') && $request->field_type) {
            $query->where('field_type', $request->field_type);
        }

        // Filter by job type
        if ($request->has('job_type') && $request->job_type) {
            $query->where('job_type', $request->job_type);
        }

        // Filter by division (district)
        if ($request->has('division') && $request->division) {
            $query->where('division', $request->division);
        }

        // Year filter
        if ($request->has('year') && $request->year) {
            $query->whereYear('created_at', $request->year);
        }

        // Get available years for filter
        $dbYears = \App\Models\Job::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
            
        $currentYear = date('Y');
        $defaultYears = range($currentYear, 2023);
        
        $years = array_unique(array_merge($dbYears, $defaultYears));
        rsort($years);

        $jobs = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.headhunting.jobs', compact('jobs', 'years'));
    }

    /**
     * Export job posts to Excel (.xlsx).
     */
    public function exportJobs(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $field_type = $request->get('field_type');
        $job_type = $request->get('job_type');
        $division = $request->get('division');
        $year = $request->get('year');
        
        // Build query
        $query = \App\Models\Job::with(['employer.user']);
        
        // Apply search filter
        if ($search) {
            $query->whereHas('employer', function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }
        
        // Apply status filter
        if ($status) {
            $query->where('status', $status);
        }
        
        // Apply field type filter
        if ($field_type) {
            $query->where('field_type', $field_type);
        }
        
        // Apply job type filter
        if ($job_type) {
            $query->where('job_type', $job_type);
        }
        
        // Apply division (district) filter
        if ($division) {
            $query->where('division', $division);
        }
        
        // Apply year filter
        if ($year) {
            $query->whereYear('created_at', $year);
        }
        
        $jobs = $query->orderBy('created_at', 'desc')->get();
        
        // Generate filename
        $dateStr = $year ? $year : 'all';
        $filename = 'job-posts_' . strtolower($dateStr) . '_' . date('Y-m-d') . '.xlsx';
        
        // Prepare data for XLSX
        $data = [
            [
                'Company Name', 'Email', 'Phone', 'Post Date', 'Job Title', 
                'Field Type', 'Job Type', 'Division', 'Deadline', 'Status'
            ] // Header row
        ];
        
        foreach ($jobs as $job) {
            $data[] = [
                $job->employer->company_name ?? 'N/A',
                $job->employer->user->email ?? 'N/A',
                $job->employer->contact_number ?? 'N/A',
                $job->created_at->format('M d, Y'),
                $job->title ?? 'N/A',
                $job->field_type ?? '',
                $job->job_type ?? '',
                $job->division ?? '',
                $job->deadline ? $job->deadline->format('M d, Y') : '',
                ucfirst($job->status ?? 'active')
            ];
        }
        
        // Generate and stream XLSX
        return response()->streamDownload(function() use ($data) {
            $xlsx = \Shuchkin\SimpleXLSXGen::fromArray($data);
            echo $xlsx;
        }, $filename);
    }

    /**
     * Delete a job post.
     */
    public function destroyJob($id)
    {
        $job = \App\Models\Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.headhunting.jobs')->with('status', 'job-deleted');
    }

    // ========================
    // BLOG METHODS
    // ========================

}

