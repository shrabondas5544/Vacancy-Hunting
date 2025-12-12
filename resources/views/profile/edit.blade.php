<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile - {{ config('app.name', 'Vacancy Hunting') }}</title>

    <style>
        /* CORPORATE DARK THEME CSS */
        :root {
            --bg-color: #0b1120;
            --card-bg: #151f32;
            --input-bg: #0f172a;
            --border-color: #2d3748;
            --primary-color: #00d4ff;
            --primary-hover: #00b8de;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --error-color: #ef4444;
            --success-color: #10b981;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 32px;
            margin-bottom: 30px;
            color: var(--text-main);
        }

        .card {
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 25px;
            color: var(--primary-color);
        }

        .profile-picture-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-picture-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--primary-color);
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            color: var(--text-main);
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            width: 100%;
            padding: 12px;
            background-color: var(--input-bg);
            border: 2px dashed var(--border-color);
            border-radius: 6px;
            cursor: pointer;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #000;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: var(--border-color);
            color: var(--text-main);
        }

        .btn-secondary:hover {
            background-color: #3d4758;
        }

        .actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.2);
            border: 1px solid var(--success-color);
            color: var(--success-color);
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.2);
            border: 1px solid var(--error-color);
            color: var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-title">Edit Profile</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <!-- Profile Picture Section -->
        <div class="card">
            <h2>Profile Picture</h2>
            <div class="profile-picture-section">
                @if(Auth::user()->isCandidate())
                    <img id="picturePreview" 
                         src="{{ $candidate->profile_picture ? asset('storage/' . $candidate->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($candidate->name) . '&size=150&background=00d4ff&color=000' }}" 
                         alt="Profile Picture" 
                         class="profile-picture-preview">
                @else
                    <img id="picturePreview" 
                         src="{{ $employer->profile_picture ? asset('storage/' . $employer->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($employer->company_name) . '&size=150&background=00d4ff&color=000' }}" 
                         alt="Company Logo" 
                         class="profile-picture-preview">
                @endif

                <form action="{{ route('profile.picture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" 
                               name="profile_picture" 
                               id="profilePictureInput" 
                               accept="image/*" 
                               class="file-input" 
                               onchange="previewImage(event)">
                        @error('profile_picture')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Picture</button>
                </form>
            </div>
        </div>

        <!-- Profile Information Section -->
        <div class="card">
            <h2>Profile Information</h2>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(Auth::user()->isCandidate())
                    <!-- Candidate Fields -->
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="form-input" 
                               value="{{ old('name', $candidate->name) }}" 
                               required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="experience_years" class="form-label">Years of Experience</label>
                        <input type="number" 
                               name="experience_years" 
                               id="experience_years" 
                               class="form-input" 
                               value="{{ old('experience_years', $candidate->experience_years) }}" 
                               min="0">
                        @error('experience_years')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="skills" class="form-label">Skills (comma separated)</label>
                        <textarea name="skills" 
                                  id="skills" 
                                  class="form-textarea" 
                                  placeholder="e.g., PHP, Laravel, JavaScript, React">{{ old('skills', $candidate->skills) }}</textarea>
                        @error('skills')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                @else
                    <!-- Employer Fields -->
                    <div class="form-group">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" 
                               name="company_name" 
                               id="company_name" 
                               class="form-input" 
                               value="{{ old('company_name', $employer->company_name) }}" 
                               required>
                        @error('company_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="company_type" class="form-label">Company Type</label>
                        <input type="text" 
                               name="company_type" 
                               id="company_type" 
                               class="form-input" 
                               value="{{ old('company_type', $employer->company_type) }}" 
                               required 
                               placeholder="e.g., IT, Marketing, Finance">
                        @error('company_type')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" 
                               name="contact_number" 
                               id="contact_number" 
                               class="form-input" 
                               value="{{ old('contact_number', $employer->contact_number) }}" 
                               required>
                        @error('contact_number')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="company_description" class="form-label">Company Description</label>
                        <textarea name="company_description" 
                                  id="company_description" 
                                  class="form-textarea" 
                                  placeholder="Brief description of your company">{{ old('company_description', $employer->company_description) }}</textarea>
                        @error('company_description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="establishment_year" class="form-label">Establishment Year</label>
                        <input type="number" 
                               name="establishment_year" 
                               id="establishment_year" 
                               class="form-input" 
                               value="{{ old('establishment_year', $employer->establishment_year) }}" 
                               min="1800" 
                               max="{{ date('Y') }}">
                        @error('establishment_year')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="company_ownership" class="form-label">Company Ownership</label>
                        <select name="company_ownership" id="company_ownership" class="form-select">
                            <option value="">Select ownership type</option>
                            <option value="private" {{ old('company_ownership', $employer->company_ownership) == 'private' ? 'selected' : '' }}>Private</option>
                            <option value="public" {{ old('company_ownership', $employer->company_ownership) == 'public' ? 'selected' : '' }}>Public</option>
                        </select>
                        @error('company_ownership')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="employee_count" class="form-label">Employee Count</label>
                        <select name="employee_count" id="employee_count" class="form-select">
                            <option value="">Select employee count</option>
                            <option value="1-20" {{ old('employee_count', $employer->employee_count) == '1-20' ? 'selected' : '' }}>1-20</option>
                            <option value="20-50" {{ old('employee_count', $employer->employee_count) == '20-50' ? 'selected' : '' }}>20-50</option>
                            <option value="50-100" {{ old('employee_count', $employer->employee_count) == '50-100' ? 'selected' : '' }}>50-100</option>
                            <option value="100-300" {{ old('employee_count', $employer->employee_count) == '100-300' ? 'selected' : '' }}>100-300</option>
                            <option value="300-1000" {{ old('employee_count', $employer->employee_count) == '300-1000' ? 'selected' : '' }}>300-1000</option>
                            <option value="1000+" {{ old('employee_count', $employer->employee_count) == '1000+' ? 'selected' : '' }}>1000+</option>
                        </select>
                        @error('employee_count')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="company_address" class="form-label">Company Address</label>
                        <textarea name="company_address" 
                                  id="company_address" 
                                  class="form-textarea" 
                                  placeholder="Full company address">{{ old('company_address', $employer->company_address) }}</textarea>
                        @error('company_address')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="trade_license_no" class="form-label">Trade License Number</label>
                        <input type="text" 
                               name="trade_license_no" 
                               id="trade_license_no" 
                               class="form-input" 
                               value="{{ old('trade_license_no', $employer->trade_license_no) }}">
                        @error('trade_license_no')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="website_url" class="form-label">Website URL</label>
                        <input type="url" 
                               name="website_url" 
                               id="website_url" 
                               class="form-input" 
                               value="{{ old('website_url', $employer->website_url) }}" 
                               placeholder="https://example.com">
                        @error('website_url')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('picturePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
