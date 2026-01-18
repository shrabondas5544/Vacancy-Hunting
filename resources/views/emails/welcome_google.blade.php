<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; line-height: 1.6; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #00d4ff; }
        .btn { display: inline-block; padding: 12px 24px; background-color: #00d4ff; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
        .btn:hover { background-color: #0099cc; }
        .footer { margin-top: 30px; font-size: 0.8rem; color: #777; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Vacancy Hunting 👋</h1>
        </div>
        
        <p>Hello,</p>
        
        <p>We’re happy to let you know that an account has been successfully created using this email address.</p>
        
        <p>To complete your registration and secure your account, please confirm your email address by clicking the button below:</p>
        
        <div style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="btn">👉 Confirm My Account</a>
        </div>
        
        <p style="margin-top: 20px;">Or copy and paste this link into your browser:</p>
        <p><a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a></p>

        <p>If you did not create an account on Vacancy Hunting, please ignore this email. No further action is required.</p>
        
        <div class="footer">
            &copy; {{ date('Y') }} Vacancy Hunting. All rights reserved.
        </div>
    </div>
</body>
</html>
