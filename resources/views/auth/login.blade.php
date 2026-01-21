@extends('layouts.guest')

@section('content')

<style>
    /* 1. BACKGROUND: DARK BLURRY GRADIENT
       Applied to the body to cover the whole screen.
    */
    body {
        background-color: #0f172a; /* Deep Navy Base */
        background-image: 
            radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
            radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
            radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
            radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
        background-attachment: fixed;
        background-size: cover;
    }

    /* 2. GLASS CARD STYLING (Applies to Mobile & Desktop)
       We override the guest layout default to add the glass effect,
       blur, and border.
    */
    .auth-card {
        background: rgba(21, 31, 50, 0.65) !important; /* Semi-transparent dark */
        backdrop-filter: blur(16px) !important; /* Frosted Blur */
        -webkit-backdrop-filter: blur(16px) !important; /* Safari support */
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
        border-radius: 16px !important;
    }

    /* 3. INPUT FIELDS */
    .form-control {
        background-color: rgba(15, 23, 42, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #e2e8f0 !important;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: rgba(15, 23, 42, 0.8) !important;
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 20px rgba(0, 212, 255, 0.25) !important;
    }

    /* 4. TYPOGRAPHY & BUTTONS */
    .auth-header h1 {
        text-shadow: 0 0 20px rgba(0, 212, 255, 0.4);
    }

    .btn-primary {
        background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
        box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 212, 255, 0.5);
    }
    
    .glass-alert {
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #34d399;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
        font-size: 0.9rem;
    }

    /* Google Button */
    .btn-google {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        background-color: white;
        color: #333;
        font-weight: 600;
        padding: 0.75rem;
        border-radius: 0.375rem;
        text-decoration: none;
        margin-top: 5px;
        transition: all 0.2s;
        border: 1px solid #e2e8f0;
    }
    .btn-google:hover {
        background-color: #f8fafc;
        text-decoration: none;
        color: #0f172a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
    }
    .btn-google img {
        width: 20px;
        height: 20px;
        margin-right: 0.75rem;
    }
    /* Wave Animation Styles */
    .wave-group {
        position: relative;
        margin: 30px 0; /* Adjusted margin */
        width: 100%;
    }

    .wave-group input {
        background-color: transparent !important;
        border: 0 !important;
        border-bottom: 2px #fff solid !important;
        display: block;
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .wave-group input:focus,
    .wave-group input:valid {
        outline: 0;
        border-bottom-color: #00d4ff !important; /* Primary light color */
        background-color: transparent !important;
    }

    .wave-group label {
        position: absolute;
        top: 10px;
        left: 0;
        pointer-events: none;
        display: flex;
    }

    .wave-group label span {
        display: inline-block;
        font-size: 16px;
        min-width: 5px;
        color: rgba(255, 255, 255, 0.7);
        transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .wave-group input:focus + label span,
    .wave-group input:valid + label span {
        color: #00d4ff;
        transform: translateY(-30px);
    }
</style>

<div>
    <div class="auth-header">
        <h1>Welcome to Vacancy Hunting</h1>
        <p>Find Your Dream Job, Find The Right People</p>
    </div>

    @if (session('status'))
        <div class="glass-alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="wave-group">
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            <label class="label">
                <span style="transition-delay:0ms">E</span>
                <span style="transition-delay:50ms">m</span>
                <span style="transition-delay:100ms">a</span>
                <span style="transition-delay:150ms">i</span>
                <span style="transition-delay:200ms">l</span>
            </label>
            @error('email')
                <span class="text-danger" style="font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="wave-group">
            <input type="password" id="password" name="password" required>
            <label class="label">
                <span style="transition-delay:0ms">P</span>
                <span style="transition-delay:50ms">a</span>
                <span style="transition-delay:100ms">s</span>
                <span style="transition-delay:150ms">s</span>
                <span style="transition-delay:200ms">w</span>
                <span style="transition-delay:250ms">o</span>
                <span style="transition-delay:300ms">r</span>
                <span style="transition-delay:350ms">d</span>
            </label>
            @error('password')
                <span class="text-danger" style="font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary">Sign In</button>

        <div class="mt-4">
             <div style="text-align: center; margin: 15px 0; color: #94a3b8; font-size: 0.9rem;">— OR —</div>
             <a href="{{ route('auth.google', ['intention' => 'login']) }}" class="btn-google">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google">
                 Sign in with Google
             </a>
        </div>
    </form>

    <div class="auth-footer">
        Don't have an account? 
        <a href="{{ route('register') }}" class="auth-link">Sign Up</a>
    </div>
</div>

@endsection