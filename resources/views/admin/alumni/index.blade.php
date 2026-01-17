@extends('admin.layout')

@section('styles')
<style>
    .page-header {
        margin-bottom: 2rem;
    }
    
    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: var(--text-muted);
    }

    .empty-state {
        background-color: var(--surface);
        border-radius: var(--radius);
        padding: 4rem 2rem;
        text-align: center;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        color: var(--primary);
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }
</style>
@endsection

@section('content')
<div class="container" style="padding-top: 2rem;">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Create Alumni</h1>
        <p class="page-subtitle">Manage alumni directory and interactions.</p>
    </div>

    <!-- Empty State -->
    <div class="empty-state">
        <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
        <h3>Under Construction</h3>
        <p style="color: var(--text-muted); max-width: 400px; margin: 0.5rem auto;">
            This module is currently being built. Please check back later for updates.
        </p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block; background: var(--primary); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none;">
            For now, Go Back to Dashboard
        </a>
    </div>
</div>
@endsection
