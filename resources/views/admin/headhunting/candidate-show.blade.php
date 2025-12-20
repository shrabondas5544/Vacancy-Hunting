@extends('admin.headhunting.layout')

@section('page-title', 'Candidate Details')

@section('page-styles')
<style>
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        transition: color 0.2s;
    }

    .back-btn:hover {
        color: var(--primary);
    }

    .back-btn svg {
        width: 18px;
        height: 18px;
    }

    .profile-header {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #0f172a 100%);
        border-radius: var(--radius);
        padding: 2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 700;
        flex-shrink: 0;
        overflow: hidden;
        border: 4px solid rgba(255, 255, 255, 0.3);
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.25rem;
    }

    .profile-info p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
    }

    .profile-meta {
        display: flex;
        gap: 1.5rem;
        margin-top: 0.75rem;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
    }

    .meta-item svg {
        width: 16px;
        height: 16px;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }

    .card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border);
    }

    .card-title svg {
        width: 20px;
        height: 20px;
        color: var(--primary);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .info-item {
        padding: 0.75rem 0;
    }

    .info-item label {
        display: block;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        margin-bottom: 0.25rem;
    }

    .info-item span {
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .info-item.full-width {
        grid-column: 1 / -1;
    }

    .timeline {
        position: relative;
        padding-left: 1.5rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: var(--border);
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -1.5rem;
        top: 0.25rem;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: var(--primary);
        border: 2px solid var(--surface);
    }

    .timeline-title {
        font-weight: 600;
        color: var(--text-main);
        font-size: 1rem;
        margin-bottom: 0.15rem;
    }

    .timeline-subtitle {
        color: var(--primary);
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .timeline-date {
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .timeline-desc {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-top: 0.5rem;
        line-height: 1.5;
    }

    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .skill-tag {
        background-color: rgba(99, 102, 241, 0.1);
        color: var(--primary);
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .languages-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .language-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid var(--border);
    }

    .language-item:last-child {
        border-bottom: none;
    }

    .language-name {
        font-weight: 500;
        color: var(--text-main);
    }

    .language-level {
        font-size: 0.85rem;
        color: var(--text-muted);
        background-color: var(--surface-hover);
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
    }

    /* Password Form */
    .password-form {
        margin-top: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .form-group input {
        width: 100%;
        padding: 0.75rem 1rem;
        background-color: var(--surface-hover);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text-main);
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--primary);
    }

    .btn-submit {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        width: 100%;
    }

    .btn-submit:hover {
        background-color: var(--primary-dark);
    }

    .alert {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .alert-success {
        background-color: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #22c55e;
    }

    .alert-error {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }

    .social-links {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 0.75rem;
        background-color: var(--surface-hover);
        border-radius: 6px;
        color: var(--text-main);
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .social-link:hover {
        background-color: var(--primary);
        color: white;
    }

    .social-link svg {
        width: 16px;
        height: 16px;
    }

    .empty-section {
        color: var(--text-muted);
        font-style: italic;
        font-size: 0.9rem;
    }

    @media (max-width: 900px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .profile-header {
            flex-direction: column;
            text-align: center;
        }

        .profile-meta {
            justify-content: center;
        }
    }
</style>
@endsection

@section('page-content')
<a href="{{ route('admin.headhunting.candidates') }}" class="back-btn">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
    </svg>
    Back to Candidates
</a>

<!-- Profile Header -->
<div class="profile-header">
    <div class="profile-avatar">
        @if($candidate->profile_picture)
            <img src="{{ asset('storage/' . $candidate->profile_picture) }}" alt="{{ $candidate->name }}">
        @else
            {{ strtoupper(substr($candidate->name ?? 'C', 0, 1)) }}
        @endif
    </div>
    <div class="profile-info">
        <h1>{{ $candidate->name ?? 'N/A' }}</h1>
        <p>{{ $candidate->user->email ?? 'No email' }}</p>
        <div class="profile-meta">
            <div class="meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Joined {{ $candidate->created_at->format('M d, Y') }}
            </div>
            @if($candidate->phone)
                <div class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    {{ $candidate->phone }}
                </div>
            @endif
            @if($candidate->city || $candidate->country)
                <div class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    {{ $candidate->city ?? '' }}{{ $candidate->city && $candidate->country ? ', ' : '' }}{{ $candidate->country ?? '' }}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="content-grid">
    <div class="main-column">
        <!-- About -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                About
            </h3>
            @if($candidate->professional_summary)
                <p style="color: var(--text-muted); line-height: 1.6;">{{ $candidate->professional_summary }}</p>
            @else
                <p class="empty-section">No professional summary provided.</p>
            @endif
        </div>

        <!-- Personal Information -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                Personal Information
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <label>Full Name</label>
                    <span>{{ $candidate->name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <span>{{ $candidate->user->email ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Phone</label>
                    <span>{{ $candidate->phone ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Date of Birth</label>
                    <span>{{ $candidate->date_of_birth ? $candidate->date_of_birth->format('M d, Y') : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Gender</label>
                    <span>{{ $candidate->gender ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Experience</label>
                    <span>{{ $candidate->experience_years ?? 0 }} years</span>
                </div>
                <div class="info-item full-width">
                    <label>Address</label>
                    <span>
                        @if($candidate->street || $candidate->city || $candidate->state || $candidate->zip_code || $candidate->country)
                            {{ $candidate->street ?? '' }}
                            {{ $candidate->city ? ', ' . $candidate->city : '' }}
                            {{ $candidate->state ? ', ' . $candidate->state : '' }}
                            {{ $candidate->zip_code ? ' ' . $candidate->zip_code : '' }}
                            {{ $candidate->country ? ', ' . $candidate->country : '' }}
                        @else
                            N/A
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Skills -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                    <polyline points="2 17 12 22 22 17"></polyline>
                    <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
                Skills
            </h3>
            @if($candidate->skills)
                <div class="skills-list">
                    @foreach(explode(',', $candidate->skills) as $skill)
                        <span class="skill-tag">{{ trim($skill) }}</span>
                    @endforeach
                </div>
            @else
                <p class="empty-section">No skills listed.</p>
            @endif
        </div>

        <!-- Education -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                </svg>
                Education
            </h3>
            @if($candidate->education->count() > 0)
                <div class="timeline">
                    @foreach($candidate->education as $edu)
                        <div class="timeline-item">
                            <div class="timeline-title">{{ $edu->degree ?? 'Degree' }}</div>
                            <div class="timeline-subtitle">{{ $edu->institution ?? 'Institution' }}</div>
                            <div class="timeline-date">{{ $edu->graduation_year ?? 'Year not specified' }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-section">No education records.</p>
            @endif
        </div>

        <!-- Experience -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                Work Experience
            </h3>
            @if($candidate->experience->count() > 0)
                <div class="timeline">
                    @foreach($candidate->experience as $exp)
                        <div class="timeline-item">
                            <div class="timeline-title">{{ $exp->job_title ?? 'Position' }}</div>
                            <div class="timeline-subtitle">{{ $exp->company_name ?? 'Company' }}</div>
                            <div class="timeline-date">
                                {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '' }}
                                - 
                                {{ $exp->is_current ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : '') }}
                            </div>
                            @if($exp->description)
                                <div class="timeline-desc">{{ $exp->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-section">No work experience records.</p>
            @endif
        </div>

        <!-- Certifications -->
        @if($candidate->certifications->count() > 0)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="7"></circle>
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                    </svg>
                    Certifications
                </h3>
                <div class="timeline">
                    @foreach($candidate->certifications as $cert)
                        <div class="timeline-item">
                            <div class="timeline-title">{{ $cert->name ?? 'Certification' }}</div>
                            <div class="timeline-subtitle">{{ $cert->issuing_organization ?? '' }}</div>
                            <div class="timeline-date">{{ $cert->issue_date ? \Carbon\Carbon::parse($cert->issue_date)->format('M Y') : '' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="side-column">
        <!-- Change Password -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                Change Password
            </h3>

            @if(session('status') === 'password-updated')
                <div class="alert alert-success">Password updated successfully!</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.headhunting.candidates.password', $candidate->id) }}" method="POST" class="password-form">
                @csrf
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required minlength="8">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn-submit">Update Password</button>
            </form>
        </div>

        <!-- Social Links -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                </svg>
                Social Links
            </h3>
            <div class="social-links">
                @if($candidate->linkedin_url)
                    <a href="{{ $candidate->linkedin_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        LinkedIn
                    </a>
                @endif
                @if($candidate->github_url)
                    <a href="{{ $candidate->github_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        GitHub
                    </a>
                @endif
                @if($candidate->portfolio_url)
                    <a href="{{ $candidate->portfolio_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        Portfolio
                    </a>
                @endif
                @if($candidate->twitter_url)
                    <a href="{{ $candidate->twitter_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        Twitter
                    </a>
                @endif
                @if(!$candidate->linkedin_url && !$candidate->github_url && !$candidate->portfolio_url && !$candidate->twitter_url)
                    <p class="empty-section">No social links provided.</p>
                @endif
            </div>
        </div>

        <!-- Languages -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
                Languages
            </h3>
            @if($candidate->languages->count() > 0)
                <div class="languages-list">
                    @foreach($candidate->languages as $lang)
                        <div class="language-item">
                            <span class="language-name">{{ $lang->language ?? 'Language' }}</span>
                            <span class="language-level">{{ $lang->proficiency ?? 'N/A' }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-section">No languages listed.</p>
            @endif
        </div>
    </div>
</div>
@endsection
