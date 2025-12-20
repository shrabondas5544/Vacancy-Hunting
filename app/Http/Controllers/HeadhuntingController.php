<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
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
        ];

        return view('admin.headhunting.index', compact('stats'));
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
    public function show($id)
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
    public function updatePassword(Request $request, $id)
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
    public function destroy($id)
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
}
