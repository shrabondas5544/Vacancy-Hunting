@extends('admin.campus-bird.layout')

@section('page-title', 'Application Forms')

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

    .create-btn {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .create-btn:hover {
        background-color: var(--primary-dark);
    }

    .create-btn svg {
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

    .forms-table {
        width: 100%;
        border-collapse: collapse;
    }

    .forms-table th,
    .forms-table td {
        padding: 1rem 1.25rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .forms-table th {
        background-color: var(--surface-hover);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
    }

    .forms-table tr:last-child td {
        border-bottom: none;
    }

    .forms-table tr:hover td {
        background-color: rgba(99, 102, 241, 0.05);
    }

    .form-title {
        font-weight: 600;
        color: var(--text-main);
        font-size: 1rem;
    }

    .department-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        background-color: rgba(99, 102, 241, 0.1);
        color: var(--primary);
    }

    .field-count {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 48px;
        height: 26px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--border);
        transition: .3s;
        border-radius: 26px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .3s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #22c55e;
    }

    input:checked + .slider:before {
        transform: translateX(22px);
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
        margin-bottom: 1.5rem;
    }

    @media (max-width: 640px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .actions-cell {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('page-content')
<div class="page-header">
    <h2>Application Forms</h2>
    <a href="{{ route('admin.campus-bird.forms.create') }}" class="create-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Create New Form
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="table-container">
    @if($forms->count() > 0)
        <table class="forms-table">
            <thead>
                <tr>
                    <th>Form Title</th>
                    <th>Department</th>
                    <th>Fields</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $form)
                <tr>
                    <td>
                        <span class="form-title">{{ $form->title }}</span>
                    </td>
                    <td>
                        <span class="department-badge">{{ $form->department }}</span>
                    </td>
                    <td>
                        <span class="field-count">{{ $form->fields_count }} Fields</span>
                    </td>
                    <td>
                        <form action="{{ route('admin.campus-bird.forms.toggle', $form) }}" method="POST" id="toggle-form-{{ $form->id }}" style="display: inline-block;">
                            @csrf
                            <label class="toggle-switch">
                                <input type="checkbox" onchange="document.getElementById('toggle-form-{{ $form->id }}').submit()" {{ $form->is_active ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </form>
                    </td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('admin.campus-bird.forms.show', $form) }}" class="action-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View
                            </a>
                            <a href="{{ route('admin.campus-bird.forms.edit', $form) }}" class="action-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.campus-bird.forms.destroy', $form) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this form?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <h3>No Forms Created Yet</h3>
            <p>Start by creating your first application form.</p>
            <a href="{{ route('admin.campus-bird.forms.create') }}" class="create-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Create Your First Form
            </a>
        </div>
    @endif
</div>
@endsection
