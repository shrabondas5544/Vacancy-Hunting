<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

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
     * Display the list of candidates for Campus Bird Internship.
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

        return view('admin.campus-bird.candidates', compact('candidates'));
    }

    /**
     * Display the public description page for Campus Bird Internship.
     */
    public function description()
    {
        return view('services.campus-bird');
    }
}
