<style>
    /* Navbar Styles - Glassmorphism Effect */
    .navbar {
        background: rgba(15, 23, 42, 0.7);
        background-image: 
            radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
            radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
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
        transition: right 0.5s cubic-bezier(0.4, 0.0, 0.2, 1);
        overflow-y: auto;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: column;
    }
    
    .mobile-drawer.active {
        right: 0;
    }
    
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
    
    .drawer-nav {
        padding: 1rem 0;
        flex: 1;
    }
    
    .drawer-logout-section {
        margin-top: auto;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0;
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
        background: transparent;
    }
    
    .drawer-nav-link:hover {
        background: rgba(0, 212, 255, 0.1) !important;
        color: #00d4ff !important;
        border-left-color: #00d4ff;
    }
    
    .drawer-nav-link[type="submit"] {
        background: transparent !important;
        color: rgba(255, 255, 255, 0.8) !important;
    }
    
    .drawer-nav-link[type="submit"]:hover {
        background: rgba(0, 212, 255, 0.1) !important;
        color: #00d4ff !important;
    }
    
    .drawer-nav-link svg {
        width: 22px;
        height: 22px;
        flex-shrink: 0;
    }
    
    @media (max-width: 1024px) {
        .nav-center {
            display: none;
        }
        
        .hamburger-btn {
            display: flex;
        }
        
        .user-menu {
            display: none;
        }
    }
    
    @media (max-width: 768px) {
        .navbar {
            padding: 1rem;
        }
        
        .username {
            display: none;
        }
    }

    /* Navigation Dropdown Styles */
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
</style>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ url('/') }}" class="logo">
            <span class="logo-icon"><img src="{{ asset('assets/images/vh-logo.jpg') }}" alt="VH"></span>
            Vacancy Hunting
        </a>
        
        <div class="nav-center">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="#" class="nav-link">About</a>
            <div class="nav-drop-wrapper">
                <a href="#" class="nav-link">Services <span style="font-size: 0.7em; margin-left: 4px;"></span></a>
                <div class="nav-drop-menu">
                    <a href="#" class="dropdown-item">Headhunting</a>
                    <a href="#" class="dropdown-item">Corporate Workshop</a>
                    <a href="#" class="dropdown-item">Career Counselling</a>
                    <a href="#" class="dropdown-item">Skill Development Program</a>
                    <a href="#" class="dropdown-item">People Empowerment</a>
                    <a href="#" class="dropdown-item">Consultancy & Advisory</a>
                </div>
            </div>
            <a href="{{ route('blog.index') }}" class="nav-link">Blog</a>
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
                <div class="drawer-user-info">
                    <h3>
                        @if(Auth::user()->isCandidate() && Auth::user()->candidate)
                            {{ Auth::user()->candidate->name }}
                        @elseif(Auth::user()->isEmployer() && Auth::user()->employer)
                            {{ Auth::user()->employer->company_name }}
                        @elseif(Auth::user()->isAdmin())
                            {{ Auth::user()->admin->name ?? Auth::user()->email }}
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
        <div class="drawer-nav-group">
            <a href="#" class="drawer-nav-link" onclick="toggleDrawerSubmenu(event, 'services-submenu')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                <span>Services</span>
                <span class="submenu-arrow" style="margin-left: auto;">▼</span>
            </a>
            <div id="services-submenu" class="drawer-submenu" style="display: none; padding-left: 1.5rem; background: rgba(0,0,0,0.1);">
                <a href="#" class="drawer-nav-link" style="font-size: 0.9rem;">Headhunting</a>
                <a href="#" class="drawer-nav-link" style="font-size: 0.9rem;">Corporate Workshop</a>
                <a href="#" class="drawer-nav-link" style="font-size: 0.9rem;">Career Counselling</a>
                <a href="#" class="drawer-nav-link" style="font-size: 0.9rem;">Skill Development Program</a>
                <a href="#" class="drawer-nav-link" style="font-size: 0.9rem;">People Empowerment</a>
                <a href="#" class="drawer-nav-link" style="font-size: 0.9rem;">Consultancy & Advisory</a>
            </div>
        </div>
        <a href="{{ route('blog.index') }}" class="drawer-nav-link">
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
    </nav>
    
    <!-- Profile and Logout Section at Bottom -->
    <div class="drawer-logout-section">
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
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User menu dropdown toggle functionality
        const userMenu = document.querySelector('.user-menu');
        const userMenuTrigger = document.querySelector('.user-menu-trigger');
        
        if (userMenuTrigger && userMenu) {
            userMenuTrigger.addEventListener('click', function(e) {
                e.stopPropagation();
                userMenu.classList.toggle('active');
            });
            
            document.addEventListener('click', function(e) {
                if (!userMenu.contains(e.target)) {
                    userMenu.classList.remove('active');
                }
            });
            
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
            document.body.style.overflow = 'hidden';
        }
        
        function closeDrawer() {
            mobileDrawer.classList.remove('active');
            drawerOverlay.classList.remove('active');
            hamburgerBtn.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', function() {
                if (mobileDrawer.classList.contains('active')) {
                    closeDrawer();
                } else {
                    openDrawer();
                }
            });
        }
        
        if (drawerOverlay) {
            drawerOverlay.addEventListener('click', closeDrawer);
        }
        
        drawerLinks.forEach(link => {
            // Only close drawer for links that don't have a custom onclick handler (like submenus)
            if (!link.hasAttribute('onclick')) {
                link.addEventListener('click', closeDrawer);
            }
        });
        
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024 && mobileDrawer.classList.contains('active')) {
                closeDrawer();
            }
        });

        // Mobile submenu toggle
        window.toggleDrawerSubmenu = function(e, id) {
            e.preventDefault();
            const submenu = document.getElementById(id);
            if (submenu.style.display === 'none') {
                submenu.style.display = 'block';
            } else {
                submenu.style.display = 'none';
            }
        };
    });
</script>
