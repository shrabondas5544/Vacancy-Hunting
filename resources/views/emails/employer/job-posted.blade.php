<!DOCTYPE html>
<html>
<head>
    <title>Job Posted Successfully</title>
    <style>
        body { font-family: 'Inter', Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f1f5f9; padding: 20px 0; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .header { background: #0f172a; padding: 30px; text-align: center; }
        .logo { color: #fff; font-size: 24px; font-weight: 800; text-decoration: none; }
        .content { padding: 40px 30px; }
        .h2 { color: #0f172a; font-size: 20px; font-weight: 700; margin-top: 0; }
        .detail-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .footer { background: #f8fafc; text-align: center; padding: 20px; font-size: 12px; color: #64748b; border-top: 1px solid #e2e8f0; }
        .btn { display: inline-block; padding: 12px 24px; background: #00bcd4; color: #fff; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" class="logo">Vacancy Hunting</a>
        </div>
        <div class="content">
            <h2 class="h2">Job Posted Successfully! 🚀</h2>
            <p>Dear {{ $job->employer->company_name ?? 'Employer' }},</p>
            <p>Your job post has been successfully created and is now live on Vacancy Hunting.</p>
            
            <div class="detail-box">
                <p style="margin: 0 0 10px;"><strong>Job Title:</strong> {{ $job->title }}</p>
                <p style="margin: 0 0 10px;"><strong>Job Type:</strong> {{ $job->job_type }}</p>
                <p style="margin: 0;"><strong>Closing Date:</strong> {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</p>
            </div>

            <p>You can manage this job, view applications, and edit details from your employer dashboard.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('employer.show-job', $job->id) }}" class="btn">View Job</a>
            </div>
            
            <p style="margin-top: 30px;">Best regards,<br>The Vacancy Hunting Team</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Vacancy Hunting. All rights reserved.
        </div>
    </div>
</body>
</html>
