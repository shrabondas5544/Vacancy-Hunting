@extends('admin.blog.layout')

@section('page-title', 'Blog Dashboard')

@section('page-styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .stat-value {
        color: var(--text-main);
        font-size: 2rem;
        font-weight: 700;
    }

    .stat-desc {
        color: var(--text-muted);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .stat-desc.up {
        color: #22c55e;
    }
</style>
@endsection

@section('page-content')
<div class="stats-grid">
    <div class="stat-card">
        <span class="stat-label">Total Blog Posts</span>
        <span class="stat-value">{{ $stats['total_blogs'] }}</span>
        <span class="stat-desc">All time</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Recent Posts</span>
        <span class="stat-value">{{ $stats['recent_blogs'] }}</span>
        <span class="stat-desc">Last 30 days</span>
    </div>
</div>

<!-- Placeholder for future charts or activity feed -->
<div style="text-align: center; color: var(--text-muted); margin-top: 4rem;">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 48px; height: 48px; opacity: 0.2; margin-bottom: 1rem;">
        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
    </svg>
    <p>More analytics coming soon</p>
</div>
@endsection
