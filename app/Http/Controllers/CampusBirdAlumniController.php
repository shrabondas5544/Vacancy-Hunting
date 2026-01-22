<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class CampusBirdAlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('program', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $alumnis = $query->latest()->paginate(10);
        return view('admin.campus-bird.alumni.index', compact('alumnis'));
    }

    public function export(Request $request)
    {
        $search = $request->search;
        $query = Alumni::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('program', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $alumnis = $query->latest()->get();

        $filename = 'campus_bird_alumni_' . date('Y-m-d') . '.xlsx';

        $data = [
            [
                'Name', 'Program', 'Category', 'Year', 'Division', 
                'Email', 'Phone', 'Date of Birth', 'Address', 
                'School', 'College', 'University',
                'Facebook', 'Instagram', 'LinkedIn', 'Twitter',
                'Description'
            ]
        ];

        foreach ($alumnis as $alumni) {
            $data[] = [
                $alumni->name,
                $alumni->program,
                $alumni->category,
                $alumni->year,
                $alumni->division,
                $alumni->email,
                $alumni->phone,
                $alumni->dob->format('Y-m-d'),
                $alumni->address,
                $alumni->school,
                $alumni->college,
                $alumni->university,
                $alumni->facebook,
                $alumni->instagram,
                $alumni->linkedin,
                $alumni->twitter,
                $alumni->description
            ];
        }

        return response()->streamDownload(function() use ($data) {
            $xlsx = \Shuchkin\SimpleXLSXGen::fromArray($data);
            echo $xlsx;
        }, $filename);
    }

    public function create()
    {
        return view('admin.campus-bird.alumni.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program' => 'required|string',
            'category' => 'required|string',
            'year' => 'required|string',
            'name' => 'required|string',
            'dob' => 'required|date',
            'address' => 'required|string',
            'division' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'school' => 'nullable|string',
            'college' => 'nullable|string',
            'university' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'twitter' => 'nullable|string',
            'photo' => 'required|image|max:2048',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/alumni'), $filename);
            $validated['photo'] = 'assets/images/alumni/' . $filename;
        }

        Alumni::create($validated);

        return redirect()->route('admin.campus-bird.alumnis.index')
            ->with('success', 'Alumni created successfully.');
    }

    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('admin.campus-bird.alumni.show', compact('alumni'));
    }

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('admin.campus-bird.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $validated = $request->validate([
            'program' => 'required|string',
            'category' => 'required|string',
            'year' => 'required|string',
            'name' => 'required|string',
            'dob' => 'required|date',
            'address' => 'required|string',
            'division' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'school' => 'nullable|string',
            'college' => 'nullable|string',
            'university' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'twitter' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if (file_exists(public_path($alumni->photo))) {
                unlink(public_path($alumni->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/alumni'), $filename);
            $validated['photo'] = 'assets/images/alumni/' . $filename;
        }

        $alumni->update($validated);

        return redirect()->route('admin.campus-bird.alumnis.index')
            ->with('success', 'Alumni updated successfully.');
    }

    public function destroy(Alumni $alumni)
    {
        if (file_exists(public_path($alumni->photo))) {
            unlink(public_path($alumni->photo));
        }
        
        $alumni->delete();

        return back()->with('success', 'Alumni deleted successfully.');
    }
}
