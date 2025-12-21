<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Articles - {{ config('app.name', 'Laravel') }}</title>
    
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

        .main-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.75rem;
        }

        .page-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 500px;
            margin: 0 auto;
        }

        /* Button Container */
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Articles Feed */
        .articles-feed {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Article Card */
        .article-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }

        .article-card:hover {
            border-color: rgba(0, 212, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .article-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, rgba(0, 188, 212, 0.3), rgba(99, 102, 241, 0.3));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            position: relative;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-published {
            background: rgba(16, 185, 129, 0.9);
            color: white;
        }

        .status-draft {
            background: rgba(251, 191, 36, 0.9);
            color: #1a1a1a;
        }

        .article-content {
            padding: 1.5rem;
        }

        .article-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
            gap: 1rem;
        }

        .article-category {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            background: rgba(0, 212, 255, 0.15);
            color: #00d4ff;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            flex-shrink: 0;
        }

        .article-date {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
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
            color: rgba(255, 255, 255, 0.65);
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .article-stats {
            display: flex;
            gap: 1rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }

        .article-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem 0.85rem;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.08);
            border: none;
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .action-btn:hover {
            background: rgba(0, 212, 255, 0.2);
            color: #00d4ff;
        }

        .action-btn.delete:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .action-btn svg {
            width: 16px;
            height: 16px;
        }

        /* Empty State */
        .empty-state {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            padding: 4rem 2rem;
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
            margin-top: 2rem;
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
        }

        .pagination .active span {
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
        }

        @media (max-width: 640px) {
            .main-content {
                padding: 1rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .article-image {
                height: 160px;
            }

            .article-header {
                flex-direction: column;
                gap: 0.5rem;
            }

            .article-footer {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .article-actions {
                width: 100%;
            }

            .action-btn {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">My Articles</h1>
            <p class="page-subtitle">Manage and view all the articles you've published.</p>
        </div>

        <!-- Buttons -->
        <div class="btn-container">
            <a href="{{ route('blog.create') }}" class="btn btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Write New Article
            </a>
            <a href="{{ route('blog.index') }}" class="btn btn-outline">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Blog
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($articles->count() > 0)
            <div class="articles-feed">
                @foreach($articles as $article)
                    <article class="article-card">
                        <div class="article-image">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}">
                            @else
                                📝
                            @endif
                            <span class="article-status {{ $article->status === 'published' ? 'status-published' : 'status-draft' }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </div>
                        
                        <div class="article-content">
                            <div class="article-header">
                                <span class="article-category">{{ $article->category_label }}</span>
                                <span class="article-date">{{ $article->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <h2 class="article-title">
                                <a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            
                            <p class="article-excerpt">{{ $article->excerpt }}</p>
                            
                            <div class="article-footer">
                                <div class="article-stats">
                                    <div class="stat-item">
                                        <span>👍</span>
                                        <span>{{ $article->reactions->where('reaction_type', 'like')->count() }}</span>
                                    </div>
                                    <div class="stat-item">
                                        <span>💬</span>
                                        <span>{{ $article->comments->count() }}</span>
                                    </div>
                                </div>
                                
                                <div class="article-actions">
                                    <a href="{{ route('blog.show', $article->slug) }}" class="action-btn">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        View
                                    </a>
                                    <form action="{{ route('blog.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pagination">
                {{ $articles->links('pagination::simple-bootstrap-4') }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">✍️</div>
                <h3>No articles yet</h3>
                <p>Start sharing your insights with the community!</p>
                <a href="{{ route('blog.create') }}" class="btn btn-primary">Write Your First Article</a>
            </div>
        @endif
    </main>
</body>
</html>
