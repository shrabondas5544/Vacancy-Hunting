<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\InternshipForm;
use App\Models\InternshipFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\InternshipApplicationSubmitted;
use Illuminate\Support\Facades\Mail;
use App\Mail\InternshipApplicationShortlisted;

class CampusBirdController extends Controller
{
    /**
     * Display the Campus Bird Internship dashboard.
     */
    public function index()
    {
        // Get real statistics
        $totalApplicants = InternshipFormSubmission::count();
        $activeForms = InternshipForm::where('is_active', true)->count();
        $pendingApplicants = InternshipFormSubmission::where('status', 'pending')->count();
        $shortlistedApplicants = InternshipFormSubmission::where('status', 'shortlisted')->count();
        $rejectedApplicants = InternshipFormSubmission::where('status', 'rejected')->count();
        $recentApplicants = InternshipFormSubmission::where('created_at', '>=', now()->subDays(30))->count();
        
        $stats = [
            'total_applicants' => $totalApplicants,
            'active_forms' => $activeForms,
            'pending_applications' => $pendingApplicants,
            'shortlisted_applications' => $shortlistedApplicants,
            'rejected_applications' => $rejectedApplicants,
            'recent_applicants' => $recentApplicants,
        ];

        // Get chart data for the last 12 months
        $chartData = $this->getChartData();

        // Get Alumni statistics for Pie Chart (Category-wise)
        $alumniByCategory = \App\Models\Alumni::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        // Get Alumni statistics for Bar/Pie Chart (Program-wise)
        $alumniByProgram = \App\Models\Alumni::selectRaw('program, count(*) as count')
            ->groupBy('program')
            ->orderByDesc('count')
            ->limit(5) // Top 5 programs
            ->pluck('count', 'program')
            ->toArray();

        return view('admin.campus-bird.index', compact('stats', 'chartData', 'alumniByCategory', 'alumniByProgram'));
    }

