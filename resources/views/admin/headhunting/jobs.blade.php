@extends('admin.headhunting.layout')

@section('page-title', 'Job Posts')

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

    .export-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: #22c55e;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.2s;
        border: 1px solid transparent;
        height: 42px;
        box-sizing: border-box;
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

    .jobs-table {
        width: 100%;
        border-collapse: collapse;
    }

    .jobs-table th,
    .jobs-table td {
        padding: 1rem 1.25rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .jobs-table th {
        background-color: var(--surface-hover);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
    }

    .jobs-table tr:last-child td {
        border-bottom: none;
    }

    .jobs-table tr:hover td {
        background-color: rgba(99, 102, 241, 0.05);
    }

    .company-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .company-avatar {
        width: 44px;
        height: 44px;
        border-radius: 8px;
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

    .company-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .company-details h4 {
        font-weight: 600;
        color: var(--text-main);
        font-size: 1rem;
        margin-bottom: 0.15rem;
    }

    .company-details h4 a {
        color: var(--text-main);
        text-decoration: none;
        transition: color 0.2s;
    }

    .company-details h4 a:hover {
        color: var(--primary);
    }

    .company-details p {
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

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-badge.active {
        background-color: rgba(34, 197, 94, 0.15);
        color: #22c55e;
    }

    .status-badge.closed {
        background-color: rgba(239, 68, 68, 0.15);
        color: #ef4444;
    }

    .status-badge.draft {
        background-color: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }

    .status-badge.deactive {
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
        .jobs-table {
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
    <h2>All Job Posts</h2>
</div>

<form action="{{ route('admin.headhunting.jobs') }}" method="GET" class="filters-row" id="filterForm" style="margin-bottom: 1.5rem;">
    <div class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" name="search" id="searchInput" placeholder="Search by company name, email, or phone..." value="{{ request('search') }}">
    </div>
    
    <select name="status" class="filter-select" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Status</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
    </select>

    <select name="field_type" class="filter-select" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Fields</option>
        <option value="Accounting" {{ request('field_type') == 'Accounting' ? 'selected' : '' }}>Accounting</option>
        <option value="Administration" {{ request('field_type') == 'Administration' ? 'selected' : '' }}>Administration</option>
        <option value="Agriculture" {{ request('field_type') == 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
        <option value="Architecture" {{ request('field_type') == 'Architecture' ? 'selected' : '' }}>Architecture</option>
        <option value="Armed Forces" {{ request('field_type') == 'Armed Forces' ? 'selected' : '' }}>Armed Forces</option>
        <option value="Aviation" {{ request('field_type') == 'Aviation' ? 'selected' : '' }}>Aviation</option>
        <option value="Banking" {{ request('field_type') == 'Banking' ? 'selected' : '' }}>Banking</option>
        <option value="Business" {{ request('field_type') == 'Business' ? 'selected' : '' }}>Business</option>
        <option value="Call Center / Customer Service" {{ request('field_type') == 'Call Center / Customer Service' ? 'selected' : '' }}>Call Center / Customer Service</option>
        <option value="Civil Engineering" {{ request('field_type') == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
        <option value="Construction" {{ request('field_type') == 'Construction' ? 'selected' : '' }}>Construction</option>
        <option value="Consulting" {{ request('field_type') == 'Consulting' ? 'selected' : '' }}>Consulting</option>
        <option value="Data Entry" {{ request('field_type') == 'Data Entry' ? 'selected' : '' }}>Data Entry</option>
        <option value="Defense" {{ request('field_type') == 'Defense' ? 'selected' : '' }}>Defense</option>
        <option value="Driving / Transport" {{ request('field_type') == 'Driving / Transport' ? 'selected' : '' }}>Driving / Transport</option>
        <option value="Education" {{ request('field_type') == 'Education' ? 'selected' : '' }}>Education</option>
        <option value="Electrical Engineering" {{ request('field_type') == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
        <option value="Engineering (General)" {{ request('field_type') == 'Engineering (General)' ? 'selected' : '' }}>Engineering (General)</option>
        <option value="Freelancing" {{ request('field_type') == 'Freelancing' ? 'selected' : '' }}>Freelancing</option>
        <option value="Garments / Textile" {{ request('field_type') == 'Garments / Textile' ? 'selected' : '' }}>Garments / Textile</option>
        <option value="Government Service" {{ request('field_type') == 'Government Service' ? 'selected' : '' }}>Government Service</option>
        <option value="Graphic Design" {{ request('field_type') == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
        <option value="Healthcare" {{ request('field_type') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
        <option value="Hospitality / Tourism" {{ request('field_type') == 'Hospitality / Tourism' ? 'selected' : '' }}>Hospitality / Tourism</option>
        <option value="Human Resources" {{ request('field_type') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
        <option value="Import / Export" {{ request('field_type') == 'Import / Export' ? 'selected' : '' }}>Import / Export</option>
        <option value="Information Technology (IT)" {{ request('field_type') == 'Information Technology (IT)' ? 'selected' : '' }}>Information Technology (IT)</option>
        <option value="Journalism / Media" {{ request('field_type') == 'Journalism / Media' ? 'selected' : '' }}>Journalism / Media</option>
        <option value="Law / Legal" {{ request('field_type') == 'Law / Legal' ? 'selected' : '' }}>Law / Legal</option>
        <option value="Manufacturing" {{ request('field_type') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing</option>
        <option value="Marketing / Sales" {{ request('field_type') == 'Marketing / Sales' ? 'selected' : '' }}>Marketing / Sales</option>
        <option value="Mechanical Engineering" {{ request('field_type') == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
        <option value="NGO / Development" {{ request('field_type') == 'NGO / Development' ? 'selected' : '' }}>NGO / Development</option>
        <option value="Nursing" {{ request('field_type') == 'Nursing' ? 'selected' : '' }}>Nursing</option>
        <option value="Pharmacy" {{ request('field_type') == 'Pharmacy' ? 'selected' : '' }}>Pharmacy</option>
        <option value="Police" {{ request('field_type') == 'Police' ? 'selected' : '' }}>Police</option>
        <option value="Private Service" {{ request('field_type') == 'Private Service' ? 'selected' : '' }}>Private Service</option>
        <option value="Public Service" {{ request('field_type') == 'Public Service' ? 'selected' : '' }}>Public Service</option>
        <option value="Real Estate" {{ request('field_type') == 'Real Estate' ? 'selected' : '' }}>Real Estate</option>
        <option value="Research" {{ request('field_type') == 'Research' ? 'selected' : '' }}>Research</option>
        <option value="Retail / Shopkeeping" {{ request('field_type') == 'Retail / Shopkeeping' ? 'selected' : '' }}>Retail / Shopkeeping</option>
        <option value="Security Service" {{ request('field_type') == 'Security Service' ? 'selected' : '' }}>Security Service</option>
        <option value="Self-Employed" {{ request('field_type') == 'Self-Employed' ? 'selected' : '' }}>Self-Employed</option>
        <option value="Shipping / Logistics" {{ request('field_type') == 'Shipping / Logistics' ? 'selected' : '' }}>Shipping / Logistics</option>
        <option value="Software Development" {{ request('field_type') == 'Software Development' ? 'selected' : '' }}>Software Development</option>
        <option value="Teaching" {{ request('field_type') == 'Teaching' ? 'selected' : '' }}>Teaching</option>
        <option value="Telecommunications" {{ request('field_type') == 'Telecommunications' ? 'selected' : '' }}>Telecommunications</option>
        <option value="Trading" {{ request('field_type') == 'Trading' ? 'selected' : '' }}>Trading</option>
        <option value="Transport / Logistics" {{ request('field_type') == 'Transport / Logistics' ? 'selected' : '' }}>Transport / Logistics</option>
    </select>

    <select name="job_type" class="filter-select" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Job Types</option>
        <option value="Full Time" {{ request('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
        <option value="Part Time" {{ request('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
        <option value="Remote" {{ request('job_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
        <option value="Freelance" {{ request('job_type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
        <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
    </select>

    <select name="division" class="filter-select" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Districts</option>
        <option value="Barishal" {{ request('division') == 'Barishal' ? 'selected' : '' }}>Barishal</option>
        <option value="Chattogram" {{ request('division') == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
        <option value="Dhaka" {{ request('division') == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
        <option value="Khulna" {{ request('division') == 'Khulna' ? 'selected' : '' }}>Khulna</option>
        <option value="Rajshahi" {{ request('division') == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
        <option value="Rangpur" {{ request('division') == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
        <option value="Mymensingh" {{ request('division') == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
        <option value="Sylhet" {{ request('division') == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
    </select>

    <select name="year" class="filter-select" id="yearFilter" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Years</option>
        @foreach($years as $year)
            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
        @endforeach
    </select>

    <a href="{{ route('admin.headhunting.jobs.export', ['search' => request('search'), 'status' => request('status'), 'field_type' => request('field_type'), 'job_type' => request('job_type'), 'division' => request('division'), 'year' => request('year')]) }}" class="export-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
        </svg>
        Export to Excel
    </a>
</form>

@if(session('status') === 'job-deleted')
    <div class="alert alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        Job post has been successfully deleted.
    </div>
@endif

<div class="table-container">
    @if($jobs->count() > 0)
        <table class="jobs-table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Post Date</th>
                    <th>Title</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>
                            <div class="company-info">
                                <a href="{{ route('admin.headhunting.employers.show', $job->employer->id) }}" class="company-avatar">
                                    @if($job->employer->profile_picture)
                                        <img src="{{ asset('storage/' . $job->employer->profile_picture) }}" alt="{{ $job->employer->company_name }}">
                                    @else
                                        {{ strtoupper(substr($job->employer->company_name ?? 'C', 0, 1)) }}
                                    @endif
                                </a>
                                <div class="company-details">
                                    <h4><a href="{{ route('admin.headhunting.employers.show', $job->employer->id) }}">{{ $job->employer->company_name ?? 'N/A' }}</a></h4>
                                    <p>{{ $job->employer->user->email ?? 'No email' }}</p>
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
                                {{ $job->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td>
                            <strong>{{ $job->title ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            @if($job->deadline)
                                <div class="date-badge">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    {{ $job->deadline->format('M d, Y') }}
                                </div>
                            @else
                                <span style="color: var(--text-muted);">No deadline</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge {{ $job->status }}">
                                {{ ucfirst($job->status ?? 'active') }}
                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ url('/headhunting/job/' . $job->id) }}" class="action-btn">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    View
                                </a>
                                <button type="button" class="action-btn delete-btn" onclick="openDeleteModal({{ $job->id }}, '{{ addslashes($job->title ?? 'this job') }}')">
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

        @if($jobs->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination">
                    @if($jobs->onFirstPage())
                        <span class="disabled">&laquo; Prev</span>
                    @else
                        <a href="{{ $jobs->previousPageUrl() }}">&laquo; Prev</a>
                    @endif

                    @foreach($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                        @if($page == $jobs->currentPage())
                            <span class="current">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($jobs->hasMorePages())
                        <a href="{{ $jobs->nextPageUrl() }}">Next &raquo;</a>
                    @else
                        <span class="disabled">Next &raquo;</span>
                    @endif
                </div>
            </div>
        @endif
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
            </svg>
            <h3>No Job Posts Found</h3>
            <p>There are no job posts in the system yet, or your search didn't match any results.</p>
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
        <h3 class="modal-title">Delete Job Post</h3>
        <p class="modal-text">Are you sure you want to delete <strong id="deleteJobTitle"></strong>? This action cannot be undone.</p>
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
    var deleteBaseUrl = "{{ url('adminview/headhunting/jobs') }}";
    
    function openDeleteModal(id, title) {
        document.getElementById('deleteModal').classList.add('active');
        document.getElementById('deleteJobTitle').textContent = title;
        document.getElementById('deleteForm').action = deleteBaseUrl + '/' + id;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
    }

    // Close modal on overlay click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // Auto search with debounce
    let typingTimer;
    const doneTypingInterval = 800;
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    function doneTyping() {
        document.getElementById('filterForm').submit();
    }
    
    // Focus search input if search param exists
    @if(request('search'))
        const input = document.getElementById('searchInput');
        input.focus();
        const val = input.value;
        input.value = '';
        input.value = val;
    @endif
</script>
@endsection
