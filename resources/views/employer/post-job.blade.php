@extends('layouts.employer')

@section('content')
<div class="content-header">
    <h1>Job Directory</h1>
    <p>Manage and filter your job postings</p>
</div>

<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('employer.post-job') }}" method="GET" class="filter-form" id="filterForm">
            <div class="filter-group search-group">
                <div class="search-input-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="search-icon">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" name="search" class="form-control search-control" placeholder="Search by job title..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="filter-group">
                <select name="field_type" class="form-control" onchange="this.form.submit()">
                    <option value="">All Fields</option>
                    <option value="IT" {{ request('field_type') == 'IT' ? 'selected' : '' }}>IT & Software</option>
                    <option value="Marketing" {{ request('field_type') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="HR" {{ request('field_type') == 'HR' ? 'selected' : '' }}>Human Resources</option>
                    <option value="Finance" {{ request('field_type') == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="Design" {{ request('field_type') == 'Design' ? 'selected' : '' }}>Design</option>
                    <option value="Sales" {{ request('field_type') == 'Sales' ? 'selected' : '' }}>Sales</option>
                    <option value="Engineering" {{ request('field_type') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                </select>
            </div>
            
            <div class="filter-group">
                <select name="job_type" class="form-control" onchange="this.form.submit()">
                    <option value="">All Job Types</option>
                    <option value="Full Time" {{ request('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                    <option value="Part Time" {{ request('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                    <option value="Remote" {{ request('job_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                    <option value="Freelance" {{ request('job_type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>

            <div class="filter-group">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <a href="{{ route('employer.create-job') }}" class="btn-primary create-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Create New Job
            </a>
        </form>
    </div>
</div>

<!-- Job Listing Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Posted Jobs ({{ $jobs->count() }})</h3>
        @if(request()->hasAny(['search', 'field_type', 'job_type', 'status']))
            <a href="{{ route('employer.post-job') }}" class="btn-text" style="font-size: 0.85rem;">Clear Filters</a>
        @endif
    </div>
    <div class="card-body p-0">
        @if($jobs->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Field</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->created_at->format('M d, Y') }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->field_type }}</td>
                            <td>
                                <span class="badge badge-blue">{{ $job->job_type }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $job->status === 'active' ? 'badge-green' : 'badge-gray' }}">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('employer.show-job', $job->id) }}" class="btn-icon" title="View">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    <form action="{{ route('employer.destroy-job', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon text-danger" title="Delete">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-list">
                <p>No jobs found.</p>
                @if(request()->hasAny(['search', 'field_type', 'job_type', 'status']))
                    <p><a href="{{ route('employer.post-job') }}" style="color: #00d4ff;">Clear filters</a> to see all jobs.</p>
                @else
                    <a href="{{ route('employer.create-job') }}" class="btn-primary" style="margin-top: 1rem; display: inline-flex;">Create Your First Job</a>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
    /* Reusing styles from create-job.blade.php plus specific ones */
    .card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.02);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #fff;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-body.p-0 {
        padding: 0;
    }

    /* Filter Form */
    .filter-form {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .filter-group {
        flex: 1;
        min-width: 150px;
    }
    
    .search-group {
        flex: 2; /* Search bar takes more space */
        min-width: 250px;
    }
    
    .search-input-wrapper {
        position: relative;
    }
    
    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: rgba(255, 255, 255, 0.4);
    }
    
    .search-control {
        padding-left: 2.5rem !important;
    }
    
    .form-control {
        width: 100%;
        padding: 0.6rem 1rem;
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        color: white;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        height: 42px; /* Fixed height for alignment */
    }

    .form-control:focus {
        outline: none;
        border-color: #00d4ff;
        box-shadow: 0 0 0 2px rgba(0, 212, 255, 0.1);
    }

    /* Buttons */
    .btn-primary {
        background: #10b981; /* Green color as requested via 'like this' image usually implies green for create */
        color: white;
        border: none;
        padding: 0 1.5rem;
        height: 42px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        white-space: nowrap;
    }
    
    .create-btn {
        flex: 0 0 auto;
    }
    
    .btn-primary svg {
        width: 18px;
        height: 18px;
    }

    .btn-primary:hover {
        background: #059669;
        transform: translateY(-1px);
    }
    
    .btn-text {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 0.9rem;
        margin-left: 0.5rem;
    }
    
    .btn-text:hover {
        color: white;
        text-decoration: underline;
    }

    /* Table Styles */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        text-align: left;
        padding: 1rem 1.5rem;
        color: rgba(255, 255, 255, 0.6);
        font-weight: 500;
        font-size: 0.85rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table td {
        padding: 1rem 1.5rem;
        color: white;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        vertical-align: middle;
    }

    .table tr:last-child td {
        border-bottom: none;
    }

    .badge {
        padding: 0.25rem 0.6rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-blue {
        background: rgba(0, 212, 255, 0.15);
        color: #00d4ff;
    }

    .badge-green {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .badge-gray {
        background: rgba(148, 163, 184, 0.15);
        color: #94a3b8;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.6);
        cursor: pointer;
        padding: 4px;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-icon svg {
        width: 18px;
        height: 18px;
    }

    .btn-icon:hover {
        color: #00d4ff;
    }

    .btn-icon.text-danger:hover {
        color: #ef4444;
    }

    .empty-list {
        padding: 3rem;
        text-align: center;
        color: rgba(255, 255, 255, 0.5);
    }
    
    .mb-4 {
        margin-bottom: 1.5rem;
    }

    @media (max-width: 1024px) {
        .filter-form {
            flex-wrap: wrap;
        }
        
        .search-group {
            flex: 1 1 100%;
            min-width: 100%;
        }
        
        .filter-group {
            flex: 1 1 calc(33% - 1rem);
        }
        
        .create-btn {
            flex: 1 1 100%;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .filter-group {
            flex: 1 1 100%;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>
@endsection
