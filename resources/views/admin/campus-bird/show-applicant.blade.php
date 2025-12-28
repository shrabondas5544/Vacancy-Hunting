@extends('admin.campus-bird.layout')

@section('page-title', 'Applicant Details')

@section('page-styles')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 1.5rem;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: var(--primary);
    }

    .applicant-header {
        background-color: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: start;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .applicant-info h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .applicant-info p {
        color: var(--text-muted);
        margin: 0.25rem 0;
    }

    .status-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-badge.pending {
        background-color: rgba(249, 115, 22, 0.1);
        color: #f97316;
    }

    .status-badge.shortlisted {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .status-badge.rejected {
        background-color: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .status-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .status-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.85rem;
    }

    .status-btn.shortlist {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-btn.shortlist:hover {
        background-color: #10b981;
        color: white;
    }

    .status-btn.reject {
        background-color: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .status-btn.reject:hover {
        background-color: #ef4444;
        color: white;
    }

    .status-btn.pending {
        background-color: rgba(249, 115, 22, 0.1);
        color: #f97316;
        border: 1px solid rgba(249, 115, 22, 0.3);
    }

    .status-btn.pending:hover {
        background-color: #f97316;
        color: white;
    }

    .delete-btn {
        padding: 0.5rem 1rem;
        background-color: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.85rem;
    }

    .delete-btn:hover {
        background-color: #ef4444;
        color: white;
    }

    .form-data-card {
        background-color: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 2rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .form-field {
        margin-bottom: 1.5rem;
    }

    .field-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .field-value {
        font-size: 1rem;
        color: var(--text-main);
        padding: 0.75rem;
        background-color: var(--background);
        border-radius: 6px;
        border: 1px solid var(--border);
    }

    .field-value.file {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .field-value.file a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }

    .field-value.file a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
        }

        .status-buttons {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('page-content')
<a href="{{ route('admin.campus-bird.applicants') }}" class="back-link">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
    </svg>
    Back to Applicants
</a>

@if(session('success'))
    <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(16, 185, 129, 0.3);">
        {{ session('success') }}
    </div>
@endif

<div class="applicant-header">
    <div class="header-content">
        <div class="applicant-info">
            <h1>{{ $applicant->applicant_name ?? 'Applicant' }}</h1>
            <p><strong>Email:</strong> {{ $applicant->applicant_email ?? 'Not provided' }}</p>
            <p><strong>Form:</strong> {{ $applicant->form->title }}</p>
            <p><strong>Department:</strong> {{ $applicant->form->department }}</p>
            <p><strong>Submitted:</strong> {{ $applicant->created_at->format('F d, Y \a\t H:i') }}</p>
        </div>

        <div class="status-actions">
            <div>
                <span class="status-badge {{ $applicant->status }}">
                    {{ ucfirst($applicant->status) }}
                </span>
            </div>

            <div class="status-buttons">
                @if($applicant->status !== 'shortlisted')
                <form action="{{ route('admin.campus-bird.applicants.status', $applicant->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="status" value="shortlisted">
                    <button type="submit" class="status-btn shortlist">
                        ✓ Shortlist
                    </button>
                </form>
                @endif

                @if($applicant->status !== 'rejected')
                <form action="{{ route('admin.campus-bird.applicants.status', $applicant->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="status-btn reject">
                        ✗ Reject
                    </button>
                </form>
                @endif

                @if($applicant->status !== 'pending')
                <form action="{{ route('admin.campus-bird.applicants.status', $applicant->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="status" value="pending">
                    <button type="submit" class="status-btn pending">
                        ⟲ Set Pending
                    </button>
                </form>
                @endif

                <form action="{{ route('admin.campus-bird.applicants.destroy', $applicant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this applicant? This action cannot be undone.');" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">
                        🗑️ Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="form-data-card">
    <h2 class="card-title">Application Details</h2>

    <!-- Default Fields (Always displayed) -->
    <div class="form-field">
        <div class="field-label">Name</div>
        <div class="field-value">
            {{ $applicant->applicant_name ?? 'Not provided' }}
        </div>
    </div>

    <div class="form-field">
        <div class="field-label">Email</div>
        <div class="field-value">
            {{ $applicant->applicant_email ?? 'Not provided' }}
        </div>
    </div>

    <div class="form-field">
        <div class="field-label">Phone Number</div>
        <div class="field-value">
            {{ $applicant->applicant_phone ?? 'Not provided' }}
        </div>
    </div>

    <!-- Custom Fields -->
    @if($applicant->form->custom_fields)
        @foreach($applicant->form->custom_fields as $field)
            <div class="form-field">
                <div class="field-label">{{ $field['label'] }}</div>
                <div class="field-value {{ $field['type'] === 'file' ? 'file' : '' }}">
                    @php
                        $value = $applicant->form_data[$field['field_name']] ?? null;
                    @endphp

                    @if($field['type'] === 'file' && $value)
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                        <a href="{{ asset('storage/' . $value) }}" target="_blank">
                            Download File
                        </a>
                    @elseif($field['type'] === 'checkbox' && is_array($value))
                        {{ implode(', ', $value) }}
                    @elseif($value)
                        {{ $value }}
                    @else
                        <em style="color: var(--text-muted);">Not provided</em>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
