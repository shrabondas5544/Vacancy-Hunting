@extends('admin.layout')

@section('styles')
    .admin-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-top: 2rem;
        flex-wrap: wrap; /* Allow wrapping on small screens but keep structure */
        gap: 1rem;
    }

    .page-title h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .page-title p {
        color: var(--text-muted);
        font-size: 1rem;
    }

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
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--text-main);
    }

    .stat-content p {
        color: var(--text-muted);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .table-container {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .custom-table th {
        background-color: rgba(0, 0, 0, 0.2);
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .custom-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border);
        color: var(--text-main);
        vertical-align: middle;
    }

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    .custom-table tr:hover {
        background-color: var(--surface-hover);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        background-color: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-email {
        font-weight: 500;
        color: var(--text-main);
    }

    .super-admin-badge {
        font-size: 0.7rem;
        color: #fca5a5;
        background: rgba(239, 68, 68, 0.1);
        padding: 0.1rem 0.4rem;
        border-radius: 4px;
        display: inline-block;
        margin-top: 0.25rem;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-success {
        background-color: rgba(34, 197, 94, 0.1);
        color: #4ade80;
    }

    .badge-secondary {
        background-color: rgba(148, 163, 184, 0.1);
        color: #94a3b8;
    }

    .permission-badge {
        background-color: rgba(99, 102, 241, 0.1);
        color: #818cf8;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        font-size: 0.75rem;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
        display: inline-block;
    }

    .timestamp {
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .action-group {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: 1px solid transparent;
    }

    .btn-toggle {
        background-color: rgba(34, 197, 94, 0.1);
        color: #4ade80;
    }

    .btn-toggle.inactive {
        background-color: rgba(234, 179, 8, 0.1);
        color: #facc15;
    }

    .btn-delete {
        background-color: rgba(239, 68, 68, 0.1);
        color: #f87171;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .alert {
        padding: 1rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
    }
    .alert-success { background: rgba(34, 197, 94, 0.1); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.2); }
    .alert-error { background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }
    .empty-icon {
        margin-bottom: 1rem;
        opacity: 0.2;
    }

    /* Back button */
    .btn-back {
        background-color: var(--surface);
        border: 1px solid var(--border);
        color: var(--text-main);
        /* Ensure it looks good */
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius);
        font-weight: 500;
        transition: all 0.2s;
        height: 48px; /* Fixed height to match primary button if needed */
    }
    .btn-back:hover {
        background-color: var(--surface-hover);
        border-color: var(--text-muted);
    }
    
    .btn-primary {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius);
        font-weight: 500;
        transition: all 0.2s;
        height: 48px;
    }
    
    .header-actions {
        display: flex;
        gap: 1rem;
    }
@endsection

@section('content')
<div class="container">
    <!-- Header -->
    <div class="admin-page-header">
        <div class="page-title">
            <h1>Manage Admin Users</h1>
            <p>View and manage all admin user accounts and permissions</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-back">Back to Dashboard</a>
            <a href="{{ route('admin.manage-admins.create') }}" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Create New Admin
            </a>
        </div>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(99, 102, 241, 0.1); color: #818cf8;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="stat-content">
                <h3>{{ $adminUsers->count() }}</h3>
                <p>Total Admins</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(34, 197, 94, 0.1); color: #4ade80;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <div class="stat-content">
                <h3>{{ $adminUsers->where('is_active', true)->count() }}</h3>
                <p>Active Admins</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(234, 179, 8, 0.1); color: #facc15;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <div class="stat-content">
                <h3>{{ $adminUsers->where('is_active', false)->count() }}</h3>
                <p>Inactive Admins</p>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Permissions</th>
                    <th>Last Login</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($adminUsers as $admin)
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="avatar-circle">
                                {{ substr($admin->email ?? 'U', 0, 1) }}
                            </div>
                            <div class="user-details">
                                <span class="user-email">{{ $admin->email }}</span>
                                @if($admin->is_super_admin)
                                <span class="super-admin-badge">Super Admin</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($admin->is_super_admin)
                            <span class="permission-badge" style="background: rgba(244, 63, 94, 0.1); color: #fb7185;">All Permissions</span>
                        @else
                            @php
                                $permissions = $admin->permissions ?? [];
                                $activePermissions = array_filter($permissions, fn($val) => $val === true);
                            @endphp
                            
                            @if(count($activePermissions) > 0)
                                <div style="display: flex; flex-wrap: wrap; gap: 4px; max-width: 300px;">
                                    @foreach(array_keys($activePermissions) as $perm)
                                        <span class="permission-badge">
                                            {{ ucwords(str_replace('_', ' ', $perm)) }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span style="color: var(--text-muted); font-size: 0.85rem;">No permissions</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        <div class="timestamp">
                            @if($admin->last_login_at)
                                <div>{{ $admin->last_login_at->format('M d, Y') }}</div>
                                <div style="font-size: 0.75rem; color: #64748b;">{{ $admin->last_login_at->format('h:i A') }}</div>
                            @else
                                <span style="color: var(--text-muted); font-size: 0.85rem;">Never</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if($admin->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            @if(!$admin->is_super_admin)
                                <a href="{{ route('admin.manage-admins.edit', $admin->id) }}" class="action-btn" style="background-color: rgba(99, 102, 241, 0.1); color: #818cf8;" title="Edit">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>

                                <form action="{{ route('admin.manage-admins.toggle-status', $admin->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="action-btn btn-toggle {{ $admin->is_active ? '' : 'inactive' }}" title="{{ $admin->is_active ? 'Deactivate' : 'Activate' }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                                    </button>
                                </form>

                                <form action="{{ route('admin.manage-admins.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            @else
                                <span style="font-size: 0.8rem; color: var(--text-muted); padding: 0.5rem;">Protected</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <h3>No Admin Users Found</h3>
                            <p style="color: var(--text-muted); margin-bottom: 2rem;">Get started by creating your first admin user.</p>
                            <a href="{{ route('admin.manage-admins.create') }}" class="btn btn-primary">Create User</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
