<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $alumni->name }} - Campus Bird Alumni</title>
    
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

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            margin: 2rem 0 2rem 2rem;
            transition: color 0.2s;
            font-size: 0.9rem;
        }
        
        .back-link:hover {
            color: #fff;
        }

        .profile-container {
            max-width: 900px;
            margin: 0 auto 4rem auto;
            padding: 0 2rem;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 3rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 60px -20px rgba(0, 0, 0, 0.3);
            position: relative;
        }
        
        .share-btn {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 188, 212, 0.4);
            transition: all 0.3s ease;
            z-index: 10;
        }
        
        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 30px rgba(0, 188, 212, 0.6);
        }

        .profile-header {
            display: flex;
            gap: 2.5rem;
            margin-bottom: 3rem;
            align-items: flex-start;
        }

        .profile-photo {
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid rgba(0, 212, 255, 0.3);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-placeholder {
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.2);
            font-weight: 700;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #00d4ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .profile-program {
            font-size: 1.25rem;
            color: #00d4ff;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .profile-batch {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1.5rem;
        }

        .profile-social {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .social-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background: rgba(0, 212, 255, 0.1);
            border-color: #00d4ff;
            color: #00d4ff;
            transform: translateY(-2px);
        }

        .profile-section {
            margin-bottom: 2.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title svg {
            color: #00d4ff;
        }

        .section-content {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.02);
            padding: 1.25rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .info-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .info-value {
            font-size: 1.1rem;
            color: #fff;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .profile-social {
                justify-content: center;
            }
            
            .profile-card {
                padding: 2rem;
            }
            
            .share-btn {
                top: 1rem;
                right: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <a href="{{ route('services.campus-bird-alumni') }}" class="back-link">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Back to Alumni
    </a>

    <main role="main">

    <div class="profile-container">
        <div class="profile-card">
            <button class="share-btn" onclick="shareProfile()" title="Share Profile">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="18" cy="5" r="3"></circle>
                    <circle cx="6" cy="12" r="3"></circle>
                    <circle cx="18" cy="19" r="3"></circle>
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
            </button>
            
            <div class="profile-header">
                <div class="profile-photo">
                    @if($alumni->photo)
                        <img src="{{ asset($alumni->photo) }}" alt="{{ $alumni->name }}" fetchpriority="high" onerror="this.parentElement.innerHTML='<div class=&quot;profile-placeholder&quot;>{{ substr($alumni->name, 0, 1) }}</div>';">
                    @else
                        <div class="profile-placeholder">
                            {{ substr($alumni->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                
                <div class="profile-info">
                    <h1 class="profile-name">{{ $alumni->name }}</h1>
                    <div class="profile-program">{{ $alumni->program }}</div>
                    <div class="profile-batch">{{ $alumni->category }} • Batch: {{ $alumni->year }}</div>
                    
                    <div class="profile-social">
                        @if($alumni->linkedin)
                            <a href="{{ $alumni->linkedin }}" target="_blank" class="social-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                LinkedIn
                            </a>
                        @endif
                        @if($alumni->facebook)
                            <a href="{{ $alumni->facebook }}" target="_blank" class="social-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                Facebook
                            </a>
                        @endif
                        @if($alumni->twitter)
                            <a href="{{ $alumni->twitter }}" target="_blank" class="social-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                Twitter
                            </a>
                        @endif
                        @if($alumni->instagram)
                            <a href="{{ $alumni->instagram }}" target="_blank" class="social-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                Instagram
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @if($alumni->description)
                <div class="profile-section">
                    <h2 class="section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 1 0 0-20z"></path><path d="M12 8v8m0-8h.01"></path></svg>
                        About
                    </h2>
                    <div class="section-content">
                        {{ $alumni->description }}
                    </div>
                </div>
            @endif

            <div class="profile-section">
                <h2 class="section-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    Personal Information
                </h2>
                <div class="info-grid">
                    @if($alumni->email)
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $alumni->email }}</div>
                        </div>
                    @endif
                    @if($alumni->phone)
                        <div class="info-item">
                            <div class="info-label">Phone</div>
                            <div class="info-value">{{ $alumni->phone }}</div>
                        </div>
                    @endif
                    @if($alumni->division)
                        <div class="info-item">
                            <div class="info-label">Division</div>
                            <div class="info-value">{{ $alumni->division }}</div>
                        </div>
                    @endif
                    @if($alumni->dob)
                        <div class="info-item">
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value">{{ $alumni->dob->format('F d, Y') }}</div>
                        </div>
                    @endif
                </div>
            </div>

            @if($alumni->school || $alumni->college || $alumni->university)
                <div class="profile-section">
                    <h2 class="section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                        Education
                    </h2>
                    <div class="info-grid">
                        @if($alumni->university)
                            <div class="info-item">
                                <div class="info-label">University</div>
                                <div class="info-value">{{ $alumni->university }}</div>
                            </div>
                        @endif
                        @if($alumni->college)
                            <div class="info-item">
                                <div class="info-label">College</div>
                                <div class="info-value">{{ $alumni->college }}</div>
                            </div>
                        @endif
                        @if($alumni->school)
                            <div class="info-item">
                                <div class="info-label">School</div>
                                <div class="info-value">{{ $alumni->school }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        </div>
    </div>
    </main>
    
    <script>
        function shareProfile() {
            const shareData = {
                title: '{{ $alumni->name }} - Campus Bird Alumni',
                text: 'Check out {{ $alumni->name }}, a Campus Bird Internship Program alumni!',
                url: window.location.href
            };

            if (navigator.share) {
                navigator.share(shareData)
                    .catch((error) => console.log('Error sharing:', error));
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href)
                    .then(() => {
                        alert('Profile link copied to clipboard!');
                    })
                    .catch((error) => {
                        console.log('Error copying to clipboard:', error);
                    });
            }
        }
    </script>
    
    @include('partials.footer')
</body>
</html>
