@extends('admin.campus-bird.layout')

@section('page-title', 'Edit Application Form')

@section('page-styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .page-header h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-main);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: var(--primary);
    }

    .back-link svg {
        width: 20px;
        height: 20px;
    }

    .form-container {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border);
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-weight: 500;
        color: var(--text-main);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 0.65rem 1rem;
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text-main);
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary);
    }

    .form-select option {
        background-color: var(--background);
        color: var(--text-main);
    }

    .error-text {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .fields-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .field-item {
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 1.25rem;
        position: relative;
    }

    .remove-field-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 0.25rem;
        transition: color 0.2s;
    }

    .remove-field-btn:hover {
        color: #ef4444;
    }

    .remove-field-btn svg {
        width: 20px;
        height: 20px;
    }

    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }

    .field-col {
        display: flex;
        flex-direction: column;
    }

    .field-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-muted);
        margin-bottom: 0.4rem;
    }

    .field-input,
    .field-select {
        padding: 0.5rem 0.75rem;
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: 6px;
        color: var(--text-main);
        font-size: 0.9rem;
    }

    .field-input:focus,
    .field-select:focus {
        outline: none;
        border-color: var(--primary);
    }

    .field-select option {
        background-color: var(--surface);
    }

    .options-container {
        margin-bottom: 0.75rem;
    }

    .hidden {
        display: none !important;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: var(--text-muted);
        cursor: pointer;
    }

    .checkbox-label input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .add-field-btn {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 0.65rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .add-field-btn:hover {
        background-color: var(--primary-dark);
    }

    .add-field-btn svg {
        width: 16px;
        height: 16px;
    }

    .form-actions {
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 1rem;
    }

    .submit-btn {
        background-color: #22c55e;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .submit-btn:hover {
        background-color: #16a34a;
    }

    @media (max-width: 640px) {
        .field-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('page-content')
<div class="page-header">
    <h2>Edit Application Form</h2>
    <a href="{{ route('admin.campus-bird.forms.index') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Back to List
    </a>
</div>

<div class="form-container">
    <form action="{{ route('admin.campus-bird.forms.update', $form->id) }}" method="POST">
        @method('PUT')
        @include('admin.campus-bird.forms._form')
    </form>
</div>
@endsection
