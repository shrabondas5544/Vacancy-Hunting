@extends('layouts.public')

@section('title', 'Cookie Policy')

@section('content')
<div class="legal-container">
    <h1>Cookie Policy</h1>
    <p class="text-muted">Last updated: {{ date('F d, Y') }}</p>

    <h2>1. What Are Cookies?</h2>
    <p>Cookies are small text files that are placed on your computer or mobile device when you visit a website. They are widely used to make websites work more efficiently and to provide information to the owners of the site.</p>

    <h2>2. How We Use Cookies</h2>
    <p>Vacancy Hunting uses cookies for several reasons:</p>
    <ul>
        <li><strong>Essential Cookies:</strong> These are necessary for the website to function properly, such as keeping you logged in.</li>
        <li><strong>Performance Cookies:</strong> These allow us to count visits and traffic sources so we can measure and improve the performance of our site.</li>
        <li><strong>Functional Cookies:</strong> These enable the website to provide enhanced functionality and personalization.</li>
    </ul>

    <h2>3. Types of Cookies We Use</h2>
    <p>We use both session cookies (which expire when you close your browser) and persistent cookies (which remain on your device for a set period).</p>

    <h2>4. Managing Cookies</h2>
    <p>Most web browsers allow some control of most cookies through the browser settings. To find out more about cookies, including how to see what cookies have been set and how to manage and delete them, visit <a href="https://www.allaboutcookies.org" target="_blank" rel="noopener noreferrer">www.allaboutcookies.org</a>.</p>
    
    <h2>5. Updates to This Policy</h2>
    <p>We may update this Cookie Policy from time to time. We encourage you to periodically review this page for the latest information on our privacy practices.</p>

    <h2>6. Contact Us</h2>
    <p>If you have specific questions about our use of cookies, please contact us.</p>
</div>
@endsection
