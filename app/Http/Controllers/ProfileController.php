<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Show Profile
    public function show()
    {
        $user = Auth::user();
        
        if ($user->isCandidate()) {
            $candidate = $user->candidate()->with([
                'education',
                'experience',
                'certifications',
                'portfolio',
                'languages',
                'references'
            ])->first();
            return view('profile.candidate', compact('candidate', 'user'));
        } elseif ($user->isEmployer()) {
            $employer = $user->employer()->with(['locations', 'teamMembers', 'media'])->first();
            return view('profile.employer', compact('employer'));
        }
        
        return redirect('/dashboard');
    }

    // Show Edit Form
    public function edit()
    {
        $user = Auth::user();
        
        if ($user->isCandidate()) {
            $candidate = $user->candidate()->with([
                'education',
                'experience',
                'certifications',
                'portfolio',
                'languages',
                'references'
            ])->first();
            return view('profile.candidate-edit', compact('candidate', 'user'));
        } elseif ($user->isEmployer()) {
            $employer = $user->employer;
            return view('profile.employer-edit', compact('employer', 'user'));
        }
        
        return redirect('/dashboard');
    }

    // Update Profile
    public function update(Request $request)
    {
        $user = Auth::user();
        
        if ($user->isCandidate()) {
            $request->validate([
                // Basic fields
                'name' => 'required|string|max:255',
                'experience_years' => 'nullable|integer|min:0',
                'skills' => 'nullable|string',
                'interested_in' => 'nullable|array',
                // New personal fields
                'professional_summary' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'street' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'zip_code' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|string|max:50',
                'pronouns' => 'nullable|string|max:50',
                // Social links
                'linkedin_url' => 'nullable|url|max:255',
                'github_url' => 'nullable|url|max:255',
                'portfolio_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'facebook_url' => 'nullable|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                // File uploads
                'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
                'hero_banner' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
                // Education
                'education' => 'nullable|array',
                'education.*.degree' => 'nullable|string|max:255',
                'education.*.institution' => 'nullable|string|max:255',
                'education.*.graduation_year' => 'nullable|integer',
                'education.*.gpa' => 'nullable|string|max:50',
                'education.*.description' => 'nullable|string',
                // Experience
                'experience' => 'nullable|array',
                'experience.*.job_title' => 'nullable|string|max:255',
                'experience.*.company_name' => 'nullable|string|max:255',
                'experience.*.start_date' => 'nullable|date',
                'experience.*.end_date' => 'nullable|date',
                'experience.*.is_current' => 'nullable|boolean',
                'experience.*.description' => 'nullable|string',
                // Certifications
                'certifications' => 'nullable|array',
                'certifications.*.certification_name' => 'nullable|string|max:255',
                'certifications.*.issuing_organization' => 'nullable|string|max:255',
                'certifications.*.issue_date' => 'nullable|date',
                'certifications.*.expiration_date' => 'nullable|date',
                'certifications.*.credential_id' => 'nullable|string|max:255',
                'certifications.*.credential_url' => 'nullable|url|max:255',
                'certifications.*.certification_type' => 'nullable|in:certification,award,honor',
                // Portfolio
                'portfolio' => 'nullable|array',
                'portfolio.*.project_name' => 'nullable|string|max:255',
                'portfolio.*.project_url' => 'nullable|url|max:255',
                'portfolio.*.description' => 'nullable|string',
                'portfolio.*.technologies' => 'nullable|string',
                'portfolio.*.thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
                // Languages
                'languages' => 'nullable|array',
                'languages.*.language' => 'nullable|string|max:255',
                'languages.*.proficiency' => 'nullable|in:basic,intermediate,fluent,native',
                // References
                'references' => 'nullable|array',
                'references.*.name' => 'nullable|string|max:255',
                'references.*.title' => 'nullable|string|max:255',
                'references.*.company' => 'nullable|string|max:255',
                'references.*.email' => 'nullable|email|max:255',
                'references.*.phone' => 'nullable|string|max:20',
                'references.*.relationship' => 'nullable|string|max:255',
            ]);
            
            $updateData = [
                'name' => $request->name,
                'experience_years' => $request->experience_years,
                'skills' => $request->skills,
                'interested_in' => $request->interested_in,
                'professional_summary' => $request->professional_summary,
                'phone' => $request->phone,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'pronouns' => $request->pronouns,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'portfolio_url' => $request->portfolio_url,
                'twitter_url' => $request->twitter_url,
                'facebook_url' => $request->facebook_url,
                'instagram_url' => $request->instagram_url,
            ];

            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = 'candidate_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('candidate_profiles', $filename, 'public');
                
                if ($user->candidate->profile_picture) {
                    Storage::disk('public')->delete($user->candidate->profile_picture);
                }
                
                $updateData['profile_picture'] = $path;
            }

            // Handle hero banner upload
            if ($request->hasFile('hero_banner')) {
                $file = $request->file('hero_banner');
                 $filename = 'banner_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('candidate_banners', $filename, 'public');
                
                if ($user->candidate->hero_banner) {
                    Storage::disk('public')->delete($user->candidate->hero_banner);
                }
                
                $updateData['hero_banner'] = $path;
            }

            // Handle education
            if ($request->has('education')) {
                $existingEducationIds = [];
                foreach ($request->education as $index => $eduData) {
                    if (!empty($eduData['degree'])) {
                        if (!empty($eduData['id'])) {
                            // Update existing
                            $education = $user->candidate->education()->find($eduData['id']);
                            if ($education) {
                                $education->update([
                                    'degree' => $eduData['degree'],
                                    'institution' => $eduData['institution'] ?? null,
                                    'graduation_year' => $eduData['graduation_year'] ?? null,
                                    'gpa' => $eduData['gpa'] ?? null,
                                    'description' => $eduData['description'] ?? null,
                                    'display_order' => $index,
                                ]);
                                $existingEducationIds[] = $education->id;
                            }
                        } else {
                            // Create new
                            $education = $user->candidate->education()->create([
                                'degree' => $eduData['degree'],
                                'institution' => $eduData['institution'] ?? null,
                                'graduation_year' => $eduData['graduation_year'] ?? null,
                                'gpa' => $eduData['gpa'] ?? null,
                                'description' => $eduData['description'] ?? null,
                                'display_order' => $index,
                            ]);
                            $existingEducationIds[] = $education->id;
                        }
                    }
                }
                $user->candidate->education()->whereNotIn('id', $existingEducationIds)->delete();
            }

            // Handle experience
            if ($request->has('experience')) {
                $existingExperienceIds = [];
                foreach ($request->experience as $index => $expData) {
                    if (!empty($expData['job_title'])) {
                        if (!empty($expData['id'])) {
                            // Update existing
                            $experience = $user->candidate->experience()->find($expData['id']);
                            if ($experience) {
                                $experience->update([
                                    'job_title' => $expData['job_title'],
                                    'company_name' => $expData['company_name'] ?? null,
                                    'start_date' => $expData['start_date'] ?? null,
                                    'end_date' => $expData['end_date'] ?? null,
                                    'is_current' => isset($expData['is_current']) ? true : false,
                                    'description' => $expData['description'] ?? null,
                                    'display_order' => $index,
                                ]);
                                $existingExperienceIds[] = $experience->id;
                            }
                        } else {
                            // Create new
                            $experience = $user->candidate->experience()->create([
                                'job_title' => $expData['job_title'],
                                'company_name' => $expData['company_name'] ?? null,
                                'start_date' => $expData['start_date'] ?? null,
                                'end_date' => $expData['end_date'] ?? null,
                                'is_current' => isset($expData['is_current']) ? true : false,
                                'description' => $expData['description'] ?? null,
                                'display_order' => $index,
                            ]);
                            $existingExperienceIds[] = $experience->id;
                        }
                    }
                }
                $user->candidate->experience()->whereNotIn('id', $existingExperienceIds)->delete();
            }

            // Handle certifications
            if ($request->has('certifications')) {
                $existingCertIds = [];
                foreach ($request->certifications as $index => $certData) {
                    if (!empty($certData['certification_name'])) {
                        if (!empty($certData['id'])) {
                            // Update existing
                            $cert = $user->candidate->certifications()->find($certData['id']);
                            if ($cert) {
                                $cert->update([
                                    'certification_name' => $certData['certification_name'],
                                    'issuing_organization' => $certData['issuing_organization'] ?? null,
                                    'issue_date' => $certData['issue_date'] ?? null,
                                    'expiration_date' => $certData['expiration_date'] ?? null,
                                    'credential_id' => $certData['credential_id'] ?? null,
                                    'credential_url' => $certData['credential_url'] ?? null,
                                    'certification_type' => $certData['certification_type'] ?? 'certification',
                                    'display_order' => $index,
                                ]);
                                $existingCertIds[] = $cert->id;
                            }
                        } else {
                            // Create new
                            $cert = $user->candidate->certifications()->create([
                                'certification_name' => $certData['certification_name'],
                                'issuing_organization' => $certData['issuing_organization'] ?? null,
                                'issue_date' => $certData['issue_date'] ?? null,
                                'expiration_date' => $certData['expiration_date'] ?? null,
                                'credential_id' => $certData['credential_id'] ?? null,
                                'credential_url' => $certData['credential_url'] ?? null,
                                'certification_type' => $certData['certification_type'] ?? 'certification',
                                'display_order' => $index,
                            ]);
                            $existingCertIds[] = $cert->id;
                        }
                    }
                }
                $user->candidate->certifications()->whereNotIn('id', $existingCertIds)->delete();
            }

            // Handle portfolio
            if ($request->has('portfolio')) {
                $existingPortfolioIds = [];
                foreach ($request->portfolio as $index => $portData) {
                    if (!empty($portData['project_name'])) {
                        $thumbnailPath = null;
                        
                        // Handle thumbnail upload
                        if (isset($request->file('portfolio')[$index]['thumbnail'])) {
                            $file = $request->file('portfolio')[$index]['thumbnail'];
                            $filename = 'portfolio_' . $user->id . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $thumbnailPath = $file->storeAs('portfolio_thumbnails', $filename, 'public');
                        }
                        
                        if (!empty($portData['id'])) {
                            // Update existing
                            $portfolio = $user->candidate->portfolio()->find($portData['id']);
                            if ($portfolio) {
                                $portUpdateData = [
                                    'project_name' => $portData['project_name'],
                                    'project_url' => $portData['project_url'] ?? null,
                                    'description' => $portData['description'] ?? null,
                                    'technologies' => $portData['technologies'] ?? null,
                                    'display_order' => $index,
                                ];
                                
                                if ($thumbnailPath) {
                                    if ($portfolio->thumbnail) {
                                        Storage::disk('public')->delete($portfolio->thumbnail);
                                    }
                                    $portUpdateData['thumbnail'] = $thumbnailPath;
                                }
                                
                                $portfolio->update($portUpdateData);
                                $existingPortfolioIds[] = $portfolio->id;
                            }
                        } else {
                            // Create new
                            $portfolio = $user->candidate->portfolio()->create([
                                'project_name' => $portData['project_name'],
                                'project_url' => $portData['project_url'] ?? null,
                                'description' => $portData['description'] ?? null,
                                'technologies' => $portData['technologies'] ?? null,
                                'thumbnail' => $thumbnailPath,
                                'display_order' => $index,
                            ]);
                            $existingPortfolioIds[] = $portfolio->id;
                        }
                    }
                }
                // Delete removed portfolio items
                $deletedPortfolio = $user->candidate->portfolio()->whereNotIn('id', $existingPortfolioIds)->get();
                foreach ($deletedPortfolio as $item) {
                    if ($item->thumbnail) {
                        Storage::disk('public')->delete($item->thumbnail);
                    }
                    $item->delete();
                }
            }

            // Handle languages
            if ($request->has('languages')) {
                $existingLanguageIds = [];
                foreach ($request->languages as $index => $langData) {
                    if (!empty($langData['language'])) {
                        if (!empty($langData['id'])) {
                            // Update existing
                            $language = $user->candidate->languages()->find($langData['id']);
                            if ($language) {
                                $language->update([
                                    'language' => $langData['language'],
                                    'proficiency' => $langData['proficiency'] ?? 'intermediate',
                                    'display_order' => $index,
                                ]);
                                $existingLanguageIds[] = $language->id;
                            }
                        } else {
                            // Create new
                            $language = $user->candidate->languages()->create([
                                'language' => $langData['language'],
                                'proficiency' => $langData['proficiency'] ?? 'intermediate',
                                'display_order' => $index,
                            ]);
                            $existingLanguageIds[] = $language->id;
                        }
                    }
                }
                $user->candidate->languages()->whereNotIn('id', $existingLanguageIds)->delete();
            }

            // Handle references
            if ($request->has('references')) {
                $existingReferenceIds = [];
                foreach ($request->references as $index => $refData) {
                    if (!empty($refData['name'])) {
                        if (!empty($refData['id'])) {
                            // Update existing
                            $reference = $user->candidate->references()->find($refData['id']);
                            if ($reference) {
                                $reference->update([
                                    'name' => $refData['name'],
                                    'title' => $refData['title'] ?? null,
                                    'company' => $refData['company'] ?? null,
                                    'email' => $refData['email'] ?? null,
                                    'phone' => $refData['phone'] ?? null,
                                    'relationship' => $refData['relationship'] ?? null,
                                    'display_order' => $index,
                                ]);
                                $existingReferenceIds[] = $reference->id;
                            }
                        } else {
                            // Create new
                            $reference = $user->candidate->references()->create([
                                'name' => $refData['name'],
                                'title' => $refData['title'] ?? null,
                                'company' => $refData['company'] ?? null,
                                'email' => $refData['email'] ?? null,
                                'phone' => $refData['phone'] ?? null,
                                'relationship' => $refData['relationship'] ?? null,
                                'display_order' => $index,
                            ]);
                            $existingReferenceIds[] = $reference->id;
                        }
                    }
                }
                $user->candidate->references()->whereNotIn('id', $existingReferenceIds)->delete();
            }
            
            $user->candidate->update($updateData);
            
        } elseif ($user->isEmployer()) {
            $request->validate([
                'company_name' => 'required|string|max:255',
                'company_type' => 'required|string',
                'contact_number' => 'required|string',
                'company_description' => 'nullable|string',
                'establishment_year' => 'nullable|integer|min:1800|max:' . date('Y'),
                'company_ownership' => ['nullable', Rule::in(['private', 'public'])],
                'employee_count' => ['nullable', Rule::in(['1-20', '20-50', '50-100', '100-300', '300-1000', '1000+'])],
                'company_address' => 'nullable|string',
                'trade_license_no' => 'nullable|string|max:255',
                'website_url' => 'nullable|url|max:255',
                // Address fields
                'street' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'zip_code' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:255',
                // Social media
                'linkedin_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'facebook_url' => 'nullable|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                'youtube_url' => 'nullable|url|max:255',
                // About company
                'mission_statement' => 'nullable|string',
                'vision_statement' => 'nullable|string',
                'company_values' => 'nullable|array',
                'company_values.*' => 'nullable|string|max:255',
                'products_services' => 'nullable|string',
                'company_history' => 'nullable|array',
                'company_history.*.year' => 'nullable|integer|min:1800|max:' . date('Y'),
                'company_history.*.event' => 'nullable|string|max:500',
                'employee_benefits' => 'nullable|array',
                'employee_benefits.*' => 'nullable|string|max:255',
                // File uploads
                'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
                'hero_banner' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120', // 5MB max
                // Media gallery
                'media_gallery' => 'nullable|array',
                'media_gallery.*' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
                // Locations
                'locations' => 'nullable|array',
                'locations.*.location_name' => 'nullable|string|max:255',
                'locations.*.street' => 'nullable|string|max:255',
                'locations.*.city' => 'nullable|string|max:255',
                'locations.*.state' => 'nullable|string|max:255',
                'locations.*.zip_code' => 'nullable|string|max:20',
                'locations.*.country' => 'nullable|string|max:255',
                'locations.*.is_primary' => 'nullable|boolean',
                // Team members
                'team_members' => 'nullable|array',
                'team_members.*.name' => 'nullable|string|max:255',
                'team_members.*.title' => 'nullable|string|max:255',
                'team_members.*.bio' => 'nullable|string',
                'team_members.*.photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            ]);
            
            $updateData = [
                'company_name' => $request->company_name,
                'company_type' => $request->company_type,
                'contact_number' => $request->contact_number,
                'company_description' => $request->company_description,
                'establishment_year' => $request->establishment_year,
                'company_ownership' => $request->company_ownership,
                'employee_count' => $request->employee_count,
                'company_address' => $request->company_address,
                'trade_license_no' => $request->trade_license_no,
                'website_url' => $request->website_url,
                // Address
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                // Social media
                'linkedin_url' => $request->linkedin_url,
                'twitter_url' => $request->twitter_url,
                'facebook_url' => $request->facebook_url,
                'instagram_url' => $request->instagram_url,
                'youtube_url' => $request->youtube_url,
                // About
                'mission_statement' => $request->mission_statement,
                'vision_statement' => $request->vision_statement,
                'company_values' => $request->company_values ? array_filter($request->company_values) : null,
                'products_services' => $request->products_services,
                'company_history' => $request->company_history ? array_filter($request->company_history, function($item) {
                    return !empty($item['year']) || !empty($item['event']);
                }) : null,
                'employee_benefits' => $request->employee_benefits,
            ];
            
            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = 'logo_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('employer_logos', $filename, 'public');
                
                // Delete old logo if exists
                if ($user->employer->profile_picture) {
                    Storage::disk('public')->delete($user->employer->profile_picture);
                }
                
                $updateData['profile_picture'] = $path;
            }
            
            // Handle hero banner upload
            if ($request->hasFile('hero_banner')) {
                $file = $request->file('hero_banner');
                $filename = 'banner_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('employer_banners', $filename, 'public');
                
                // Delete old banner if exists
                if ($user->employer->hero_banner) {
                    Storage::disk('public')->delete($user->employer->hero_banner);
                }
                
                $updateData['hero_banner'] = $path;
            }
            
            \Log::info('Employer Update Data:', $updateData);
            
            // Handle media gallery uploads
            if ($request->hasFile('media_gallery')) {
                $mediaFiles = $request->file('media_gallery');
                $displayOrder = $user->employer->media()->max('display_order') ?? 0;
                
                foreach ($mediaFiles as $file) {
                    $filename = 'media_' . $user->id . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('employer_media', $filename, 'public');
                    
                    $displayOrder++;
                    $user->employer->media()->create([
                        'media_type' => 'photo',
                        'file_path' => $path,
                        'display_order' => $displayOrder,
                    ]);
                }
            }
            
            // Handle locations
            if ($request->has('locations')) {
                $existingLocationIds = [];
                foreach ($request->locations as $index => $locationData) {
                    if (!empty($locationData['location_name'])) {
                        if (!empty($locationData['id'])) {
                            // Update existing location
                            $location = $user->employer->locations()->find($locationData['id']);
                            if ($location) {
                                $location->update([
                                    'location_name' => $locationData['location_name'],
                                    'street' => $locationData['street'] ?? null,
                                    'city' => $locationData['city'] ?? null,
                                    'state' => $locationData['state'] ?? null,
                                    'zip_code' => $locationData['zip_code'] ?? null,
                                    'country' => $locationData['country'] ?? null,
                                    'is_primary' => isset($locationData['is_primary']) ? true : false,
                                    'display_order' => $index,
                                ]);
                                $existingLocationIds[] = $location->id;
                            }
                        } else {
                            // Create new location
                            $location = $user->employer->locations()->create([
                                'location_name' => $locationData['location_name'],
                                'street' => $locationData['street'] ?? null,
                                'city' => $locationData['city'] ?? null,
                                'state' => $locationData['state'] ?? null,
                                'zip_code' => $locationData['zip_code'] ?? null,
                                'country' => $locationData['country'] ?? null,
                                'is_primary' => isset($locationData['is_primary']) ? true : false,
                                'display_order' => $index,
                            ]);
                            $existingLocationIds[] = $location->id;
                        }
                    }
                }
                // Delete removed locations
                $user->employer->locations()->whereNotIn('id', $existingLocationIds)->delete();
            }
            
            // Handle team members
            if ($request->has('team_members')) {
                $existingMemberIds = [];
                foreach ($request->team_members as $index => $memberData) {
                    if (!empty($memberData['name'])) {
                        $photoPath = null;
                        
                        // Handle photo upload
                        if (isset($request->file('team_members')[$index]['photo'])) {
                            $file = $request->file('team_members')[$index]['photo'];
                            $filename = 'team_' . $user->id . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $photoPath = $file->storeAs('team_members', $filename, 'public');
                        }
                        
                        if (!empty($memberData['id'])) {
                            // Update existing member
                            $member = $user->employer->teamMembers()->find($memberData['id']);
                            if ($member) {
                                $memberUpdateData = [
                                    'name' => $memberData['name'],
                                    'title' => $memberData['title'] ?? null,
                                    'bio' => $memberData['bio'] ?? null,
                                    'display_order' => $index,
                                ];
                                
                                if ($photoPath) {
                                    // Delete old photo
                                    if ($member->photo) {
                                        Storage::disk('public')->delete($member->photo);
                                    }
                                    $memberUpdateData['photo'] = $photoPath;
                                }
                                
                                $member->update($memberUpdateData);
                                $existingMemberIds[] = $member->id;
                            }
                        } else {
                            // Create new member
                            $member = $user->employer->teamMembers()->create([
                                'name' => $memberData['name'],
                                'title' => $memberData['title'] ?? null,
                                'bio' => $memberData['bio'] ?? null,
                                'photo' => $photoPath,
                                'display_order' => $index,
                            ]);
                            $existingMemberIds[] = $member->id;
                        }
                    }
                }
                // Delete removed team members  
                $deletedMembers = $user->employer->teamMembers()->whereNotIn('id', $existingMemberIds)->get();
                foreach ($deletedMembers as $member) {
                    if ($member->photo) {
                        Storage::disk('public')->delete($member->photo);
                    }
                    $member->delete();
                }
            }
            
            \Log::info('About to update employer with data:', $updateData);
            $result = $user->employer->update($updateData);
            \Log::info('Employer update result:', ['success' => $result, 'profile_picture' => $user->employer->fresh()->profile_picture]);
        }
        
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    // Update Profile Picture
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048', // Max 2MB
        ]);
        
        $user = Auth::user();
        
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            
            // Generate unique filename
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Store in public disk
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            
            // Update profile picture for the appropriate role
            if ($user->isCandidate()) {
                // Delete old profile picture if exists
                if ($user->candidate->profile_picture) {
                    Storage::disk('public')->delete($user->candidate->profile_picture);
                }
                $user->candidate->update(['profile_picture' => $path]);
            } elseif ($user->isEmployer()) {
                // Delete old profile picture if exists
                if ($user->employer->profile_picture) {
                    Storage::disk('public')->delete($user->employer->profile_picture);
                }
                $user->employer->update(['profile_picture' => $path]);
            }
            
            return back()->with('success', 'Profile picture updated successfully!');
        }
        
        return back()->with('error', 'No file uploaded.');
    }
}
