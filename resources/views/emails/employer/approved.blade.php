<!DOCTYPE html>
<html>
<head>
    <title>Account Approved</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #0f172a; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .logo { color: #fff; font-size: 24px; font-weight: bold; text-decoration: none; }
        .content { background: #f8fafc; padding: 30px; border-radius: 0 0 8px 8px; border: 1px solid #e2e8f0; }
        .btn { display: inline-block; padding: 12px 24px; background: #00bcd4; color: #fff; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 20px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #64748b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" class="logo">Vacancy Hunting</a>
        </div>
        <div class="content">
            <h2>Congratulations! 🎉</h2>
            <p>Dear {{ $employer->company_name }},</p>
            <p>We are pleased to inform you that your verification is complete by the Vacancy Hunting team.</p>
            <p>Your employer account has been approved and created successfully. You can now log in to post jobs, search for candidates, and manage your recruitment process.</p>
            <p>👉 <strong>Login Details:</strong><br>Please use your <strong>registered email address</strong> and the <strong>password you created</strong> to access your account.</p>
            <div style="text-align: center;">
                <a href="{{ route('login') }}" class="btn">Login to Dashboard</a>
            </div>
            <p style="margin-top: 30px;">Best regards,<br>The Vacancy Hunting Team</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Vacancy Hunting. All rights reserved.
        </div>
    </div>
</body>
</html>

