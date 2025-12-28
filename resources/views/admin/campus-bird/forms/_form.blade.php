@csrf

<div class="form-section">
    <div class="form-group">
        <label class="form-label" for="title">Form Title</label>
        <input type="text" name="title" id="title" class="form-input" value="{{ old('title', $form->title ?? '') }}" required placeholder="e.g., Marketing Intern Application">
        @error('title') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="department">Department</label>
        <select name="department" id="department" class="form-select" required>
            <option value="">Select Department</option>
            @foreach(['IT and graphics', 'Content & creation', 'Marketing & promotions', 'Human Resources', 'Bussniess Development', 'Client Management & Public Relation(CM & PR)', 'Product Design & Development (PDDT)', 'Education Consultancy'] as $dept)
                <option value="{{ $dept }}" {{ (old('department', $form->department ?? '') == $dept) ? 'selected' : '' }}>{{ $dept }}</option>
            @endforeach
        </select>
        @error('department') <span class="error-text">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-section">
    <h3 class="section-title">Default Fields (Automatically Included)</h3>
    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
        These 3 fields are automatically included in every application form and cannot be removed:
    </p>
    
    <div class="fields-container">
        <div class="field-item" style="background-color: rgba(99, 102, 241, 0.05); border-color: rgba(99, 102, 241, 0.2);">
            <div class="field-row">
                <div class="field-col">
                    <label class="field-label">Field Label</label>
                    <input type="text" value="What's your name" class="field-input" disabled style="opacity: 0.7;">
                </div>
                <div class="field-col">
                    <label class="field-label">Field Type</label>
                    <input type="text" value="Text Input" class="field-input" disabled style="opacity: 0.7;">
                </div>
            </div>
            <div style="margin-top: 0.5rem;">
                <label class="checkbox-label" style="opacity: 0.7;">
                    <input type="checkbox" checked disabled>
                    Required Field
                </label>
            </div>
        </div>

        <div class="field-item" style="background-color: rgba(99, 102, 241, 0.05); border-color: rgba(99, 102, 241, 0.2);">
            <div class="field-row">
                <div class="field-col">
                    <label class="field-label">Field Label</label>
                    <input type="text" value="What's your email" class="field-input" disabled style="opacity: 0.7;">
                </div>
                <div class="field-col">
                    <label class="field-label">Field Type</label>
                    <input type="text" value="Email Input" class="field-input" disabled style="opacity: 0.7;">
                </div>
            </div>
            <div style="margin-top: 0.5rem;">
                <label class="checkbox-label" style="opacity: 0.7;">
                    <input type="checkbox" checked disabled>
                    Required Field
                </label>
            </div>
        </div>

        <div class="field-item" style="background-color: rgba(99, 102, 241, 0.05); border-color: rgba(99, 102, 241, 0.2);">
            <div class="field-row">
                <div class="field-col">
                    <label class="field-label">Field Label</label>
                    <input type="text" value="Phone number" class="field-input" disabled style="opacity: 0.7;">
                </div>
                <div class="field-col">
                    <label class="field-label">Field Type</label>
                    <input type="text" value="Text Input" class="field-input" disabled style="opacity: 0.7;">
                </div>
            </div>
            <div style="margin-top: 0.5rem;">
                <label class="checkbox-label" style="opacity: 0.7;">
                    <input type="checkbox" checked disabled>
                    Required Field
                </label>
            </div>
        </div>
    </div>
</div>

<div class="form-section">
    <h3 class="section-title">Custom Fields (Optional)</h3>
    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
        Add additional fields specific to this form:
    </p>
    
    <div id="fields-container" class="fields-container">
        {{-- Fields will be injected here via JS --}}
    </div>

    <button type="button" id="add-field-btn" class="add-field-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Add Field
    </button>
</div>

<div class="form-actions">
    <button type="submit" class="submit-btn">
        {{ isset($form) ? 'Update Form' : 'Create Form' }}
    </button>
</div>

{{-- Template for new field (hidden) --}}
<template id="field-template">
    <div class="field-item">
        <button type="button" class="remove-field-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        
        <div class="field-row">
            <div class="field-col">
                <label class="field-label">Field Label</label>
                <input type="text" name="custom_fields[INDEX][label]" class="field-input field-label-input" required placeholder="e.g., Full Name">
            </div>
            <div class="field-col">
                <label class="field-label">Field Type</label>
                <select name="custom_fields[INDEX][type]" class="field-select field-type-select">
                    <option value="text">Text Input</option>
                    <option value="textarea">Long Text</option>
                    <option value="date">Date Picker</option>
                    <option value="radio">Radio Buttons</option>
                    <option value="select">Dropdown Select</option>
                    <option value="checkbox">Checkbox Group</option>
                    <option value="file">File Upload</option>
                </select>
            </div>
        </div>
        
        <div class="options-container hidden">
            <label class="field-label">Options (comma separated)</label>
            <input type="text" name="custom_fields[INDEX][options]" class="field-input" placeholder="e.g., Morning, Afternoon, Evening">
        </div>

        <div>
            <label class="checkbox-label">
                <input type="checkbox" name="custom_fields[INDEX][is_required]" value="1">
                Required Field
            </label>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('fields-container');
        const addBtn = document.getElementById('add-field-btn');
        const template = document.getElementById('field-template');
        let fieldIndex = 0;

        // Existing data from server (for edit mode)
        const existingFields = @json(old('custom_fields', isset($form) ? $form->custom_fields : []));

        function addField(data = null) {
            const clone = template.content.cloneNode(true);
            const root = clone.querySelector('.field-item');
            
            // Replace placeholders
            root.innerHTML = root.innerHTML.replace(/INDEX/g, fieldIndex);
            
            // Set values if data exists
            if (data) {
                root.querySelector('[name$="[label]"]').value = data.label;
                root.querySelector('[name$="[type]"]').value = data.type;
                if (data.options) {
                    let optVal = Array.isArray(data.options) ? data.options.join(', ') : (data.options || '');
                    root.querySelector('[name$="[options]"]').value = optVal;
                }
                if (data.is_required) {
                    root.querySelector('[name$="[is_required]"]').checked = true;
                }
                
                // Trigger visibility check
                toggleOptions(root.querySelector('[name$="[type]"]'));
            }

            container.appendChild(root);
            fieldIndex++;
        }

        // Event Delegation
        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-field-btn')) {
                e.target.closest('.field-item').remove();
            }
        });

        container.addEventListener('change', function(e) {
            if (e.target.classList.contains('field-type-select')) {
                toggleOptions(e.target);
            }
        });

        function toggleOptions(selectElement) {
            const val = selectElement.value;
            const container = selectElement.closest('.field-item').querySelector('.options-container');
            if (['radio', 'select', 'checkbox'].includes(val)) {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
        }

        addBtn.addEventListener('click', () => addField());

        // Initialize existing fields
        if (existingFields && existingFields.length > 0) {
            existingFields.forEach(field => addField(field));
        }
    });
</script>
