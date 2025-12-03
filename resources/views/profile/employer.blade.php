<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employer Profile - {{ config('app.name', 'Vacancy Hunting') }}</title>
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ROOT VARIABLES FOR THEME */
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --bg-hover: #334155;
            --border-color: #334155;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --accent-primary: #3b82f6;
            --accent-hover: #2563eb;
            --accent-light: rgba(59, 130, 246, 0.1);
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        [data-theme="light"] {
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: #f1f5f9;
            --border-color: #e2e8f0;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --accent-light: rgba(59, 130, 246, 0.08);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* HERO BANNER */
        .hero-banner {
            position: relative;
            height: 300px;
            background: var(--gradient-1);
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.3), rgba(15, 23, 42, 0.8));
        }

        .hero-content {
            position: absolute;
            bottom: 30px;
            left: 0;
            right: 0;
            padding: 0 40px;
            display: flex;
            align-items: flex-end;
            gap: 30px;
            z-index: 1;
        }

        .company-logo {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 5px solid var(--bg-secondary);
            background-color: var(--bg-card);
            object-fit: cover;
            box-shadow: var(--shadow-lg);
        }

        .hero-info h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-info p {
            color: #e2e8f0;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 10px;
        }

        .status-approved {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
            border: 1.5px solid var(--success);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.15);
            color: var(--warning);
            border: 1.5px solid var(--warning);
        }

        .status-rejected {
            background: rgba(239, 68, 68, 0.15);
            color: var(--error);
            border: 1.5px solid var(--error);
        }

        /* THEME TOGGLE */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .theme-toggle i {
            font-size: 18px;
            color: var(--accent-primary);
        }

        /* CONTAINER */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* PROGRESS BAR */
        .profile-completion {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px 30px;
            margin: 30px 0;
            box-shadow: var(--shadow-md);
        }

        .completion-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .completion-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .completion-percentage {
            font-size: 24px;
            font-weight: 700;
            color: var(--accent-primary);
        }

        .progress-bar-container {
            width: 100%;
            height: 12px;
            background: var(--bg-primary);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--accent-primary), #8b5cf6);
            border-radius: 20px;
            transition: width 0.5s ease;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .completion-hint {
            margin-top: 8px;
            font-size: 14px;
            color: var(--text-muted);
        }

        /* TABS */
        .tabs-container {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .tabs-nav {
            display: flex;
            gap: 0;
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .tabs-nav::-webkit-scrollbar {
            height: 4px;
        }

        .tabs-nav::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 2px;
        }

        .tab-button {
            flex: 1;
            min-width: 140px;
            padding: 18px 24px;
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .tab-button:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }

        .tab-button.active {
            color: var(--accent-primary);
            background: var(--accent-light);
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent-primary);
        }

        .tab-content {
            display: none;
            padding: 30px;
            animation: fadeIn 0.4s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* SECTION CARD */
        .section-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .section-card h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-card h2 i {
            color: var(--accent-primary);
        }

        /* INFO ROWS */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            background: var(--bg-card);
            border-radius: 8px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .info-item:hover {
            border-color: var(--accent-primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
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
            color: var(--accent-primary);
            font-size: 18px;
        }

        .info-details {
            flex: 1;
        }

        .info-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 15px;
            color: var(--text-primary);
            word-break: break-word;
        }

        .info-value a {
            color: var(--accent-primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .info-value a:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }

        /* SOCIAL MEDIA ICONS */
        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .social-link {
            width: 48px;
            height: 48px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 20px;
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .social-link.linkedin:hover { background: #0077b5; color: white; border-color: #0077b5; }
        .social-link.twitter:hover { background: #1da1f2; color: white; border-color: #1da1f2; }
        .social-link.facebook:hover { background: #1877f2; color: white; border-color: #1877f2; }
        .social-link.instagram:hover { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color: white; border-color: transparent; }
        .social-link.youtube:hover { background: #ff0000; color: white; border-color: #ff0000; }

        /* MEDIA GALLERY */
        .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .media-item {
            position: relative;
            aspect-ratio: 16/9;
            border-radius: 12px;
            overflow: hidden;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .media-item:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-lg);
        }

        .media-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .media-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
        }

        .media-placeholder i {
            font-size: 48px;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        /* TEAM MEMBERS */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .team-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-primary);
        }

        .team-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 16px;
            object-fit: cover;
            border: 3px solid var(--accent-primary);
        }

        .team-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .team-title {
            font-size: 14px;
            color: var(--accent-primary);
            margin-bottom: 12px;
        }

        .team-bio {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* BENEFITS LIST */
        .benefits-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }

        .benefit-item i {
            color: var(--success);
            font-size: 18px;
        }

        /* TIMELINE */
        .timeline {
            position: relative;
            padding-left: 40px;
            margin-top: 20px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--border-color);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 24px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -33px;
            top: 0;
            width: 12px;
            height: 12px;
            background: var(--accent-primary);
            border-radius: 50%;
            border: 3px solid var(--bg-card);
        }

        .timeline-year {
            font-size: 16px;
            font-weight: 700;
            color: var(--accent-primary);
            margin-bottom: 4px;
        }

        .timeline-text {
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* MAP */
        .map-container {
            width: 100%;
            height: 300px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            margin-top: 16px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* LOCATIONS LIST */
        .locations-list {
            display: grid;
            gap: 16px;
            margin-top: 20px;
        }

        .location-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            gap: 16px;
        }

        .location-card.primary {
            border-color: var(--accent-primary);
            background: var(--accent-light);
        }

        .location-icon {
            width: 50px;
            height: 50px;
            background: var(--accent-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .location-icon i {
            color: var(--accent-primary);
            font-size: 24px;
        }

        .location-details h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .location-details p {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        /* ACTION BUTTONS */
        .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding: 0 20px 30px;
            flex-wrap: wrap;
        }

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

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero-banner {
                height: 200px;
            }

            .hero-content {
                padding: 0 20px;
                bottom: 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .company-logo {
                width: 100px;
                height: 100px;
            }

            .hero-info h1 {
                font-size: 24px;
            }

            .tabs-nav {
                flex-wrap: nowrap;
            }

            .tab-button {
                min-width: 100px;
                padding: 14px 16px;
                font-size: 13px;
            }

            .tab-content {
                padding: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .section-card {
                padding: 16px;
            }

            .actions {
                padding: 0 20px 20px;
            }

            .btn {
                flex: 1;
                justify-content: center;
            }

            .theme-toggle {
                top: 10px;
                right: 10px;
            }
        }

        /* VALUES LIST */
        .values-list {
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }

        .value-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .value-item:hover {
            border-color: var(--accent-primary);
            transform: translateX(5px);
        }

        .value-item i {
            color: var(--accent-primary);
            font-size: 20px;
        }

        .value-item span {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-primary);
        }
    </style>
</head>
<body>


    <!-- Hero Banner -->
    <div class="hero-banner" style="background-image: url('{{ $employer->hero_banner ? asset('storage/' . $employer->hero_banner) : '' }}');">
        <div class="hero-content">
            <img src="{{ $employer->profile_picture ? asset('storage/' . $employer->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($employer->company_name) . '&size=150&background=3b82f6&color=fff' }}" 
                 alt="{{ $employer->company_name }}" 
                 class="company-logo">
            <div class="hero-info">
                <h1>{{ $employer->company_name }}</h1>
                <p>
                    <i class="fas fa-envelope"></i>
                    {{ $employer->user->email }}
                </p>
                <span class="status-badge status-{{ $employer->status }}">
                    <i class="fas fa-{{ $employer->status === 'approved' ? 'check-circle' : ($employer->status === 'pending' ? 'clock' : 'times-circle') }}"></i>
                    {{ ucfirst($employer->status) }}
                </span>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Profile Completion -->
        <div class="profile-completion">
            <div class="completion-header">
                <h3><i class="fas fa-chart-line"></i> Profile Completion</h3>
                <span class="completion-percentage">{{ $employer->profile_completion }}%</span>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar" style="width: {{ $employer->profile_completion }}%"></div>
            </div>
            @if($employer->profile_completion < 100)
            <p class="completion-hint">
                <i class="fas fa-lightbulb"></i>
                Complete your profile to attract more candidates! Add {{ $employer->profile_completion < 70 ? 'mission statement, team members, and media' : 'remaining details' }}.
            </p>
            @endif
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <div class="tabs-nav">
                <button class="tab-button active" onclick="switchTab('overview')">
                    <i class="fas fa-home"></i> Overview
                </button>
                <button class="tab-button" onclick="switchTab('about')">
                    <i class="fas fa-building"></i> About Us
                </button>
                <button class="tab-button" onclick="switchTab('contact')">
                    <i class="fas fa-address-card"></i> Contact
                </button>
                <button class="tab-button" onclick="switchTab('media')">
                    <i class="fas fa-images"></i> Media
                </button>

            </div>

            <!-- OVERVIEW TAB -->
            <div id="overview-tab" class="tab-content active">
                <div class="section-card">
                    <h2><i class="fas fa-info-circle"></i> Company Information</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-building"></i></div>
                            <div class="info-details">
                                <div class="info-label">Company Name</div>
                                <div class="info-value">{{ $employer->company_name }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-briefcase"></i></div>
                            <div class="info-details">
                                <div class="info-label">Industry</div>
                                <div class="info-value">{{ $employer->company_type ?? 'Not specified' }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-phone"></i></div>
                            <div class="info-details">
                                <div class="info-label">Contact Number</div>
                                <div class="info-value">{{ $employer->contact_number ?? 'Not specified' }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-calendar"></i></div>
                            <div class="info-details">
                                <div class="info-label">Established</div>
                                <div class="info-value">{{ $employer->establishment_year ?? 'Not specified' }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-users"></i></div>
                            <div class="info-details">
                                <div class="info-label">Employee Count</div>
                                <div class="info-value">{{ $employer->employee_count ?? 'Not specified' }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-landmark"></i></div>
                            <div class="info-details">
                                <div class="info-label">Ownership</div>
                                <div class="info-value">{{ $employer->company_ownership ? ucfirst($employer->company_ownership) : 'Not specified' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($employer->company_description)
                <div class="section-card">
                    <h2><i class="fas fa-align-left"></i> Company Description</h2>
                    <p style="color: var(--text-secondary); line-height: 1.8;">{{ $employer->company_description }}</p>
                </div>
                @endif

                @if($employer->employee_benefits && count($employer->employee_benefits) > 0)
                <div class="section-card">
                    <h2><i class="fas fa-gift"></i> Employee Benefits & Perks</h2>
                    <div class="benefits-list">
                        @foreach($employer->employee_benefits as $benefit)
                        <div class="benefit-item">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ $benefit }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- ABOUT US TAB -->
            <div id="about-tab" class="tab-content">
                @if($employer->mission_statement)
                <div class="section-card">
                    <h2><i class="fas fa-bullseye"></i> Mission Statement</h2>
                    <p style="color: var(--text-secondary); line-height: 1.8; font-size: 15px;">{{ $employer->mission_statement }}</p>
                </div>
                @endif

                @if($employer->vision_statement)
                <div class="section-card">
                    <h2><i class="fas fa-eye"></i> Vision Statement</h2>
                    <p style="color: var(--text-secondary); line-height: 1.8; font-size: 15px;">{{ $employer->vision_statement }}</p>
                </div>
                @endif

                @if($employer->company_values && count($employer->company_values) > 0)
                <div class="section-card">
                    <h2><i class="fas fa-heart"></i> Company Values & Culture</h2>
                    <div class="values-list">
                        @foreach($employer->company_values as $value)
                        <div class="value-item">
                            <i class="fas fa-star"></i>
                            <span>{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($employer->products_services)
                <div class="section-card">
                    <h2><i class="fas fa-box"></i> Products & Services</h2>
                    <p style="color: var(--text-secondary); line-height: 1.8;">{{ $employer->products_services }}</p>
                </div>
                @endif

                @if($employer->company_history && count($employer->company_history) > 0)
                <div class="section-card">
                    <h2><i class="fas fa-history"></i> Company History & Milestones</h2>
                    <div class="timeline">
                        @foreach($employer->company_history as $milestone)
                        <div class="timeline-item">
                            <div class="timeline-year">{{ $milestone['year'] ?? '' }}</div>
                            <div class="timeline-text">{{ $milestone['event'] ?? '' }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($employer->teamMembers && $employer->teamMembers->count() > 0)
                <div class="section-card">
                    <h2><i class="fas fa-user-tie"></i> Key Team Members</h2>
                    <div class="team-grid">
                        @foreach($employer->teamMembers as $member)
                        <div class="team-card">
                            <img src="{{ $member->photo ? asset('storage/' . $member->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&size=100&background=3b82f6&color=fff' }}" 
                                 alt="{{ $member->name }}" 
                                 class="team-photo">
                            <div class="team-name">{{ $member->name }}</div>
                            <div class="team-title">{{ $member->title }}</div>
                            @if($member->bio)
                            <div class="team-bio">{{ $member->bio }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(!$employer->mission_statement && !$employer->vision_statement && !$employer->company_values && !$employer->products_services && !$employer->company_history && (!$employer->teamMembers || $employer->teamMembers->count() === 0))
                <div class="empty-state">
                    <i class="fas fa-building"></i>
                    <p>No company information available yet. Click "Edit Profile" to add details.</p>
                </div>
                @endif
            </div>

            <!-- CONTACT TAB -->
            <div id="contact-tab" class="tab-content">
                <div class="section-card">
                    <h2><i class="fas fa-map-marker-alt"></i> Primary Address</h2>
                    <div class="info-grid">
                        @if($employer->street)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-road"></i></div>
                            <div class="info-details">
                                <div class="info-label">Street</div>
                                <div class="info-value">{{ $employer->street }}</div>
                            </div>
                        </div>
                        @endif
                        @if($employer->city)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-city"></i></div>
                            <div class="info-details">
                                <div class="info-label">City</div>
                                <div class="info-value">{{ $employer->city }}</div>
                            </div>
                        </div>
                        @endif
                        @if($employer->state)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-map"></i></div>
                            <div class="info-details">
                                <div class="info-label">State/Province</div>
                                <div class="info-value">{{ $employer->state }}</div>
                            </div>
                        </div>
                        @endif
                        @if($employer->zip_code)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-mail-bulk"></i></div>
                            <div class="info-details">
                                <div class="info-label">ZIP/Postal Code</div>
                                <div class="info-value">{{ $employer->zip_code }}</div>
                            </div>
                        </div>
                        @endif
                        @if($employer->country)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-flag"></i></div>
                            <div class="info-details">
                                <div class="info-label">Country</div>
                                <div class="info-value">{{ $employer->country }}</div>
                            </div>
                        </div>
                        @endif
                        @if($employer->company_address)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-location-arrow"></i></div>
                            <div class="info-details">
                                <div class="info-label">Full Address</div>
                                <div class="info-value">{{ $employer->company_address }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($employer->city && $employer->country)
                    <div class="map-container">
                        <iframe src="https://maps.google.com/maps?q={{ urlencode(($employer->street ?? '') . ' ' . ($employer->city ?? '') . ' ' . ($employer->state ?? '') . ' ' . ($employer->country ?? '')) }}&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen loading="lazy"></iframe>
                    </div>
                    @endif
                </div>

                @if($employer->locations && $employer->locations->count() > 0)
                <div class="section-card">
                    <h2><i class="fas fa-globe"></i> Multiple Locations & Branches</h2>
                    <div class="locations-list">
                        @foreach($employer->locations as $location)
                        <div class="location-card {{ $location->is_primary ? 'primary' : '' }}">
                            <div class="location-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="location-details">
                                <h3>{{ $location->location_name }} @if($location->is_primary)<span style="color: var(--accent-primary); font-size: 12px;">(Primary)</span>@endif</h3>
                                @if($location->street)<p>{{ $location->street }}</p>@endif
                                <p>{{ $location->city }}@if($location->state), {{ $location->state }}@endif @if($location->zip_code){{ $location->zip_code }}@endif</p>
                                @if($location->country)<p>{{ $location->country }}</p>@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="section-card">
                    <h2><i class="fas fa-link"></i> Website & Social Media</h2>
                    <div class="info-grid">
                        @if($employer->website_url)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-globe"></i></div>
                            <div class="info-details">
                                <div class="info-label">Website</div>
                                <div class="info-value">
                                    <a href="{{ $employer->website_url }}" target="_blank">{{ $employer->website_url }}</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($employer->trade_license_no)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-certificate"></i></div>
                            <div class="info-details">
                                <div class="info-label">Trade License No.</div>
                                <div class="info-value">{{ $employer->trade_license_no }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($employer->linkedin_url || $employer->twitter_url || $employer->facebook_url || $employer->instagram_url || $employer->youtube_url)
                    <div style="margin-top: 24px;">
                        <div class="info-label" style="margin-bottom: 12px;">CONNECT WITH US</div>
                        <div class="social-links">
                            @if($employer->linkedin_url)
                            <a href="{{ $employer->linkedin_url }}" target="_blank" class="social-link linkedin" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            @endif
                            @if($employer->twitter_url)
                            <a href="{{ $employer->twitter_url }}" target="_blank" class="social-link twitter" title="Twitter/X">
                                <i class="fab fa-twitter"></i>
                            </a>
                            @endif
                            @if($employer->facebook_url)
                            <a href="{{ $employer->facebook_url }}" target="_blank" class="social-link facebook" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if($employer->instagram_url)
                            <a href="{{ $employer->instagram_url }}" target="_blank" class="social-link instagram" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif
                            @if($employer->youtube_url)
                            <a href="{{ $employer->youtube_url }}" target="_blank" class="social-link youtube" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- MEDIA TAB -->
            <div id="media-tab" class="tab-content">
                <div class="section-card">
                    <h2><i class="fas fa-images"></i> Media Gallery</h2>
                    @if($employer->media && $employer->media->count() > 0)
                    <div class="media-grid">
                        @foreach($employer->media as $mediaItem)
                        <div class="media-item">
                            @if($mediaItem->media_type === 'photo')
                            <img src="{{ asset('storage/' . $mediaItem->file_path) }}" alt="{{ $mediaItem->caption ?? 'Media' }}">
                            @else
                            <div class="media-placeholder">
                                <i class="fas fa-video"></i>
                                <p>Video</p>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-images"></i>
                        <p>No media uploaded yet. Showcase your office, team events, or products!</p>
                    </div>
                    @endif
                </div>
            </div>


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
    </div>

    <script>
        // Tab Switching
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.add('active');
            event.target.closest('.tab-button').classList.add('active');
        }


    </script>
</body>
</html>
