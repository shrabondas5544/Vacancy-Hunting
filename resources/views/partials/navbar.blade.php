<style>
    /* Navbar Styles - Glassmorphism Effect */
    .navbar {
        background: rgba(15, 23, 42, 0.7);
        background-image: 
            radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
            radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        backdrop-filter: blur(20px) saturate(180%);
        padding: 1rem 2rem;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
        gap: 0.6rem;
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        white-space: nowrap; /* Prevent text wrapping */
        text-align: left; /* Ensure text alignment */
    }
    
    .logo-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .logo-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Performance: explicit dimensions */
        width: 32px;
        height: 32px;
    }
    
    .nav-center {
        display: flex;
        gap: 2rem;
        align-items: center;
    }
    
    .nav-link {
        position: relative;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 0.5rem 0;
    }
    
    /* Animated underline effect */
    .nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #00bcd4, #00d4ff);
        transform: translateX(-50%);
        transition: width 0.3s ease;
        box-shadow: 0 0 10px rgba(0, 188, 212, 0.5);
    }
    
    .nav-link:hover {
        color: #00d4ff;
        transform: translateY(-2px);
        text-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
    }
    
    .nav-link:hover::before {
        width: 100%;
    }
    
    /* Glow effect on hover */
    .nav-link:hover {
        animation: navLinkGlow 0.3s ease-in-out;
    }
    
    @keyframes navLinkGlow {
        0%, 100% {
            filter: brightness(1);
        }
        50% {
            filter: brightness(1.3);
        }
    }
    
    .nav-right {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .user-menu {
        position: relative;
        padding-bottom: 0.5rem;
        /* Crucial: Extend the wrapper down so the mouse doesn't leave it before hitting the menu */
        padding-bottom: 20px;
        margin-bottom: -20px; /* Compensate for layout */
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
        top: 100%; /* Positions it right at the bottom of the padded wrapper */
        background: rgba(255, 255, 255, 0.98);
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
        min-width: 220px;
        overflow: hidden;
        margin-top: 0; /* No margin to ensure physical connection */
        border: 1px solid rgba(0, 0, 0, 0.08);
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
        z-index: 1100;
    }
    
    /* Invisible bridge for profile dropdown - Extra safety */
    .user-menu-dropdown::before {
        content: '';
        position: absolute;
        top: -30px; 
        left: 0;
        width: 100%;
        height: 30px;
        background: transparent;
    }
    
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
    
    .dropdown-item:not(:last-child) {
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }
    
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
    
    .profile-icon.user-menu-trigger {
        cursor: pointer;
    }
    
    .user-menu-dropdown form {
        margin: 0;
        padding: 0;
    }
    
    /* Navigation Dropdown Styles */
    .nav-drop-wrapper {
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
        /* Padding to increase hit area slightly if needed */
        padding: 0 0.5rem;
        /* Crucial: Extend the wrapper down so the mouse doesn't leave it before hitting the menu */
        padding-bottom: 20px;
        margin-bottom: -20px; /* Compensate for layout */
    }

    .nav-drop-menu {
        display: none;
        position: absolute;
        left: 0;
        top: 100%; /* Positions it right at the bottom of the padded wrapper */
        background: rgba(255, 255, 255, 0.98);
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
        min-width: 260px;
        overflow: hidden;
        margin-top: 0; /* No margin to ensure physical connection */
        border: 1px solid rgba(0, 0, 0, 0.08);
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
        z-index: 1100; /* Ensure it's on top */
    }
    
    /* Invisible bridge to prevent menu from closing when moving mouse - Extra safety */
    .nav-drop-menu::before {
        content: '';
        position: absolute;
        top: -30px; 
        left: 0;
        width: 100%;
        height: 30px;
        background: transparent;
    }

    .nav-drop-wrapper:hover .nav-drop-menu {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    /* ------- MOBILE BOTTOM NAVIGATION STYLES ------- */
    .mobile-bottom-nav {
        display: none;
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        height: 70px;
        background: rgba(15, 23, 42, 0.9);
        -webkit-backdrop-filter: blur(15px);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 2000;
        justify-content: space-around;
        align-items: center;
        padding: 0 10px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        border-radius: 40px;
    }

    .mobile-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.75rem;
        gap: 4px;
        flex: 1;
        height: 100%;
        transition: all 0.3s ease;
        background: transparent;
        border: none;
        cursor: pointer;
    }

    .mobile-nav-item svg {
        width: 24px;
        height: 24px;
        stroke-width: 2;
        transition: all 0.3s ease;
    }

    .mobile-nav-item.active,
    .mobile-nav-item:hover {
        color: #00d4ff;
    }

    .mobile-nav-item.active svg,
    .mobile-nav-item:hover svg {
        transform: translateY(-2px);
        filter: drop-shadow(0 0 5px rgba(0, 212, 255, 0.5));
    }

    /* Center Item (Home) Special Style */
    .mobile-nav-item.center-item {
        position: relative;
        top: -20px;
        background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
        width: 56px;
        height: 56px;
        border-radius: 50%;
        flex: none;
        color: white;
        box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
        border: 4px solid #0f172a; /* Match body bg to create cutout effect */
    }

    .mobile-nav-item.center-item svg {
        width: 28px;
        height: 28px;
        color: white !important;
    }

    .mobile-nav-item.center-item span {
        display: none;
    }

    .mobile-nav-item.center-item:hover {
        transform: translateY(-5px);
        color: white;
    }

    /* Bottom Sheet Styles */
    .bottom-sheet-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        -webkit-backdrop-filter: blur(4px);
        backdrop-filter: blur(4px);
        z-index: 2001;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .bottom-sheet-overlay.active {
        display: block;
        opacity: 1;
    }

    .bottom-sheet {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #1e293b;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        padding: 20px 0;
        transform: translateY(100%);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 2002;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        max-height: 80vh;
        overflow-y: auto;
    }

    .bottom-sheet.active {
        transform: translateY(0);
    }

    .sheet-handle {
        width: 40px;
        height: 4px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 2px;
        margin: 0 auto 20px;
    }

    .sheet-header {
        padding: 0 20px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 10px;
    }

    .sheet-title {
        color: white;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .sheet-content {
        padding: 0 10px;
    }

    .sheet-item {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        font-size: 1rem;
        border-radius: 12px;
        transition: background 0.2s;
        gap: 12px;
    }

    .sheet-item:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #00d4ff;
    }

    .sheet-item svg {
        width: 20px;
        height: 20px;
        opacity: 0.7;
    }
    
    .sheet-item:hover svg {
        opacity: 1;
        color: #00d4ff;
    }

    @media (max-width: 1024px) {
        .nav-center {
            display: none;
        }
        
        .user-menu {
            display: none;
        }
    }
    
    @media (max-width: 1024px) {
        .navbar {
            padding: 0.8rem 1rem; /* Reduced padding for mobile */
        }
        .navbar-container {
            justify-content: space-between; /* Keep spacing distributed */
        }
        .logo {
            flex-direction: row-reverse; /* Text on Left, Icon on Right */
        }
        
        .username {
            display: none;
        }

        .mobile-bottom-nav {
            display: flex;
        }

        /* Adjust body padding for bottom nav */
        body {
            padding-bottom: 80px;
        }
    }

    .nav-spacer-icon {
        font-size: 0.7em; 
        margin-left: 4px;
    }
</style>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ url('/') }}" class="logo">
            <span class="logo-icon"><img src="{{ asset('assets/images/VH_logo.png') }}" alt="VH" width="32" height="32"></span>
            Vacancy Hunting
        </a>
        
        <div class="nav-center">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="#" class="nav-link">About</a>
            <div class="nav-drop-wrapper">
                <a href="#" class="nav-link">Services <span class="nav-spacer-icon"></span></a>
                <div class="nav-drop-menu">
                    <a href="{{ route('employer.dashboard') }}" class="dropdown-item">Headhunting</a>
                    <a href="#" class="dropdown-item">Corporate Workshop</a>
                    <a href="#" class="dropdown-item">Career Counselling</a>
                    <a href="#" class="dropdown-item">Skill Development Program</a>
                    <a href="#" class="dropdown-item">People Empowerment</a>
                    <a href="#" class="dropdown-item">Consultancy & Advisory</a>
                </div>
            </div>
            <a href="{{ route('blog.index') }}" class="nav-link">Blog</a>
            <div class="nav-drop-wrapper">
                <a href="#" class="nav-link">VH Career <span class="nav-spacer-icon"></span></a>
                <div class="nav-drop-menu">
                    <a href="{{ route('services.campus-bird') }}" class="dropdown-item">Campus Bird Internship Program</a>
                </div>
            </div>
            <div class="nav-drop-wrapper">
                <a href="#" class="nav-link">Legal <span class="nav-spacer-icon"></span></a>
                <div class="nav-drop-menu">
                    <a href="{{ route('terms') }}" class="dropdown-item">Terms of Service</a>
                    <a href="{{ route('privacy') }}" class="dropdown-item">Privacy Policy</a>
                    <a href="{{ route('cookie-policy') }}" class="dropdown-item">Cookie Policy</a>
                </div>
            </div>
        </div>
        
        <div class="nav-right">
            @auth
                <!-- Logged in user with dropdown -->
                <div class="user-menu">
                    <div class="user-profile">
                        <span class="username">
                            @if(Auth::user()->isCandidate() && Auth::user()->candidate)
                                {{ Auth::user()->candidate->name }}
                            @elseif(Auth::user()->isEmployer() && Auth::user()->employer)
                                {{ Auth::user()->employer->company_name }}
                            @elseif(Auth::user()->isAdmin())
                                {{ Auth::user()->admin->name ?? Auth::user()->email }}
                            @else
                                {{ Auth::user()->email }}
                            @endif
                        </span>
                        <div class="profile-icon user-menu-trigger">
                            @if(Auth::user()->isCandidate() && Auth::user()->candidate)
                                {{ strtoupper(substr(Auth::user()->candidate->name, 0, 1)) }}
                            @elseif(Auth::user()->isEmployer() && Auth::user()->employer)
                                {{ strtoupper(substr(Auth::user()->employer->company_name, 0, 1)) }}
                            @elseif(Auth::user()->isAdmin())
                                {{ strtoupper(substr(Auth::user()->admin->name ?? Auth::user()->email, 0, 1)) }}
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
                        @if(!Auth::user()->google_id)
                        <a href="{{ route('password.change') }}" class="dropdown-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <span>Change Password</span>
                        </a>
                        @endif
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
                    <button class="user-menu-trigger" aria-label="User Menu">
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

