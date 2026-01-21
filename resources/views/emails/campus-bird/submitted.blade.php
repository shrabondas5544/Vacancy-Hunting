<!DOCTYPE html>
<html>
<head>
    <title>Application Received</title>
    <style>
        body { font-family: 'Inter', Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f1f5f9; padding: 20px 0; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .header { background: #0f172a; padding: 30px; text-align: center; }
        .logo { color: #fff; font-size: 24px; font-weight: 800; text-decoration: none; }
        .content { padding: 40px 30px; }
        .h2 { color: #0f172a; font-size: 20px; font-weight: 700; margin-top: 0; }
        .detail-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .footer { background: #f8fafc; text-align: center; padding: 20px; font-size: 12px; color: #64748b; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" class="logo">Vacancy Hunting</a>
        </div>
        <div class="content">
            <h2 class="h2">Application Received! 🎓</h2>
            <p>Dear {{ $submission->applicant_name }},</p>
            <p>Thank you for applying to the <strong>Campus Bird Internship Program</strong>. We have successfully received your application for the <strong>{{ $submission->form->department ?? 'Internship' }}</strong> department.</p>
            
            <div class="detail-box">
                <p style="margin: 0 0 10px;"><strong>Submission Date:</strong> {{ $submission->created_at->format('M d, Y h:i A') }}</p>
                <p style="margin: 0;"><strong>Status:</strong> <span style="color: #eab308; font-weight: 600;">Pending Review</span></p>
            </div>

            <p>Our team will review your application and credential details. If you are shortlisted, we will contact you via email or phone for the next steps.</p>
            
            <p>Best regards,<br>The VH Career Team</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Vacancy Hunting. All rights reserved.
        </div>
    </div>
</body>
</html>
