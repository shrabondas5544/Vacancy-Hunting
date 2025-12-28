@extends('admin.campus-bird.layout')

@section('page-title', 'View Form')

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

    .form-preview-container {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .form-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .form-department {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        background-color: rgba(99, 102, 241, 0.1);
        color: var(--primary);
    }

    .form-status {
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #22c55e;
    }

    .status-indicator.inactive {
        background-color: #ef4444;
    }

    .fields-preview {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .field-preview {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .field-label {
        font-weight: 500;
        color: var(--text-main);
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .required-badge {
        color: #ef4444;
        font-size: 0.85rem;
    }

    .field-type-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
        background-color: var(--surface-hover);
        color: var(--text-muted);
        margin-left: 0.5rem;
    }

    .field-input-preview,
    .field-select-preview,
    .field-textarea-preview {
        width: 100%;
        padding: 0.65rem 1rem;
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text-muted);
        font-size: 0.95rem;
        pointer-events: none;
    }

    .field-textarea-preview {
        min-height: 100px;
        resize: none;
    }

    .radio-group,
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .radio-option,
    .checkbox-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 6px;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .radio-option input[type="radio"],
    .checkbox-option input[type="checkbox"] {
        pointer-events: none;
    }

    .file-upload-preview {
        padding: 1rem;
        background-color: var(--background);
        border: 1px dashed var(--border);
        border-radius: 8px;
        text-align: center;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .file-upload-preview svg {
        width: 32px;
        height: 32px;
        margin: 0 auto 0.5rem;
        opacity: 0.5;
    }

    .actions {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 1rem;
    }

    .edit-btn {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 0.65rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .edit-btn:hover {
        background-color: var(--primary-dark);
    }

    .edit-btn svg {
        width: 16px;
        height: 16px;
    }

    .default-field-badge {
        background-color: rgba(99, 102, 241, 0.15);
        color: var(--primary);
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }
</style>
@endsection

@section('page-content')
<div class="page-header">
    <h2>Form Preview</h2>
    <a href="{{ route('admin.campus-bird.forms.index') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Back to List
    </a>
</div>

<div class="form-preview-container">
    <div class="form-header">
        <h1 class="form-title">{{ $form->title }}</h1>
        <span class="form-department">{{ $form->department }}</span>
        <div class="form-status">
            <span class="status-indicator {{ $form->is_active ? '' : 'inactive' }}"></span>
            <span>{{ $form->is_active ? 'Active' : 'Inactive' }}</span>
        </div>
    </div>

    <div class="fields-preview">
        @php
            $allFields = $form->getAllFields();
        @endphp
        
        @foreach($allFields as $index => $field)
        <div class="field-preview">
            <label class="field-label">
                {{ $field['label'] }}
                @if($field['is_required'])
                    <span class="required-badge">*</span>
                @endif
                <span class="field-type-badge">{{ ucfirst($field['type']) }}</span>
                @if($index < 3)
                    <span class="default-field-badge">DEFAULT</span>
                @endif
            </label>

            @if($field['type'] === 'text')
                <input type="text" class="field-input-preview" placeholder="Enter {{ strtolower($field['label']) }}" disabled>
            
            @elseif($field['type'] === 'textarea')
                <textarea class="field-textarea-preview" placeholder="Enter {{ strtolower($field['label']) }}" disabled></textarea>
            
            @elseif($field['type'] === 'date')
                <input type="date" class="field-input-preview" disabled>
            
            @elseif($field['type'] === 'radio')
                <div class="radio-group">
                    @if(isset($field['options']))
                        @foreach($field['options'] as $option)
                        <label class="radio-option">
                            <input type="radio" name="{{ $field['field_name'] }}" disabled>
                            {{ $option }}
                        </label>
                        @endforeach
                    @endif
                </div>
            
            @elseif($field['type'] === 'select')
                <select class="field-select-preview" disabled>
                    <option>Select {{ strtolower($field['label']) }}</option>
                    @if(isset($field['options']))
                        @foreach($field['options'] as $option)
                        <option>{{ $option }}</option>
                        @endforeach
                    @endif
                </select>
            
            @elseif($field['type'] === 'checkbox')
                <div class="checkbox-group">
                    @if(isset($field['options']))
                        @foreach($field['options'] as $option)
                        <label class="checkbox-option">
                            <input type="checkbox" disabled>
                            {{ $option }}
                        </label>
                        @endforeach
                    @endif
                </div>
            
            @elseif($field['type'] === 'file')
                <div class="file-upload-preview">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    Click to upload or drag and drop
                </div>
            @endif
        </div>
        @endforeach
    </div>

    <div class="actions">
        <a href="{{ route('admin.campus-bird.forms.edit', $form) }}" class="edit-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            Edit Form
        </a>
    </div>
</div>
@endsection