<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav">
    <!-- Services (Triggers Bottom Sheet) -->
    <button class="mobile-nav-item {{ (request()->routeIs('employer.dashboard*') || (request()->is('services*') && !request()->routeIs('services.campus-bird*'))) ? 'active' : '' }}" onclick="openBottomSheet('servicesSheet')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
        </svg>
        <span>Services</span>
    </button>

    <!-- Blog -->
    <a href="{{ route('blog.index') }}" class="mobile-nav-item {{ request()->routeIs('blog.*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
        </svg>
        <span>Blog</span>
    </a>

    <!-- Home (Center) -->
    <a href="{{ url('/') }}" class="mobile-nav-item center-item" aria-label="Home">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Home</span>
    </a>

    <!-- VH Career (Triggers Bottom Sheet) -->
    <button class="mobile-nav-item {{ request()->routeIs('services.campus-bird*') ? 'active' : '' }}" onclick="openBottomSheet('vhCareerSheet')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <!-- Graduation Cap -->
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
            <!-- Briefcase -->
            <rect x="6" y="14" width="12" height="8" rx="2" />
            <path d="M9 14v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2" />
        </svg>
        <span>VH Career</span>
    </button>

    <!-- Profile or SignIn -->
    @auth
        <button class="mobile-nav-item {{ request()->routeIs('profile.*') || request()->routeIs('password.*') ? 'active' : '' }}" onclick="openBottomSheet('profileSheet')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span>Profile</span>
        </button>
    @else
        <a href="{{ route('login') }}" class="mobile-nav-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                <polyline points="10 17 15 12 10 7"></polyline>
                <line x1="15" y1="12" x2="3" y2="12"></line>
            </svg>
            <span>Sign In</span>
        </a>
    @endauth
