@extends('admin.layout')

@section('styles')
<style>
    .dashboard-wrapper {
        min-height: 100vh;
        background-color: var(--background);
        padding-bottom: 2rem;
    }

    .navbar {
        background-color: var(--surface);
        border-bottom: 1px solid var(--border);
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: var(--shadow);
    }

    .nav-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .user-menu {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logout-btn {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .logout-btn:hover {
        color: var(--error);
    }

    .avatar {
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
        box-shadow: 0 0 0 2px var(--background);
    }

    .hero-section {
        background: linear-gradient(135deg, #4f46e5 0%, #0f172a 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--border);
    }

    .hero-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .hero-subtitle {
        opacity: 0.8;
        font-size: 1.1rem;
        color: #cbd5e1;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 0 1rem;
    }

    .card {
        background-color: var(--surface);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        border: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
        background-color: var(--surface-hover);
    }

    .card-icon-wrapper {
        width: 64px;
        height: 64px;
        background-color: rgba(99, 102, 241, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        color: var(--primary);
        transition: all 0.3s;
    }

    .card:hover .card-icon-wrapper {
        background-color: var(--primary);
        color: white;
        transform: scale(1.1);
    }

    .card-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .card-desc {
        font-size: 0.9rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .card svg {
        width: 32px;
        height: 32px;
    }

    /* Mobile adjustments */
    @media (max-width: 640px) {
        .hero-section {
            padding: 2rem 0;
            text-align: center;
        }
        
        .grid-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="#" class="logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                Vacancy Hunting
            </a>
            <div class="user-menu">
                <span style="color: white; font-weight: 500; font-size: 0.9rem; margin-right: 0.5rem; opacity: 0.9;">{{ Auth::user()->email }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf

                    <button type="submit" class="logout-btn">Logout</button>
                </form>
                <div class="avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">VH Admin Dashboard</h1>
            <p class="hero-subtitle">Manage all aspects of your platform from one place.</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="container">
        <div class="grid-container">
            <!-- Headhunting -->
            @if($isSuperAdmin || (isset($permissions['headhunting']) && $permissions['headhunting']))
            <a href="{{ route('admin.headhunting.index') }}" class="card">
                <div class="card-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3 class="card-title">Headhunting</h3>
                <p class="card-desc">Executive search and specialized recruitment services.</p>
            </a>
            @endif

            <!-- Corporate Workshop -->
            @if($isSuperAdmin || (isset($permissions['corporate_workshop']) && $permissions['corporate_workshop']))
            <a href="{{ route('admin.corporate-workshop') }}" class="card">
                <div class="card-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                </div>
                <h3 class="card-title">Corporate Workshop</h3>
                <p class="card-desc">Organize and manage corporate training sessions.</p>
            </a>
            @endif

            <!-- Career Counselling -->
            @if($isSuperAdmin || (isset($permissions['career_counselling']) && $permissions['career_counselling']))
            <a href="{{ route('admin.career-counselling') }}" class="card">
                <div class="card-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <h3 class="card-title">Career Counselling</h3>
                <p class="card-desc">Guidance and advisory for career paths.</p>
            </a>
            @endif

            <!-- Skill Development -->
            @if($isSuperAdmin || (isset($permissions['skill_development']) && $permissions['skill_development']))
            <a href="{{ route('admin.skill-development') }}" class="card">
                <div class="card-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                </div>
                <h3 class="card-title">Skill Development</h3>
                <p class="card-desc">Manage skill enhancement programs and courses.</p>
            </a>
            @endif

            <!-- People Empowerment -->
            @if($isSuperAdmin || (isset($permissions['people_empowerment']) && $permissions['people_empowerment']))
            <a href="{{ route('admin.people-empowerment') }}" class="card">
                <div class="card-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 class="card-title">People Empowerment</h3>
                <p class="card-desc">Initiatives to empower and uplift individuals.</p>
            </a>
            @endif

            <!-- Consultancy & Advisory -->
            @if($isSuperAdmin || (isset($permissions['consultancy_advisory']) && $permissions['consultancy_advisory']))
            <a href="{{ route('admin.consultancy-advisory') }}" class="card">
                <div class="card-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                </div>
                <h3 class="card-title">Consultancy & Advisory</h3>
                <p class="card-desc">Professional consultancy services for businesses.</p>
            </a>
            @endif

            <!-- Campus Bird Internship -->
            @if($isSuperAdmin || (isset($permissions['campus_bird']) && $permissions['campus_bird']))
            <a href="{{ route('admin.campus-bird.index') }}" class="card">
                <div class="card-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h3 class="card-title">Campus Bird Internship</h3>
                <p class="card-desc">Manage internship programs and campus activities.</p>
            </a>
            @endif

            <!-- Manage Admin Users (Super Admin Only) -->
            @if($isSuperAdmin)
            <a href="{{ route('admin.manage-admins.index') }}" class="card">
                <div class="card-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <circle cx="18" cy="7" r="3"></circle>
                        <line x1="12" y1="12" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12" y2="8"></line>
                    </svg>
                </div>
                <h3 class="card-title">Manage Admin Users</h3>
                <p class="card-desc">Create and manage admin user accounts and permissions.</p>
            </a>
            @endif

        </div>
    </div>
</div>
@endsection
