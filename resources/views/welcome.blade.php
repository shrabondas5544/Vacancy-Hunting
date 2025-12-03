<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        /* Navbar Styles - Matching signin page gradient */
        .navbar {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
                radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        
        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }
        
        .logo-icon {
            width: 24px;
            height: 24px;
            background: #00bcd4;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-icon::before {
            content: '◈';
            color: white;
            font-size: 14px;
        }
        
        .nav-center {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: #00bcd4;
        }
        
        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        
        /* User Menu Dropdown */
        .user-menu {
            position: relative;
            /* Add padding to create hover bridge */
            padding-bottom: 0.5rem;
        }
        
        .user-menu-trigger {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .user-menu-trigger:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .user-menu-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12), 
                        0 2px 8px rgba(0, 0, 0, 0.08);
            min-width: 220px;
            overflow: hidden;
            margin-top: 4px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        
        /* Show dropdown on hover OR when active class is added */
        .user-menu:hover .user-menu-dropdown,
        .user-menu.active .user-menu-dropdown {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        
        .dropdown-item {
            padding: 0.875rem 1.25rem;
            color: #2d3748;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.925rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            width: 100%;
            text-align: left;
            background: transparent;
            cursor: pointer;
            position: relative;
        }
        
        .dropdown-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #00bcd4;
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(0, 188, 212, 0.08) 0%, rgba(0, 188, 212, 0.02) 100%);
            color: #00bcd4;
        }
        
        .dropdown-item:hover::before {
            transform: scaleY(1);
        }
        
        /* Add divider between items */
        .dropdown-item:not(:last-child) {
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            height: calc(100vh - 72px);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80') center/cover;
        }
        
        .hero-content {
            text-align: center;
            color: white;
            z-index: 2;
            max-width: 800px;
            padding: 2rem;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 2.5rem;
            opacity: 0.95;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            background: #00bcd4;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid #00bcd4;
            display: inline-block;
        }
        
        .btn-primary:hover {
            background: #00a5bb;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 188, 212, 0.4);
        }
        
        .btn-secondary {
            background: transparent;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid white;
            display: inline-block;
        }
        
        .btn-secondary:hover {
            background: white;
            color: #1a2332;
            transform: translateY(-2px);
        }
        
        /* Carousel Indicators */
        .carousel-indicators {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
            z-index: 3;
        }
        
        .indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .indicator.active {
            background: white;
            width: 30px;
            border-radius: 5px;
        }
        
        /* Logged in user profile */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .user-profile:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        
        .username {
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
        }
        
        .profile-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #00bcd4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.95rem;
        }
        
        /* Make profile icon clickable when it's a trigger */
        .profile-icon.user-menu-trigger {
            cursor: pointer;
        }
        
        /* Style form in dropdown */
        .user-menu-dropdown form {
            margin: 0;
            padding: 0;
        }
        
        /* Hamburger Menu Button */
        .hamburger-btn {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .hamburger-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .hamburger-btn span {
            display: block;
            width: 25px;
            height: 3px;
            background: white;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        .hamburger-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }
        
        .hamburger-btn.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }
        
        /* Mobile Drawer Overlay */
        .mobile-drawer-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .mobile-drawer-overlay.active {
            display: block;
            opacity: 1;
        }
        
        /* Mobile Drawer */
        .mobile-drawer {
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            max-width: 85%;
            height: 100vh;
            background-color: #0f172a;
            background-image: 
                linear-gradient(135deg, rgba(56, 189, 248, 0.1) 0%, rgba(30, 58, 138, 0.15) 100%),
                radial-gradient(at 50% 0%, rgba(0, 212, 255, 0.1) 0px, transparent 50%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: -4px 0 30px rgba(0, 0, 0, 0.5);
            z-index: 2000;
            transition: right 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            overflow-y: auto;
            border-left: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .mobile-drawer.active {
            right: 0;
        }
        
        /* Mobile Drawer Header */
        .drawer-header {
            padding: 2rem 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: linear-gradient(180deg, rgba(0, 212, 255, 0.1) 0%, transparent 100%);
        }
        
        .drawer-user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .drawer-profile-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        }
        
        .drawer-user-info h3 {
            font-size: 1.1rem;
            color: white;
            margin: 0 0 0.25rem 0;
            font-weight: 600;
        }
        
        .drawer-user-info p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            margin: 0;
        }
        
        /* Drawer Navigation */
        .drawer-nav {
            padding: 1rem 0;
        }
        
        .drawer-nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .drawer-nav-link:hover {
            background: rgba(0, 212, 255, 0.1);
            color: #00d4ff;
            border-left-color: #00d4ff;
        }
        
        .drawer-nav-link svg {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
        }
        
        .drawer-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 0.5rem 0;
        }
        
        .logout-btn {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .nav-center {
                display: none;
            }
            
            .hamburger-btn {
                display: flex;
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }
            
            .username {
                display: none;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .hero-buttons {
                flex-direction: column;
            }
            
            .btn-primary, .btn-secondary {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ url('/') }}" class="logo">
                <span class="logo-icon"></span>
                Vacancy Hunting
            </a>
            
            <div class="nav-center">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
                <a href="#" class="nav-link">About</a>
                <a href="#" class="nav-link">Services</a>
                <a href="#" class="nav-link">Blog</a>
                <a href="#" class="nav-link">Policy</a>
            </div>
            
            <div class="nav-right">
                <!-- Hamburger Menu for Mobile -->
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                @auth
                    <!-- Logged in user with dropdown -->
                    <div class="user-menu">
                        <div class="user-profile">
                            <span class="username">
                                @if(Auth::user()->isCandidate())
                                    {{ Auth::user()->candidate->name }}
                                @elseif(Auth::user()->isEmployer())
                                    {{ Auth::user()->employer->company_name }}
                                @elseif(Auth::user()->isAdmin())
                                    {{ Auth::user()->admin->name }}
                                @else
                                    {{ Auth::user()->email }}
                                @endif
                            </span>
                            <div class="profile-icon user-menu-trigger">
                                @if(Auth::user()->isCandidate())
                                    {{ strtoupper(substr(Auth::user()->candidate->name, 0, 1)) }}
                                @elseif(Auth::user()->isEmployer())
                                    {{ strtoupper(substr(Auth::user()->employer->company_name, 0, 1)) }}
                                @elseif(Auth::user()->isAdmin())
                                    {{ strtoupper(substr(Auth::user()->admin->name, 0, 1)) }}
                                @else
                                    {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
                                @endif
                            </div>
                        </div>
                        
                        <!-- Dropdown for logged-in users -->
                        <div class="user-menu-dropdown">
                            <a href="{{ route('profile.show') }}" class="dropdown-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Profile</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Not logged in - Show dropdown menu -->
                    <div class="user-menu">
                        <button class="user-menu-trigger">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </button>
                        <div class="user-menu-dropdown">
                            <a href="{{ route('login') }}" class="dropdown-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                <span>Sign In</span>
                            </a>
                            <a href="{{ route('register') }}" class="dropdown-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                                <span>Sign Up</span>
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
    
    <!-- Mobile Drawer Overlay -->
    <div class="mobile-drawer-overlay" id="drawerOverlay"></div>
    
    <!-- Mobile Drawer -->
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            @auth
                <div class="drawer-user-profile">
                    <div class="drawer-profile-icon">
                        @if(Auth::user()->isCandidate())
                            {{ strtoupper(substr(Auth::user()->candidate->name, 0, 1)) }}
                        @elseif(Auth::user()->isEmployer())
                            {{ strtoupper(substr(Auth::user()->employer->company_name, 0, 1)) }}
                        @elseif(Auth::user()->isAdmin())
                            {{ strtoupper(substr(Auth::user()->admin->name, 0, 1)) }}
                        @else
                            {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
                        @endif
                    </div>
                    <div class="drawer-user-info">
                        <h3>
                            @if(Auth::user()->isCandidate())
                                {{ Auth::user()->candidate->name }}
                            @elseif(Auth::user()->isEmployer())
                                {{ Auth::user()->employer->company_name }}
                            @elseif(Auth::user()->isAdmin())
                                {{ Auth::user()->admin->name }}
                            @else
                                {{ Auth::user()->email }}
                            @endif
                        </h3>
                        <p>
                            @if(Auth::user()->isCandidate())
                                Candidate
                            @elseif(Auth::user()->isEmployer())
                                Employer
                            @elseif(Auth::user()->isAdmin())
                                Admin
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <div class="drawer-user-profile">
                    <div class="drawer-profile-icon">👤</div>
                    <div class="drawer-user-info">
                        <h3>Welcome!</h3>
                        <p>Sign in to continue</p>
                    </div>
                </div>
            @endauth
        </div>
        
        <nav class="drawer-nav">
            <a href="{{ url('/') }}" class="drawer-nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Home</span>
            </a>
            <a href="#" class="drawer-nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4"></path>
                    <path d="M12 8h.01"></path>
                </svg>
                <span>About</span>
            </a>
            <a href="#" class="drawer-nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                <span>Services</span>
            </a>
            <a href="#" class="drawer-nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <span>Blog</span>
            </a>
            <a href="#" class="drawer-nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <span>Policy</span>
            </a>
            
            <div class="drawer-divider"></div>
            
            @auth
                <a href="{{ route('profile.show') }}" class="drawer-nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>My Profile</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="drawer-nav-link" style="width: 100%; cursor: pointer;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="drawer-nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                    <span>Sign In</span>
                </a>
                <a href="{{ route('register') }}" class="drawer-nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    <span>Sign Up</span>
                </a>
            @endauth
        </nav>
    </div>
    
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Find a right people</h1>
            <p class="hero-subtitle">Skills. Careers. Success</p>
            <div class="hero-buttons">
                <a href="#" class="btn-primary">For Job Seekers</a>
                <a href="#" class="btn-secondary">For Employers</a>
            </div>
        </div>
        
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <div class="indicator active"></div>
            <div class="indicator"></div>
            <div class="indicator"></div>
        </div>
    </section>
    
    <script>
        // User menu dropdown toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const userMenu = document.querySelector('.user-menu');
            const userMenuTrigger = document.querySelector('.user-menu-trigger');
            
            if (userMenuTrigger && userMenu) {
                // Toggle dropdown on click
                userMenuTrigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userMenu.classList.toggle('active');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userMenu.contains(e.target)) {
                        userMenu.classList.remove('active');
                    }
                });
                
                // Close dropdown when clicking a dropdown item
                const dropdownItems = document.querySelectorAll('.dropdown-item');
                dropdownItems.forEach(item => {
                    item.addEventListener('click', function() {
                        userMenu.classList.remove('active');
                    });
                });
            }
            
            // Mobile drawer functionality
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const drawerOverlay = document.getElementById('drawerOverlay');
            const drawerLinks = document.querySelectorAll('.drawer-nav-link');
            
            function openDrawer() {
                mobileDrawer.classList.add('active');
                drawerOverlay.classList.add('active');
                hamburgerBtn.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent body scrolling
            }
            
            function closeDrawer() {
                mobileDrawer.classList.remove('active');
                drawerOverlay.classList.remove('active');
                hamburgerBtn.classList.remove('active');
                document.body.style.overflow = ''; // Restore body scrolling
            }
            
            // Toggle drawer when hamburger button is clicked
            if (hamburgerBtn) {
                hamburgerBtn.addEventListener('click', function() {
                    if (mobileDrawer.classList.contains('active')) {
                        closeDrawer();
                    } else {
                        openDrawer();
                    }
                });
            }
            
            // Close drawer when overlay is clicked
            if (drawerOverlay) {
                drawerOverlay.addEventListener('click', closeDrawer);
            }
            
            // Close drawer when a drawer link is clicked
            drawerLinks.forEach(link => {
                link.addEventListener('click', closeDrawer);
            });
            
            // Close drawer on window resize if it's open
            window.addEventListener('resize', function() {
                if (window.innerWidth > 1024 && mobileDrawer.classList.contains('active')) {
                    closeDrawer();
                }
            });
        });
    </script>
</body>
</html>
