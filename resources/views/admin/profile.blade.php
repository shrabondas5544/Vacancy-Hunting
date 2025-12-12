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
    
    .back-btn {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
        transition: color 0.2s;
        margin-right: 1rem;
    }
    
    .back-btn:hover {
        color: var(--primary);
    }

    .container-sm {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .profile-card {
        background-color: var(--surface);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        margin-top: 2rem;
    }

    .profile-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .profile-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .profile-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-main);
        font-size: 0.9rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        background-color: rgba(15, 23, 42, 0.5);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        color: var(--text-main);
        font-size: 1rem;
        transition: all 0.2s;
        font-family: inherit;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    .btn-block {
        width: 100%;
    }
    
    .error-msg {
        color: var(--error);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }
    
    .success-msg {
        background-color: rgba(34, 197, 94, 0.1);
        color: var(--success);
        padding: 1rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        text-align: center;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                Vacancy Hunting
            </a>
            <div class="user-menu">
                <a href="{{ route('admin.dashboard') }}" class="back-btn">Back to Dashboard</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-sm">
        <div class="profile-card">
            <div class="profile-header">
                <h2 class="profile-title">Profile Settings</h2>
                <p class="profile-subtitle">{{ Auth::user()->email }} ({{ ucfirst(Auth::user()->role) }})</p>
            </div>

            @if (session('status') === 'password-updated')
                <div class="success-msg">
                    Password updated successfully.
                </div>
            @endif

            <form action="{{ route('admin.profile.password') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-input" required>
                    @error('current_password')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                    @error('password')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
