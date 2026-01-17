@extends('admin.layout')

@section('styles')
<style>
    .campus-bird-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 260px;
        background-color: var(--surface);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        position: fixed;
        height: 100vh;
        left: 0;
        top: 0;
        z-index: 100;
        transition: transform 0.3s ease;
    }

    .sidebar-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--text-main);
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
    }

    .sidebar-logo img {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        object-fit: cover;
    }

    .sidebar-nav {
        flex: 1;
        padding: 1rem 0;
        overflow-y: auto;
    }

    .nav-section {
        margin-bottom: 1.5rem;
    }

    .nav-section-title {
        padding: 0.5rem 1.5rem;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-muted);
        font-weight: 600;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.5rem;
        color: var(--text-muted);
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
        text-decoration: none;
    }

    .nav-item:hover {
        color: var(--text-main);
        background-color: var(--surface-hover);
    }

    .nav-item.active {
        color: var(--primary);
        background-color: rgba(99, 102, 241, 0.1);
        border-left-color: var(--primary);
    }

    .nav-item svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .sidebar-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
    }

    .back-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: var(--primary);
    }

    .back-link svg {
        width: 18px;
        height: 18px;
    }

    /* Main Content Styles */
    .main-content {
        flex: 1;
        margin-left: 260px;
        background-color: var(--background);
        min-height: 100vh;
    }

    .content-header {
        background-color: var(--surface);
        border-bottom: 1px solid var(--border);
        padding: 1rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-main);
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        background-color: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .user-name {
        font-weight: 500;
        color: var(--text-main);
        font-size: 0.9rem;
    }

    .content-body {
        padding: 2rem;
    }

    /* Mobile Toggle */
    .mobile-toggle {
        display: none;
        background: none;
        border: none;
        color: var(--text-main);
        cursor: pointer;
        padding: 0.5rem;
    }

    .mobile-toggle svg {
        width: 24px;
        height: 24px;
        border-radius: 8px;
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 99;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-overlay.open {
            display: block;
        }

        .main-content {
            margin-left: 0;
        }

        .mobile-toggle {
            display: block;
        }

        .content-body {
            padding: 1rem;
        }
    }

    /* Additional content styles */
    @yield('page-styles')
</style>
@endsection

@section('content')
<div class="campus-bird-wrapper">
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.campus-bird.index') }}" class="sidebar-logo">
                <img src="{{ asset('assets/images/vh-logo.jpg') }}" alt="VH Logo">
                Campus Bird Internship
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">General</div>
                <a href="{{ route('admin.campus-bird.index') }}" class="nav-item {{ request()->routeIs('admin.campus-bird.index') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    Dashboard
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Programs</div>
                <a href="{{ route('admin.campus-bird.applicants') }}" class="nav-item {{ request()->routeIs('admin.campus-bird.applicants*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Applicants
                </a>
                <a href="{{ route('admin.campus-bird.forms.index') }}" class="nav-item {{ request()->routeIs('admin.campus-bird.forms*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Application Forms
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('admin.dashboard') }}" class="back-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Main Dashboard
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="content-header">
            <div class="header-left">
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="header-title">@yield('page-title', 'Campus Bird Internship')</h1>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <div class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                </div>
            </div>
        </header>

        <div class="content-body">
            @yield('page-content')
        </div>
    </main>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('open');
    }
</script>
@endsection
