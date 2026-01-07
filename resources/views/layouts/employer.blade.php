<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Vacancy Hunting') }} - Employer Portal</title>
    
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
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Main content wrapper */
        .employer-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Content container with sidebar */
        /* Content container with sidebar */
        .employer-container {
            flex: 1;
            display: flex;
            width: 100%;
            gap: 0;
        }

        /* Sidebar */
        .employer-sidebar {
            width: 280px;
            background: rgba(15, 23, 42, 0.7);
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(30, 58, 138, 0.2) 0px, transparent 50%);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #00d4ff;
        }

        .sidebar-nav {
            padding: 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(0, 212, 255, 0.1);
            color: #00d4ff;
            border-left-color: #00d4ff;
        }

        .sidebar-link svg {
            width: 20px;
            height: 20px;
        }

        /* Main content area */
        .employer-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        /* Content header */
        .content-header {
            margin-bottom: 2rem;
        }

        .content-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .content-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
        }

        /* Stats grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 212, 255, 0.2);
        }

        .stat-card h3 {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #00d4ff;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .empty-state h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .empty-state p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1rem;
        }

        /* Mobile responsive */
        @media (max-width: 1024px) {
            .employer-sidebar {
                display: none;
            }

            .employer-content {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="employer-wrapper">
        <div class="employer-container">
            <!-- Sidebar -->
            <aside class="employer-sidebar">
                <div class="sidebar-header">
                    <h2>Employer Portal</h2>
                </div>
                <nav class="sidebar-nav">
                    <a href="{{ route('employer.dashboard') }}" class="sidebar-link {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('employer.post-job') }}" class="sidebar-link {{ request()->routeIs('employer.post-job') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"></path>
                        </svg>
                        <span>Post a Job</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="employer-content">
                @yield('content')
            </main>
        </div>
    </div>

    @include('partials.footer')

    <script>
        // Add navbar mobile drawer functionality
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileDrawer = document.getElementById('mobileDrawer');
        const drawerOverlay = document.getElementById('drawerOverlay');

        if (hamburgerBtn && mobileDrawer && drawerOverlay) {
            hamburgerBtn.addEventListener('click', () => {
                hamburgerBtn.classList.toggle('active');
                mobileDrawer.classList.toggle('active');
                drawerOverlay.classList.toggle('active');
            });

            drawerOverlay.addEventListener('click', () => {
                hamburgerBtn.classList.remove('active');
                mobileDrawer.classList.remove('active');
                drawerOverlay.classList.remove('active');
            });
        }

        // Drawer submenu toggle
        function toggleDrawerSubmenu(event, submenuId) {
            event.preventDefault();
            const submenu = document.getElementById(submenuId);
            const arrow = event.currentTarget.querySelector('.submenu-arrow');
            
            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
                if (arrow) arrow.textContent = '▲';
            } else {
                submenu.style.display = 'none';
                if (arrow) arrow.textContent = '▼';
            }
        }
    </script>
</body>
</html>
