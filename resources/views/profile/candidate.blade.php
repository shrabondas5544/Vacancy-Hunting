<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $candidate->name }} - Profile - {{ config('app.name') }}</title>
    
    <!-- Font Awesome with font-display:swap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @font-face {
            font-family: 'Font Awesome 6 Free';
            font-display: swap;
        }
    </style>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"></noscript>
    
    <style>
        /* ROOT VARIABLES FOR THEME */
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --bg-hover: #334155;
            --border-color: #334155;
            --text-primary: #ffffff;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --accent-primary: #2563eb;
            --accent-text: #60a5fa;
            --accent-hover: #1d4ed8;
            --accent-light: rgba(59, 130, 246, 0.1);
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #0f172a; /* Deep Navy Base */
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
                radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
            background-attachment: fixed;
            background-size: cover;
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* HERO BANNER */
        .hero-banner {
            position: relative;
            height: 300px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
        }

        .hero-content {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px 30px;
            display: flex;
            align-items: flex-end;
            gap: 30px;
        }

        .candidate-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 6px solid var(--bg-primary);
            object-fit: cover;
            background: var(--bg-card);
            box-shadow: var(--shadow-lg);
        }

        .hero-info {
            flex: 1;
            padding-bottom: 20px;
        }

        .hero-info h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .hero-info p {
            font-size: 18px;
            opacity: 0.95;
            margin-bottom: 4px;
        }

        /* CONTAINER */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        /* PROGRESS BAR */
        .progress-section {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px 24px;
margin-bottom: 24px;
            box-shadow: var(--shadow-md);
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .progress-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .progress-percentage {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent-text);
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: var(--bg-primary);
            border-radius: 20px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6 0%, #8b5cf6 100%);
            border-radius: 20px;
            transition: width 0.5s ease;
        }

        .progress-text {
            margin-top: 8px;
            font-size: 13px;
            color: var(--text-muted);
        }

        /* TABS */
        .tabs-nav {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            border-bottom: 2px solid var(--border-color);
            overflow-x: auto;
        }

        .tab-button {
            background: none;
            border: none;
            padding: 16px 24px;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .tab-button:hover {
            color: var(--text-primary);
            background: var(--accent-light);
        }

        .tab-button.active {
            color: var(--accent-text);
            border-bottom-color: var(--accent-text);
        }

        .tab-button i {
            margin-right: 8px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* CARDS */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-md);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header i {
            color: var(--accent-text);
            font-size: 22px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .info-grid {
            display: grid;
            gap: 16px;
        }

        .info-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: var(--accent-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-icon i {
            color: var(--accent-text);
            font-size: 18px;
        }

        .info-details {
            flex: 1;
        }

        .info-label {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            color: var(--text-primary);
            font-weight: 500;
        }

        /* TAGS */
        .tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .tag {
            background: var(--bg-primary);
            color: var(--accent-text);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid var(--border-color);
        }

        .tag.language {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-color: rgba(16, 185, 129, 0.3);
        }

        .tag.language .proficiency {
            font-size: 11px;
            opacity: 0.8;
            margin-left: 4px;
        }

        /* TIMELINE */
        .timeline {
            position: relative;
            padding-left: 40px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 18px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--border-color);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 32px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: -30px;
            top: 2px;
            width: 20px;
            height: 20px;
            background: var(--accent-primary);
            border: 3px solid var(--bg-card);
            border-radius: 50%;
            box-shadow: 0 0 0 3px var(--border-color);
        }

        .timeline-date {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .timeline-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
margin-bottom: 4px;
        }

        .timeline-subtitle {
            font-size: 15px;
            color: var(--accent-text);
            margin-bottom: 12px;
        }

        .timeline-content {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* PORTFOLIO GRID */
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .portfolio-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .portfolio-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-primary);
        }

        .portfolio-thumbnail {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            object-fit: cover;
        }

        .portfolio-content {
            padding: 20px;
        }

        .portfolio-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .portfolio-description {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .portfolio-tech {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* CERTIFICATIONS */
        .cert-item {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .cert-icon {
            width: 60px;
            height: 60px;
            background: var(--accent-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cert-icon i {
            font-size: 28px;
            color: var(--accent-text);
        }

        .cert-details {
            flex: 1;
        }

        .cert-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .cert-org {
            font-size: 14px;
            color: var(--accent-text);
            margin-bottom: 8px;
        }

        .cert-date {
            font-size: 13px;
            color: var(--text-muted);
        }

        .cert-badge {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            margin-left: 12px;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .empty-state p {
            font-size: 16px;
        }

        /* BUTTONS */
        .btn {
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--accent-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            background: var(--bg-card);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--bg-hover);
            transform: translateY(-2px);
        }

        .actions {
            display: flex;
            gap: 16px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid var(--border-color);
        }

        /* SOCIAL LINKS */
        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .social-link {
            width: 44px;
            height: 44px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .social-link.linkedin { border-color: #0077b5; }
        .social-link.linkedin:hover { background: #0077b5; }
        .social-link.github { border-color: #333; }
        .social-link.github:hover { background: #333; }
        .social-link.twitter { border-color: #1da1f2; }
        .social-link.twitter:hover { background: #1da1f2; }
        .social-link.facebook { border-color: #1877f2; }
        .social-link.facebook:hover { background: #1877f2; }
        .social-link.instagram { border-color: #e4405f; }
        .social-link.instagram:hover { background: #e4405f; }

        .social-link i {
            font-size: 20px;
            color: var(--text-secondary);
        }

        .social-link:hover i {
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            body {
                padding-top: 0;
            }

            .hero-banner {
                height: 240px;
                min-height: 240px;
            }

            .hero-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 0 15px 15px;
                gap: 0;
            }

            .candidate-avatar {
                width: 100px;
                height: 100px;
                transform: translateY(50px);
                border-width: 4px;
            }

            .hero-info {
                padding-bottom: 10px;
                margin-top: 60px;
            }

            .hero-info h1 {
                font-size: 22px;
                margin-bottom: 6px;
            }

            .hero-info p {
                font-size: 14px;
            }

            .container {
                padding: 15px;
            }

            .progress-section {
                padding: 16px;
                margin-bottom: 16px;
            }

            .progress-label {
                font-size: 12px;
            }

            .progress-percentage {
                font-size: 16px;
            }

            .tabs-nav {
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                margin-bottom: 16px;
            }

            .tabs-nav::-webkit-scrollbar {
                display: none;
            }

            .tab-button {
                padding: 12px 16px;
                font-size: 13px;
                flex-shrink: 0;
            }

            .tab-button i {
                margin-right: 6px;
                font-size: 14px;
            }

            .card {
                padding: 16px;
                margin-bottom: 16px;
            }

            .card-header {
                margin-bottom: 16px;
                padding-bottom: 12px;
            }

            .card-header h2 {
                font-size: 18px;
            }

            .card-header i {
                font-size: 20px;
            }

            .info-grid {
                gap: 12px;
            }

            .info-icon {
                width: 36px;
                height: 36px;
            }

            .info-icon i {
                font-size: 16px;
            }

            .info-label {
                font-size: 11px;
            }

            .info-value {
                font-size: 14px;
            }

            .tags-list {
                gap: 8px;
            }

            .tag {
                font-size: 12px;
                padding: 6px 12px;
            }

            .timeline {
                padding-left: 30px;
            }

            .timeline::before {
                left: 14px;
            }

            .timeline-marker {
                left: -22px;
                top: 2px;
                width: 16px;
                height: 16px;
                border-width: 2px;
            }

            .timeline-date {
                font-size: 12px;
            }

            .timeline-title {
                font-size: 16px;
            }

            .timeline-subtitle {
                font-size: 14px;
            }

            .timeline-content {
                font-size: 13px;
            }

            .portfolio-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .portfolio-thumbnail {
                height: 160px;
            }

            .portfolio-content {
                padding: 16px;
            }

            .cert-item {
                padding: 16px;
                flex-direction: column;
                gap: 16px;
            }

            .cert-icon {
                width: 50px;
                height: 50px;
            }

            .cert-icon i {
                font-size: 24px;
            }

            .cert-name {
                font-size: 16px;
            }

            .cert-org {
                font-size: 13px;
            }

            .social-links {
                justify-content: flex-start;
                gap: 10px;
            }

            .social-link {
                width: 40px;
                height: 40px;
            }

            .social-link i {
                font-size: 18px;
            }

            .actions {
                flex-direction: column;
                gap: 12px;
                margin-top: 20px;
                padding-top: 20px;
            }

            .btn {
                width: 100%;
                justify-content: center;
                padding: 12px 24px;
                font-size: 14px;
            }
        }

        /* SMALL MOBILE */
        @media (max-width: 480px) {
            .hero-banner {
                height: 220px;
                min-height: 220px;
            }

            .candidate-avatar {
                width: 90px;
                height: 90px;
            }

            .hero-info h1 {
                font-size: 20px;
            }

            .container {
                padding: 12px;
            }

            .card {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <!-- Hero Banner -->
    <div class="hero-banner" style="background-image: url('{{ $candidate->hero_banner ? asset('storage/' . $candidate->hero_banner) : '' }}');">
        <div class="hero-content">
            <img src="{{ $candidate->profile_picture ? asset('storage/' . $candidate->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($candidate->name) . '&size=180&background=3b82f6&color=fff' }}"
                 alt="{{ $candidate->name }}"
                 class="candidate-avatar"
                 width="180"
                 height="180"
                 fetchpriority="high">
            <div class="hero-info">
                <h1>{{ $candidate->name }}</h1>
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            </div>
        </div>
    </div>

    <main class="container">
        <!-- Profile Completion Progress -->
        <div class="progress-section">
            <div class="progress-header">
                <span class="progress-label">Profile Completion</span>
                <span class="progress-percentage">{{ $candidate->profile_completion }}%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $candidate->profile_completion }}%"></div>
            </div>
            <p class="progress-text">
                @if($candidate->profile_completion < 70)
                    Complete your profile to attract more employers! Add {{ $candidate->professional_summary ? 'experience and education' : 'your bio, experience, and education' }}.
                @else
                    Great! Your profile looks professional.
                @endif
            </p>
        </div>

        <!-- Tabs Navigation -->
        <div class="tabs-nav">
            <button class="tab-button active" onclick="switchTab('overview')">
                <i class="fas fa-user"></i> Overview
            </button>
            <button class="tab-button" onclick="switchTab('experience')">
                <i class="fas fa-briefcase"></i> Experience
            </button>
            <button class="tab-button" onclick="switchTab('education')">
                <i class="fas fa-graduation-cap"></i> Education
            </button>
            <button class="tab-button" onclick="switchTab('certifications')">
                <i class="fas fa-certificate"></i> Certifications
            </button>
            <button class="tab-button" onclick="switchTab('portfolio')">
                <i class="fas fa-folder-open"></i> Portfolio
            </button>
            <button class="tab-button" onclick="switchTab('contact')">
                <i class="fas fa-address-card"></i> Contact
            </button>
        </div>

        <!-- OVERVIEW TAB -->
        <div id="overview-tab" class="tab-content active">
            @if($candidate->professional_summary)
           <div class="card">
                <div class="card-header">
                    <i class="fas fa-align-left"></i>
                    <h2>Professional Summary</h2>
                </div>
                <p style="color: var(--text-secondary); line-height: 1.8;">{{ $candidate->professional_summary }}</p>
            </div>
            @endif

            @if($candidate->skills)
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-code"></i>
                    <h2>Skills</h2>
                </div>
                <div class="tags-list">
                    @foreach(explode(',', $candidate->skills) as $skill)
                        <span class="tag">{{ trim($skill) }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if($candidate->languages && $candidate->languages->count() > 0)
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-language"></i>
                    <h2>Languages</h2>
                </div>
                <div class="tags-list">
                    @foreach($candidate->languages as $lang)
                        <span class="tag language">
                            {{ $lang->language }}
                            <span class="proficiency">({{ ucfirst($lang->proficiency) }})</span>
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-line"></i>
                    <h2>Quick Stats</h2>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-briefcase"></i></div>
                        <div class="info-details">
                            <div class="info-label">Experience</div>
                            <div class="info-value">{{ $candidate->experience_years ?? 'Not specified' }} {{ $candidate->experience_years ? 'years' : '' }}</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div class="info-details">
                            <div class="info-label">Education Records</div>
                            <div class="info-value">{{ $candidate->education->count() }} {{ $candidate->education->count() == 1 ? 'Degree' : 'Degrees' }}</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-certificate"></i></div>
                        <div class="info-details">
                            <div class="info-label">Certifications</div>
                            <div class="info-value">{{ $candidate->certifications->count() }}</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-folder-open"></i></div>
                        <div class="info-details">
                            <div class="info-label">Portfolio Projects</div>
                            <div class="info-value">{{ $candidate->portfolio->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- EXPERIENCE TAB -->
        <div id="experience-tab" class="tab-content">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-briefcase"></i>
                    <h2>Work Experience</h2>
                </div>

                @if($candidate->experience && $candidate->experience->count() > 0)
                    <div class="timeline">
                        @foreach($candidate->experience as $exp)
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-date">
                                    {{ $exp->start_date->format('M Y') }} - {{ $exp->is_current ? 'Present' : $exp->end_date->format('M Y') }}
                                </div>
                                <div class="timeline-title">{{ $exp->job_title }}</div>
                                <div class="timeline-subtitle">{{ $exp->company_name }}</div>
                                @if($exp->description)
                                    <div class="timeline-content">{{ $exp->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-briefcase"></i>
                        <p>No work experience added yet. Click "Edit Profile" to add your professional background.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- EDUCATION TAB -->
        <div id="education-tab" class="tab-content">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-graduation-cap"></i>
                    <h2>Education</h2>
                </div>

                @if($candidate->education && $candidate->education->count() > 0)
                    <div class="timeline">
                        @foreach($candidate->education as $edu)
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-date">
                                    @if($edu->graduation_year)
                                        Graduated {{ $edu->graduation_year }}
                                    @endif
                                </div>
                                <div class="timeline-title">{{ $edu->degree }}</div>
                                <div class="timeline-subtitle">{{ $edu->institution }}</div>
                                @if($edu->gpa)
                                    <div class="timeline-content">GPA: {{ $edu->gpa }}</div>
                                @endif
                                @if($edu->description)
                                    <div class="timeline-content">{{ $edu->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-graduation-cap"></i>
                        <p>No education records added yet. Add your academic background to strengthen your profile.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- CERTIFICATIONS TAB -->
        <div id="certifications-tab" class="tab-content">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-certificate"></i>
                    <h2>Certifications & Achievements</h2>
                </div>

                @if($candidate->certifications && $candidate->certifications->count() > 0)
                    @foreach($candidate->certifications as $cert)
                        <div class="cert-item">
                            <div class="cert-icon">
                                @if($cert->certification_type == 'award')
                                    <i class="fas fa-trophy"></i>
                                @elseif($cert->certification_type == 'honor')
                                    <i class="fas fa-medal"></i>
                                @else
                                    <i class="fas fa-certificate"></i>
                                @endif
                            </div>
                            <div class="cert-details">
                                <div class="cert-name">
                                    {{ $cert->certification_name }}
                                    @if($cert->certification_type != 'certification')
                                        <span class="cert-badge">{{ ucfirst($cert->certification_type) }}</span>
                                    @endif
                                </div>
                                <div class="cert-org">{{ $cert->issuing_organization }}</div>
                                <div class="cert-date">
                                    @if($cert->issue_date)
                                        Issued: {{ $cert->issue_date->format('M Y') }}
                                    @endif
                                    @if($cert->expiration_date)
                                        • Expires: {{ $cert->expiration_date->format('M Y') }}
                                    @endif
                                    @if($cert->credential_url)
                                        • <a href="{{ $cert->credential_url }}" target="_blank" style="color: var(--accent-primary);">View Credential</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-certificate"></i>
                        <p>No certifications added yet. Showcase your achievements and credentials.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- PORTFOLIO TAB -->
        <div id="portfolio-tab" class="tab-content">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-folder-open"></i>
                    <h2>Portfolio & Projects</h2>
                </div>

                @if($candidate->portfolio && $candidate->portfolio->count() > 0)
                    <div class="portfolio-grid">
                        @foreach($candidate->portfolio as $project)
                            <div class="portfolio-card">
                                @if($project->thumbnail)
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->project_name }}" class="portfolio-thumbnail">
                                @else
                                    <div class="portfolio-thumbnail">
                                        <i class="fas fa-code"></i>
                                    </div>
                                @endif
                                <div class="portfolio-content">
                                    <div class="portfolio-title">
                                        @if($project->project_url)
                                            <a href="{{ $project->project_url }}" target="_blank" style="color: inherit; text-decoration: none;">
                                                {{ $project->project_name }} <i class="fas fa-external-link-alt" style="font-size: 14px; opacity: 0.6;"></i>
                                            </a>
                                        @else
                                            {{ $project->project_name }}
                                        @endif
                                    </div>
                                    @if($project->description)
                                        <div class="portfolio-description">{{ $project->description }}</div>
                                    @endif
                                    @if($project->technologies)
                                        <div class="portfolio-tech"><strong>Tech:</strong> {{ $project->technologies }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <p>No projects added yet. Showcase your work and impress potential employers.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- CONTACT TAB -->
        <div id="contact-tab" class="tab-content">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-id-card"></i>
                    <h2>Contact Information</h2>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="info-details">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $user->email }}</div>
                        </div>
                    </div>
                    @if($candidate->phone)
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div class="info-details">
                            <div class="info-label">Phone</div>
                            <div class="info-value">{{ $candidate->phone }}</div>
                        </div>
                    </div>
                    @endif
                    @if($candidate->street || $candidate->city || $candidate->state || $candidate->zip_code || $candidate->country)
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="info-details">
                            <div class="info-label">Address</div>
                            <div class="info-value">
                                @if($candidate->street)
                                    {{ $candidate->street }}<br>
                                @endif
                                {{ $candidate->city }}{{ $candidate->city && ($candidate->state || $candidate->zip_code) ? ', ' : '' }}{{ $candidate->state }} {{ $candidate->zip_code }}<br>
                                {{ $candidate->country }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                @if($candidate->linkedin_url || $candidate->github_url || $candidate->portfolio_url || $candidate->twitter_url || $candidate->facebook_url || $candidate->instagram_url)
                <div style="margin-top: 24px;">
                    <div class="info-label" style="margin-bottom: 12px;">Social & Professional Links</div>
                    <div class="social-links">
                        @if($candidate->linkedin_url)
                            <a href="{{ $candidate->linkedin_url }}" target="_blank" class="social-link linkedin" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                        @if($candidate->github_url)
                            <a href="{{ $candidate->github_url }}" target="_blank" class="social-link github" title="GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                        @if($candidate->twitter_url)
                            <a href="{{ $candidate->twitter_url }}" target="_blank" class="social-link twitter" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if($candidate->facebook_url)
                            <a href="{{ $candidate->facebook_url }}" target="_blank" class="social-link facebook" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($candidate->instagram_url)
                            <a href="{{ $candidate->instagram_url }}" target="_blank" class="social-link instagram" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($candidate->portfolio_url)
                            <a href="{{ $candidate->portfolio_url }}" target="_blank" class="social-link" title="Portfolio Website" style="border-color: var(--accent-primary);">
                                <i class="fas fa-globe"></i>
                            </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            @if($candidate->references && $candidate->references->count() > 0)
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-check"></i>
                    <h2>Professional References</h2>
                </div>
                @foreach($candidate->references as $ref)
                    <div class="cert-item">
                        <div class="cert-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="cert-details">
                            <div class="cert-name">{{ $ref->name }}</div>
                            <div class="cert-org">{{ $ref->title }} at {{ $ref->company }}</div>
                            <div class="cert-date">
                                {{ $ref->email }}
                                @if($ref->phone)
                                    • {{ $ref->phone }}
                                @endif
                                @if($ref->relationship)
                                    • {{ $ref->relationship }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="actions">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </main>

    <script>
        // Tab Switching
        function switchTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.add('active');

            // Add active class to clicked button
            event.target.closest('.tab-button').classList.add('active');
        }
    </script>

    @include('partials.footer')
</body>
</html>
