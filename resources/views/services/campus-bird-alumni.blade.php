<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Our Alumni - Campus Bird Internship Program') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"></noscript>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
                radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
            color: #e2e8f0;
        }

        .page-header {
            text-align: center;
            padding: 4rem 1rem 3rem 1rem;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #00d4ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 700px;
            margin: 0 auto;
        }

        .content-section {
            max-width: 1400px;
            margin: 0 auto 3rem auto;
            padding: 0 2rem;
        }

        .alumni-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }
        
        @media (max-width: 1200px) {
            .alumni-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .alumni-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .alumni-grid {
                grid-template-columns: 1fr;
            }
        }

        .alumni-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 1.5rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            height: 100%;
        }

        .alumni-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -10px rgba(0, 212, 255, 0.2);
            border-color: rgba(0, 212, 255, 0.3);
        }

        .alumni-photo {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border-radius: 50%;
            margin-bottom: 1rem;
            overflow: hidden;
            border: 3px solid rgba(0, 212, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .alumni-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .alumni-placeholder {
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.2);
            font-weight: 700;
        }

        .alumni-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .alumni-role {
            font-size: 0.95rem;
            color: #00d4ff;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .alumni-company {
             font-size: 0.9rem;
             color: rgba(255, 255, 255, 0.6);
             margin-bottom: 0.5rem;
        }

        .alumni-category {
             font-size: 0.85rem;
             color: #00d4ff;
             margin-bottom: 1rem;
             font-weight: 600;
             text-transform: uppercase;
             letter-spacing: 0.05em;
        }

        .alumni-desc {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            margin-bottom: auto;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .view-profile-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 188, 212, 0.3);
            margin-top: 1.5rem;
        }
        
        .view-profile-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 188, 212, 0.5);
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            margin-bottom: 2rem;
            transition: color 0.2s;
            font-size: 0.9rem;
        }
        
        .back-link:hover {
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Filter Section Styles */
        .filter-section {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .filter-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 500;
        }

        .filter-input, .filter-select {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            color: #fff;
            font-family: inherit;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.2s;
        }

        .filter-input:focus, .filter-select:focus {
            outline: none;
            border-color: #00d4ff;
            background: rgba(15, 23, 42, 0.8);
        }

        .filter-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        .filter-btn {
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            height: 46px;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 188, 212, 0.3);
        }

        @media (max-width: 1200px) {
            .filter-form {
                grid-template-columns: 1fr 1fr 1fr;
            }
        }

        /* Mobile Filter Styles */
        .mobile-filter-header {
            display: none;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .alumni-count {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .filter-toggle-btn {
            display: none;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .filter-header-mobile {
            display: none;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .filter-header-mobile h3 {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .close-filter-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            padding: 0.5rem;
        }

        @media (max-width: 768px) {
            .mobile-filter-header {
                display: flex;
            }

            .filter-toggle-btn {
                display: flex;
            }

            /* Backdrop overlay */
            .filter-section::before {
                content: '';
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.7);
                backdrop-filter: blur(4px);
                z-index: -1;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .filter-section.show::before {
                opacity: 1;
            }

            .filter-section {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                top: auto; /* Ensure it doesn't cover top */
                max-height: 80vh;
                background: rgba(15, 23, 42, 0.98);
                z-index: 1000;
                margin: 0;
                border-radius: 20px 20px 0 0;
                padding: 0;
                overflow-y: auto;
                transform: translateY(100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-bottom: none;
            }

            .filter-section.show {
                transform: translateY(0);
            }

            .filter-header-mobile {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1.5rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                position: sticky;
                top: 0;
                background: inherit; /* inherit from filter-section */
                z-index: 10;
                border-radius: 20px 20px 0 0;
            }
            
            .filter-header-mobile h3 {
                margin: 0;
                color: white;
                font-size: 1.2rem;
                font-weight: 600;
            }

            .close-filter-btn {
                background: transparent;
                border: none;
                color: rgba(255, 255, 255, 0.7);
                cursor: pointer;
                padding: 0.5rem;
            }

            .filter-form {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
                padding: 1.5rem;
                align-items: stretch !important; /* Override desktop align-items: end */
            }

            .filter-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start !important; /* Force left alignment */
                width: 100%;
            }

            .filter-group label {
                font-size: 0.9rem;
                font-weight: 500;
                margin-bottom: 0;
                text-align: left !important; /* Force left alignment */
                color: rgba(255, 255, 255, 0.8);
                width: 100%;
                display: block;
            }

            .filter-input, .filter-select {
                width: 100%;
                background: rgba(15, 23, 42, 0.5);
                border: 1px solid rgba(255, 255, 255, 0.1);
                padding: 0.6rem 1rem;
                font-size: 0.95rem;
                text-align: left !important; /* Force left alignment */
                border-radius: 6px;
                color: white;
                height: 42px;
                transition: all 0.3s ease;
            }
            
            .filter-input:focus, .filter-select:focus {
                outline: none;
                border-color: #00d4ff;
                box-shadow: 0 0 0 2px rgba(0, 212, 255, 0.1);
            }
            
            .filter-buttons {
                padding-top: 0.5rem;
            }

            .filter-btn {
                width: 100%;
                background: linear-gradient(135deg, #00d4ff, #00bcd4);
                color: white;
                border: none;
                padding: 0.75rem 1rem;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                margin-top: 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
            }
        }

        @keyframes slideUp {
            from { 
                transform: translateY(100%);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
    <script>
        function toggleFilter() {
            const filterSection = document.getElementById('filterSection');
            filterSection.classList.toggle('show');
            
            if (filterSection.classList.contains('show')) {
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            } else {
                document.body.style.overflow = '';
            }
        }
    </script>
</head>
<body>
    @include('partials.navbar')

    <main role="main">
        <header class="page-header">

            <h1 class="page-title">{{ __('Our Pride, Our Alumni') }}</h1>
            <p class="page-subtitle">{{ __('Success stories from our Campus Bird Internship Program graduates who are now making waves in the industry.') }}</p>
        </header>

        <div class="content-section">
            
            <!-- Mobile Filter Toggle -->
            <div class="mobile-filter-header">
                <div class="alumni-count">{{ $alumni->count() }} {{ __('Alumni Found') }}</div>
                <button id="filterToggle" class="filter-toggle-btn" onclick="toggleFilter()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    {{ __('Filter') }}
                </button>
            </div>

            <!-- Search & Filter Section -->
            <div class="filter-section" id="filterSection">
                <div class="filter-header-mobile">
                    <h3>{{ __('Filter Alumni') }}</h3>
                    <button type="button" class="close-filter-btn" onclick="toggleFilter()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form action="{{ route('services.campus-bird-alumni') }}" method="GET" class="filter-form">
                    <div class="filter-group">
                        <label class="filter-label">{{ __('Search by Name') }}</label>
                        <input type="text" name="search" class="filter-input" placeholder="{{ __('Enter alumni name...') }}" value="{{ request('search') }}">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">{{ __('Program') }}</label>
                        <select name="program" class="filter-select">
                            <option value="">{{ __('All Programs') }}</option>
                            @foreach($programs as $prog)
                                <option value="{{ $prog }}" {{ request('program') == $prog ? 'selected' : '' }}>{{ $prog }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">{{ __('Category') }}</label>
                        <select name="category" class="filter-select">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">{{ __('Year') }}</label>
                        <select name="year" class="filter-select">
                            <option value="">{{ __('All Years') }}</option>
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">{{ __('Division') }}</label>
                        <select name="division" class="filter-select">
                            <option value="">{{ __('All Divisions') }}</option>
                            @foreach($divisions as $div)
                                <option value="{{ $div }}" {{ request('division') == $div ? 'selected' : '' }}>{{ $div }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-buttons" style="display: flex; gap: 0.5rem;">
                        <button type="submit" class="filter-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                            {{ __('Search') }}
                        </button>
                        @if(request()->anyFilled(['search', 'program', 'category', 'year', 'division']))
                            <a href="{{ route('services.campus-bird-alumni') }}" class="filter-btn" style="background: rgba(255,255,255,0.1); text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                {{ __('Clear') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            @if($alumni->count() > 0)
                <div class="alumni-grid">
                    @foreach($alumni as $alum)
                        <div class="alumni-card">
                            <div class="alumni-photo">
                                @if($alum->photo)
                                    <img src="{{ asset($alum->photo) }}" alt="{{ $alum->name }}" loading="lazy" onerror="this.parentElement.innerHTML='<div class=&quot;alumni-placeholder&quot;>{{ substr($alum->name, 0, 1) }}</div>';">
                                @else
                                    <div class="alumni-placeholder">
                                        {{ substr($alum->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <h2 class="alumni-name">{{ $alum->name }}</h2>
                            <div class="alumni-role">{{ $alum->program }}</div>
                            <div class="alumni-company">{{ __('Batch') }}: {{ $alum->year }}</div>
                            <div class="alumni-category">{{ $alum->category }}</div>
                            
                            @if($alum->description)
                                <p class="alumni-desc">{{ $alum->description }}</p>
                            @else
                                <div style="flex: 1;"></div>
                            @endif

                            <a href="{{ route('services.campus-bird-alumni-profile', ['id' => $alum->id, 'slug' => \Str::slug($alum->name)]) }}" class="view-profile-btn">
                                {{ __('View Profile') }}
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p>{{ __('No alumni profiles found yet. Check back soon!') }}</p>
                </div>
            @endif
        </div>
    </main>
    
    @include('partials.footer')
</body>
</html>
