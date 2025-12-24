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

        /* Modern UI Components */
        .page-header {
            text-align: center;
            margin-bottom: 4rem;
            padding: 3rem 0;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            font-size: 1.1rem;
            color: #94a3b8;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Layout */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Button Container */
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
            backdrop-filter: blur(4px);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #38bdf8;
            color: #38bdf8;
        }

        /* Articles List */
        .articles-feed {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Article Card */
        .article-card {
            background: rgba(30, 41, 59, 0.4);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            transition: all 0.3s ease;
            display: flex;
        }

        .article-card:hover {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(56, 189, 248, 0.25);
            transform: translateX(4px);
        }

        .article-image {
            width: 240px;
            flex-shrink: 0;
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.1), rgba(99, 102, 241, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            position: relative;
            object-fit: cover;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-status {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            backdrop-filter: blur(4px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .status-published {
            background: rgba(16, 185, 129, 0.9);
            color: white;
        }

        .status-draft {
            background: rgba(245, 158, 11, 0.9);
            color: white;
        }

        .article-content {
            padding: 1.5rem 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .article-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .article-category {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #38bdf8;
        }

        .article-date {
            font-size: 0.85rem;
            color: #64748b;
        }

        .article-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .article-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }

        .article-title a:hover {
            color: #38bdf8;
        }

        .article-excerpt {
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .article-stats {
            display: flex;
            gap: 1.5rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .article-actions {
            display: flex;
            gap: 0.75rem;
        }

        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .action-btn:hover {
            background: rgba(56, 189, 248, 0.15);
            border-color: #38bdf8;
            color: #38bdf8;
        }

        .action-btn.delete:hover {
            background: rgba(239, 68, 68, 0.15);
            border-color: #ef4444;
            color: #ef4444;
        }

        /* Empty State */
        .empty-state {
            background: rgba(30, 41, 59, 0.4);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
            padding: 5rem 2rem;
            backdrop-filter: blur(12px);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }

        .empty-state h3 {
            font-size: 1.75rem;
            margin-bottom: 0.75rem;
            color: #f1f5f9;
        }

        .empty-state p {
            color: #94a3b8;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        /* Success Message */
        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            backdrop-filter: blur(4px);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 3rem;
        }

        .pagination a, .pagination span {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background: rgba(56, 189, 248, 0.15);
            color: #38bdf8;
            border-color: rgba(56, 189, 248, 0.3);
        }

        .pagination .active span {
            background: #38bdf8;
            color: #0f172a;
            font-weight: 700;
            border: none;
        }

        @media (max-width: 768px) {
            .article-card {
                flex-direction: column;
            }
            .article-image {
                width: 100%;
                height: 200px;
            }
            .article-content {
                padding: 1.5rem;
            }
            .article-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }
            .article-actions {
                width: 100%;
                justify-content: space-between;
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
            <p class="page-subtitle">Manage and view all the articles you've published to the community.</p>
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
                                    <div class="stat-item" title="Likes">
                                        <span>👍</span>
                                        <span>{{ $article->reactions->where('reaction_type', 'like')->count() }}</span>
                                    </div>
                                    <div class="stat-item" title="Comments">
                                        <span>💬</span>
                                        <span>{{ $article->comments->count() }}</span>
                                    </div>
                                    <div class="stat-item" title="Views">
                                        <span>👁️</span>
                                        <span>{{ $article->views_count ?? 0 }}</span>
                                    </div>
                                </div>
                                
                                <div class="article-actions">
                                    <a href="{{ route('blog.show', $article->slug) }}" class="action-btn">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        View
                                    </a>
                                    <!-- Edit feature can be added here -->
                                    
                                    <form action="{{ route('blog.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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

    @include('partials.footer')

</body>
</html>
