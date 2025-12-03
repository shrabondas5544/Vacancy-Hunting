<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile - {{ config('app.name') }}</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --border-color: #334155;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --accent-primary: #3b82f6;
            --accent-hover: #2563eb;
            --accent-light: rgba(59, 130, 246, 0.1);
            --success: #10b981;
            --error: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #0f172a; /* Deep Navy Base */
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
                radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
            background-attachment: fixed;
            background-size: cover;
            color: var(--text-primary);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 16px;
        }

        .section-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--border-color);
        }

        .section-header i {
            color: var(--accent-primary);
            font-size: 22px;
        }

        .section-header h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 12px 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .form-hint {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .error-message {
            color: var(--error);
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-area:hover {
            border-color: var(--accent-primary);
            background: var(--accent-light);
        }

        .file-upload-area input[type="file"] {
            display: none;
        }

        .file-upload-area i {
            font-size: 48px;
            color: var(--accent-primary);
            margin-bottom: 12px;
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 12px;
            border: 1px solid var(--border-color);
        }

        .dynamic-item {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .dynamic-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .add-btn, .remove-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .add-btn {
            background: var(--accent-primary);
            color: white;
        }

        .add-btn:hover {
            background: var(--accent-hover);
        }

        .remove-btn {
            background: var(--error);
            color: white;
        }

        .remove-btn:hover {
            background: #dc2626;
        }

        .btn {
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: var(--accent-primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--bg-card);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: var(--bg-primary);
        }

        .form-actions {
            position: sticky;
            bottom: 0;
            background: var(--bg-primary);
            padding: 20px 0;
            border-top: 2px solid var(--border-color);
            display: flex;
            gap: 16px;
            margin-top: 30px;
        }

        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-item label {
            cursor: pointer;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-user-edit"></i> Edit Your Profile</h1>
            <p class="page-subtitle">Update your professional information to attract employers</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- Profile Pictures -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-image"></i>
                    <h2>Profile Images</h2>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Profile Picture</label>
                    <div class="file-upload-area" onclick="document.getElementById('profilePictureInput').click()">
                        <i class="fas fa-user-circle"></i>
                        <div><strong>Click to upload</strong><br><small>Max 2MB</small></div>
                        <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" onchange="previewImage(event, 'profilePreview')">
                    </div>
                    <img id="profilePreview" src="{{ $candidate->profile_picture ? asset('storage/' . $candidate->profile_picture) : '' }}" class="image-preview" style="display: {{ $candidate->profile_picture ? 'block' : 'none' }}">
                </div>
            </div>

            <!-- Personal Information -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-id-card"></i>
                    <h2>Personal Information</h2>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $candidate->name) }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-input" value="{{ old('phone', $candidate->phone) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-input" value="{{ old('date_of_birth', $candidate->date_of_birth ? $candidate->date_of_birth->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select...</option>
                        <option value="Male" {{ old('gender', $candidate->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $candidate->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $candidate->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        <option value="Prefer not to say" {{ old('gender', $candidate->gender) == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Street Address</label>
                    <input type="text" name="street" class="form-input" value="{{ old('street', $candidate->street) }}">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-input" value="{{ old('city', $candidate->city) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">State/Province</label>
                        <input type="text" name="state" class="form-input" value="{{ old('state', $candidate->state) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">ZIP/Postal Code</label>
                        <input type="text" name="zip_code" class="form-input" value="{{ old('zip_code', $candidate->zip_code) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-input" value="{{ old('country', $candidate->country) }}">
                    </div>
                </div>
            </div>

            <!-- Professional Summary -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-align-left"></i>
                    <h2>Professional Summary</h2>
                </div>
                
                <div class="form-group">
                    <label class="form-label">About Me</label>
                    <textarea name="professional_summary" class="form-textarea" placeholder="Write a brief summary about your professional background and goals...">{{ old('professional_summary', $candidate->professional_summary) }}</textarea>
                    <div class="form-hint">This appears at the top of your profile</div>
                </div>
            </div>

            <!-- Skills & Experience -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-code"></i>
                    <h2>Skills & Experience</h2>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Skills</label>
                    <textarea name="skills" class="form-textarea" style="min-height: 80px;" placeholder="e.g., PHP, Laravel, JavaScript, React, MySQL">{{ old('skills', $candidate->skills) }}</textarea>
                    <div class="form-hint">Separate skills with commas</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Years of Experience</label>
                    <input type="number" name="experience_years" class="form-input" value="{{ old('experience_years', $candidate->experience_years) }}" min="0">
                </div>
            </div>

            <!-- Social Links -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-link"></i>
                    <h2>Professional & Social Links</h2>
                </div>
                
                <div class="form-group">
                    <label class="form-label"><i class="fab fa-linkedin"></i> LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="form-input" value="{{ old('linkedin_url', $candidate->linkedin_url) }}" placeholder="https://linkedin.com/in/yourprofile">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fab fa-github"></i> GitHub URL</label>
                    <input type="url" name="github_url" class="form-input" value="{{ old('github_url', $candidate->github_url) }}" placeholder="https://github.com/yourusername">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-globe"></i> Portfolio Website</label>
                    <input type="url" name="portfolio_url" class="form-input" value="{{ old('portfolio_url', $candidate->portfolio_url) }}" placeholder="https://yourportfolio.com">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-twitter"></i> Twitter/X URL</label>
                        <input type="url" name="twitter_url" class="form-input" value="{{ old('twitter_url', $candidate->twitter_url) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-facebook"></i> Facebook URL</label>
                        <input type="url" name="facebook_url" class="form-input" value="{{ old('facebook_url', $candidate->facebook_url) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fab fa-instagram"></i> Instagram URL</label>
                    <input type="url" name="instagram_url" class="form-input" value="{{ old('instagram_url', $candidate->instagram_url) }}">
                </div>
            </div>


            <!-- Work Experience -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-briefcase"></i>
                    <h2>Work Experience</h2>
                </div>
                
                <div id="experienceList">
                    @php
                        $experiences = old('experience', $candidate->experience ?? []);
                    @endphp
                    @forelse($experiences as $index => $exp)
                        <div class="dynamic-item">
                            <input type="hidden" name="experience[{{ $index }}][id]" value="{{ $exp->id ?? '' }}">
                            <div class="dynamic-item-header">
                                <strong style="color: var(--accent-primary);">Experience #{{ $index + 1 }}</strong>
                                <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Job Title</label>
                                <input type="text" name="experience[{{ $index }}][job_title]" class="form-input" value="{{ $exp->job_title ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="experience[{{ $index }}][company_name]" class="form-input" value="{{ $exp->company_name ?? '' }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="experience[{{ $index }}][start_date]" class="form-input" value="{{ $exp->start_date ? $exp->start_date->format('Y-m-d') : '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="experience[{{ $index }}][end_date]" class="form-input" value="{{ $exp->end_date ? $exp->end_date->format('Y-m-d') : '' }}">
                                </div>
                            </div>
                            <div class="checkbox-item" style="margin-bottom: 12px;">
                                <input type="checkbox" id="current_{{ $index }}" name="experience[{{ $index }}][is_current]" value="1" {{ ($exp->is_current ?? false) ? 'checked' : '' }}>
                                <label for="current_{{ $index }}">I currently work here</label>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="experience[{{ $index }}][description]" class="form-textarea">{{ $exp->description ?? '' }}</textarea>
                            </div>
                        </div>
                    @empty
                        <div class="dynamic-item">
                            <div class="dynamic-item-header">
                                <strong style="color: var(--accent-primary);">Experience #1</strong>
                                <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Job Title</label>
                                <input type="text" name="experience[0][job_title]" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="experience[0][company_name]" class="form-input">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="experience[0][start_date]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="experience[0][end_date]" class="form-input">
                                </div>
                            </div>
                            <div class="checkbox-item" style="margin-bottom: 12px;">
                                <input type="checkbox" id="current_0" name="experience[0][is_current]" value="1">
                                <label for="current_0">I currently work here</label>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="experience[0][description]" class="form-textarea"></textarea>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="add-btn" onclick="addExperience()">
                    <i class="fas fa-plus"></i> Add Experience
                </button>
            </div>

            <!-- Education -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-graduation-cap"></i>
                    <h2>Education</h2>
                </div>
                
                <div id="educationList">
                    @php
                        $educations = old('education', $candidate->education ?? []);
                    @endphp
                    @forelse($educations as $index => $edu)
                        <div class="dynamic-item">
                            <input type="hidden" name="education[{{ $index }}][id]" value="{{ $edu->id ?? '' }}">
                            <div class="dynamic-item-header">
                                <strong style="color: var(--accent-primary);">Education #{{ $index + 1 }}</strong>
                                <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Degree</label>
                                <input type="text" name="education[{{ $index }}][degree]" class="form-input" value="{{ $edu->degree ?? '' }}" placeholder="e.g., Bachelor's in Computer Science">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Institution</label>
                                <input type="text" name="education[{{ $index }}][institution]" class="form-input" value="{{ $edu->institution ?? '' }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Graduation Year</label>
                                    <input type="number" name="education[{{ $index }}][graduation_year]" class="form-input" value="{{ $edu->graduation_year ?? '' }}" min="1950" max="2050">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">GPA</label>
                                    <input type="text" name="education[{{ $index }}][gpa]" class="form-input" value="{{ $edu->gpa ?? '' }}" placeholder="e.g., 3.8/4.0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="education[{{ $index }}][description]" class="form-textarea">{{ $edu->description ?? '' }}</textarea>
                            </div>
                        </div>
                    @empty
                        <div class="dynamic-item">
                            <div class="dynamic-item-header">
                                <strong style="color: var(--accent-primary);">Education #1</strong>
                                <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Degree</label>
                                <input type="text" name="education[0][degree]" class="form-input" placeholder="e.g., Bachelor's in Computer Science">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Institution</label>
                                <input type="text" name="education[0][institution]" class="form-input">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Graduation Year</label>
                                    <input type="number" name="education[0][graduation_year]" class="form-input" min="1950" max="2050">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">GPA</label>
                                    <input type="text" name="education[0][gpa]" class="form-input" placeholder="e.g., 3.8/4.0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="education[0][description]" class="form-textarea"></textarea>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="add-btn" onclick="addEducation()">
                    <i class="fas fa-plus"></i> Add Education
                </button>
            </div>

            <!-- Certifications -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-certificate"></i>
                    <h2>Certifications & Achievements</h2>
                </div>
                
                <div id="certificationsList">
                    @php
                        $certifications = old('certifications', $candidate->certifications ?? []);
                    @endphp
                    @forelse($certifications as $index => $cert)
                        <div class="dynamic-item">
                            <input type="hidden" name="certifications[{{ $index }}][id]" value="{{ $cert->id ?? '' }}">
                            <div class="dynamic-item-header">
                                <strong style="color: var(--accent-primary);">Certification #{{ $index + 1 }}</strong>
                                <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Certification Name</label>
                                <input type="text" name="certifications[{{ $index }}][certification_name]" class="form-input" value="{{ $cert->certification_name ?? '' }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Issuing Organization</label>
                                    <input type="text" name="certifications[{{ $index }}][issuing_organization]" class="form-input" value="{{ $cert->issuing_organization ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <select name="certifications[{{ $index }}][certification_type]" class="form-select">
                                        <option value="certification" {{ ($cert->certification_type ?? 'certification') == 'certification' ? 'selected' : '' }}>Certification</option>
                                        <option value="award" {{ ($cert->certification_type ?? '') == 'award' ? 'selected' : '' }}>Award</option>
                                        <option value="honor" {{ ($cert->certification_type ?? '') == 'honor' ? 'selected' : '' }}>Honor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Issue Date</label>
                                    <input type="date" name="certifications[{{ $index }}][issue_date]" class="form-input" value="{{ $cert->issue_date ? $cert->issue_date->format('Y-m-d') : '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Expiration Date</label>
                                    <input type="date" name="certifications[{{ $index }}][expiration_date]" class="form-input" value="{{ $cert->expiration_date ? $cert->expiration_date->format('Y-m-d') : '' }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Credential ID</label>
                                    <input type="text" name="certifications[{{ $index }}][credential_id]" class="form-input" value="{{ $cert->credential_id ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Credential URL</label>
                                    <input type="url" name="certifications[{{ $index }}][credential_url]" class="form-input" value="{{ $cert->credential_url ?? '' }}">
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--text-muted); text-align: center; padding: 20px;">No certifications added yet. Click "Add Certification" to get started!</p>
                    @endforelse
                </div>
                <button type="button" class="add-btn" onclick="addCertification()">
                    <i class="fas fa-plus"></i> Add Certification
                </button>
            </div>

            <!-- Portfolio -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-folder-open"></i>
                    <h2>Portfolio & Projects</h2>
                </div>
                
                <div id="portfolioList">
                    @php
                        $portfolio = old('portfolio', $candidate->portfolio ?? []);
                    @endphp
                    @forelse($portfolio as $index => $proj)
                        <div class="dynamic-item">
                            <input type="hidden" name="portfolio[{{ $index }}][id]" value="{{ $proj->id ?? '' }}">
                            <div class="dynamic-item-header">
                                <strong style="color: var(--accent-primary);">Project #{{ $index + 1 }}</strong>
                                <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="form group">
                                <label class="form-label">Project Name</label>
                                <input type="text" name="portfolio[{{ $index }}][project_name]" class="form-input" value="{{ $proj->project_name ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Project URL</label>
                                <input type="url" name="portfolio[{{ $index }}][project_url]" class="form-input" value="{{ $proj->project_url ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="portfolio[{{ $index }}][description]" class="form-textarea">{{ $proj->description ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Technologies Used</label>
                                <input type="text" name="portfolio[{{ $index }}][technologies]" class="form-input" value="{{ $proj->technologies ?? '' }}" placeholder="e.g., Laravel, Vue.js, MySQL">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Thumbnail Image</label>
                                <input type="file" name="portfolio[{{ $index }}][thumbnail]" class="form-input" accept="image/*">
                                @if(isset($proj->thumbnail))
                                    <img src="{{ asset('storage/' . $proj->thumbnail) }}" class="image-preview" style="display: block; margin-top: 10px;">
                                @endif
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--text-muted); text-align: center; padding: 20px;">No projects added yet. Click "Add Project" to showcase your work!</p>
                    @endforelse
                </div>
                <button type="button" class="add-btn" onclick="addPortfolio()">
                    <i class="fas fa-plus"></i> Add Project
                </button>
            </div>

            <!-- Languages -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-language"></i>
                    <h2>Languages</h2>
                </div>
                
                <div id="languagesList">
                    @php
                        $languages = old('languages', $candidate->languages ?? []);
                    @endphp
                    @forelse($languages as $index => $lang)
                        <div class="dynamic-item">
                            <input type="hidden" name="languages[{{ $index }}][id]" value="{{ $lang->id ?? '' }}">
                            <div class="dynamic-item-header">
                                <strong style="color: var(--accent-primary);">Language #{{ $index + 1 }}</strong>
                                <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Language</label>
                                    <input type="text" name="languages[{{ $index }}][language]" class="form-input" value="{{ $lang->language ?? '' }}" placeholder="e.g., English">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Proficiency</label>
                                    <select name="languages[{{ $index }}][proficiency]" class="form-select">
                                        <option value="basic" {{ ($lang->proficiency ?? 'intermediate') == 'basic' ? 'selected' : '' }}>Basic</option>
                                        <option value="intermediate" {{ ($lang->proficiency ?? 'intermediate') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="fluent" {{ ($lang->proficiency ?? '') == 'fluent' ? 'selected' : '' }}>Fluent</option>
                                        <option value="native" {{ ($lang->proficiency ?? '') == 'native' ? 'selected' : '' }}>Native</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--text-muted); text-align: center; padding: 20px;">No languages added yet. Click "Add Language" to list your language skills!</p>
                    @endforelse
                </div>
                <button type="button" class="add-btn" onclick="addLanguage()">
                    <i class="fas fa-plus"></i> Add Language
                </button>
            </div>

            <!-- References -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-user-check"></i>
                    <h2>Professional References</h2>
                </div>
                
                <div id="referencesList">
                    @php
                        $references = old('references', $candidate->references ?? []);
                    @endphp
                    @forelse($references as $index => $ref)
                        <div class="dynamic-item">
                            <input type="hidden" name="references[{{ $index }}][id]" value="{{ $ref->id ?? '' }}">
                            <div class="dynamic-item-header">
                                <strong style="color: var(--accent-primary);">Reference #{{ $index + 1 }}</strong>
                                <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" name="references[{{ $index }}][name]" class="form-input" value="{{ $ref->name ?? '' }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Title/Position</label>
                                    <input type="text" name="references[{{ $index }}][title]" class="form-input" value="{{ $ref->title ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" name="references[{{ $index }}][company]" class="form-input" value="{{ $ref->company ?? '' }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="references[{{ $index }}][email]" class="form-input" value="{{ $ref->email ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="references[{{ $index }}][phone]" class="form-input" value="{{ $ref->phone ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Relationship</label>
                                <input type="text" name="references[{{ $index }}][relationship]" class="form-input" value="{{ $ref->relationship ?? '' }}" placeholder="e.g., Former Manager, Direct Supervisor">
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--text-muted); text-align: center; padding: 20px;">No references added yet. Add professional references to strengthen your profile.</p>
                    @endforelse
                </div>
                <button type="button" class="add-btn" onclick="addReference()">
                    <i class="fas fa-plus"></i> Add Reference
                </button>
            </div>

            <!-- Job Preferences -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-briefcase"></i>
                    <h2>Job Preferences</h2>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Interested In</label>
                    <div class="checkbox-grid">
                        @php
                            $interested_in = old('interested_in', $candidate->interested_in ?? []);
                        @endphp
                        <div class="checkbox-item">
                            <input type="checkbox" id="full_time" name="interested_in[]" value="full_time" {{ in_array('full_time', $interested_in) ? 'checked' : '' }}>
                            <label for="full_time">Full Time</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="part_time" name="interested_in[]" value="part_time" {{ in_array('part_time', $interested_in) ? 'checked' : '' }}>
                            <label for="part_time">Part Time</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="contract" name="interested_in[]" value="contract" {{ in_array('contract', $interested_in) ? 'checked' : '' }}>
                            <label for="contract">Contract</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="freelance" name="interested_in[]" value="freelance" {{ in_array('freelance', $interested_in) ? 'checked' : '' }}>
                            <label for="freelance">Freelance</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="internship" name="interested_in[]" value="internship" {{ in_array('internship', $interested_in) ? 'checked' : '' }}>
                            <label for="internship">Internship</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="remote" name="interested_in[]" value="remote" {{ in_array('remote', $interested_in) ? 'checked' : '' }}>
                            <label for="remote">Remote</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save All Changes
                </button>
                <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Add Experience
        function addExperience() {
            const list = document.getElementById('experienceList');
            const index = list.children.length;
            const html = `
                <div class="dynamic-item">
                    <div class="dynamic-item-header">
                        <strong style="color: var(--accent-primary);">Experience #${index + 1}</strong>
                        <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Job Title</label>
                        <input type="text" name="experience[${index}][job_title]" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="experience[${index}][company_name]" class="form-input">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="experience[${index}][start_date]" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">End Date</label>
                            <input type="date" name="experience[${index}][end_date]" class="form-input">
                        </div>
                    </div>
                    <div class="checkbox-item" style="margin-bottom: 12px;">
                        <input type="checkbox" id="current_${index}" name="experience[${index}][is_current]" value="1">
                        <label for="current_${index}">I currently work here</label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="experience[${index}][description]" class="form-textarea"></textarea>
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('beforeend', html);
        }

        // Add Education
        function addEducation() {
            const list = document.getElementById('educationList');
            const index = list.children.length;
            const html = `
                <div class="dynamic-item">
                    <div class="dynamic-item-header">
                        <strong style="color: var(--accent-primary);">Education #${index + 1}</strong>
                        <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Degree</label>
                        <input type="text" name="education[${index}][degree]" class="form-input" placeholder="e.g., Bachelor's in Computer Science">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Institution</label>
                        <input type="text" name="education[${index}][institution]" class="form-input">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Graduation Year</label>
                            <input type="number" name="education[${index}][graduation_year]" class="form-input" min="1950" max="2050">
                        </div>
                        <div class="form-group">
                            <label class="form-label">GPA</label>
                            <input type="text" name="education[${index}][gpa]" class="form-input" placeholder="e.g., 3.8/4.0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="education[${index}][description]" class="form-textarea"></textarea>
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('beforeend', html);
        }

        // Add Certification
        function addCertification() {
            const list = document.getElementById('certificationsList');
            const index = list.querySelectorAll('.dynamic-item').length;
            const html = `
                <div class="dynamic-item">
                    <div class="dynamic-item-header">
                        <strong style="color: var(--accent-primary);">Certification #${index + 1}</strong>
                        <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Certification Name</label>
                        <input type="text" name="certifications[${index}][certification_name]" class="form-input">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Issuing Organization</label>
                            <input type="text" name="certifications[${index}][issuing_organization]" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Type</label>
                            <select name="certifications[${index}][certification_type]" class="form-select">
                                <option value="certification">Certification</option>
                                <option value="award">Award</option>
                                <option value="honor">Honor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Issue Date</label>
                            <input type="date" name="certifications[${index}][issue_date]" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Expiration Date</label>
                            <input type="date" name="certifications[${index}][expiration_date]" class="form-input">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Credential ID</label>
                            <input type="text" name="certifications[${index}][credential_id]" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Credential URL</label>
                            <input type="url" name="certifications[${index}][credential_url]" class="form-input">
                        </div>
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('beforeend', html);
        }

        // Add Portfolio
        function addPortfolio() {
            const list = document.getElementById('portfolioList');
            const index = list.querySelectorAll('.dynamic-item').length;
            const html = `
                <div class="dynamic-item">
                    <div class="dynamic-item-header">
                        <strong style="color: var(--accent-primary);">Project #${index + 1}</strong>
                        <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Project Name</label>
                        <input type="text" name="portfolio[${index}][project_name]" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Project URL</label>
                        <input type="url" name="portfolio[${index}][project_url]" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="portfolio[${index}][description]" class="form-textarea"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Technologies Used</label>
                        <input type="text" name="portfolio[${index}][technologies]" class="form-input" placeholder="e.g., Laravel, Vue.js, MySQL">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Thumbnail Image</label>
                        <input type="file" name="portfolio[${index}][thumbnail]" class="form-input" accept="image/*">
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('beforeend', html);
        }

        // Add Language
        function addLanguage() {
            const list = document.getElementById('languagesList');
            const index = list.querySelectorAll('.dynamic-item').length;
            const html = `
                <div class="dynamic-item">
                    <div class="dynamic-item-header">
                        <strong style="color: var(--accent-primary);">Language #${index + 1}</strong>
                        <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Language</label>
                            <input type="text" name="languages[${index}][language]" class="form-input" placeholder="e.g., English">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Proficiency</label>
                            <select name="languages[${index}][proficiency]" class="form-select">
                                <option value="basic">Basic</option>
                                <option value="intermediate" selected>Intermediate</option>
                                <option value="fluent">Fluent</option>
                                <option value="native">Native</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('beforeend', html);
        }

        // Add Reference
        function addReference() {
            const list = document.getElementById('referencesList');
            const index = list.querySelectorAll('.dynamic-item').length;
            const html = `
                <div class="dynamic-item">
                    <div class="dynamic-item-header">
                        <strong style="color: var(--accent-primary);">Reference #${index + 1}</strong>
                        <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="references[${index}][name]" class="form-input">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Title/Position</label>
                            <input type="text" name="references[${index}][title]" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Company</label>
                            <input type="text" name="references[${index}][company]" class="form-input">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="references[${index}][email]" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" name="references[${index}][phone]" class="form-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Relationship</label>
                        <input type="text" name="references[${index}][relationship]" class="form-input" placeholder="e.g., Former Manager, Direct Supervisor">
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('beforeend', html);
        }

        // Preview Image
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
