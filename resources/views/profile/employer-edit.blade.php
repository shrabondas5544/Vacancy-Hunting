<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Employer Profile - {{ config('app.name', 'Vacancy Hunting') }}</title>
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ROOT VARIABLES FOR THEME */
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --bg-hover: #334155;
            --border-color: #334155;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --accent-primary: #3b82f6;
            --accent-hover: #2563eb;
            --accent-light: rgba(59, 130, 246, 0.1);
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        [data-theme="light"] {
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: #f1f5f9;
            --border-color: #e2e8f0;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --accent-light: rgba(59, 130, 246, 0.08);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            padding: 0;
        }

        /* THEME TOGGLE */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .theme-toggle i {
            font-size: 18px;
            color: var(--accent-primary);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-primary);
        }

        .page-subtitle {
            font-size: 16px;
            color: var(--text-secondary);
        }

        /* ALERTS */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
            border: 1.5px solid var(--success);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            color: var(--error);
            border: 1.5px solid var(--error);
        }

        /* SECTION CARD */
        .section-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-md);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .section-header i {
            color: var(--accent-primary);
            font-size: 24px;
        }

        .section-header h2 {
            font-size: 22px;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* FORM ELEMENTS */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label .required {
            color: var(--error);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            background-color: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
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

        /* FILE UPLOAD */
        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--bg-primary);
        }

        .file-upload-area:hover {
            border-color: var(--accent-primary);
            background: var(--accent-light);
        }

        .file-upload-area i {
            font-size: 48px;
            color: var(--accent-primary);
            margin-bottom: 12px;
        }

        .file-upload-area input[type="file"] {
            display: none;
        }

        .file-upload-text {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* IMAGE PREVIEW */
        .image-preview {
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            margin-top: 16px;
            border: 1px solid var(--border-color);
        }

        /* DYNAMIC LIST ITEMS */
        .dynamic-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .dynamic-item {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            position: relative;
        }

        .dynamic-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .remove-btn {
            background: var(--error);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: #dc2626;
            transform: scale(1.05);
        }

        .add-btn {
            background: var(--accent-primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 16px;
        }

        .add-btn:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* CHECKBOXES */
        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-item:hover {
            border-color: var(--accent-primary);
            background: var(--accent-light);
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-item label {
            cursor: pointer;
            font-size: 14px;
            color: var(--text-primary);
        }

        /* BUTTONS */
        .btn {
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--accent-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            background: var(--bg-card);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--bg-hover);
            transform: translateY(-2px);
        }

        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
            position: sticky;
            bottom: 0;
            background: var(--bg-card);
            padding: 20px;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .checkbox-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .theme-toggle {
                top: 10px;
                right: 10px;
                padding: 6px 12px;
                font-size: 12px;
            }
        }

        .checkbox-item input[type="checkbox"]:checked + label {
            color: var(--accent-primary);
            font-weight: 600;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Edit Employer Profile</h1>
            <p class="page-subtitle">Update your company information to attract the best candidates</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- COMPANY LOGO -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-image"></i>
                    <h2>Company Branding</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Company Logo</label>
                    <div class="file-upload-area" onclick="document.getElementById('profilePictureInput').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <div class="file-upload-text">
                            <strong>Click to upload your company logo</strong><br>
                            <small>PNG, JPG or GIF (Max 2MB)</small>
                        </div>
                        <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" onchange="previewLogo(event)">
                    </div>
                    @if($employer->profile_picture)
                        <img id="logoPreview" src="{{ asset('storage/' . $employer->profile_picture) }}" alt="Current Logo" class="image-preview" style="display: block; margin-top: 16px;">
                    @else
                        <img id="logoPreview" src="" alt="Logo Preview" class="image-preview" style="display: none; margin-top: 16px;">
                    @endif
                    @error('profile_picture')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- BASIC COMPANY INFORMATION -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-building"></i>
                    <h2>Company Information</h2>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Company Name <span class="required">*</span></label>
                        <input type="text" name="company_name" class="form-input" value="{{ old('company_name', $employer->company_name) }}" required>
                        @error('company_name')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Industry/Type <span class="required">*</span></label>
                        <input type="text" name="company_type" class="form-input" value="{{ old('company_type', $employer->company_type) }}" placeholder="e.g., IT, Healthcare, Finance" required>
                        @error('company_type')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Contact Number <span class="required">*</span></label>
                        <input type="text" name="contact_number" class="form-input" value="{{ old('contact_number', $employer->contact_number) }}" required>
                        @error('contact_number')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Website URL</label>
                        <input type="url" name="website_url" class="form-input" value="{{ old('website_url', $employer->website_url) }}" placeholder="https://example.com">
                        @error('website_url')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Establishment Year</label>
                        <input type="number" name="establishment_year" class="form-input" value="{{ old('establishment_year', $employer->establishment_year) }}" min="1800" max="{{ date('Y') }}">
                        @error('establishment_year')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Company Ownership</label>
                        <select name="company_ownership" class="form-select">
                            <option value="">Select ownership type</option>
                            <option value="private" {{ old('company_ownership', $employer->company_ownership) == 'private' ? 'selected' : '' }}>Private</option>
                            <option value="public" {{ old('company_ownership', $employer->company_ownership) == 'public' ? 'selected' : '' }}>Public</option>
                        </select>
                        @error('company_ownership')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Employee Count</label>
                        <select name="employee_count" class="form-select">
                            <option value="">Select employee count</option>
                            <option value="1-20" {{ old('employee_count', $employer->employee_count) == '1-20' ? 'selected' : '' }}>1-20</option>
                            <option value="20-50" {{ old('employee_count', $employer->employee_count) == '20-50' ? 'selected' : '' }}>20-50</option>
                            <option value="50-100" {{ old('employee_count', $employer->employee_count) == '50-100' ? 'selected' : '' }}>50-100</option>
                            <option value="100-300" {{ old('employee_count', $employer->employee_count) == '100-300' ? 'selected' : '' }}>100-300</option>
                            <option value="300-1000" {{ old('employee_count', $employer->employee_count) == '300-1000' ? 'selected' : '' }}>300-1000</option>
                            <option value="1000+" {{ old('employee_count', $employer->employee_count) == '1000+' ? 'selected' : '' }}>1000+</option>
                        </select>
                        @error('employee_count')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Trade License Number</label>
                        <input type="text" name="trade_license_no" class="form-input" value="{{ old('trade_license_no', $employer->trade_license_no) }}">
                        @error('trade_license_no')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Company Description</label>
                    <textarea name="company_description" class="form-textarea" placeholder="Brief overview of your company">{{ old('company_description', $employer->company_description) }}</textarea>
                    <div class="form-hint">A brief introduction to your company (2-3 sentences)</div>
                    @error('company_description')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- ADDRESS INFORMATION -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-map-marker-alt"></i>
                    <h2>Primary Address</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Street Address</label>
                    <input type="text" name="street" class="form-input" value="{{ old('street', $employer->street) }}" placeholder="123 Main Street">
                    @error('street')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-input" value="{{ old('city', $employer->city) }}">
                        @error('city')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">State/Province</label>
                        <input type="text" name="state" class="form-input" value="{{ old('state', $employer->state) }}">
                        @error('state')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">ZIP/Postal Code</label>
                        <input type="text" name="zip_code" class="form-input" value="{{ old('zip_code', $employer->zip_code) }}">
                        @error('zip_code')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-input" value="{{ old('country', $employer->country) }}">
                        @error('country')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Full Address (Legacy)</label>
                    <textarea name="company_address" class="form-textarea" placeholder="Complete address">{{ old('company_address', $employer->company_address) }}</textarea>
                    <div class="form-hint">Use the fields above for structured address, or this field for full address</div>
                    @error('company_address')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- SOCIAL MEDIA -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-share-alt"></i>
                    <h2>Social Media Links</h2>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-linkedin"></i> LinkedIn</label>
                        <input type="url" name="linkedin_url" class="form-input" value="{{ old('linkedin_url', $employer->linkedin_url) }}" placeholder="https://linkedin.com/company/...">
                        @error('linkedin_url')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-twitter"></i> Twitter/X</label>
                        <input type="url" name="twitter_url" class="form-input" value="{{ old('twitter_url', $employer->twitter_url) }}" placeholder="https://twitter.com/...">
                        @error('twitter_url')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-facebook"></i> Facebook</label>
                        <input type="url" name="facebook_url" class="form-input" value="{{ old('facebook_url', $employer->facebook_url) }}" placeholder="https://facebook.com/...">
                        @error('facebook_url')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-instagram"></i> Instagram</label>
                        <input type="url" name="instagram_url" class="form-input" value="{{ old('instagram_url', $employer->instagram_url) }}" placeholder="https://instagram.com/...">
                        @error('instagram_url')
                            <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fab fa-youtube"></i> YouTube</label>
                    <input type="url" name="youtube_url" class="form-input" value="{{ old('youtube_url', $employer->youtube_url) }}" placeholder="https://youtube.com/...">
                    @error('youtube_url')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- ABOUT COMPANY -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-align-left"></i>
                    <h2>About Company</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Mission Statement</label>
                    <textarea name="mission_statement" class="form-textarea" placeholder="What is your company's mission?">{{ old('mission_statement', $employer->mission_statement) }}</textarea>
                    <div class="form-hint">Your company's purpose and goals</div>
                    @error('mission_statement')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Vision Statement</label>
                    <textarea name="vision_statement" class="form-textarea" placeholder="What is your company's vision for the future?">{{ old('vision_statement', $employer->vision_statement) }}</textarea>
                    <div class="form-hint">Your company's future aspirations</div>
                    @error('vision_statement')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Company Values</label>
                    <div id="valuesList">
                        @php
                            $values = old('company_values', $employer->company_values ?? []);
                            $valueCount = count($values);
                        @endphp
                        @if($valueCount > 0)
                            @foreach($values as $index => $value)
                                <div class="form-group" style="margin-bottom: 10px; display: flex; gap: 10px; align-items: center;">
                                    <input type="text" name="company_values[]" class="form-input" value="{{ $value }}" placeholder="e.g., Innovation, Integrity, Teamwork" style="flex: 1;">
                                    <button type="button" class="remove-btn" onclick="this.parentElement.remove()" style="flex-shrink: 0;">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="form-group" style="margin-bottom: 10px;">
                                <input type="text" name="company_values[]" class="form-input" placeholder="e.g., Innovation, Integrity, Teamwork">
                            </div>
                        @endif
                    </div>
                    <button type="button" class="add-btn" onclick="addValue()">
                        <i class="fas fa-plus"></i> Add Value
                    </button>
                    <div class="form-hint">Core values that drive your company culture</div>
                    @error('company_values')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Products & Services</label>
                    <textarea name="products_services" class="form-textarea" placeholder="Describe your main products and services">{{ old('products_services', $employer->products_services) }}</textarea>
                    <div class="form-hint">What products/services does your company offer?</div>
                    @error('products_services')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Company History & Milestones</label>
                    <div id="historyList">
                        @php
                            $history = old('company_history', $employer->company_history ?? []);
                        @endphp
                        @if(count($history) > 0)
                            @foreach($history as $index => $milestone)
                                <div class="dynamic-item" style="margin-bottom: 16px;">
                                    <div class="form-row">
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <input type="number" name="company_history[{{ $index }}][year]" class="form-input" value="{{ $milestone['year'] ?? '' }}" placeholder="Year (e.g., 2020)" min="1800" max="{{ date('Y') }}">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0; flex: 2;">
                                            <input type="text" name="company_history[{{ $index }}][event]" class="form-input" value="{{ $milestone['event'] ?? '' }}" placeholder="Milestone event description">
                                        </div>
                                        <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                            <i class="fas fa-times"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="add-btn" onclick="addHistory()">
                        <i class="fas fa-plus"></i> Add Milestone
                    </button>
                    <div class="form-hint">Key historical events and achievements</div>
                    @error('company_history')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- MULTIPLE LOCATIONS -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-map-marked-alt"></i>
                    <h2>Multiple Locations & Branches</h2>
                </div>

                <div id="locationsList">
                    @php
                        $locations = old('locations', $employer->locations ?? []);
                    @endphp
                    @if(count($locations) > 0)
                        @foreach($locations as $index => $location)
                            <div class="dynamic-item" style="margin-bottom: 20px;">
                                <div class="dynamic-item-header">
                                    <h4 style="color: var(--text-primary); font-size: 16px; margin: 0;">Location {{ $index + 1 }}</h4>
                                    <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>
                                
                                <input type="hidden" name="locations[{{ $index }}][id]" value="{{ $location->id ?? '' }}">
                                
                                <div class="form-group">
                                    <label class="form-label">Location Name</label>
                                    <input type="text" name="locations[{{ $index }}][location_name]" class="form-input" value="{{ $location->location_name ?? '' }}" placeholder="e.g., Headquarters, New York Office">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Street Address</label>
                                    <input type="text" name="locations[{{ $index }}][street]" class="form-input" value="{{ $location->street ?? '' }}" placeholder="123 Business Ave">
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">City</label>
                                        <input type="text" name="locations[{{ $index }}][city]" class="form-input" value="{{ $location->city ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">State/Province</label>
                                        <input type="text" name="locations[{{ $index }}][state]" class="form-input" value="{{ $location->state ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">ZIP Code</label>
                                        <input type="text" name="locations[{{ $index }}][zip_code]" class="form-input" value="{{ $location->zip_code ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <input type="text" name="locations[{{ $index }}][country]" class="form-input" value="{{ $location->country ?? '' }}">
                                    </div>
                                </div>

                                <div class="checkbox-item" style="margin-top: 12px;">
                                    <input type="checkbox" id="location_primary_{{ $index }}" name="locations[{{ $index }}][is_primary]" value="1" {{ ($location->is_primary ?? false) ? 'checked' : '' }}>
                                    <label for="location_primary_{{ $index }}">Mark as Primary Location</label>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="button" class="add-btn" onclick="addLocation()">
                    <i class="fas fa-plus"></i> Add Location
                </button>
                <div class="form-hint">Add your office locations, branches, or facilities</div>
            </div>

            <!-- TEAM MEMBERS -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-users"></i>
                    <h2>Key Team Members</h2>
                </div>

                <div id="teamMembersList">
                    @php
                        $teamMembers = old('team_members', $employer->teamMembers ?? []);
                    @endphp
                    @if(count($teamMembers) > 0)
                        @foreach($teamMembers as $index => $member)
                            <div class="dynamic-item" style="margin-bottom: 20px;">
                                <div class="dynamic-item-header">
                                    <h4 style="color: var(--text-primary); font-size: 16px; margin: 0;">Team Member {{ $index + 1 }}</h4>
                                    <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>

                                <input type="hidden" name="team_members[{{ $index }}][id]" value="{{ $member->id ?? '' }}">

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="team_members[{{ $index }}][name]" class="form-input" value="{{ $member->name ?? '' }}" placeholder="John Doe">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Title/Position</label>
                                        <input type="text" name="team_members[{{ $index }}][title]" class="form-input" value="{{ $member->title ?? '' }}" placeholder="CEO, CTO, Manager">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Bio</label>
                                    <textarea name="team_members[{{ $index }}][bio]" class="form-textarea" style="min-height: 80px;" placeholder="Brief bio or description">{{ $member->bio ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="team_members[{{ $index }}][photo]" class="form-input" accept="image/*" onchange="previewTeamPhoto(event, {{ $index }})">
                                    <div class="form-hint">Upload a professional photo (Max 2MB)</div>
                                    @if(isset($member->photo))
                                        <img id="teamPhotoPreview{{ $index }}" src="{{ asset('storage/' . $member->photo) }}" alt="Current Photo" style="max-width: 150px; border-radius: 8px; margin-top: 10px; border: 1px solid var(--border-color);">
                                    @else
                                        <img id="teamPhotoPreview{{ $index }}" src="" alt="Photo Preview" style="max-width: 150px; border-radius: 8px; margin-top: 10px; border: 1px solid var(--border-color); display: none;">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="button" class="add-btn" onclick="addTeamMember()">
                    <i class="fas fa-plus"></i> Add Team Member
                </button>
                <div class="form-hint">Showcase your leadership team and key personnel</div>
            </div>

            <!-- MEDIA GALLERY -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-images"></i>
                    <h2>Media Gallery</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Photos</label>
                    <div class="file-upload-area" onclick="document.getElementById('mediaGalleryInput').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <div class="file-upload-text">
                            <strong>Click to upload images for your media gallery</strong><br>
                            <small>You can select multiple images (PNG, JPG or GIF, Max 2MB each)</small>
                        </div>
                        <input type="file" id="mediaGalleryInput" name="media_gallery[]" accept="image/*" multiple onchange="previewMediaGallery(event)">
                    </div>
                    <div class="form-hint">Upload photos of your office, team events, products, or company culture</div>
                    @error('media_gallery')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    @error('media_gallery.*')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Preview Grid -->
                <div id="mediaPreviewGrid" style="display: none; margin-top: 20px;">
                    <label class="form-label">Selected Images Preview</label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 16px; margin-top: 12px;">
                        <!-- Previews will be added here dynamically -->
                    </div>
                </div>

                <!-- Existing Media -->
                @if($employer->media && $employer->media->count() > 0)
                <div style="margin-top: 24px;">
                    <label class="form-label">Current Media Gallery</label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 16px; margin-top: 12px;">
                        @foreach($employer->media as $mediaItem)
                            <div style="position: relative; aspect-ratio: 16/9; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color);">
                                <img src="{{ asset('storage/' . $mediaItem->file_path) }}" alt="Media" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    <div class="form-hint" style="margin-top: 10px;">Note: To remove existing images, please contact support or use the profile management page</div>
                </div>
                @endif
            </div>

            <!-- EMPLOYEE BENEFITS -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-gift"></i>
                    <h2>Employee Benefits & Perks</h2>
                </div>

                <div class="checkbox-grid">
                    @php
                        $selectedBenefits = old('employee_benefits', $employer->employee_benefits ?? []);
                        $availableBenefits = [
                            'Health Insurance',
                            'Dental Insurance',
                            'Vision Insurance',
                            'Life Insurance',
                            '401(k) Matching',
                            'Paid Time Off',
                            'Paid Holidays',
                            'Sick Leave',
                            'Parental Leave',
                            'Remote Work Options',
                            'Flexible Schedule',
                            'Professional Development',
                            'Tuition Reimbursement',
                            'Gym Membership',
                            'Free Meals',
                            'Transportation Allowance',
                            'Stock Options',
                            'Performance Bonuses',
                            'Relocation Assistance',
                            'Employee Discounts'
                        ];
                    @endphp
                    @foreach($availableBenefits as $benefit)
                        <div class="checkbox-item">
                            <input type="checkbox" id="benefit_{{ $loop->index }}" name="employee_benefits[]" value="{{ $benefit }}" {{ in_array($benefit, $selectedBenefits) ? 'checked' : '' }}>
                            <label for="benefit_{{ $loop->index }}">{{ $benefit }}</label>
                        </div>
                    @endforeach
                </div>
                @error('employee_benefits')
                    <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <!-- FORM ACTIONS -->
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

        // Preview Logo
        function previewLogo(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('logoPreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Preview Banner
        function previewBanner(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('bannerPreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Add Company Value
        function addValue() {
            const valuesList = document.getElementById('valuesList');
            const newValue = document.createElement('div');
            newValue.className = 'form-group';
            newValue.style.marginBottom = '10px';
            newValue.style.display = 'flex';
            newValue.style.gap = '10px';
            newValue.style.alignItems = 'center';
            newValue.innerHTML = `
                <input type="text" name="company_values[]" class="form-input" placeholder="e.g., Innovation, Integrity, Teamwork" style="flex: 1;">
                <button type="button" class="remove-btn" onclick="this.parentElement.remove()" style="flex-shrink: 0;">
                    <i class="fas fa-times"></i> Remove
                </button>
            `;
            valuesList.appendChild(newValue);
        }

        // Add History Milestone
        let historyIndex = {{ count($employer->company_history ?? []) }};
        function addHistory() {
            const historyList = document.getElementById('historyList');
            const newMilestone = document.createElement('div');
            newMilestone.className = 'dynamic-item';
            newMilestone.style.marginBottom = '16px';
            newMilestone.innerHTML = `
                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 0;">
                        <input type="number" name="company_history[${historyIndex}][year]" class="form-input" placeholder="Year (e.g., 2020)" min="1800" max="{{ date('Y') }}">
                    </div>
                    <div class="form-group" style="margin-bottom: 0; flex: 2;">
                        <input type="text" name="company_history[${historyIndex}][event]" class="form-input" placeholder="Milestone event description">
                    </div>
                    <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i> Remove
                    </button>
                </div>
            `;
            historyList.appendChild(newMilestone);
            historyIndex++;
        }

        // Preview Media Gallery
        function previewMediaGallery(event) {
            const files = event.target.files;
            if (files.length === 0) return;
            
            const previewGrid = document.getElementById('mediaPreviewGrid');
            const gridContainer = previewGrid.querySelector('div[style*="grid"]');
            
            // Clear previous previews
            gridContainer.innerHTML = '';
            previewGrid.style.display = 'block';
            
            // Create preview for each selected file
            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.style.cssText = 'position: relative; aspect-ratio: 16/9; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color);';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}" style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: rgba(0,0,0,0.7); color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; text-align: center;">
                                ${file.name}
                            </div>
                        `;
                        gridContainer.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Add Location
        let locationIndex = {{ count($employer->locations ?? []) }};
        function addLocation() {
            const locationsList = document.getElementById('locationsList');
            const newLocation = document.createElement('div');
            newLocation.className = 'dynamic-item';
            newLocation.style.marginBottom = '20px';
            newLocation.innerHTML = `
                <div class="dynamic-item-header">
                    <h4 style="color: var(--text-primary); font-size: 16px; margin: 0;">Location ${locationIndex + 1}</h4>
                    <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i> Remove
                    </button>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Location Name</label>
                    <input type="text" name="locations[${locationIndex}][location_name]" class="form-input" placeholder="e.g., Headquarters, New York Office">
                </div>

                <div class="form-group">
                    <label class="form-label">Street Address</label>
                    <input type="text" name="locations[${locationIndex}][street]" class="form-input" placeholder="123 Business Ave">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="locations[${locationIndex}][city]" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">State/Province</label>
                        <input type="text" name="locations[${locationIndex}][state]" class="form-input">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">ZIP Code</label>
                        <input type="text" name="locations[${locationIndex}][zip_code]" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <input type="text" name="locations[${locationIndex}][country]" class="form-input">
                    </div>
                </div>

                <div class="checkbox-item" style="margin-top: 12px;">
                    <input type="checkbox" id="location_primary_${locationIndex}" name="locations[${locationIndex}][is_primary]" value="1">
                    <label for="location_primary_${locationIndex}">Mark as Primary Location</label>
                </div>
            `;
            locationsList.appendChild(newLocation);
            locationIndex++;
        }

        // Add Team Member
        let teamMemberIndex = {{ count($employer->teamMembers ?? []) }};
        function addTeamMember() {
            const teamMembersList = document.getElementById('teamMembersList');
            const newMember = document.createElement('div');
            newMember.className = 'dynamic-item';
            newMember.style.marginBottom = '20px';
            newMember.innerHTML = `
                <div class="dynamic-item-header">
                    <h4 style="color: var(--text-primary); font-size: 16px; margin: 0;">Team Member ${teamMemberIndex + 1}</h4>
                    <button type="button" class="remove-btn" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i> Remove
                    </button>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="team_members[${teamMemberIndex}][name]" class="form-input" placeholder="John Doe">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Title/Position</label>
                        <input type="text" name="team_members[${teamMemberIndex}][title]" class="form-input" placeholder="CEO, CTO, Manager">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea name="team_members[${teamMemberIndex}][bio]" class="form-textarea" style="min-height: 80px;" placeholder="Brief bio or description"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Photo</label>
                    <input type="file" name="team_members[${teamMemberIndex}][photo]" class="form-input" accept="image/*" onchange="previewTeamPhoto(event, ${teamMemberIndex})">
                    <div class="form-hint">Upload a professional photo (Max 2MB)</div>
                    <img id="teamPhotoPreview${teamMemberIndex}" src="" alt="Photo Preview" style="max-width: 150px; border-radius: 8px; margin-top: 10px; border: 1px solid var(--border-color); display: none;">
                </div>
            `;
            teamMembersList.appendChild(newMember);
            teamMemberIndex++;
        }

        // Preview Team Photo
        function previewTeamPhoto(event, index) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('teamPhotoPreview' + index);
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
