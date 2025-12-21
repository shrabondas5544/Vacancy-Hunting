@extends('admin.headhunting.layout')

@section('page-title', 'Blog Posts')

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

    .blogs-table {
        width: 100%;
        border-collapse: collapse;
    }

    .blogs-table th,
    .blogs-table td {
        padding: 1rem 1.25rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .blogs-table th {
        background-color: var(--surface-hover);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
    }

    .blogs-table tr:last-child td {
        border-bottom: none;
    }

    .blogs-table tr:hover td {
        background-color: rgba(99, 102, 241, 0.05);
    }

    .blog-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .blog-image {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.25rem;
        flex-shrink: 0;
        overflow: hidden;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-details h4 {
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.95rem;
        margin-bottom: 0.15rem;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .blog-details p {
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

    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background-color: rgba(99, 102, 241, 0.15);
        color: var(--primary);
    }

    .category-badge.it_software {
        background-color: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    .category-badge.marketing_sales {
        background-color: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }

    .category-badge.finance_banking {
        background-color: rgba(34, 197, 94, 0.15);
        color: #22c55e;
    }

    .category-badge.education {
        background-color: rgba(168, 85, 247, 0.15);
        color: #a855f7;
    }

    .category-badge.other {
        background-color: rgba(107, 114, 128, 0.15);
        color: #6b7280;
    }

    .actions-cell {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .action-btn {
        background-color: var(--surface-hover);
        color: var(--text-main);
        border: 1px solid var(--border);
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
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
        width: 14px;
        height: 14px;
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
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .modal-icon.delete {
        background-color: rgba(239, 68, 68, 0.1);
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
        .blogs-table {
            display: block;
            overflow-x: auto;
        }
    }

    @media (max-width: 640px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .filters-row {
            flex-direction: column;
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
    <h2>All Blog Posts</h2>
</div>

<form action="{{ route('admin.headhunting.blogs') }}" method="GET" class="filters-row" style="margin-bottom: 1.5rem;">
    <div class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" name="search" placeholder="Search by title or author email..." value="{{ request('search') }}">
    </div>
    <select name="category" class="filter-select">
        <option value="">All Categories</option>
        <option value="it_software" {{ request('category') == 'it_software' ? 'selected' : '' }}>IT/Software</option>
        <option value="marketing_sales" {{ request('category') == 'marketing_sales' ? 'selected' : '' }}>Marketing/Sales</option>
        <option value="finance_banking" {{ request('category') == 'finance_banking' ? 'selected' : '' }}>Finance/Banking</option>
        <option value="education" {{ request('category') == 'education' ? 'selected' : '' }}>Education</option>
        <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>Other</option>
    </select>
    <button type="submit" class="search-btn">Filter</button>
</form>

@if(session('status') === 'blog-deleted')
    <div class="alert alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        Blog post has been successfully deleted.
    </div>
@endif

<div class="table-container">
    @if($articles->count() > 0)
        <table class="blogs-table">
            <thead>
                <tr>
                    <th>Blog Post</th>
                    <th>Upload Date</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            <div class="blog-info">
                                <div class="blog-image">
                                    @if($article->featured_image)
                                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}">
                                    @else
                                        📝
                                    @endif
                                </div>
                                <div class="blog-details">
                                    <h4>{{ $article->title }}</h4>
                                    <p>By {{ $article->author_name }} ({{ $article->user->email ?? 'No email' }})</p>
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
                                {{ $article->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td>
                            @php
                                $categoryLabels = [
                                    'it_software' => 'IT/Software',
                                    'marketing_sales' => 'Marketing/Sales',
                                    'finance_banking' => 'Finance/Banking',
                                    'education' => 'Education',
                                    'other' => 'Other',
                                ];
                            @endphp
                            <span class="category-badge {{ $article->category }}">
                                {{ $categoryLabels[$article->category] ?? ucfirst($article->category) }}
                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ url('/blog/' . $article->slug) }}" target="_blank" class="action-btn">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    View
                                </a>
                                <button type="button" class="action-btn delete-btn" onclick="openDeleteModal({{ $article->id }}, '{{ addslashes($article->title) }}')">
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

        @if($articles->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination">
                    @if($articles->onFirstPage())
                        <span class="disabled">&laquo; Prev</span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}">&laquo; Prev</a>
                    @endif

                    @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                        @if($page == $articles->currentPage())
                            <span class="current">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}">Next &raquo;</a>
                    @else
                        <span class="disabled">Next &raquo;</span>
                    @endif
                </div>
            </div>
        @endif
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
            <h3>No Blog Posts Found</h3>
            <p>There are no blog posts in the system yet, or your search didn't match any results.</p>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-content">
        <div class="modal-icon delete">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
        </div>
        <h3 class="modal-title">Delete Blog Post</h3>
        <p class="modal-text">Are you sure you want to delete "<strong id="deleteBlogTitle"></strong>"? This action cannot be undone.</p>
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
    var deleteBaseUrl = "{{ url('adminview/headhunting/blogs') }}";
    
    function openDeleteModal(id, title) {
        document.getElementById('deleteModal').classList.add('active');
        document.getElementById('deleteBlogTitle').textContent = title;
        document.getElementById('deleteForm').action = deleteBaseUrl + '/' + id;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
    }

    // Close modal on overlay click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
@endsection
