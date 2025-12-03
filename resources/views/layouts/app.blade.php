<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Vacancy Hunting') }} - Dashboard</title>

    <style>
        /* CORPORATE DARK THEME CSS */
        :root {
            --bg-color: #0f172a;
            --card-bg: #151f32;
            --input-bg: #0f172a;
            --border-color: #2d3748;
            --primary-color: #00d4ff;
            --primary-hover: #00b8de;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --error-color: #ef4444;
            --success-color: #10b981;
            --warning-color: #f59e0b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-header {
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
        }

        .dashboard-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            color: var(--text-muted);
            font-size: 16px;
        }

        /* Notification Popup Styles */
        .notification-popup {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(245, 158, 11, 0.4);
            max-width: 400px;
            z-index: 9999;
            animation: slideInRight 0.4s ease-out;
            border-left: 5px solid #fbbf24;
        }

        .notification-popup.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-left-color: #34d399;
            box-shadow: 0 10px 40px rgba(16, 185, 129, 0.4);
        }

        .notification-popup.error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border-left-color: #f87171;
            box-shadow: 0 10px 40px rgba(239, 68, 68, 0.4);
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .notification-icon {
            font-size: 28px;
            flex-shrink: 0;
        }

        .notification-text {
            flex: 1;
        }

        .notification-title {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .notification-message {
            font-size: 14px;
            line-height: 1.5;
            opacity: 0.95;
        }

        .notification-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            flex-shrink: 0;
            transition: background 0.2s;
        }

        .notification-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .notification-popup.hiding {
            animation: slideOutRight 0.3s ease-in forwards;
        }

        .btn-logout {
            background-color: var(--error-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: opacity 0.2s;
        }

        .btn-logout:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            @yield('content')
            
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </div>

    <!-- Notification Popup -->
    @if(session('employer_pending'))
        <div class="notification-popup" id="notification">
            <div class="notification-content">
                <div class="notification-icon">⏳</div>
                <div class="notification-text">
                    <div class="notification-title">Pending Approval</div>
                    <div class="notification-message">{{ session('employer_pending') }}</div>
                </div>
                <button class="notification-close" onclick="closeNotification()">×</button>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="notification-popup success" id="notification">
            <div class="notification-content">
                <div class="notification-icon">✓</div>
                <div class="notification-text">
                    <div class="notification-title">Success</div>
                    <div class="notification-message">{{ session('success') }}</div>
                </div>
                <button class="notification-close" onclick="closeNotification()">×</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="notification-popup error" id="notification">
            <div class="notification-content">
                <div class="notification-icon">✕</div>
                <div class="notification-text">
                    <div class="notification-title">Error</div>
                    <div class="notification-message">{{ session('error') }}</div>
                </div>
                <button class="notification-close" onclick="closeNotification()">×</button>
            </div>
        </div>
    @endif

    <script>
        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.classList.add('hiding');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }

        // Auto-dismiss after 8 seconds
        if (document.getElementById('notification')) {
            setTimeout(() => {
                closeNotification();
            }, 8000);
        }
    </script>

    @stack('scripts')
</body>
</html>
