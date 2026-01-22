@extends('admin.campus-bird.layout')

@section('page-title', 'Alumni Details')

@section('page-styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-title h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.25rem;
    }

    .page-title p {
        color: var(--text-muted);
        font-size: 1rem;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 2rem;
    }

    .card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .profile-card {
        text-align: center;
    }

    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--surface-hover);
        margin-bottom: 1.5rem;
    }

    .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .profile-category {
        font-size: 1rem;
        color: var(--primary);
        font-weight: 500;
        margin-bottom: 1.5rem;
        display: inline-block;
        background: rgba(99, 102, 241, 0.1);
        padding: 0.25rem 1rem;
        border-radius: 50px;
    }

    .info-list {
        text-align: left;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        border-top: 1px solid var(--border);
        padding-top: 1.5rem;
        margin-top: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: var(--text-muted);
    }

    .info-item svg {
        width: 20px;
        height: 20px;
        color: var(--primary);
        flex-shrink: 0;
    }

    .info-item span {
        font-size: 0.95rem;
        word-break: break-all;
    }

    .details-section {
        margin-bottom: 2rem;
    }

    .details-section h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--border);
    }

    .details-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 1rem;
    }

    .details-group label {
        display: block;
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
    }

    .details-group p {
        color: var(--text-main);
        font-size: 1rem;
        font-weight: 500;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--surface-hover);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        transition: all 0.2s;
    }

    .social-link:hover {
        background-color: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: var(--primary);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.2s;
    }

    .btn-edit:hover {
        background-color: var(--primary-dark);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: transparent;
        border: 1px solid var(--border);
        color: var(--text-main);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.2s;
    }

    .btn-back:hover {
        background-color: var(--surface-hover);
    }

    @media (max-width: 900px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('page-content')
<div class="page-header">
    <div class="page-title">
        <h1>Alumni Profile</h1>
        <p>View alumni details</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <a href="{{ route('admin.campus-bird.alumnis.index') }}" class="btn-back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back
        </a>
        <a href="{{ route('admin.campus-bird.alumnis.edit', $alumni->id) }}" class="btn-edit">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
            Edit Profile
        </a>
    </div>
</div>

<div class="content-grid">
    <!-- Sidebar Profile Card -->
    <div class="card profile-card">
        <img src="{{ asset($alumni->photo) }}" alt="{{ $alumni->name }}" class="profile-img">
        <h2 class="profile-name">{{ $alumni->name }}</h2>
        <div class="profile-category">{{ $alumni->category }}</div>

        <div class="info-list">
            <div class="info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <span>Born: {{ $alumni->dob->format('M d, Y') }}</span>
            </div>
            <div class="info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <span>{{ $alumni->email }}</span>
            </div>
            <div class="info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                <span>{{ $alumni->phone }}</span>
            </div>
            <div class="info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span>{{ $alumni->address }}</span>
            </div>
        </div>

        <div class="social-links">
            @if($alumni->facebook)
            <a href="{{ $alumni->facebook }}" target="_blank" class="social-link" title="Facebook">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
            </a>
            @endif
            @if($alumni->twitter)
            <a href="{{ $alumni->twitter }}" target="_blank" class="social-link" title="Twitter">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
            </a>
            @endif
            @if($alumni->linkedin)
            <a href="{{ $alumni->linkedin }}" target="_blank" class="social-link" title="LinkedIn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
            </a>
            @endif
            @if($alumni->instagram)
            <a href="{{ $alumni->instagram }}" target="_blank" class="social-link" title="Instagram">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
            </a>
            @endif
        </div>
    </div>

    <!-- Main Details -->
    <div class="card">
        <div class="details-section">
            <h3>About</h3>
            <p style="color: var(--text-muted); line-height: 1.6;">
                {{ $alumni->description }}
            </p>
        </div>

        <div class="details-section">
            <h3>Program Details</h3>
            <div class="details-row">
                <div class="details-group">
                    <label>Program Version</label>
                    <p>{{ $alumni->program }}</p>
                </div>
                <div class="details-group">
                    <label>Division</label>
                    <p>{{ $alumni->division }}</p>
                </div>
                <div class="details-group">
                    <label>Year</label>
                    <p>{{ $alumni->year }}</p>
                </div>
            </div>
        </div>

        @if($alumni->school || $alumni->college || $alumni->university)
        <div class="details-section" style="border-bottom: none; margin-bottom: 0;">
            <h3>Education</h3>
            <div class="details-row">
                @if($alumni->university)
                <div class="details-group">
                    <label>University</label>
                    <p>{{ $alumni->university }}</p>
                </div>
                @endif
                @if($alumni->college)
                <div class="details-group">
                    <label>College</label>
                    <p>{{ $alumni->college }}</p>
                </div>
                @endif
                @if($alumni->school)
                <div class="details-group">
                    <label>School</label>
                    <p>{{ $alumni->school }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
