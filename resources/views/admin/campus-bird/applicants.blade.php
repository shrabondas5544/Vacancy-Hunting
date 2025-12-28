@extends('admin.campus-bird.layout')

@section('page-title', 'Applicants')

@section('page-styles')
<style>
    /* Search Filter Styles */
    .search-filter-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        align-items: center;
    }

    .search-input {
        flex: 1;
        max-width: 400px;
        padding: 0.7rem 1rem 0.7rem 2.5rem;
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        color: var(--text-main);
        font-size: 0.9rem;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23888' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: 0.75rem center;
        background-size: 18px;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        background-color: rgba(255, 255, 255, 0.08);
    }

    .status-select {
        padding: 0.7rem 1rem;
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        color: var(--text-main);
        font-size: 0.9rem;
        min-width: 150px;
    }

    .status-select:focus {
        outline: none;
        border-color: var(--primary);
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
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .user-info-text h4 {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-main);
    }

    .user-info-text p {
        margin: 0.25rem 0 0;
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.85rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-badge.pending {
        background-color: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }

    .status-badge.shortlisted {
        background-color: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .status-badge.rejected {
        background-color: rgba(239, 68, 68, 0.15);
        color: #ef4444;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        padding: 0.4rem;
        border-radius: 6px;
        border: 1px solid var(--border);
        background: transparent;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .action-btn:hover {
        background-color: var(--surface-hover);
        color: var(--primary);
        border-color: var(--primary);
    }

    .action-btn.danger:hover {
        color: #ef4444;
        border-color: #ef4444;
    }

    .pagination-container {
        padding: 1.5rem;
        border-top: 1px solid var(--border);
    }
</style>
@endsection

@section('page-content')
<!-- Search and Filter -->
<div class="search-filter-row">
    <form action="{{ route('admin.campus-bird.applicants') }}" method="GET" id="filterForm" style="display: flex; gap: 1rem; flex: 1;">
        <input 
            type="text" 
            name="search" 
            class="search-input" 
            placeholder="Search by name or email..."
            value="{{ request('search') }}"
            id="searchInput"
        >
        <select name="status" class="status-select" id="statusFilter">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </form>
</div>

<script>
    // Live search functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const filterForm = document.getElementById('filterForm');
    
    let searchTimeout;
    
    // Auto-submit on typing (with 500ms delay)
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            filterForm.submit();
        }, 500);
    });
    
    // Auto-submit on status change (immediate)
    statusFilter.addEventListener('change', function() {
        filterForm.submit();
    });
</script>

@if(session('success'))
    <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(16, 185, 129, 0.3);">
        {{ session('success') }}
    </div>
@endif

<!-- Applicants Table -->
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Applicant</th>
                <th>Form/Department</th>
                <th>Submission Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applicants as $applicant)
            <tr>
                <td>
                    <div class="user-info-text">
                        <h4>{{ $applicant->applicant_name ?? 'Not Provided' }}</h4>
                        <p>{{ $applicant->applicant_email ?? 'N/A' }}</p>
                        @if($applicant->applicant_phone)
                            <p>📞 {{ $applicant->applicant_phone }}</p>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="user-info-text">
                        <h4>{{ $applicant->form->title ?? 'N/A' }}</h4>
                        <p>{{ $applicant->form->department ?? 'Department not specified' }}</p>
                    </div>
                </td>
                <td>{{ $applicant->created_at->format('M d, Y H:i') }}</td>
                <td>
                    <span class="status-badge {{ $applicant->status }}">
                        {{ ucfirst($applicant->status) }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.campus-bird.applicants.show', $applicant->id) }}" class="action-btn" title="View Details">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                        <form action="{{ route('admin.campus-bird.applicants.destroy', $applicant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this applicant?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn danger" title="Delete">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                    No applicants found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($applicants->hasPages())
    <div class="pagination-container">
        {{ $applicants->links() }}
    </div>
    @endif
</div>
@endsection
