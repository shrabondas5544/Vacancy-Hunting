@extends('admin.layout')

@section('styles')
<style>
    html, body {
        height: 100%;
        margin: 0;
    }

    .login-wrapper {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
        padding: 1rem;
    }

    .login-card {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(12px);
        padding: 2.5rem;
        border-radius: 20px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.5);
        border: 1px solid rgba(255, 255, 255, 0.05);
        animation: floatUp 0.6s ease-out;
    }

    @keyframes floatUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .login-subtitle {
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

    .form-input, .form-select {
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

    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }
    
    .form-input::placeholder {
        color: var(--secondary);
    }

    .form-select option {
        background-color: var(--surface);
        color: var(--text-main);
    }

    .btn-block {
        width: 100%;
    }
    
    .error-msg {
        color: var(--error);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .footer-text {
        text-align: center;
        margin-top: 1.5rem;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    /* Mobile adjustments */
    @media (max-width: 640px) {
        .login-card {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">Admin Access</h1>
            <p class="login-subtitle">Secure login for platform administrators</p>
        </div>

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="role" class="form-label">Login As</label>
                <select id="role" name="role" class="form-select">
                    <option value="admin">Administrator</option>
                    <option value="moderator">Moderator</option>
                    <option value="chairman">Chairman</option>
                    <option value="candidate">Candidate</option>
                    <option value="employer">Employer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="admin@example.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Login to Dashboard
            </button>
        </form>

        <div class="footer-text">
            © {{ date('Y') }} Vacancy Hunting. Restricted Area.
        </div>
    </div>
</div>
@endsection
