@extends('layouts.guest')

@section('content')

<style>
    /* 1. BACKGROUND: DARK BLURRY GRADIENT */
    body {
        background-color: #0f172a;
        background-image: 
            radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
            radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
            radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
            radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
        background-attachment: fixed;
        background-size: cover;
    }

    /* 2. GLASS CARD STYLING (Desktop) */
    .auth-card {
        background: rgba(21, 31, 50, 0.65) !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
        border-radius: 16px !important;
        /* Ensure specific padding for the larger form */
        padding: 2.5rem !important; 
    }

    /* 3. MOBILE: REMOVE CARD */
    @media (max-width: 640px) {
        .auth-card {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            backdrop-filter: none !important;
            padding: 0 !important;
        }
        .auth-header {
            margin-top: 1.5rem;
        }
    }

    /* 4. INPUT FIELDS & SELECTS */
    .form-control {
        background-color: rgba(15, 23, 42, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #e2e8f0 !important;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: rgba(15, 23, 42, 0.8) !important;
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 20px rgba(0, 212, 255, 0.25) !important;
    }

    /* Fix for Dropdown Options being white on some browsers */
    select.form-control option {
        background-color: #0f172a;
        color: #fff;
    }

    /* 5. TEXT & BUTTONS */
    .auth-header h1 {
        text-shadow: 0 0 20px rgba(0, 212, 255, 0.4);
        color: #fff;
    }

    .btn-primary {
        background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
        box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
        margin-top: 15px;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 212, 255, 0.5);
    }

    /* Checkbox Styling adjustment for dark theme */
    .checkbox-label {
        background: rgba(15, 23, 42, 0.6) !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
        color: #cbd5e1 !important;
    }

    .text-danger {
        font-size: 0.85rem;
        color: #ef4444 !important;
        margin-top: 4px;
        display: block;
    }

    /* Google Button */
    .btn-google {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        background-color: white;
        color: #333;
        font-weight: 600;
        padding: 0.75rem;
        border-radius: 0.375rem;
        text-decoration: none;
        margin-top: 5px;
        transition: all 0.2s;
        border: 1px solid #e2e8f0;
    }
    .btn-google:hover {
        background-color: #f8fafc;
        text-decoration: none;
        color: #0f172a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
    }
    .btn-google img {
        width: 20px;
        height: 20px;
        margin-right: 0.75rem;
    }
</style>

