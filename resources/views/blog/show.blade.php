<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $article->title }} - {{ config('app.name', 'Laravel') }}</title>
    
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
            padding: 1.75rem 1.5rem;
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

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        /* Main Content */
        .main-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            margin-bottom: 2rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #00d4ff;
        }

        /* Article Header */
        .article-header {
            margin-bottom: 2rem;
        }

        .article-category {
            display: inline-block;
            padding: 0.4rem 1rem;
            background: rgba(0, 212, 255, 0.15);
            color: #00d4ff;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #fff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .author-details {
            display: flex;
            flex-direction: column;
        }

        .author-name {
            font-weight: 600;
            color: #fff;
        }

        .author-type {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .article-date {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        .article-actions {
            margin-left: auto;
            display: flex;
            gap: 0.75rem;
        }

        /* Featured Image */
        .featured-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 2rem;
        }

        /* Article Content */
        .article-content {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 2rem;
        }

        .article-body {
            font-size: 1.1rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.85);
        }

        .article-body p {
            margin-bottom: 1.5rem;
        }

        .article-body h2, .article-body h3 {
            margin: 2rem 0 1rem;
            color: #fff;
        }

        .article-body ul, .article-body ol {
            margin: 1rem 0 1.5rem 1.5rem;
        }

        .article-body li {
            margin-bottom: 0.5rem;
        }

        .article-body a {
            color: #00d4ff;
        }

        .article-body blockquote {
            border-left: 4px solid #00d4ff;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
            color: rgba(255, 255, 255, 0.7);
            font-style: italic;
        }

        /* Reactions Section */
        .reactions-section {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 2rem;
        }

        .reactions-title {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1rem;
        }

        .reactions-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .reaction-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .reaction-btn:hover {
            background: rgba(0, 212, 255, 0.1);
            border-color: rgba(0, 212, 255, 0.3);
        }

        .reaction-btn.active {
            background: rgba(0, 212, 255, 0.2);
            border-color: #00d4ff;
            color: #00d4ff;
        }

        .reaction-emoji {
            font-size: 1.2rem;
        }

        .login-prompt {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
        }

        .login-prompt a {
            color: #00d4ff;
        }

        /* Comments Section */
        .comments-section {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .comments-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .comments-title {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .comments-count {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        /* Comment Form */
        .comment-form {
            margin-bottom: 2rem;
        }

        .comment-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 1rem;
            color: white;
            font-family: inherit;
            font-size: 1rem;
            resize: vertical;
            min-height: 100px;
            margin-bottom: 1rem;
        }

        .comment-input:focus {
            outline: none;
            border-color: #00d4ff;
        }

        .comment-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        /* Comment Item */
        .comment-item {
            padding: 1.5rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .comment-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .comment-meta {
            flex: 1;
        }

        .comment-author {
            font-weight: 600;
            color: #fff;
        }

        .comment-date {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .comment-content {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 0.75rem;
        }

        .comment-actions {
            display: flex;
            gap: 1rem;
        }

        .comment-action-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .comment-action-btn:hover {
            color: #00d4ff;
        }

        /* Reply Form */
        .reply-form {
            margin-top: 1rem;
            padding-left: 3rem;
            display: none;
        }

        .reply-form.active {
            display: block;
        }

        /* Replies */
        .replies {
            margin-left: 3rem;
            padding-left: 1rem;
            border-left: 2px solid rgba(255, 255, 255, 0.1);
        }

        .reply-item {
            padding: 1rem 0;
        }

        .no-comments {
            text-align: center;
            padding: 2rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Success Message */
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

        /* Responsive */
        @media (max-width: 768px) {
            .article-title {
                font-size: 1.75rem;
            }

            .article-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .article-actions {
                margin-left: 0;
                width: 100%;
            }

            .article-content {
                padding: 1.5rem;
            }

            .reactions-buttons {
                /* flex-direction: column; Removed to keep buttons parallel */
                flex-direction: row; 
            }

            .reaction-btn {
                justify-content: center;
                flex: 1; /* Make them equal width */
            }

            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main class="main-content">
        <a href="{{ route('blog.index') }}" class="back-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Blog
        </a>

        @if(session('success'))
            <div class="alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Article Header -->
        <header class="article-header">
            <span class="article-category">{{ $article->category_label }}</span>
            <h1 class="article-title">{{ $article->title }}</h1>
            
            <div class="article-meta">
                <div class="author-info">
                    <div class="author-avatar">{{ $article->author_initial }}</div>
                    <div class="author-details">
                        <span class="author-name">{{ $article->author_name }}</span>
                        <span class="author-type">{{ $article->author_type }}</span>
                    </div>
                </div>
                <span class="article-date">{{ $article->published_at ? $article->published_at->format('F d, Y') : 'Draft' }}</span>
                
                @auth
                    @if(Auth::id() === $article->user_id)
                        <div class="article-actions">
                            <form action="{{ route('blog.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </header>

        <!-- Featured Image -->
        @if($article->featured_image)
            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="featured-image">
        @endif

        <!-- Article Content -->
        <div class="article-content">
            <div class="article-body">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>

        <!-- Reactions Section -->
        <div class="reactions-section">
            <p class="reactions-title">What do you think about this article?</p>
            
            @auth
                <div class="reactions-buttons">
                    @php $counts = $article->reaction_counts; @endphp
                    
                    <button class="reaction-btn {{ $userReaction && $userReaction->reaction_type === 'like' ? 'active' : '' }}" 
                            onclick="react('like')" id="react-like">
                        <span class="reaction-emoji">👍</span>
                        <span>Like</span>
                        <span id="count-like">{{ $counts['like'] ?? 0 }}</span>
                    </button>
                    
                    <button class="reaction-btn {{ $userReaction && $userReaction->reaction_type === 'dislike' ? 'active' : '' }}"
                            onclick="react('dislike')" id="react-dislike">
                        <span class="reaction-emoji">👎</span>
                        <span>Dislike</span>
                        <span id="count-dislike">{{ $counts['dislike'] ?? 0 }}</span>
                    </button>
                </div>
            @else
                <p class="login-prompt">
                    <a href="{{ route('login') }}">Sign in</a> to react to this article
                </p>
            @endauth
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <div class="comments-header">
                <h2 class="comments-title">Comments</h2>
                <span class="comments-count">{{ $article->allComments->count() }} comments</span>
            </div>

            @auth
                <form class="comment-form" action="{{ route('blog.comment', $article->id) }}" method="POST">
                    @csrf
                    <textarea name="content" class="comment-input" placeholder="Write a comment..." required></textarea>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            @else
                <p class="login-prompt" style="margin-bottom: 2rem;">
                    <a href="{{ route('login') }}">Sign in</a> to leave a comment
                </p>
            @endauth

            <div class="comments-list">
                @forelse($article->comments as $comment)
                    <div class="comment-item">
                        <div class="comment-header">
                            <div class="comment-avatar">{{ $comment->commenter_initial }}</div>
                            <div class="comment-meta">
                                <span class="comment-author">{{ $comment->commenter_name }}</span>
                                <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="comment-content">{{ $comment->content }}</p>
                        
                        <div class="comment-actions">
                            @auth
                                <button class="comment-action-btn" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>
                            @endauth
                            @if(Auth::check() && Auth::id() === $comment->user_id)
                                <form action="{{ route('blog.comment.delete', $comment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="comment-action-btn" style="color: #ef4444;">Delete</button>
                                </form>
                            @endif
                        </div>

                        @auth
                            <div class="reply-form" id="reply-form-{{ $comment->id }}">
                                <form action="{{ route('blog.comment', $article->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="content" class="comment-input" placeholder="Write a reply..." required style="min-height: 80px;"></textarea>
                                    <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                                </form>
                            </div>
                        @endauth

                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="replies">
                                @foreach($comment->replies as $reply)
                                    <div class="reply-item">
                                        <div class="comment-header">
                                            <div class="comment-avatar" style="width: 32px; height: 32px; font-size: 0.75rem;">{{ $reply->commenter_initial }}</div>
                                            <div class="comment-meta">
                                                <span class="comment-author">{{ $reply->commenter_name }}</span>
                                                <span class="comment-date">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <p class="comment-content">{{ $reply->content }}</p>
                                        @if(Auth::check() && Auth::id() === $reply->user_id)
                                            <form action="{{ route('blog.comment.delete', $reply->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="comment-action-btn" style="color: #ef4444;">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="no-comments">
                        <p>No comments yet. Be the first to share your thoughts!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    @include('partials.footer')


    <script>
        function toggleReplyForm(commentId) {
            const form = document.getElementById('reply-form-' + commentId);
            form.classList.toggle('active');
        }

        function react(type) {
            fetch('{{ route("blog.react", $article->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ reaction_type: type })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update button states
                    ['like', 'dislike'].forEach(t => {
                        const btn = document.getElementById('react-' + t);
                        if (btn) {
                            btn.classList.remove('active');
                            document.getElementById('count-' + t).textContent = data.counts[t] || 0;
                        }
                    });
                    
                    if (data.reacted) {
                        document.getElementById('react-' + type).classList.add('active');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
