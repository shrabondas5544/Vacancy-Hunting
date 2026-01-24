<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts - Async Loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"></noscript>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
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

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 188, 212, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        
        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #00d4ff;
            color: #00d4ff;
        }

        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 1.5rem; /* Reduced from 3rem */
            padding: 2rem 0 1rem; /* Reduced padding */
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #00d4ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        /* Search Container Styles */
        .search-container {
            margin-bottom: 2rem;
        }
        
        .search-wrapper-container { /* Renamed from .navbar-container to avoid conflict */
            display: flex;
            justify-content: center;
            padding: 0 1rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 600px; /* SLightly wider */
            background-color: #1a1b23;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            border: 1px solid #2a2b33;
        }

        .search-bar:focus-within {
            background-color: #222533;
            border-color: #00d4ff; /* Changed to Blue */
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.35); /* Blue shadow */
        }

        .search-bar:hover {
            background-color: #222533;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.35);
        }

        .InputContainer {
            display: flex;
            align-items: center;
            flex-grow: 1;
            gap: 0.75rem;
        }

        .input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 1rem;
            background: none;
            color: #f0f0f0;
            padding: 0.5rem 0;
            font-family: inherit;
        }

        .input::placeholder {
            color: #8a8a8a;
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }

        .input:focus::placeholder {
            opacity: 0.5;
        }

        .searchIcon {
            width: 20px;
            height: 20px;
            fill: #8a8a8a;
            transition: fill 0.2s ease;
        }

        .search-bar:focus-within .searchIcon {
            fill: #00d4ff; /* Blue */
        }

        .border {
            width: 1px;
            height: 24px;
            background-color: #3a3b43;
            margin: 0 0.75rem;
        }

        .micButton {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 50%;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #00d4ff; /* Make icon blue */
        }

        .micButton:hover {
            background-color: rgba(0, 212, 255, 0.1);
            transform: scale(1.1);
        }

        .micIcon {
            width: 20px;
            height: 20px;
            stroke: currentColor; /* Use text color */
            transition: all 0.2s ease;
        }

        /* Write Button Container */
        .write-btn-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        /* Category Filters */
        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 3rem;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .filter-btn:hover {
            background: rgba(0, 212, 255, 0.1);
            border-color: rgba(0, 212, 255, 0.3);
            color: #00d4ff;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            border-color: transparent;
            color: white;
        }

        /* Articles Feed - 2 Column Grid */
        .articles-feed {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Article Card */
        .article-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
            position: relative;
        }

        .article-card:hover {
            border-color: rgba(0, 212, 255, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .share-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .share-btn:hover {
            background: rgba(0, 212, 255, 0.8);
            border-color: #00d4ff;
            transform: scale(1.1);
        }

        .share-btn svg {
            width: 18px;
            height: 18px;
        }

        .article-image {
            width: 100%;
            height: 350px;
            object-fit: cover;
            cursor: pointer;
            background: linear-gradient(135deg, rgba(0, 188, 212, 0.2) 0%, rgba(30, 58, 138, 0.2) 100%);
        }

        .article-image-placeholder {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, rgba(0, 188, 212, 0.2) 0%, rgba(30, 58, 138, 0.2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            cursor: pointer;
        }

        .article-content {
            padding: 1.25rem;
        }

        .article-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .article-category {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            background: rgba(0, 212, 255, 0.15);
            color: #00d4ff;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .article-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .article-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s;
        }

        .article-title a:hover {
            color: #00d4ff;
        }

        .article-excerpt {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .author-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
        }

        .author-details {
            display: flex;
            flex-direction: column;
        }

        .author-name {
            font-weight: 600;
            color: #fff;
            font-size: 0.95rem;
        }

        .article-date {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .article-actions-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .reaction-stats {
            display: flex;
            gap: 1rem;
        }

        .reaction-count {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .read-more-link {
            color: #00d4ff;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .read-more-link:hover {
            color: #fff;
        }

        /* Write Article Button */
        .write-btn-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1.5rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 3rem;
        }

        .pagination a, .pagination span {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: rgba(0, 212, 255, 0.2);
            color: #00d4ff;
            border-color: rgba(0, 212, 255, 0.3);
            color: #00d4ff;
        }

        .pagination .active span {
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
        }

        /* Success Message */
        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .articles-feed {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .article-image {
                height: 250px;
            }

            .filter-section {
                overflow-x: auto;
                flex-wrap: nowrap;
                justify-content: flex-start;
                padding-bottom: 1rem;
                -webkit-overflow-scrolling: touch;
                /* Prevent interfering with swipe-back gesture - multiple browser prefixes */
                -webkit-overscroll-behavior-x: contain;
                -moz-overscroll-behavior-x: contain;
                -ms-overscroll-behavior-x: contain;
                overscroll-behavior-x: contain;
            }

            .filter-btn {
                white-space: nowrap;
                flex-shrink: 0;
            }

            .main-content {
                padding: 1rem;
            }

            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main class="main-content" role="main">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Blog & Insights</h1>
            <p class="page-subtitle">Discover articles from industry professionals, employers, and job seekers sharing their knowledge and experiences.</p>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <form method="GET" action="{{ route('blog.index') }}" class="search-form">
                @if($selectedCategory !== 'all')
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                @endif
                
                <div class="search-wrapper-container"> <!-- Updated class name -->
                    <div class="search-bar">
                        <div class="InputContainer">
                            <svg class="searchIcon" width="20px" viewBox="0 0 24 24" height="20px" xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path d="M15.5 14h-.79l-.28-.27A6.518 6.518 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                            </svg>
                            <input class="input" id="search-input" name="search" placeholder="Search by title, author, or company..." type="text" value="{{ $search ?? '' }}" onkeydown="if(event.key === 'Enter') this.form.submit();"/>
                        </div>
                        <div class="border"></div>
                        <button type="submit" aria-label="Search" class="micButton">
                            <!-- Changed to Magnifying Glass/Search Icon as requested -->
                            <svg width="20px" viewBox="0 0 24 24" height="20px" fill="none" stroke="currentColor" stroke-width="2" class="micIcon">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <style>
            .search-container {
                margin-bottom: 2rem;
            }
            .search-wrapper-container {
                display: flex;
                justify-content: center;
                padding: 0 1rem;
            }

            .search-bar {
                display: flex;
                align-items: center;
                width: 100%;
                max-width: 600px;
                background-color: #1a1b23;
                padding: 0.5rem 1rem;
                border-radius: 30px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
                transition: all 0.3s ease;
                border: 1px solid #2a2b33;
            }

            .search-bar:focus-within {
                background-color: #222533;
                border-color: #00d4ff !important; /* Force Blue */
                box-shadow: 0 4px 15px rgba(0, 212, 255, 0.35) !important; /* Force Blue Shadow */
            }

            .search-bar:hover {
                background-color: #222533;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.35);
            }

            .InputContainer {
                display: flex;
                align-items: center;
                flex-grow: 1;
                gap: 0.75rem;
            }

            .input {
                flex: 1;
                border: none;
                outline: none;
                font-size: 1rem;
                background: none;
                color: #f0f0f0;
                padding: 0.5rem 0;
                font-family: inherit;
            }

            .input::placeholder {
                color: #8a8a8a;
                opacity: 1;
                transition: opacity 0.2s ease;
            }

            .input:focus::placeholder {
                opacity: 0.5;
            }

            .searchIcon {
                width: 20px;
                height: 20px;
                fill: #8a8a8a;
                transition: fill 0.2s ease;
            }

            .search-bar:focus-within .searchIcon {
                fill: #00ff99;
            }

            .border {
                width: 1px;
                height: 24px;
                background-color: #3a3b43;
                margin: 0 0.75rem;
            }

            .micButton {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                border: none;
                border-radius: 50%;
                background: none;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .micButton:hover {
                background-color: #2a2b33;
            }

            .micIcon {
                width: 18px;
                height: 18px;
                fill: #8a8a8a;
                transition: fill 0.2s ease;
            }

            .micButton:hover .micIcon {
                fill: #ff5100;
            }
        </style>

        @if(session('success'))
            <div class="alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Write Article Button -->
        @auth
            <div class="write-btn-container">
                <a href="{{ route('blog.create') }}" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Write Article
                </a>
                <a href="{{ route('blog.my-articles') }}" class="btn btn-outline">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    My Articles
                </a>
            </div>
        @endauth

        <!-- Category Filters -->
        <div class="filter-section">
            <a href="{{ route('blog.index') }}" class="filter-btn {{ $selectedCategory === 'all' ? 'active' : '' }}">
                All Categories
            </a>
            @foreach($categories as $key => $label)
                <a href="{{ route('blog.index', ['category' => $key]) }}" class="filter-btn {{ $selectedCategory === $key ? 'active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- Articles Feed - Stacked Layout -->
        @if($articles->count() > 0)
            <div class="articles-feed">
                @foreach($articles as $article)
                    <article class="article-card">
                        <button class="share-btn" onclick="shareArticle(this, '{{ route('blog.show', $article->slug) }}', '{{ addslashes($article->title) }}')" title="Share article">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="18" cy="5" r="3"></circle>
                                <circle cx="6" cy="12" r="3"></circle>
                                <circle cx="18" cy="19" r="3"></circle>
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                            </svg>
                        </button>
                        <a href="{{ route('blog.show', $article->slug) }}">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="article-image">
                            @else
                                <div class="article-image-placeholder">📝</div>
                            @endif
                        </a>
                        
                        <div class="article-content">
                            <div class="article-header-row">
                                <div class="author-info">
                                    <div class="author-avatar">{{ $article->author_initial }}</div>
                                    <div class="author-details">
                                        <span class="author-name">{{ $article->author_name }}</span>
                                        <span class="article-date">{{ $article->published_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <span class="article-category">{{ $article->category_label }}</span>
                            </div>
                            
                            <h2 class="article-title">
                                <a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            
                            <p class="article-excerpt">{{ $article->excerpt }}</p>

                            <div class="article-actions-bar">
                                @php $counts = $article->reaction_counts; @endphp
                                <div class="reaction-stats">
                                    <span class="reaction-count">👍 {{ $counts['like'] ?? 0 }}</span>
                                    <span class="reaction-count">👎 {{ $counts['dislike'] ?? 0 }}</span>
                                    <span class="reaction-count">💬 {{ $article->comments->count() }}</span>
                                </div>
                                <a href="{{ route('blog.show', $article->slug) }}" class="read-more-link">Read more →</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $articles->appends(['category' => $selectedCategory])->links('pagination::simple-bootstrap-4') }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📝</div>
                <h3>No articles yet</h3>
                <p>Be the first to share your insights with the community!</p>
                @auth
                    <a href="{{ route('blog.create') }}" class="btn btn-primary">Write Your First Article</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Sign In to Write</a>
                @endauth
            </div>
        @endif
    </main>

    @include('partials.footer')

    <script>
        function shareArticle(button, url, title) {
            // Check if Web Share API is supported (Chrome, Safari, Edge mobile)
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                }).catch((error) => {
                    console.log('Share cancelled or failed:', error);
                });
            } 
            // Check if Clipboard API is supported (most modern browsers including Firefox)
            else if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(() => {
                    showShareFeedback(button, 'Link copied!', true);
                }).catch((error) => {
                    console.error('Failed to copy link:', error);
                    showShareFeedback(button, 'Failed to copy', false);
                });
            }
            // Final fallback for older browsers
            else {
                // Create temporary input to copy text
                const input = document.createElement('input');
                input.value = url;
                document.body.appendChild(input);
                input.select();
                try {
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    showShareFeedback(button, 'Link copied!', true);
                } catch (error) {
                    document.body.removeChild(input);
                    showShareFeedback(button, 'Failed to copy', false);
                }
            }
        }

        function showShareFeedback(element, message, success) {
            const btn = element.closest('.share-btn') || element;
            if (!btn) return;
            
            const originalHTML = btn.innerHTML;
            const originalBg = btn.style.background;
            
            // Show success or error icon
            if (success) {
                btn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>';
                btn.style.background = 'rgba(16, 185, 129, 0.8)';
            } else {
                btn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
                btn.style.background = 'rgba(239, 68, 68, 0.8)';
            }
            
            // Add tooltip
            btn.title = message;
            
            // Reset after 2 seconds
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.style.background = originalBg;
                btn.title = 'Share article';
            }, 2000);
        }
    </script>

</body>
</html>
