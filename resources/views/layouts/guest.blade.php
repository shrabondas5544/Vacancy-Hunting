<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Vacancy Hunting') }}</title>

    <!-- Fonts - Async Loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"></noscript>

    <style>
        /* CORPORATE DARK THEME CSS */
        :root {
            --bg-color: #0b1120;
            --card-bg: #151f32;
            --input-bg: #0f172a;
            --border-color: #2d3748;
            --primary-color: #00d4ff;
            --primary-hover: #00b8de;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --error-color: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 450px;
        }

        .auth-card {
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
            text-align: center;
        }

        .auth-header {
            margin-bottom: 30px;
        }

        .auth-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-main);
        }

        .auth-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            color: var(--text-main);
            font-size: 15px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .text-danger {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: #0b1120;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .auth-footer {
            margin-top: 25px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .auth-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 5px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            background: var(--input-bg);
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            font-size: 13px;
            cursor: pointer;
        }

        .checkbox-label input {
            margin-right: 8px;
            accent-color: var(--primary-color);
        }

        .hidden {
            display: none;
        }

        /* Notification Popup */
        .notification-popup {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(245, 158, 11, 0.4);
            max-width: 450px;
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
                transform: translateX(450px);
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
                transform: translateX(450px);
                opacity: 0;
            }
        }

        .notification-popup.hiding {
            animation: slideOutRight 0.3s ease-in forwards;
        }
    </style>
</head>
<body>
    <main role="main" class="auth-wrapper">
        <div class="auth-card">
            @yield('content')
        </div>
    </main>
    
    <!-- Notification Popups -->
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

        // Auto-dismiss after 10 seconds
        if (document.getElementById('notification')) {
            setTimeout(() => {
                closeNotification();
            }, 10000);
        }
    </script>
    
    @stack('scripts')
</body>
</html>
