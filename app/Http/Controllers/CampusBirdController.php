<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\InternshipForm;
use App\Models\InternshipFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampusBirdController extends Controller
{
    /**
     * Display the Campus Bird Internship dashboard.
     */
    public function index()
    {
        // Placeholder stats for now
        $stats = [
            'total_interns' => Candidate::count(), // Assuming all candidates for now, or we could filter if there was a type
            'active_programs' => 5, // Dummy data
            'pending_applications' => 12, // Dummy data
        ];

        return view('admin.campus-bird.index', compact('stats'));
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
        InternshipFormSubmission::create([
            'internship_form_id' => $form->id,
            'applicant_name' => $request->applicant_name,
            'applicant_email' => $request->applicant_email,
            'applicant_phone' => $request->applicant_phone,
            'status' => 'pending',
            'form_data' => $formData,
        ]);

        return redirect()->route('services.campus-bird')->with('success', 'Your application has been submitted successfully!');
    }
}
