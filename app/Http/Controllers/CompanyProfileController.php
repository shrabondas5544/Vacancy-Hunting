<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;

class CompanyProfileController extends Controller
{
    /**
     * Show the public company profile
     */
    public function show($id)
    {
        $employer = Employer::with('user')->findOrFail($id);
        
        return view('company.profile', compact('employer'));
    }
}