</div>

<!-- Bottom Sheet Overlay -->
<div class="bottom-sheet-overlay" id="bottomSheetOverlay" onclick="closeAllBottomSheets()"></div>

<!-- Services Bottom Sheet -->
<div class="bottom-sheet" id="servicesSheet">
    <div class="sheet-handle"></div>
    <div class="sheet-header">
        <div class="sheet-title">Services</div>
    </div>
    <div class="sheet-content">
        <a href="{{ route('employer.dashboard') }}" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            Headhunting
        </a>
        <a href="#" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
            </svg>
            Corporate Workshop
        </a>
        <a href="#" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 12h5l2 5 3-10 2 5h5v-6h-5l-2-5-3 10-2-5h-5z"></path>
            </svg>
            Career Counselling
        </a>
        <a href="#" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                <polyline points="17 6 23 6 23 12"></polyline>
            </svg>
            Skill Development Program
        </a>
        <a href="#" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            People Empowerment
        </a>
        <a href="#" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            Consultancy & Advisory
        </a>
        <!-- Add more services as needed -->
    </div>
</div>

<!-- VH Career Bottom Sheet -->
<div class="bottom-sheet" id="vhCareerSheet">
    <div class="sheet-handle"></div>
    <div class="sheet-header">
        <div class="sheet-title">VH Career</div>
    </div>
    <div class="sheet-content">
        <a href="{{ route('services.campus-bird') }}" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            Campus Bird Internship Program
        </a>
    </div>
</div>

<!-- Profile Bottom Sheet -->
<div class="bottom-sheet" id="profileSheet">
    <div class="sheet-handle"></div>
    <div class="sheet-header">
        <div class="sheet-title">Account</div>
    </div>
    <div class="sheet-content">
        <a href="{{ route('profile.show') }}" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            Profile
        </a>
        @if(Auth::check() && !Auth::user()->google_id)
        <a href="{{ route('password.change') }}" class="sheet-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            Change Password
        </a>
        @endif
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="sheet-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; color: inherit; font: inherit; padding: 15px 20px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>

<script>
    function openBottomSheet(id) {
        document.getElementById('bottomSheetOverlay').classList.add('active');
        document.getElementById(id).classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeAllBottomSheets() {
        document.getElementById('bottomSheetOverlay').classList.remove('active');
        document.querySelectorAll('.bottom-sheet').forEach(sheet => {
            sheet.classList.remove('active');
        });
        document.body.style.overflow = '';
    }
</script>
