<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Write Article - {{ config('app.name', 'Laravel') }}</title>
    
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
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 188, 212, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        
        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #00d4ff;
            color: #00d4ff;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .main-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            margin-bottom: 2rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #00d4ff;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Form */
        .form-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            padding: 0.875rem 1rem;
            color: white;
            font-family: inherit;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #00d4ff;
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.15);
        }

        .form-input::placeholder, .form-textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-select {
            cursor: pointer;
        }

        .form-select option {
            background: #1e293b;
            color: white;
        }

        .form-textarea {
            min-height: 300px;
            resize: vertical;
            line-height: 1.7;
        }

        .form-hint {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 0.5rem;
        }

        /* Image Upload */
        .image-upload {
            border: 2px dashed rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .image-upload:hover {
            border-color: rgba(0, 212, 255, 0.5);
            background: rgba(0, 212, 255, 0.05);
        }

        .image-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
        }

        .upload-text {
            color: rgba(255, 255, 255, 0.7);
        }

        .upload-hint {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 0.5rem;
        }

        .image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            display: none;
            margin-top: 1rem;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin-top: 2rem;
        }

        /* Error */
        .form-error {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .alert-error ul {
            margin: 0.5rem 0 0 1rem;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main class="main-content">
        <a href="{{ route('blog.index') }}" class="back-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Blog
        </a>

        <div class="page-header">
            <h1 class="page-title">Write New Article</h1>
        </div>

        @if($errors->any())
            <div class="alert-error">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="title">Article Title *</label>
                <input type="text" name="title" id="title" class="form-input" 
                       placeholder="Enter a compelling title..." 
                       value="{{ old('title') }}" required>
                @error('title')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="category">Category *</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $key => $label)
                        <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Featured Image</label>
                <div class="image-upload">
                    <input type="file" name="featured_image" id="featured_image" accept="image/*" onchange="previewImage(this)">
                    <div class="upload-icon">📷</div>
                    <p class="upload-text">Click or drag to upload image</p>
                    <p class="upload-hint">JPG, PNG, GIF or WebP (max 2MB)</p>
                    <img id="image-preview" class="image-preview" alt="Preview">
                </div>
                @error('featured_image')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Content *</label>
                <textarea name="content" id="content" class="form-textarea" 
                          placeholder="Write your article here..." required>{{ old('content') }}</textarea>
                <p class="form-hint">Share your insights, experiences, or knowledge with the community.</p>
                @error('content')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Publish Article
                </button>
                <a href="{{ route('blog.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </main>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
