@extends('admin.headhunting.layout')

@section('page-title', 'Candidates')

@section('page-styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-header h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-main);
    }

    .filters-row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        width: 100%;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0.5rem 1rem;
        flex: 1;
        max-width: 320px;
    }

    .search-box svg {
        width: 20px;
        height: 20px;
        color: var(--text-muted);
        flex-shrink: 0;
    }

    .search-box input {
        flex: 1;
        background: none;
        border: none;
        color: var(--text-main);
        font-size: 0.95rem;
        outline: none;
    }

    .search-box input::placeholder {
        color: var(--text-muted);
    }

    .filter-select {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0.5rem 1rem;
        color: var(--text-main);
        font-size: 0.95rem;
        outline: none;
        cursor: pointer;
    }

    .filter-select option {
        background-color: var(--surface);
        color: var(--text-main);
    }

    .search-btn {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .search-btn:hover {
        background-color: var(--primary-dark);
    }

    .export-btn {
        background-color: #22c55e;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .export-btn:hover {
        background-color: #16a34a;
    }

    .export-btn svg {
        width: 18px;
        height: 18px;
    }

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background-color: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #22c55e;
    }

    .alert svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .table-container {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
    }

    .candidates-table {
        width: 100%;
        border-collapse: collapse;
    }

    .candidates-table th,
    .candidates-table td {
        padding: 1rem 1.25rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .candidates-table th {
        background-color: var(--surface-hover);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
    }

    .candidates-table tr:last-child td {
        border-bottom: none;
    }

    .candidates-table tr:hover td {
        background-color: rgba(99, 102, 241, 0.05);
    }

    .candidate-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .candidate-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
        flex-shrink: 0;
        overflow: hidden;
    }

    .candidate-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .candidate-details h4 {
        font-weight: 600;
        color: var(--text-main);
        font-size: 1rem;
        margin-bottom: 0.15rem;
    }

    .candidate-details p {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .date-badge svg {
        width: 16px;
        height: 16px;
        color: var(--primary);
    }

    .actions-cell {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        background-color: var(--surface-hover);
        color: var(--text-main);
        border: 1px solid var(--border);
        padding: 0.5rem 0.85rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
    }

    .action-btn:hover {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .action-btn.delete-btn:hover {
        background-color: #ef4444;
        border-color: #ef4444;
        color: white;
    }

    .action-btn svg {
        width: 16px;
        height: 16px;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-muted);
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.95rem;
    }

    /* Pagination Styles */
    .pagination-wrapper {
        padding: 1rem;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 0.35rem;
    }

    .pagination a,
    .pagination span {
        padding: 0.5rem 0.85rem;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .pagination a {
        background-color: var(--surface-hover);
        color: var(--text-main);
    }

    .pagination a:hover {
        background-color: var(--primary);
        color: white;
    }

    .pagination span.current {
        background-color: var(--primary);
        color: white;
    }

    .pagination span.disabled {
        background-color: var(--surface-hover);
        color: var(--text-muted);
        opacity: 0.5;
    }

    /* Delete Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        max-width: 400px;
        width: 90%;
        text-align: center;
    }

    .modal-icon {
        width: 64px;
        height: 64px;
        background-color: rgba(239, 68, 68, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: #ef4444;
    }

    .modal-icon svg {
        width: 32px;
        height: 32px;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .modal-text {
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }

    .modal-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .modal-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .modal-btn-cancel {
        background-color: var(--surface-hover);
        color: var(--text-main);
    }

    .modal-btn-cancel:hover {
        background-color: var(--border);
    }

    .modal-btn-delete {
        background-color: #ef4444;
        color: white;
    }

    .modal-btn-delete:hover {
        background-color: #dc2626;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .candidates-table {
            display: block;
            overflow-x: auto;
        }
    }

    @media (max-width: 640px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: 100%;
        }

        .actions-cell {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('page-content')
<div class="page-header">
    <h2>All Candidates</h2>
</div>

<form action="{{ route('admin.headhunting.candidates') }}" method="GET" class="filters-row" id="filterForm" style="margin-bottom: 1.5rem;">
    <div class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" name="search" id="searchInput" placeholder="Search by name or email..." value="{{ request('search') }}">
    </div>
    
    <select name="month" class="filter-select" id="monthFilter" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Months</option>
        <option value="1" {{ request('month') == '1' ? 'selected' : '' }}>January</option>
        <option value="2" {{ request('month') == '2' ? 'selected' : '' }}>February</option>
        <option value="3" {{ request('month') == '3' ? 'selected' : '' }}>March</option>
        <option value="4" {{ request('month') == '4' ? 'selected' : '' }}>April</option>
        <option value="5" {{ request('month') == '5' ? 'selected' : '' }}>May</option>
        <option value="6" {{ request('month') == '6' ? 'selected' : '' }}>June</option>
        <option value="7" {{ request('month') == '7' ? 'selected' : '' }}>July</option>
        <option value="8" {{ request('month') == '8' ? 'selected' : '' }}>August</option>
        <option value="9" {{ request('month') == '9' ? 'selected' : '' }}>September</option>
        <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>October</option>
        <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>November</option>
        <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>December</option>
    </select>

    <select name="year" class="filter-select" id="yearFilter" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Years</option>
        @foreach($years as $year)
            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
            
        @endforeach
    </select>

    <a href="{{ route('admin.headhunting.candidates.export', ['month' => request('month'), 'year' => request('year'), 'search' => request('search')]) }}" class="export-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
        </svg>
        Export to Excel
    </a>
</form>

@if(session('status') === 'candidate-deleted')
    <div class="alert alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        Candidate account has been successfully deleted.
    </div>
@endif

<div class="table-container">
    @if($candidates->count() > 0)
        <table class="candidates-table">
            <thead>
                <tr>
                    <th>Candidate</th>
                    <th>Joining Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $candidate)
                    <tr>
                        <td>
                            <div class="candidate-info">
                                <div class="candidate-avatar">
                                    @if($candidate->profile_picture)
                                        <img src="{{ asset('storage/' . $candidate->profile_picture) }}" alt="{{ $candidate->name }}">
                                    @else
                                        {{ strtoupper(substr($candidate->name ?? 'C', 0, 1)) }}
                                    @endif
                                </div>
                                <div class="candidate-details">
                                    <h4>{{ $candidate->name ?? 'N/A' }}</h4>
                                    <p>{{ $candidate->user->email ?? 'No email' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="date-badge">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ $candidate->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('admin.headhunting.candidates.show', $candidate->id) }}" class="action-btn">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    View
                                </a>
                                <button type="button" class="action-btn delete-btn" onclick="openDeleteModal({{ $candidate->id }}, '{{ addslashes($candidate->name ?? 'this candidate') }}')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($candidates->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination">
                    @if($candidates->onFirstPage())
                        <span class="disabled">&laquo; Prev</span>
                    @else
                        <a href="{{ $candidates->previousPageUrl() }}">&laquo; Prev</a>
                    @endif

                    @foreach($candidates->getUrlRange(1, $candidates->lastPage()) as $page => $url)
                        @if($page == $candidates->currentPage())
                            <span class="current">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($candidates->hasMorePages())
                        <a href="{{ $candidates->nextPageUrl() }}">Next &raquo;</a>
                    @else
                        <span class="disabled">Next &raquo;</span>
                    @endif
                </div>
            </div>
        @endif
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <h3>No Candidates Found</h3>
            <p>There are no candidates in the system yet, or your search didn't match any results.</p>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-content">
        <div class="modal-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
        </div>
        <h3 class="modal-title">Delete Candidate</h3>
        <p class="modal-text">Are you sure you want to delete <strong id="candidateName"></strong>? This action cannot be undone and will remove all their data.</p>
        <div class="modal-actions">
            <button type="button" class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <form id="deleteForm" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-btn modal-btn-delete">Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    var deleteBaseUrl = "{{ url('adminview/headhunting/candidates') }}";
    
    function openDeleteModal(id, name) {
        document.getElementById('deleteModal').classList.add('active');
        document.getElementById('candidateName').textContent = name;
        document.getElementById('deleteForm').action = deleteBaseUrl + '/' + id;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
    }

    // Close modal on overlay click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Auto search with debounce
    let typingTimer;
    const doneTypingInterval = 800; // time in ms (0.8 seconds)
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function() {
        clearTimeout(typingTimer);
        if (searchInput.value) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        } else {
            // Check if there was a previous value to avoid reloading on empty -> empty
            // But if user cleared the input, we probably want to reset filter
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });

    function doneTyping() {
        document.getElementById('filterForm').submit();
    }
    
    // Focus search input if search param exists
    @if(request('search'))
        const input = document.getElementById('searchInput');
        input.focus();
        // Move cursor to end
        const val = input.value;
        input.value = '';
        input.value = val;
    @endif
</script>
@endsection
