@extends('layouts.employer')

@section('content')
<div class="content-header">
    <h1>Dashboard</h1>
    <p>Welcome to your employer portal</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Jobs Posted</h3>
        <div class="stat-value">{{ $stats['total_jobs'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Active Jobs</h3>
        <div class="stat-value">{{ $stats['active_jobs'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Applications</h3>
        <div class="stat-value">{{ $stats['total_applications'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Pending Applications</h3>
        <div class="stat-value">{{ $stats['pending_applications'] }}</div>
    </div>
</div>

<div class="empty-state">
    <h2>Dashboard Statistics Coming Soon</h2>
    <p>This section will display detailed analytics and insights about your job postings and applications.</p>
</div>
@endsection
