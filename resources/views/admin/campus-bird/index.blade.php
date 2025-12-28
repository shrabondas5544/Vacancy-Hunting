@extends('admin.campus-bird.layout')

@section('page-title', 'Dashboard')

@section('page-styles')
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #064e3b 100%);
        border-radius: var(--radius);
        padding: 2.5rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        bottom: -60%;
        left: 10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .hero-subtitle {
        opacity: 0.85;
        font-size: 1rem;
        max-width: 500px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 24px;
        height: 24px;
    }

    .stat-icon.green {
        background-color: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .stat-icon.blue {
        background-color: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    .stat-icon.orange {
        background-color: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }

    .stat-info h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-info p {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .quick-actions {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background-color: var(--surface-hover);
        border-radius: 8px;
        color: var(--text-main);
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .action-link:hover {
        background-color: var(--primary);
        color: white;
        transform: translateX(5px);
    }
</style>
@endsection

@section('page-content')
<!-- Hero Section -->
<div class="dashboard-hero">
    <div class="hero-content">
        <h1 class="hero-title">Campus Bird Internship</h1>
        <p class="hero-subtitle">Manage internship programs, student applications, and campus activities.</p>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_interns'] ?? 0 }}</h3>
            <p>Total Interns</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['active_programs'] ?? 0 }}</h3>
            <p>Active Programs</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['pending_applications'] ?? 0 }}</h3>
            <p>Pending Applications</p>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h2 class="section-title">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
        </svg>
        Quick Actions
    </h2>
    <div class="action-links">
        <a href="{{ route('admin.campus-bird.applicants') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            View Applicants
        </a>
        <a href="{{ route('admin.campus-bird.forms.index') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            Manage Application Forms
        </a>
        <a href="{{ route('admin.dashboard') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            Back to Main Dashboard
        </a>
    </div>
</div>
@endsection