    /**
     * Get chart data for applicants and forms.
     */
    private function getChartData()
    {
        $months = [];
        $applicantData = [];
        $pendingData = [];
        $shortlistedData = [];

        // Get data for last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $applicantData[] = InternshipFormSubmission::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $pendingData[] = InternshipFormSubmission::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'pending')
                ->count();
            
            $shortlistedData[] = InternshipFormSubmission::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'shortlisted')
                ->count();
        }

        return [
            'labels' => $months,
            'applicants' => $applicantData,
            'pending' => $pendingData,
            'shortlisted' => $shortlistedData,
        ];
    }

    /**
     * Display the list of applicants for Campus Bird Internship.
     */
    public function applicants(Request $request)
    {
        $query = InternshipFormSubmission::with('form');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                  ->orWhere('applicant_email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && in_array($request->status, ['pending', 'shortlisted', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $applicants = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.campus-bird.applicants', compact('applicants'));
    }

    /**
     * Show applicant details.
     */
    public function showApplicant($id)
    {
        $applicant = InternshipFormSubmission::with('form')->findOrFail($id);
        return view('admin.campus-bird.show-applicant', compact('applicant'));
    }

    /**
     * Update applicant status.
     */
    public function updateApplicantStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,shortlisted,rejected',
        ]);

        $applicant = InternshipFormSubmission::findOrFail($id);
        $applicant->status = $request->status;
        $applicant->save();

        // Send shortlist email if status is shortlisted
        if ($request->status === 'shortlisted') {
            try {
                Mail::to($applicant->applicant_email)->send(new InternshipApplicationShortlisted($applicant));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to send shortlist email: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Applicant status updated successfully.');
    }

    /**
     * Delete an applicant.
     */
    public function destroyApplicant($id)
    {
        $applicant = InternshipFormSubmission::findOrFail($id);
        $applicant->delete();

        return redirect()->route('admin.campus-bird.applicants')->with('success', 'Applicant deleted successfully.');
    }

    /**
     * Export applicants to Excel (.xlsx).
     */
    public function exportApplicants(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        
        // Build query
        $query = InternshipFormSubmission::with('form');
        
        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                  ->orWhere('applicant_email', 'like', "%{$search}%");
            });
        }
        
        // Apply status filter
        if ($status && in_array($status, ['pending', 'shortlisted', 'rejected'])) {
            $query->where('status', $status);
        }
        
        $applicants = $query->orderBy('created_at', 'desc')->get();
        
        // Generate filename
        $statusText = $status ? $status . '_' : '';
        $filename = 'campus_bird_applicants_' . $statusText . date('Y-m-d') . '.xlsx';
        
        // Collect all unique custom field names across all applicants
        $allCustomFields = [];
        foreach ($applicants as $applicant) {
            if ($applicant->form_data && is_array($applicant->form_data)) {
                foreach (array_keys($applicant->form_data) as $fieldName) {
                    if (!in_array($fieldName, $allCustomFields)) {
                        $allCustomFields[] = $fieldName;
                    }
                }
            }
        }
        
        // Prepare header row
        $headers = [
            'Name', 'Email', 'Phone', 'Department', 'Form Title', 
            'Submission Date', 'Status'
        ];
        
        // Add custom field headers
        foreach ($allCustomFields as $fieldName) {
            $headers[] = ucwords(str_replace('_', ' ', $fieldName));
        }
        
        $data = [$headers];
        
        // Prepare data rows
        foreach ($applicants as $applicant) {
            $row = [
                $applicant->applicant_name ?? 'N/A',
                $applicant->applicant_email ?? 'N/A',
                $applicant->applicant_phone ?? 'N/A',
                $applicant->form->department ?? 'N/A',
                $applicant->form->title ?? 'N/A',
                $applicant->created_at->format('M d, Y H:i'),
                ucfirst($applicant->status)
            ];
            
            // Add custom field values
            foreach ($allCustomFields as $fieldName) {
                $value = '';
                if (isset($applicant->form_data[$fieldName])) {
                    $fieldValue = $applicant->form_data[$fieldName];
                    
                    if (is_array($fieldValue)) {
                        $value = implode(', ', $fieldValue);
                    } else {
                        $value = $fieldValue;
                    }
                }
                $row[] = $value;
            }
            
            $data[] = $row;
        }
        
        // Generate and stream XLSX
        return response()->streamDownload(function() use ($data) {
            $xlsx = \Shuchkin\SimpleXLSXGen::fromArray($data);
            echo $xlsx;
        }, $filename);
    }


    /**
     * Display the public description page for Campus Bird Internship.
     */
    public function description()
    {
        // All available departments
        $allDepartments = [
            'IT and graphics',
            'Content & creation',
            'Marketing & promotions',
            'Human Resources',
            'Bussniess Development',
            'Client Management & Public Relation(CM &  PR)',
            'Product Design & Development (PDDT)',
            'Education Consultancy'
        ];

        // Get active forms grouped by department
        $activeForms = InternshipForm::where('is_active', true)->get()->keyBy('department');

        // Build departments array with availability status
        $departments = [];
        foreach ($allDepartments as $dept) {
            $departments[] = [
                'name' => $dept,
                'available' => isset($activeForms[$dept]),
                'form' => isset($activeForms[$dept]) ? $activeForms[$dept] : null
            ];
        }

        return view('services.campus-bird', compact('departments'));
    }

    /**
     * Display the list of alumni.
     */
    public function alumni(Request $request)
    {
        $query = \App\Models\Alumni::query();

        // Search by Name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by Program
        if ($request->filled('program')) {
            $query->where('program', $request->program);
        }

        // Filter by Category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by Year
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Filter by Division
        if ($request->filled('division')) {
            $query->where('division', $request->division);
        }

        $alumni = $query->orderBy('year', 'desc')->get();

        // Fetch options for filters
        $programs = [];
        for ($i = 1; $i <= 10; $i++) {
            $programs[] = "Campus Bird Internship $i";
        }

        $categories = [
            'IT and graphics',
            'Content & creation',
            'Marketing & promotion',
            'Human Resources',
            'Bussniess Development',
            'Client management & Public Relation(CM & PR)',
            'Product design & Development(PDDT)',
            'Education Consultancy'
        ];

        $years = range(2020, 2050);

        $divisions = [
            'Barishal',
            'Chattogram',
            'Dhaka',
            'Khulna',
            'Rajshahi',
            'Rangpur',
            'Mymensingh',
            'Sylhet'
        ];

        return view('services.campus-bird-alumni', compact('alumni', 'programs', 'categories', 'years', 'divisions'));
    }

    /**
     * Display individual alumni profile.
     */
    public function showAlumni($id)
    {
        $alumni = \App\Models\Alumni::findOrFail($id);
        return view('services.campus-bird-alumni-profile', compact('alumni'));
    }

    /**
     * Display the application form for a specific department.
     */
    public function applicationForm($department)
    {
        // Find the active form for this department
        $form = InternshipForm::where('department', $department)
            ->where('is_active', true)
            ->first();

        if (!$form) {
            // Show not available page instead of 404
            return view('services.campus-bird-not-available', compact('department'));
        }

        return view('services.campus-bird-application', compact('form', 'department'));
    }

    /**
     * Handle the application form submission.
     */
    public function submitApplication(Request $request)
    {
        $request->validate([
            'internship_form_id' => 'required|exists:internship_forms,id',
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|email|max:255',
            'applicant_phone' => 'required|string|max:20',
        ]);

        $form = InternshipForm::findOrFail($request->internship_form_id);
        $allFields = $form->getAllFields();
        $formData = [];
        $rules = [];

        // Build validation rules for custom fields only (default fields already validated above)
        foreach ($allFields as $field) {
            // Skip default fields as they're already validated
            if (in_array($field['field_name'], ['applicant_name', 'applicant_email', 'applicant_phone'])) {
                continue;
            }

            $fieldRules = [];
            
            if ($field['is_required']) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            if ($field['type'] === 'file') {
                $fieldRules[] = 'file';
                $fieldRules[] = 'max:10240'; // 10MB max
            } elseif ($field['type'] === 'date') {
                $fieldRules[] = 'date';
            }

            $rules[$field['field_name']] = $fieldRules;
        }

        $validated = $request->validate($rules);

        // Process custom field data and handle file uploads
        foreach ($allFields as $field) {
            $fieldName = $field['field_name'];
            
            // Skip default fields
            if (in_array($fieldName, ['applicant_name', 'applicant_email', 'applicant_phone'])) {
                continue;
            }
            
            if ($field['type'] === 'file' && $request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $path = $file->store('internship-applications', 'public');
                $formData[$fieldName] = $path;
            } elseif ($field['type'] === 'checkbox') {
                $formData[$fieldName] = $request->has($fieldName) ? $request->input($fieldName, []) : [];
            } else {
                $formData[$fieldName] = $request->input($fieldName);
            }
        }

        // Store the submission
        $submission = InternshipFormSubmission::create([
            'internship_form_id' => $form->id,
            'applicant_name' => $request->applicant_name,
            'applicant_email' => $request->applicant_email,
            'applicant_phone' => $request->applicant_phone,
            'status' => 'pending',
            'form_data' => $formData,
        ]);

        // Send confirmation email
        try {
            Mail::to($submission->applicant_email)->send(new InternshipApplicationSubmitted($submission));
        } catch (\Exception $e) {
            // Log error but continue
            \Illuminate\Support\Facades\Log::error('Failed to send internship application email: ' . $e->getMessage());
        }

        return redirect()->route('services.campus-bird')->with('success', 'Your application has been submitted successfully!');
    }
}
