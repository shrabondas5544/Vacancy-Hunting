@extends('layouts.public')

@section('title', 'Privacy Policy')

@section('content')
<div class="legal-container">
    <h1>Privacy Policy</h1>
    <p class="text-muted">Last updated: {{ date('F d, Y') }}</p>

    <h2>1. Introduction</h2>
    <p>Vacancy Hunting respects your privacy and is committed to protecting your personal data. This privacy policy will inform you as to how we look after your personal data when you visit our website.</p>

    <h2>2. Data We Collect</h2>
    <p>We may collect, use, store and transfer different kinds of personal data about you, including:</p>
    <ul>
        <li><strong>Identity Data:</strong> Name, username, educational background.</li>
        <li><strong>Contact Data:</strong> Email address, telephone number, address.</li>
        <li><strong>Professional Data:</strong> Resume/CV, employment history, skills.</li>
        <li><strong>Technical Data:</strong> IP address, browser type, device information.</li>
    </ul>

    <h2>3. How We Use Your Data</h2>
    <p>We use your personal data to:</p>
    <ul>
        <li>Provide our recruitment services to you.</li>
        <li>Match candidates with potential employers.</li>
        <li>Manage your account and subscription.</li>
        <li>Improve our website and services.</li>
    </ul>

    <h2>4. Data Sharing</h2>
    <p>We may share your data with:</p>
    <ul>
        <li>Employers when you apply for a job or enable profile visibility.</li>
        <li>Service providers who help us operate our business.</li>
        <li>Law enforcement agencies when required by law.</li>
    </ul>

    <h2>5. Data Security</h2>
    <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used, or accessed in an unauthorized way.</p>

    <h2>6. Your Rights</h2>
    <p>You have the right to access, correct, or request deletion of your personal data. You may also object to the processing of your personal data.</p>
    
    <h2>7. Contact Us</h2>
    <p>If you have any questions about this privacy policy, please contact our Data Protection Officer at privacy@vacancyhunting.com.</p>
</div>
@endsection
