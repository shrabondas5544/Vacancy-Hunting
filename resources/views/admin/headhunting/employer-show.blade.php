@extends('admin.headhunting.layout')

@section('page-title', 'Employer Details')

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
        background: linear-gradient(135deg, #0f766e 0%, #0d9488 50%, #0f172a 100%);
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
        border-radius: 12px;
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

    .profile-info {
        flex: 1;
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

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-badge.pending {
        background-color: rgba(249, 115, 22, 0.2);
        color: #fb923c;
    }

    .status-badge.approved {
        background-color: rgba(34, 197, 94, 0.2);
        color: #4ade80;
    }

    .status-badge.rejected {
        background-color: rgba(239, 68, 68, 0.2);
        color: #f87171;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .header-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        text-decoration: none;
    }

    .header-btn.approve {
        background-color: #22c55e;
        color: white;
    }

    .header-btn.approve:hover {
        background-color: #16a34a;
    }

    .header-btn.reject {
        background-color: rgba(239, 68, 68, 0.2);
        color: #f87171;
    }

    .header-btn.reject:hover {
        background-color: #ef4444;
        color: white;
    }

    .header-btn svg {
        width: 18px;
        height: 18px;
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

    .text-content {
        color: var(--text-muted);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .team-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1rem;
    }

    .team-member {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background-color: var(--surface-hover);
        border-radius: 8px;
    }

    .team-member-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        overflow: hidden;
    }

    .team-member-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .team-member-info h5 {
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.9rem;
    }

    .team-member-info p {
        font-size: 0.8rem;
        color: var(--text-muted);
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

    .locations-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .location-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.75rem;
        background-color: var(--surface-hover);
        border-radius: 8px;
    }

    .location-item svg {
        width: 20px;
        height: 20px;
        color: var(--primary);
        flex-shrink: 0;
        margin-top: 0.1rem;
    }

    .location-item span {
        color: var(--text-main);
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

        .action-buttons {
            justify-content: center;
        }
    }
</style>
@endsection

@section('page-content')
<a href="{{ route('admin.headhunting.employers') }}" class="back-btn">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
    </svg>
    Back to Employers
</a>

<!-- Profile Header -->
<div class="profile-header">
    <div class="profile-avatar">
        @if($employer->profile_picture)
            <img src="{{ asset('storage/' . $employer->profile_picture) }}" alt="{{ $employer->company_name }}">
        @else
            {{ strtoupper(substr($employer->company_name ?? 'E', 0, 1)) }}
        @endif
    </div>
    <div class="profile-info">
        <h1>{{ $employer->company_name ?? 'N/A' }}</h1>
        <p>{{ $employer->user->email ?? 'No email' }}</p>
        <div class="profile-meta">
            <span class="status-badge {{ $employer->status }}">
                {{ ucfirst($employer->status ?? 'pending') }}
            </span>
            <div class="meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Registered {{ $employer->created_at->format('M d, Y') }}
            </div>
            @if($employer->status === 'approved' && $employer->approved_at)
                <div class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Approved {{ $employer->approved_at->format('M d, Y') }}
                </div>
            @endif
            @if($employer->contact_number)
                <div class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    {{ $employer->contact_number }}
                </div>
            @endif
        </div>
    </div>
    @if($employer->status === 'pending')
        <div class="action-buttons">
            <form action="{{ route('admin.headhunting.employers.approve', $employer->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="header-btn approve">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Approve
                </button>
            </form>
            <form action="{{ route('admin.headhunting.employers.reject', $employer->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="header-btn reject">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    Reject
                </button>
            </form>
        </div>
    @endif
</div>

<div class="content-grid">
    <div class="main-column">
        <!-- About -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"></path>
                    <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path>
                </svg>
                About Company
            </h3>
            @if($employer->company_description)
                <p class="text-content">{{ $employer->company_description }}</p>
            @else
                <p class="empty-section">No company description provided.</p>
            @endif
        </div>

        <!-- Company Information -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                Company Information
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <label>Company Name</label>
                    <span>{{ $employer->company_name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Company Type</label>
                    <span>{{ $employer->company_type ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Contact Number</label>
                    <span>{{ $employer->contact_number ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <span>{{ $employer->user->email ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Establishment Year</label>
                    <span>{{ $employer->establishment_year ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Company Ownership</label>
                    <span>{{ ucfirst($employer->company_ownership ?? 'N/A') }}</span>
                </div>
                <div class="info-item">
                    <label>Employee Count</label>
                    <span>{{ $employer->employee_count ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <label>Trade License No.</label>
                    <span>{{ $employer->trade_license_no ?? 'N/A' }}</span>
                </div>
                <div class="info-item full-width">
                    <label>Address</label>
                    <span>
                        @if($employer->street || $employer->city || $employer->state || $employer->zip_code || $employer->country)
                            {{ $employer->street ?? '' }}
                            {{ $employer->city ? ', ' . $employer->city : '' }}
                            {{ $employer->state ? ', ' . $employer->state : '' }}
                            {{ $employer->zip_code ? ' ' . $employer->zip_code : '' }}
                            {{ $employer->country ? ', ' . $employer->country : '' }}
                        @elseif($employer->company_address)
                            {{ $employer->company_address }}
                        @else
                            N/A
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        @if($employer->mission_statement || $employer->vision_statement)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="6"></circle>
                        <circle cx="12" cy="12" r="2"></circle>
                    </svg>
                    Mission & Vision
                </h3>
                @if($employer->mission_statement)
                    <div style="margin-bottom: 1rem;">
                        <label style="font-weight: 600; color: var(--text-main); margin-bottom: 0.5rem; display: block;">Mission</label>
                        <p class="text-content">{{ $employer->mission_statement }}</p>
                    </div>
                @endif
                @if($employer->vision_statement)
                    <div>
                        <label style="font-weight: 600; color: var(--text-main); margin-bottom: 0.5rem; display: block;">Vision</label>
                        <p class="text-content">{{ $employer->vision_statement }}</p>
                    </div>
                @endif
            </div>
        @endif

        <!-- Company Values -->
        @if($employer->company_values)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    Company Values
                </h3>
                @if(is_array($employer->company_values))
                    <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                        @foreach($employer->company_values as $value)
                            <span style="background-color: var(--surface-hover); color: var(--text-main); padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.9rem;">
                                {{ $value }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-content">{{ $employer->company_values }}</p>
                @endif
            </div>
        @endif

        <!-- Products & Services -->
        @if($employer->products_services)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    Products & Services
                </h3>
                <p class="text-content">{{ $employer->products_services }}</p>
            </div>
        @endif

        <!-- Company History -->
        @if($employer->company_history)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Company History
                </h3>
                @if(is_array($employer->company_history))
                    <ul style="list-style-type: none; padding: 0;">
                        @foreach($employer->company_history as $history)
                            <li style="margin-bottom: 1rem; padding-left: 1rem; border-left: 2px solid var(--primary);">
                                @if(is_array($history) && isset($history['year']))
                                    <strong style="color: var(--primary);">{{ $history['year'] }}</strong>
                                    <p style="margin: 0.25rem 0 0 0; font-size: 0.95rem;">{{ $history['description'] ?? '' }}</p>
                                @else
                                    <p style="margin: 0;">{{ is_string($history) ? $history : json_encode($history) }}</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-content">{{ $employer->company_history }}</p>
                @endif
            </div>
        @endif

        <!-- Employee Benefits -->
        @if($employer->employee_benefits)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    Employee Benefits
                </h3>
                @if(is_array($employer->employee_benefits))
                    <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                        @foreach($employer->employee_benefits as $benefit)
                            <span style="background-color: var(--surface-hover); color: var(--text-main); padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem;">
                                {{ $benefit }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-content">{{ $employer->employee_benefits }}</p>
                @endif
            </div>
        @endif

        <!-- Team Members -->
        @if($employer->teamMembers->count() > 0)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Key Team Members
                </h3>
                <div class="team-list">
                    @foreach($employer->teamMembers as $member)
                        <div class="team-member">
                            <div class="team-member-avatar">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                @else
                                    {{ strtoupper(substr($member->name ?? 'T', 0, 1)) }}
                                @endif
                            </div>
                            <div class="team-member-info">
                                <h5>{{ $member->name }}</h5>
                                <p>{{ $member->position }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Media Gallery -->
        @if($employer->media->count() > 0)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                    Media Gallery
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
                    @foreach($employer->media as $media)
                        <div style="aspect-ratio: 16/9; background-color: var(--surface-hover); border-radius: 8px; overflow: hidden; position: relative;">
                            @if($media->media_type === 'image')
                                <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->caption }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 32px; height: 32px;">
                                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                    </svg>
                                </div>
                            @endif
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

            <form action="{{ route('admin.headhunting.employers.password', $employer->id) }}" method="POST" class="password-form">
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

        <!-- Website & Social Links -->
        <div class="card">
            <h3 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                </svg>
                Links
            </h3>
            <div class="social-links">
                @if($employer->website_url)
                    <a href="{{ $employer->website_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        Website
                    </a>
                @endif
                @if($employer->linkedin_url)
                    <a href="{{ $employer->linkedin_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        LinkedIn
                    </a>
                @endif
                @if($employer->twitter_url)
                    <a href="{{ $employer->twitter_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        Twitter
                    </a>
                @endif
                @if($employer->facebook_url)
                    <a href="{{ $employer->facebook_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        Facebook
                    </a>
                @endif
                @if($employer->instagram_url)
                    <a href="{{ $employer->instagram_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        Instagram
                    </a>
                @endif
                @if($employer->youtube_url)
                    <a href="{{ $employer->youtube_url }}" target="_blank" class="social-link">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        YouTube
                    </a>
                @endif
                @if(!$employer->website_url && !$employer->linkedin_url && !$employer->twitter_url && !$employer->facebook_url && !$employer->instagram_url && !$employer->youtube_url)
                    <p class="empty-section">No links provided.</p>
                @endif
            </div>
        </div>

        <!-- Locations -->
        @if($employer->locations->count() > 0)
            <div class="card">
                <h3 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Office Locations
                </h3>
                <div class="locations-list">
                    @foreach($employer->locations as $location)
                        <div class="location-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>{{ $location->address ?? $location->city ?? 'Location' }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
