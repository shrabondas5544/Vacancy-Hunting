@extends('admin.campus-bird.layout')

@section('page-title', 'Candidate List')

@section('page-styles')
<style>
    .filter-section {
        background-color: var(--surface);
        padding: 1.5rem;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        margin-bottom: 2rem;
    }

    .filter-form {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
    }

    .form-input {
        width: 100%;
        padding: 0.6rem 1rem;
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .search-btn {
        padding: 0.6rem 1.5rem;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .search-btn:hover {
        background-color: var(--primary-hover);
    }

    /* Table Styles */
    .table-container {
        background-color: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th,
    .data-table td {
        padding: 1rem 1.5rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .data-table th {
        background-color: rgba(0, 0, 0, 0.02);
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar-small {
        width: 32px;
        height: 32px;
        background-color: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .user-info-text h4 {
        margin: 0;
        font-size: 0.95rem;
        color: var(--text-main);
    }

    .user-info-text p {
        margin: 0;
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-badge.active {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .action-btn {
        padding: 0.4rem;
        border-radius: 6px;
        border: 1px solid var(--border);
        background: transparent;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.2s;
    }

    .action-btn:hover {
        background-color: var(--surface-hover);
        color: var(--primary);
        border-color: var(--primary);
    }

    .pagination-container {
        padding: 1.5rem;
        border-top: 1px solid var(--border);
    }
</style>
@endsection

@section('page-content')
<!-- Filter Section -->
<div class="filter-section">
    <form action="{{ route('admin.campus-bird.candidates') }}" method="GET" class="filter-form">
        <div class="form-group">
            <input type="text" name="search" class="form-input" placeholder="Search by name or email..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="search-btn">Search</button>
    </form>
</div>

<!-- Candidates Table -->
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Candidate</th>
                <th>Phone</th>
                <th>Joined Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($candidates as $candidate)
            <tr>
                <td>
                    <div class="user-cell">
                        <div class="user-avatar-small">
                            {{ strtoupper(substr($candidate->name, 0, 1)) }}
                        </div>
                        <div class="user-info-text">
                            <h4>{{ $candidate->name }}</h4>
                            <p>{{ $candidate->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $candidate->phone ?? 'N/A' }}</td>
                <td>{{ $candidate->created_at->format('M d, Y') }}</td>
                <td>
                    <span class="status-badge active">Active</span>
                </td>
                <td>
                    <a href="#" class="action-btn" title="View Details">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                    No candidates found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($candidates->hasPages())
    <div class="pagination-container">
        {{ $candidates->links() }}
    </div>
    @endif
</div>
@endsection
