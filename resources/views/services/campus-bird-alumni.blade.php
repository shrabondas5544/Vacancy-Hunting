<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Alumni - Campus Bird Internship Program</title>
    
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
            padding: 2rem;
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
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border-radius: 50%;
            margin-bottom: 1.5rem;
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
             margin-bottom: 1rem;
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
    </style>
</head>
<body>
    @include('partials.navbar')

    <main role="main">
        <header class="page-header">
            <a href="{{ route('services.campus-bird') }}" class="back-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Program
            </a>
            <h1 class="page-title">Our Pride, Our Alumni</h1>
            <p class="page-subtitle">Success stories from our Campus Bird Internship Program graduates who are now making waves in the industry.</p>
        </header>

        <div class="content-section">
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
                            <div class="alumni-company">Batch: {{ $alum->year }}</div>
                            
                            @if($alum->description)
                                <p class="alumni-desc">{{ $alum->description }}</p>
                            @else
                                <div style="flex: 1;"></div>
                            @endif

                            <a href="{{ route('services.campus-bird-alumni-profile', ['id' => $alum->id, 'slug' => \Str::slug($alum->name)]) }}" class="view-profile-btn">
                                View Profile
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p>No alumni profiles found yet. Check back soon!</p>
                </div>
            @endif
        </div>
    </main>
    
    @include('partials.footer')
</body>
</html>