<div>
    <div class="auth-header">
        <h1>Create Account</h1>
        <p>Join the Vacancy Hunting Ecosystem</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="role" class="form-label">I want to sign up as a...</label>
            <select id="role" name="role" class="form-control" onchange="toggleFormFields()">
                <option value="candidate" {{ old('role') == 'candidate' ? 'selected' : '' }}>Candidate (Job Seeker)</option>
                <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer (Company)</option>
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Login Details</label>
            
            <input type="email" name="email" class="form-control" 
                   value="{{ old('email') }}" placeholder="Email Address" 
                   style="margin-bottom: 15px;" required>
            @error('email')
                <span class="text-danger" style="margin-bottom: 10px;">{{ $message }}</span>
            @enderror

            <input type="password" name="password" class="form-control" 
                   placeholder="Password" style="margin-bottom: 15px;" required>
            @error('password')
                <span class="text-danger" style="margin-bottom: 10px;">{{ $message }}</span>
            @enderror

            <input type="password" name="password_confirmation" class="form-control" 
                   placeholder="Confirm Password" required>
        </div>

        <div id="candidate-fields" class="{{ old('role') == 'employer' ? 'hidden' : '' }}">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" 
                       value="{{ old('name') }}" placeholder="e.g. John Doe">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Current Experience (Years)</label>
                <input type="number" name="experience" class="form-control" 
                       value="{{ old('experience') }}" placeholder="e.g. 3">
            </div>

            <div class="form-group">
                <label class="form-label">Primary Skills</label>
                <input type="text" name="skills_text" class="form-control" 
                       value="{{ old('skills_text') }}" placeholder="e.g. web dev, MS word, excel">
            </div>

            <div class="form-group">
                <label class="form-label">Interested In</label>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="job_type[]" value="full_time" 
                        {{ (is_array(old('job_type')) && in_array('full_time', old('job_type'))) ? 'checked' : '' }}> Full Time
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="job_type[]" value="remote"
                        {{ (is_array(old('job_type')) && in_array('remote', old('job_type'))) ? 'checked' : '' }}> Remote
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="job_type[]" value="freelance"
                        {{ (is_array(old('job_type')) && in_array('freelance', old('job_type'))) ? 'checked' : '' }}> Freelance
                    </label>
                </div>
            </div>
        </div>

        <div id="employer-fields" class="{{ old('role') != 'employer' ? 'hidden' : '' }}">
            <div class="form-group">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" 
                       value="{{ old('company_name') }}" placeholder="e.g. Tech Solutions Ltd.">
                @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Company Type</label>
                <select name="company_type" class="form-control">
                    <option value="">Select Type...</option>
                    <option value="it" {{ old('company_type') == 'it' ? 'selected' : '' }}>IT / Software</option>
                    <option value="marketing" {{ old('company_type') == 'marketing' ? 'selected' : '' }}>Marketing & Sales</option>
                    <option value="finance" {{ old('company_type') == 'finance' ? 'selected' : '' }}>Finance / Banking</option>
                    <option value="education" {{ old('company_type') == 'education' ? 'selected' : '' }}>Education</option>
                    <option value="other" {{ old('company_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Contact Number</label>
                <input type="tel" name="contact_number" class="form-control" 
                       value="{{ old('contact_number') }}" placeholder="+880 123 456 789">
            </div>

            <div class="form-group">
                <label class="form-label">Establishment Year (Optional)</label>
                <input type="number" name="establishment_year" class="form-control" 
                       value="{{ old('establishment_year') }}" placeholder="e.g. 2015" 
                       min="1800" max="{{ date('Y') }}">
                @error('establishment_year') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Company Ownership (Optional)</label>
                <select name="company_ownership" class="form-control">
                    <option value="">Select Ownership Type...</option>
                    <option value="private" {{ old('company_ownership') == 'private' ? 'selected' : '' }}>Private</option>
                    <option value="public" {{ old('company_ownership') == 'public' ? 'selected' : '' }}>Public</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Number of Employees (Optional)</label>
                <select name="employee_count" class="form-control">
                    <option value="">Select Employee Count...</option>
                    <option value="1-20" {{ old('employee_count') == '1-20' ? 'selected' : '' }}>1-20</option>
                    <option value="20-50" {{ old('employee_count') == '20-50' ? 'selected' : '' }}>20-50</option>
                    <option value="50-100" {{ old('employee_count') == '50-100' ? 'selected' : '' }}>50-100</option>
                    <option value="100-300" {{ old('employee_count') == '100-300' ? 'selected' : '' }}>100-300</option>
                    <option value="300-1000" {{ old('employee_count') == '300-1000' ? 'selected' : '' }}>300-1000</option>
                    <option value="1000+" {{ old('employee_count') == '1000+' ? 'selected' : '' }}>1000+</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Company Address (Optional)</label>
                <textarea name="company_address" class="form-control" 
                          placeholder="Full company address">{{ old('company_address') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Trade License No (Optional)</label>
                <input type="text" name="trade_license_no" class="form-control" 
                       value="{{ old('trade_license_no') }}" placeholder="e.g. TL-12345">
            </div>

            <div class="form-group">
                <label class="form-label">Website URL (Optional)</label>
                <input type="url" name="website_url" class="form-control" 
                       value="{{ old('website_url') }}" placeholder="https://www.example.com">
                @error('website_url') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Company Description</label>
                <textarea name="company_description" class="form-control" 
                          placeholder="Briefly describe your company...">{{ old('company_description') }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn-primary">Create Account</button>
        
        <div id="google-auth-section" class="mt-4">
             <div style="text-align: center; margin: 15px 0; color: #94a3b8; font-size: 0.9rem;">— OR —</div>
             <a href="{{ route('auth.google', ['intention' => 'register']) }}" class="btn-google">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google">
                 Sign up with Google
             </a>
        </div>
    </form>

    <div class="auth-footer">
        Already have an account? 
        <a href="{{ route('login') }}" class="auth-link">Sign In</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleFormFields() {
        const roleSelect = document.getElementById('role');
        const candidateFields = document.getElementById('candidate-fields');
        const employerFields = document.getElementById('employer-fields');
        const googleAuthSection = document.getElementById('google-auth-section');

        if (roleSelect.value === 'employer') {
            candidateFields.classList.add('hidden');
            employerFields.classList.remove('hidden');
            if (googleAuthSection) googleAuthSection.style.display = 'none';
            
            enableInputs(employerFields);
            disableInputs(candidateFields);
        } else {
            candidateFields.classList.remove('hidden');
            employerFields.classList.add('hidden');
            if (googleAuthSection) googleAuthSection.style.display = 'block';

            enableInputs(candidateFields);
            disableInputs(employerFields);
        }
    }

    function disableInputs(container) {
        // We only disable inputs that are NOT the role selector or common fields
        // But here container is strictly the candidate-fields or employer-fields div
        const inputs = container.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.disabled = true);
    }

    function enableInputs(container) {
        const inputs = container.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.disabled = false);
    }

    // Run on load to ensure correct state if page reloads with errors
    document.addEventListener('DOMContentLoaded', function() {
        toggleFormFields();
    });
</script>
@endpush