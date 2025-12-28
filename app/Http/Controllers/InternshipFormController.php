<?php

namespace App\Http\Controllers;

use App\Models\InternshipForm;
use Illuminate\Http\Request;

class InternshipFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = InternshipForm::all();
        return view('admin.campus-bird.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.campus-bird.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'custom_fields' => 'nullable|array',
            'custom_fields.*.label' => 'required|string|max:255',
            'custom_fields.*.type' => 'required|string|in:text,date,radio,select,file,checkbox,textarea',
        ]);

        $customFields = [];
        
        if ($request->has('custom_fields')) {
            foreach ($request->custom_fields as $index => $fieldData) {
                $options = null;
                if (isset($fieldData['options']) && !empty($fieldData['options'])) {
                    if (is_array($fieldData['options'])) {
                        $options = $fieldData['options'];
                    } else {
                        $options = array_values(array_filter(array_map('trim', explode(',', $fieldData['options']))));
                    }
                }

                $customFields[] = [
                    'label' => $fieldData['label'],
                    'field_name' => \Illuminate\Support\Str::slug($fieldData['label']),
                    'type' => $fieldData['type'],
                    'options' => $options,
                    'is_required' => isset($fieldData['is_required']) ? filter_var($fieldData['is_required'], FILTER_VALIDATE_BOOLEAN) : false,
                ];
            }
        }

        InternshipForm::create([
            'title' => $request->title,
            'department' => $request->department,
            'is_active' => true,
            'custom_fields' => $customFields,
        ]);

        return redirect()->route('admin.campus-bird.forms.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource for preview.
     */
    public function show(InternshipForm $form)
    {
        return view('admin.campus-bird.forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InternshipForm $form)
    {
        return view('admin.campus-bird.forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternshipForm $form)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'custom_fields' => 'nullable|array',
            'custom_fields.*.label' => 'required|string|max:255',
            'custom_fields.*.type' => 'required|string|in:text,date,radio,select,file,checkbox,textarea',
        ]);

        $customFields = [];
        
        if ($request->has('custom_fields')) {
            foreach ($request->custom_fields as $index => $fieldData) {
                $options = null;
                if (isset($fieldData['options']) && !empty($fieldData['options'])) {
                    if (is_array($fieldData['options'])) {
                        $options = $fieldData['options'];
                    } else {
                        $options = array_values(array_filter(array_map('trim', explode(',', $fieldData['options']))));
                    }
                }

                $customFields[] = [
                    'label' => $fieldData['label'],
                    'field_name' => \Illuminate\Support\Str::slug($fieldData['label']),
                    'type' => $fieldData['type'],
                    'options' => $options,
                    'is_required' => isset($fieldData['is_required']) ? filter_var($fieldData['is_required'], FILTER_VALIDATE_BOOLEAN) : false,
                ];
            }
        }

        $form->update([
            'title' => $request->title,
            'department' => $request->department,
            'custom_fields' => $customFields,
        ]);

        return redirect()->route('admin.campus-bird.forms.index')->with('success', 'Form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternshipForm $form)
    {
        $form->delete();
        return redirect()->route('admin.campus-bird.forms.index')->with('success', 'Form deleted successfully.');
    }

    /**
     * Toggle the active status of the form.
     */
    public function toggle(InternshipForm $form)
    {
        // If activating this form, deactivate all other forms in the same department
        if (!$form->is_active) {
            InternshipForm::where('department', $form->department)
                ->where('id', '!=', $form->id)
                ->update(['is_active' => false]);
        }
        
        $form->is_active = !$form->is_active;
        $form->save();
        
        return redirect()->back()->with('success', 'Form status updated.');
    }
}
