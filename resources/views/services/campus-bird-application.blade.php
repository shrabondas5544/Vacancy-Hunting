<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Campus Bird Internship Application - {{ $department }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
                radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
            color: #e2e8f0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #00d4ff;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 2rem;
            transition: all 0.2s;
        }

        .back-link:hover {
            gap: 0.75rem;
        }

        .form-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #00d4ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .form-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 3rem;
            backdrop-filter: blur(10px);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .required {
            color: #ff4444;
            margin-left: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #00d4ff;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .radio-group, .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .radio-option, .checkbox-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .radio-option:hover, .checkbox-option:hover {
            background: rgba(0, 212, 255, 0.05);
            border-color: rgba(0, 212, 255, 0.3);
        }

        .radio-option input, .checkbox-option input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .radio-option label, .checkbox-option label {
            cursor: pointer;
            flex: 1;
            color: #e2e8f0;
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-input-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: rgba(0, 212, 255, 0.1);
            border: 1px solid rgba(0, 212, 255, 0.3);
            border-radius: 8px;
            color: #00d4ff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-input-label:hover {
            background: rgba(0, 212, 255, 0.2);
        }

        .file-input {
            display: none;
        }

        .file-name {
            margin-top: 0.5rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(0, 188, 212, 0.4);
            margin-top: 2rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 188, 212, 0.6);
        }

        .error-message {
            color: #ff4444;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid rgba(255, 68, 68, 0.3);
            color: #ff4444;
        }

        @media (max-width: 768px) {
            body {
                padding: 0; /* Remove padding to fix navbar/footer gaps */
            }

            .container {
                padding-top: 2rem; /* Ensure content has space */
                padding-bottom: 6rem; /* Space for mobile nav */
            }

            .form-card {
                padding: 1.5rem;
            }

            .form-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        <a href="{{ route('services.campus-bird') }}" class="back-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Campus Bird
        </a>

        <div class="form-header">
            <h1 class="form-title">{{ $form->title }}</h1>
            <p class="form-subtitle">{{ $department }}</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following errors:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('campus-bird.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="internship_form_id" value="{{ $form->id }}">

                @php
                    $allFields = $form->getAllFields();
                @endphp

                @foreach($allFields as $field)
                    <div class="form-group">
                        <label class="form-label">
                            {{ $field['label'] }}
                            @if($field['is_required'])
                                <span class="required">*</span>
                            @endif
                        </label>

                        @if($field['type'] === 'text')
                            <input 
                                type="{{ in_array($field['field_name'], ['applicant_email']) ? 'email' : 'text' }}" 
                                name="{{ $field['field_name'] }}" 
                                class="form-control" 
                                value="{{ old($field['field_name']) ?? (Auth::check() && Auth::user()->isCandidate() ? (
                                    $field['field_name'] == 'applicant_name' ? (Auth::user()->candidate->name ?? Auth::user()->name) : (
                                        $field['field_name'] == 'applicant_email' ? Auth::user()->email : (
                                            $field['field_name'] == 'applicant_phone' ? (Auth::user()->candidate->phone ?? '') : ''
                                        )
                                    )
                                ) : '') }}"
                                {{ $field['is_required'] ? 'required' : '' }}
                            >

                        @elseif($field['type'] === 'textarea')
                            <textarea 
                                name="{{ $field['field_name'] }}" 
                                class="form-control"
                                {{ $field['is_required'] ? 'required' : '' }}
                            >{{ old($field['field_name']) }}</textarea>

                        @elseif($field['type'] === 'date')
                            <input 
                                type="date" 
                                name="{{ $field['field_name'] }}" 
                                class="form-control"
                                value="{{ old($field['field_name']) }}"
                                {{ $field['is_required'] ? 'required' : '' }}
                            >

                        @elseif($field['type'] === 'radio' && isset($field['options']))
                            <div class="radio-group">
                                @foreach($field['options'] as $option)
                                    <div class="radio-option">
                                        <input 
                                            type="radio" 
                                            name="{{ $field['field_name'] }}" 
                                            value="{{ $option }}"
                                            id="{{ $field['field_name'] }}_{{ $loop->index }}"
                                            {{ old($field['field_name']) == $option ? 'checked' : '' }}
                                            {{ $field['is_required'] ? 'required' : '' }}
                                        >
                                        <label for="{{ $field['field_name'] }}_{{ $loop->index }}">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>

                        @elseif($field['type'] === 'select' && isset($field['options']))
                            <select 
                                name="{{ $field['field_name'] }}" 
                                class="form-control"
                                {{ $field['is_required'] ? 'required' : '' }}
                            >
                                <option value="">Select an option</option>
                                @foreach($field['options'] as $option)
                                    <option value="{{ $option }}" {{ old($field['field_name']) == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>

                        @elseif($field['type'] === 'checkbox' && isset($field['options']))
                            <div class="checkbox-group">
                                @foreach($field['options'] as $option)
                                    <div class="checkbox-option">
                                        <input 
                                            type="checkbox" 
                                            name="{{ $field['field_name'] }}[]" 
                                            value="{{ $option }}"
                                            id="{{ $field['field_name'] }}_{{ $loop->index }}"
                                            {{ is_array(old($field['field_name'])) && in_array($option, old($field['field_name'])) ? 'checked' : '' }}
                                        >
                                        <label for="{{ $field['field_name'] }}_{{ $loop->index }}">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>

                        @elseif($field['type'] === 'file')
                            <div class="file-input-wrapper">
                                <label for="file_{{ $field['field_name'] }}" class="file-input-label">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    Choose File
                                </label>
                                <input 
                                    type="file" 
                                    name="{{ $field['field_name'] }}" 
                                    id="file_{{ $field['field_name'] }}"
                                    class="file-input"
                                    {{ $field['is_required'] ? 'required' : '' }}
                                    onchange="updateFileName(this)"
                                >
                                <div class="file-name" id="filename_{{ $field['field_name'] }}">No file chosen</div>
                            </div>
                        @endif

                        @error($field['field_name'])
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach

                <button type="submit" class="submit-btn">Submit Application</button>
            </form>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('filename_' + input.name);
            if (input.files && input.files[0]) {
                fileNameDisplay.textContent = input.files[0].name;
            } else {
                fileNameDisplay.textContent = 'No file chosen';
            }
        }
    </script>

    @include('partials.footer')
</body>
</html>
