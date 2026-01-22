@extends('admin.campus-bird.layout')

@section('page-title', 'Alumni Management')

@section('page-styles')
<style>
    /* Search Filter Styles */
    .search-filter-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        align-items: center;
        flex-wrap: wrap;
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

    .create-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.25rem;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.25);
    }

    .create-btn:hover {
        background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
        transform: translateY(-1px);
    }

    .export-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.25rem;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
    }

    .export-btn:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
        transform: translateY(-1px);
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

    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-avatar-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--surface-hover);
        color: var(--text-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
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
        background-color: rgba(99, 102, 241, 0.15);
        color: var(--primary);
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
<!-- Search and Action -->
<div class="search-filter-row">
    <input 
        type="text" 
        name="search" 
        class="search-input" 
        placeholder="Search by name, program or email..."
        value="{{ request('search') }}"
        id="searchInput"
        form="filterForm"
    >
    
    <a href="{{ route('admin.campus-bird.alumnis.create') }}" class="create-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Create Alumni
    </a>

    <a href="{{ route('admin.campus-bird.alumnis.export', ['search' => request('search')]) }}" class="export-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
        </svg>
        Export to Excel
    </a>

    <form action="{{ route('admin.campus-bird.alumnis.index') }}" method="GET" id="filterForm" style="display: none;"></form>
</div>

<script>
    // Live search functionality
    const searchInput = document.getElementById('searchInput');
    const filterForm = document.getElementById('filterForm');
    
    let searchTimeout;
    
    // Auto-submit on typing (with 500ms delay)
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            filterForm.submit();
        }, 500);
    });
</script>

@if(session('success'))
    <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(16, 185, 129, 0.3);">
        {{ session('success') }}
    </div>
@endif

<!-- Alumni Table -->
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Profile</th>
                <th>Program Info</th>
                <th>Division</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnis as $alumni)
            <tr>
                <td>
                    <div class="user-info">
                        @if($alumni->photo)
                            <img src="{{ asset($alumni->photo) }}" alt="{{ $alumni->name }}" class="user-avatar">
                        @else
                            <div class="user-avatar-placeholder">
                                {{ substr($alumni->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="user-info-text">
                            <h4>{{ $alumni->name }}</h4>
                            <p style="font-size: 0.8rem; color: var(--text-muted);">{{ $alumni->email }}</p>
                            <p style="font-size: 0.8rem; color: var(--text-muted);">{{ $alumni->phone }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="user-info-text">
                        <h4>{{ $alumni->program }}</h4>
                        <p>{{ $alumni->category }}</p>
                    </div>
                </td>
                <td>
                    {{ $alumni->division }}
                </td>
                <td>
                    <span class="status-badge">
                        {{ $alumni->year }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.campus-bird.alumnis.show', $alumni->id) }}" class="action-btn" title="View Details">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                        <a href="{{ route('admin.campus-bird.alumnis.edit', $alumni->id) }}" class="action-btn" title="Edit">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('admin.campus-bird.alumnis.destroy', $alumni->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this alumni?');" style="display: inline;">
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
                    No alumnis found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($alumnis->hasPages())
    <div class="pagination-container">
        {{ $alumnis->links() }}
    </div>
    @endif
</div>
@endsection
