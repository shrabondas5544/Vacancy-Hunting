<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Vacancy Hunting') }} - @yield('title')</title>
    
    <!-- Fonts - Async Loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"></noscript>
    
    <style>
        /* CORPORATE DARK THEME CSS - ENHANCED */
        :root {
            --bg-color: #0f172a;
            --text-main: #e2e8f0;
            --text-muted: #94a3b8;
            --primary-color: #00d4ff;
            --primary-hover: #00b8de;
            --border-color: rgba(255, 255, 255, 0.08);
            --card-bg: rgba(30, 41, 59, 0.7);
            --card-glass: rgba(15, 23, 42, 0.6);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            /* Rich Gradient Background matching Blog */
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%), 
                radial-gradient(at 0% 100%, rgba(30, 64, 175, 0.2) 0px, transparent 50%);
            background-attachment: fixed;
            background-size: cover;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .page-content {
            flex: 1;
            padding: 3rem 2rem;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            color: #fff;
            margin-bottom: 1rem;
            line-height: 1.3;
        }
        
        h1 { 
            font-size: 2.75rem; 
            font-weight: 800; 
            margin-bottom: 0.5rem; 
            background: linear-gradient(135deg, #fff 0%, #00d4ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
        
        h2 { 
            font-size: 1.75rem; 
            margin-top: 2.5rem; 
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-color);
            color: #f1f5f9;
        }
        
        p, ul, ol {
            margin-bottom: 1.5rem;
            line-height: 1.7;
            color: var(--text-muted);
            font-size: 1.05rem;
        }
        
        ul, ol {
            padding-left: 1.5rem;
        }
        
        li {
            margin-bottom: 0.5rem;
        }
        
        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.2s;
            border-bottom: 1px solid transparent;
        }
        
        a:hover {
            color: var(--primary-hover);
            border-bottom-color: var(--primary-hover);
        }
        
        strong {
            color: #e2e8f0;
        }
        
        /* Glassmorphism Card Style */
        .legal-container {
            background: var(--card-glass);
            padding: 3.5rem;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            animation: fadeInUp 0.6s ease-out;
        }
        
        .last-updated {
            font-size: 0.9rem;
            color: rgba(148, 163, 184, 0.8);
            margin-bottom: 2rem;
            display: block;
            font-weight: 500;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-content {
                padding: 2rem 1rem;
            }
            .legal-container {
                padding: 1.75rem;
                border-radius: 16px;
            }
            h1 { font-size: 2rem; }
            h2 { font-size: 1.5rem; margin-top: 2rem; }
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="page-content">
        @yield('content')
    </div>

    @include('partials.footer')
</body>
</html>
