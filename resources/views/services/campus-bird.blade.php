<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Bird Internship Program - Vacancy Hunting</title>
    
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
            max-width: 1000px;
            margin: 0 auto 3rem auto;
            padding: 0 1rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 2.5rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .section-heading {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-heading svg {
            color: #00d4ff;
        }

        .section-text {
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
        }

        .feature-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2.5rem;
        }

        .feature-item {
            display: flex;
            gap: 1rem;
            align-items: center;
            background: rgba(255, 255, 255, 0.02);
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            border-color: rgba(0, 212, 255, 0.3);
            background: rgba(0, 212, 255, 0.05);
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            color: #00d4ff;
            flex-shrink: 0;
        }

        .feature-text {
            color: #e2e8f0;
            font-weight: 500;
        }

        .cta-section {
            background: linear-gradient(135deg, rgba(0, 188, 212, 0.1) 0%, rgba(30, 58, 138, 0.2) 100%);
            border: 1px solid rgba(0, 212, 255, 0.3);
            padding: 4rem 2rem;
            border-radius: 16px;
            text-align: center;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(0, 212, 255, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: white;
            position: relative;
            z-index: 1;
        }

        .cta-subtitle {
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            position: relative;
            z-index: 1;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%);
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 1rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 188, 212, 0.4);
            position: relative;
            z-index: 1;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 188, 212, 0.6);
        }
        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-container {
            background: #1e293b;
            width: 90%;
            max-width: 800px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transform: translateY(20px);
            transition: transform 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }

        .modal-close {
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .modal-body {
            padding: 2rem;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .category-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.25rem;
            border-radius: 12px;
            color: white;
            text-align: left;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
        }

        .category-btn:hover {
            background: rgba(0, 212, 255, 0.1);
            border-color: #00d4ff;
            color: #00d4ff;
            transform: translateY(-2px);
        }

        .category-btn svg {
            width: 20px;
            height: 20px;
            opacity: 0.5;
            transition: all 0.2s;
        }

        .category-btn:hover svg {
            opacity: 1;
            transform: translateX(4px);
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main role="main">

    @if(session('success'))
        <div style="position: fixed; top: 80px; right: 20px; background: linear-gradient(135deg, #00bcd4 0%, #0099cc 100%); color: white; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 8px 24px rgba(0, 188, 212, 0.4); z-index: 999; animation: slideIn 0.3s ease;">
            {{ session('success') }}
        </div>
        <style>
            @keyframes slideIn {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        </style>
        <script>
            setTimeout(function() {
                document.querySelector('[style*="slideIn"]').style.animation = 'slideOut 0.3s ease forwards';
                setTimeout(function() {
                    document.querySelector('[style*="slideIn"]')?.remove();
                }, 300);
            }, 5000);
        </script>
    @endif

    <header class="page-header">
        <h1 class="page-title">Campus Bird Internship Program</h1>
        <p class="page-subtitle">Kickstart your career with real-world experience and professional mentorship right from your campus.</p>
    </header>

    <div class="content-section">
        <div class="card">
            <h2 class="section-heading">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                About the Program
            </h2>
            <p class="section-text">
                The Campus Bird Internship Program is designed to bridge the gap between academic learning and industry requirements. 
                We provide students with hands-on opportunities to work on live projects, gain valuable skills, and understand corporate dynamics.
            </p>
            <p class="section-text">
                Whether you are in your final year or just starting your college journey, our flexible program structure ensures that you can 
                balance your studies while building a strong professional portfolio.
            </p>

            <ul class="feature-list">
                <li class="feature-item">
                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <span class="feature-text">Hands-on Live Projects</span>
                </li>
                <li class="feature-item">
                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                    <span class="feature-text">Guidance from Industry Experts</span>
                </li>
                <li class="feature-item">
                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15l-2 5l-2.8-5h-5.2l3.8-2.6l-1.4-5.4l4.8 3.4l4.8-3.4l-1.4 5.4l3.8 2.6z"></path></svg>
                    <span class="feature-text">Certification & Recommendation</span>
                </li>
                <li class="feature-item">
                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                    <span class="feature-text">PPO for Top Performers</span>
                </li>
            </ul>
        </div>

        <div class="cta-section">
            <h2 class="cta-title">Ready to spread your wings?</h2>
            <p class="cta-subtitle">Join the flock and start your professional journey today!</p>
            
            <button onclick="toggleModal()" class="cta-button">
                Fill this form for Application
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </div>

        <div style="text-align: center; margin-top: 4rem;">
            <h2 class="section-heading" style="justify-content: center; font-size: 2rem; margin-bottom: 1rem;">
                Our Pride, Our Alumni
            </h2>
            <p class="section-text" style="text-align: center; max-width: 600px; margin: 0 auto 2rem auto;">
                Meet our previous graduates who have successfully transitioned into their professional careers after completing the Campus Bird Internship Program.
            </p>
            <a href="{{ route('services.campus-bird-alumni') }}" class="cta-button" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); box-shadow: none;">
                See our previous alums
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </a>
        </div>
    </div>

    <!-- Application Modal -->
    <div class="modal-overlay" id="applicationModal">
        <div class="modal-container">
            <div class="modal-header">
                <h2 class="modal-title">Select Internship Category</h2>
                <button class="modal-close" onclick="toggleModal()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="category-grid">
                    @foreach($departments as $dept)
                        <a href="{{ route('campus-bird.apply', ['department' => $dept['name']]) }}" class="category-btn" style="{{ !$dept['available'] ? 'opacity: 0.7;' : '' }}">
                            {{ $dept['name'] }}
                            @if($dept['available'])
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            @else
                                <span style="font-size: 0.75rem; color: #ff6b6b;">Not Available</span>
                            @endif
                        </a>
                    @endforeach
                </div>
                <p style="text-align: center; color: rgba(255, 255, 255, 0.6); font-size: 0.9rem; margin-top: 1.5rem; line-height: 1.6;">
                    Programs marked as "Not Available" are currently not offered.<br>
                    Stay tuned at our 
                    <a href="https://www.facebook.com/vacancyhuntingbd" target="_blank" style="color: #00d4ff; text-decoration: none;">Facebook</a> / 
                    <a href="https://www.linkedin.com/company/vacancy-hunting" target="_blank" style="color: #00d4ff; text-decoration: none;">LinkedIn</a> 
                    page for future updates.
                </p>
            </div>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('applicationModal');
            document.body.style.overflow = modal.classList.contains('active') ? 'auto' : 'hidden';
            modal.classList.toggle('active');
        }

        // Close modal when clicking outside
        document.getElementById('applicationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleModal();
            }
        });
    </script>

    </main>

    @include('partials.footer')
</body>
</html>
