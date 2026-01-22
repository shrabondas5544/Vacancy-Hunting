@extends('admin.campus-bird.layout')

@section('page-title', 'Edit Alumni')

@section('page-styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .page-title p {
        color: var(--text-muted);
        font-size: 1rem;
    }

    .card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-main);
    }

    .form-control, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text-main);
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }

    .form-text {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    .error-msg {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--border);
        margin-top: 0.5rem;
    }
    
    .section-title:first-child {
        margin-top: 0;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        border-top: 1px solid var(--border);
        padding-top: 1.5rem;
    }

    .btn-cancel {
        background-color: transparent;
        border: 1px solid var(--border);
        color: var(--text-main);
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .btn-cancel:hover {
        background-color: var(--surface-hover);
    }
    
    .btn-primary {
        background-color: var(--primary);
        color: white;
        border: none;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
    }

    /* Grid for larger forms */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .current-photo {
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .current-photo img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border);
    }
    
    .current-photo-label {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('page-content')
<div class="page-header">
    <div class="page-title">
        <h1>Edit Alumni Profile</h1>
        <p>Update information for {{ $alumni->name }}</p>
    </div>
    <a href="{{ route('admin.campus-bird.alumnis.index') }}" class="btn-cancel">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Back to List
    </a>
</div>

<div class="card">
    @if($errors->any())
        <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid rgba(239, 68, 68, 0.3);">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.campus-bird.alumnis.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="section-title">Program Information</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Program Version <span style="color: #ef4444;">*</span></label>
                <select name="program" class="form-select @error('program') is-invalid @enderror" required>
                    <option value="">Select Program</option>
                    @for($i = 1; $i <= 50; $i++)
                        <option value="Campus Bird Internship {{ $i }}" {{ old('program', $alumni->program) == 'Campus Bird Internship '.$i ? 'selected' : '' }}>
                            Campus Bird Internship {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Category <span style="color: #ef4444;">*</span></label>
                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                    <option value="">Select Category</option>
                    @foreach(['IT and Graphics', 'Content & Creation', 'Marketing & Promotion', 'Human Resources', 'Bussniess, Development', 'Client Management & Public Relation(CM & PR)', 'Product Design & Development (PDDT)', 'Education Consultancy'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $alumni->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Year <span style="color: #ef4444;">*</span></label>
                <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $alumni->year) }}" required>
            </div>
        </div>

        <div class="section-title" style="margin-top: 1rem;">Personal Information</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Full Name <span style="color: #ef4444;">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $alumni->name) }}" placeholder="Enter full name" required>
            </div>
            <div class="form-group">
                <label class="form-label">Date of Birth <span style="color: #ef4444;">*</span></label>
                <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $alumni->dob ? $alumni->dob->format('Y-m-d') : '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email Address <span style="color: #ef4444;">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $alumni->email) }}" placeholder="example@email.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number <span style="color: #ef4444;">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $alumni->phone) }}" placeholder="+880..." required>
            </div>
            <div class="form-group">
                <label class="form-label">Division <span style="color: #ef4444;">*</span></label>
                <select name="division" class="form-select @error('division') is-invalid @enderror" required>
                    <option value="">Select Division</option>
                    @foreach(['Barishal', 'Chattogram', 'Dhaka', 'Khulna', 'Rajshahi', 'Rangpur', 'Mymensingh', 'Sylhet'] as $div)
                        <option value="{{ $div }}" {{ old('division', $alumni->division) == $div ? 'selected' : '' }}>{{ $div }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Address <span style="color: #ef4444;">*</span></label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $alumni->address) }}" placeholder="Full address" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Profile Photo</label>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" style="padding: 0.5rem;">
            <div class="current-photo">
                <img src="{{ asset($alumni->photo) }}" alt="Current Profile Photo">
                <div class="current-photo-label">Current profile photo</div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Short Description <span style="color: #ef4444;">*</span></label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Brief bio or description..." required>{{ old('description', $alumni->description) }}</textarea>
        </div>

        <div class="section-title" style="margin-top: 1rem;">Education (Optional)</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">School</label>
                <input type="text" name="school" class="form-control @error('school') is-invalid @enderror" value="{{ old('school', $alumni->school) }}" placeholder="School name">
            </div>
            <div class="form-group">
                <label class="form-label">College</label>
                <input type="text" name="college" class="form-control @error('college') is-invalid @enderror" value="{{ old('college', $alumni->college) }}" placeholder="College name">
            </div>
            <div class="form-group">
                <label class="form-label">University</label>
                <input type="text" name="university" class="form-control @error('university') is-invalid @enderror" value="{{ old('university', $alumni->university) }}" placeholder="University name">
            </div>
        </div>

        <div class="section-title" style="margin-top: 1rem;">Social Media (Optional)</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Facebook Profile</label>
                <input type="url" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $alumni->facebook) }}" placeholder="https://facebook.com/...">
            </div>
            <div class="form-group">
                <label class="form-label">Instagram Profile</label>
                <input type="url" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $alumni->instagram) }}" placeholder="https://instagram.com/...">
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn Profile</label>
                <input type="url" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $alumni->linkedin) }}" placeholder="https://linkedin.com/in/...">
            </div>
            <div class="form-group">
                <label class="form-label">Twitter Profile</label>
                <input type="url" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $alumni->twitter) }}" placeholder="https://twitter.com/...">
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.campus-bird.alumnis.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                Update Alumni Profile
            </button>
        </div>
    </form>
</div>
@endsection
