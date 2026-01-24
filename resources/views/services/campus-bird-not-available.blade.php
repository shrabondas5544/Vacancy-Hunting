<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Program Not Available - Campus Bird Internship</title>
    
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
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 4rem 2rem;
            text-align: center;
            min-height: calc(100vh - 80px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .icon-container {
            margin-bottom: 2rem;
        }

        .icon {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon svg {
            width: 60px;
            height: 60px;
            color: #ff6b6b;
        }

        .title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #ff6b6b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .department-name {
            font-size: 1.3rem;
            color: #00d4ff;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .message {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .social-links {
            margin: 2rem 0;
        }

        .social-links a {
            color: #00d4ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .social-links a:hover {
            color: #00bcd4;
            text-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(0, 212, 255, 0.1);
            color: #00d4ff;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid rgba(0, 212, 255, 0.3);
            margin-top: 2rem;
        }

        .back-button:hover {
            background: rgba(0, 212, 255, 0.2);
            border-color: #00d4ff;
            transform: translateX(-5px);
        }

        .back-button svg {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 768px) {
            .title {
                font-size: 2rem;
            }

            .department-name {
                font-size: 1.1rem;
            }

            .message {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main role="main" class="container">
        <div class="icon-container">
            <div class="icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
        </div>

        <h1 class="title">Program Not Available</h1>
        <p class="department-name">{{ $department }}</p>
        
        <p class="message">
            This program is currently not offered.<br>
            We're constantly expanding our internship opportunities.
        </p>

        <div class="social-links">
            <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 1rem;">Stay tuned for updates:</p>
            <a href="https://www.facebook.com/vacancyhuntingbd" target="_blank">Facebook</a>
            <span style="color: rgba(255, 255, 255, 0.5); margin: 0 1rem;">/</span>
            <a href="https://www.linkedin.com/company/vacancy-hunting" target="_blank">LinkedIn</a>
        </div>

        <a href="{{ route('services.campus-bird') }}" class="back-button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Campus Bird
        </a>
    </main>

    @include('partials.footer')
</body>
</html>
