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
        
        /* Navbar styles are now imported via partials.navbar */
        
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
            transition: right 0.5s cubic-bezier(0.4, 0.0, 0.2, 1);
            overflow-y: auto;
            border-left: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
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
            flex: 1;
        }
        
        /* Logout Section at Bottom */
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
        
        /* Ensure logout button doesn't have white background */
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
            
            /* Hide desktop user menu on mobile since drawer has sign in/sign up */
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
    @include('partials.navbar')

    
    
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
    
    @include('partials.footer')

</body>
</html>
