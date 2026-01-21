<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Find the Right People</title>
    
    <!-- Fonts - Optimized for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"></noscript>
    
    <style>
        :root {
            --primary-color: #00bcd4;
            --primary-dark: #0097a7;
            --primary-light: #00d4ff;
            --secondary-color: #1a2332;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --bg-dark: #0f172a;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            min-height: calc(100vh - 72px);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(26, 35, 50, 0.95) 0%, rgba(15, 23, 42, 0.9) 100%),
                        url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80') center/cover;
            background-attachment: fixed;
            padding: 2rem;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(0, 212, 255, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(102, 126, 234, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 4rem;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            color: white;
            z-index: 2;
            animation: fadeInUp 1s ease-out;
        }

        .hero-left {
            flex: 1;
            max-width: 600px;
        }

        .hero-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-image {
            max-width: 100%;
            height: auto;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero-badge {
            display: inline-block;
            background: rgba(0, 212, 255, 0.15);
            border: 1px solid rgba(0, 212, 255, 0.3);
            color: #00d4ff;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            animation: fadeInUp 1s ease-out 0.2s backwards;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            color: #ffffff;
            animation: fadeInUp 1s ease-out 0.4s backwards;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            animation: fadeInUp 1s ease-out 0.6s backwards;
        }

        /* Search Bar Styles */
        .hero-search {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease-out 0.8s backwards;
        }

        .search-group {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            flex: 1;
            gap: 0.75rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .search-group svg {
            width: 20px;
            height: 20px;
            color: #64748b;
            flex-shrink: 0;
        }

        .search-group input,
        .search-group select {
            border: none;
            outline: none;
            background: transparent;
            font-size: 0.95rem;
            color: #1e293b;
            width: 100%;
        }

        .search-group select {
            cursor: pointer;
        }

        .search-btn {
            background: linear-gradient(135deg, #00d4ff 0%, #00bcd4 100%);
            border: none;
            border-radius: 12px;
            padding: 0.95rem 2rem;
            color: white;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(0, 212, 255, 0.3);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 212, 255, 0.4);
        }

        .search-btn svg {
            width: 18px;
            height: 18px;
        }

        /* Hero Footer */
        .hero-footer {
            display: flex;
            align-items: center;
            gap: 2rem;
            animation: fadeInUp 1s ease-out 1s backwards;
        }

        .hero-link {
            color: #00d4ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .hero-link:hover {
            color: #fff;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #00d4ff 0%, #00bcd4 100%);
            color: white;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.3);
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 212, 255, 0.5);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: inline-block;
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
        }
        
        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(26, 35, 50, 0.9) 100%);
            padding: 4rem 2rem;
            position: relative;
        }
        
        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
        }
        
        .stat-card {
            text-align: center;
            color: white;
            animation: fadeInUp 1s ease-out;
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #00d4ff 0%, #667eea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .stat-label {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
        }
        
        /* Services Section */
        .services-section {
            padding: 6rem 0; /* Removing horizontal padding to allow full width carousel */
            /* Hero Background Styles */
            position: relative;
            background: linear-gradient(135deg, rgba(26, 35, 50, 0.95) 0%, rgba(15, 23, 42, 0.9) 100%),
                        url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80') center/cover;
            background-attachment: fixed;
            overflow: hidden;
        }

        .services-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(0, 212, 255, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(102, 126, 234, 0.15) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
            z-index: 1;
            padding: 0 2rem;
        }
        
        .section-title {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Carousel Styles */
        .services-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
            z-index: 1;
            padding: 1rem 0; /* Space for shadows */
        }

        .services-track {
            display: flex;
            gap: 2.5rem;
            width: max-content;
            animation: scroll 40s linear infinite;
            padding-right: 2.5rem; /* Compensate for last gap to make seamless */
        }

        .services-track:hover {
            animation-play-state: paused;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        
        .service-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            /* Sizing for 3 cards on desktop */
            width: 30vw; 
            min-width: 350px; /* Prevent being too small */
            max-width: 450px; /* Prevent being too large */
            flex-shrink: 0;
        }
        
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.1) 0%, rgba(102, 126, 234, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s;
        }
        
        .service-card:hover::before {
            opacity: 1;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            border-color: rgba(0, 212, 255, 0.5);
            box-shadow: 0 20px 60px rgba(0, 212, 255, 0.3);
        }
        
        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #00d4ff 0%, #00bcd4 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.3);
        }
        
        .service-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .service-description {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }
        
        /* About Section */
        .about-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, rgba(26, 35, 50, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%);
            position: relative;
        }
        
        .about-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        
        .about-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
        }
        
        .about-text {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.8;
            margin-bottom: 2.5rem;
        }
        
        .btn-outline {
            background: transparent;
            color: #00d4ff;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid #00d4ff;
            display: inline-block;
        }
        
        .btn-outline:hover {
            background: #00d4ff;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.4);
        }
        
        /* CTA Section */
        .cta-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.1) 0%, rgba(102, 126, 234, 0.1) 100%);
            position: relative;
        }
        
        .cta-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 4rem 3rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        
        .cta-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .cta-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.75);
            margin-bottom: 2.5rem;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .service-card {
                width: 45vw; /* 2 cards visible */
            }
        }
        
        @media (max-width: 768px) {
            .hero-content {
                flex-direction: column;
                gap: 2rem;
            }

            .hero-left {
                max-width: 100%;
            }

            .hero-right {
                max-width: 400px;
            }

            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .hero-search {
                flex-direction: column;
            }

            .search-btn {
                width: 100%;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            
            .stats-container {
                /* Mobile 2x2 Grid */
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 1rem;
            }
            
            .stat-card {
                min-height: 150px; /* Smaller height for mobile */
                padding: 1.5rem 1rem;
            }
            
            .stat-number {
                font-size: 2rem; /* Smaller number */
            }

            .stat-label {
                font-size: 0.9rem; /* Smaller label */
            }
            
            
            /* Mobile Carousel */
            .service-card {
                width: 85vw; /* 1 card visible */
            }
            
            .about-title {
                font-size: 2rem;
            }
            
            .cta-title {
                font-size: 2rem;
            }
            
            .cta-content {
                padding: 3rem 2rem;
            }
        }
        
        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .service-card {
                padding: 2rem;
            }
        }
    /* Stats Section Styles */
    .stats-section {
        padding: 6rem 2rem;
        position: relative;
        z-index: 2;
        /* Blog Page Background Style */
        background-color: #0f172a;
        background-image: 
            radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
            radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
            radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
            radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
        background-attachment: fixed;
        background-size: cover;
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 2rem;
    }

    .stat-card {
        /* From Uiverse.io by SteveBloX - Adapted */
        box-sizing: border-box;
        /* width: 190px; height: 254px;  -- Removing fixed size to fit content */
        min-height: 150px; /* Approximate height */
        background: rgba(255, 255, 255, 0.05); /* Adjusted opacity for dark theme, user had 0.58 light */
        border: 1px solid rgba(255, 255, 255, 0.2); /* User: border: 1px solid white; */
        box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
        backdrop-filter: blur(6px);
        border-radius: 17px;
        text-align: center;
        cursor: pointer;
        transition: all 0.5s;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        user-select: none;
        /* font-weight: bolder; color: black; -- Keeping existing theme colors */
    }

    .stat-card:hover {
        /* User: border: 1px solid black; -- Adjusted for dark theme */
        border: 1px solid rgba(0, 212, 255, 0.5); 
        transform: scale(1.05);
    }

    .stat-card:active {
        transform: scale(0.95) rotateZ(1.7deg);
    }



    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #fff 0%, #00d4ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        font-family: 'Inter', sans-serif;
    }

    .stat-label {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-left">
                <span class="hero-badge">Ready to find your dream job?</span>
                <h1 class="hero-title">Take the next step in your career journey.</h1>
                <p class="hero-subtitle">Explore opportunities that match your skills and passions, and land the job you've always wanted with Vacancy Hunting.</p>
                
                <!-- Search Bar (Dummy) -->
                <div class="hero-search">
                    <div class="search-group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Enter skills or job title" disabled>
                    </div>
                    <div class="search-group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <select disabled>
                            <option>Select Category</option>
                        </select>
                    </div>
                    <button class="search-btn" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                <!-- Footer Link -->
                <div class="hero-footer">
                    <a href="{{ route('login') }}" class="hero-link">Find Jobs →</a>
                </div>
            </div>

            <div class="hero-right">
                <img src="{{ asset('assets/images/VH masscot.png') }}" alt="VH Mascot" class="hero-image" width="700" height="700" fetchpriority="high">
            </div>
        </div>
    </section>
    
    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-card">
                <span class="stat-number" data-target="{{ $activeJobs }}">0+</span>
                <span class="stat-label">Active Jobs</span>
            </div>
            <div class="stat-card">
                <span class="stat-number" data-target="{{ $companies }}">0+</span>
                <span class="stat-label">Companies</span>
            </div>
            <div class="stat-card">
                <span class="stat-number" data-target="{{ $candidates }}">0+</span>
                <span class="stat-label">Candidates</span>
            </div>
            <div class="stat-card">
                <span class="stat-number" data-target="93">0%</span>
                <span class="stat-label">Success Rate</span>
            </div>
        </div>
    </section>

    <!-- Counter Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.stat-number');
            const animationDuration = 2000; // 2 seconds for all animations

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-target');
                const isPercentage = counter.innerText.includes('%');
                const isPlus = counter.innerText.includes('+');
                let startTimestamp = null;

                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / animationDuration, 1);
                    
                    // Easing function for smooth animation (easeOutExpo)
                    const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    
                    const currentCount = Math.floor(easeProgress * target);

                    let suffix = '';
                    if (isPercentage) suffix = '%';
                    else if (isPlus) suffix = '+';

                    counter.innerText = currentCount + suffix;

                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        counter.innerText = target + suffix;
                    }
                };

                window.requestAnimationFrame(step);
            };

            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Find the counters within this section
                        const sectionCounters = entry.target.querySelectorAll('.stat-number');
                        sectionCounters.forEach(counter => animateCounter(counter));
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }
        });
    </script>
    
    <!-- Services Section -->
    <section class="services-section">
        <div class="section-header">
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">Comprehensive HR solutions tailored to your needs</p>
        </div>
        
        <div class="services-wrapper">
            <div class="services-track">
                <!-- Data Loops Twice for Seamless Scrolling -->
                @for ($i = 0; $i < 2; $i++)
                <div class="service-card">
                    <div class="service-icon">🎯</div>
                    <h3 class="service-title">Headhunting & Recruitment</h3>
                    <p class="service-description">Strategic talent acquisition connecting exceptional professionals with leading organizations across all industries.</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">📚</div>
                    <h3 class="service-title">Skill Development Program</h3>
                    <p class="service-description">Comprehensive training programs designed to enhance professional capabilities and career advancement.</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">💪</div>
                    <h3 class="service-title">People Empowerment</h3>
                    <p class="service-description">Empowering individuals and teams through leadership development and organizational transformation.</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">💼</div>
                    <h3 class="service-title">Consultancy & Advisory</h3>
                    <p class="service-description">Expert guidance on HR strategy, organizational design, and workforce optimization solutions.</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">🎓</div>
                    <h3 class="service-title">Career Counseling</h3>
                    <p class="service-description">Professional career guidance helping individuals navigate their career path and achieve their goals.</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">📝</div>
                    <h3 class="service-title">Resume / CV Writing</h3>
                    <p class="service-description">Professional resume and CV crafting services that showcase your skills and experience effectively.</p>
                </div>
                @endfor
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section class="about-section">
        <div class="about-content">
            <h2 class="about-title">Why Choose Us?</h2>
            <p class="about-text">
                We are a leading HR solutions provider committed to bridging the gap between talent and opportunity. 
                With years of experience and a proven track record, we deliver excellence in recruitment, training, 
                and career development services that drive success for both individuals and organizations.
            </p>
            <a href="#" class="btn-outline">Know More About Us</a>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Take the Next Step?</h2>
            <p class="cta-subtitle">Join thousands of professionals and companies who trust us with their career and recruitment needs.</p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn-primary">Get Started Today</a>
                <a href="#" class="btn-secondary">Contact Us</a>
            </div>
        </div>
    </section>
    
    @include('partials.footer')
</body>
</html>
