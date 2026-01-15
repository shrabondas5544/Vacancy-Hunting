@extends('admin.layout')

@section('styles')
    .admin-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-top: 2rem;
        flex-wrap: wrap;
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

    .layout-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-main);
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        color: var(--text-main);
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }

    .error-msg {
        color: var(--error);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    .text-hint {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    .super-admin-card {
        background-color: rgba(244, 63, 94, 0.05);
        border: 1px solid rgba(244, 63, 94, 0.2);
        border-radius: var(--radius);
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .super-admin-card:hover {
        background-color: rgba(244, 63, 94, 0.1);
        border-color: rgba(244, 63, 94, 0.3);
    }

    .super-admin-checkbox {
        width: 20px;
        height: 20px;
        accent-color: #f43f5e;
    }

    .super-admin-label {
        color: var(--text-main);
        font-weight: 600;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .super-admin-desc {
        color: var(--text-muted);
        font-size: 0.85rem;
        font-weight: 400;
    }

    .permissions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .permission-card {
        background-color: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .permission-card:hover {
        background-color: var(--surface-hover);
        border-color: var(--primary);
    }

    .permission-card.disabled {
        opacity: 0.4;
        cursor: not-allowed;
        pointer-events: none;
    }

    .permission-checkbox {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
    }

    .permission-label {
        color: var(--text-main);
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
    }

    .info-list {
        list-style: none;
    }

    .info-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1rem;
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .info-icon {
        color: var(--success);
        margin-top: 0.2rem;
    }
    
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        border-top: 1px solid var(--border);
        padding-top: 1.5rem;
    }

    .btn-cancel {
        background-color: transparent;
        border: 1px solid var(--border);
        color: var(--text-main);
        /* Matches index page style */
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius);
        font-weight: 500;
        transition: all 0.2s;
        height: 48px;
    }
    
    .btn-cancel:hover {
        background-color: var(--surface-hover);
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

    @media (max-width: 768px) {
        .layout-grid {
            grid-template-columns: 1fr;
        }
    }
@endsection

@section('content')
<div class="container">
    <div class="admin-page-header">
        <div class="page-title">
            <h1>Create New Admin User</h1>
            <p>Add a new admin with specific module permissions</p>
        </div>
        <div>
            <a href="{{ route('admin.manage-admins.index') }}" class="btn btn-cancel">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Back to List
            </a>
        </div>
    </div>

    <div class="layout-grid">
        <!-- Form Section -->
        <div class="card">
            <form action="{{ route('admin.manage-admins.store') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="admin@vacancyhunting.com"
                        required
                    >
                    @error('email')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••"
                        required
                    >
                    <span class="text-hint">Minimum 8 characters required</span>
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Super Admin Checkbox -->
                <div class="form-group">
                    <label class="super-admin-card" for="is_super_admin">
                        <input 
                            type="checkbox" 
                            name="is_super_admin" 
                            value="1"
                            id="is_super_admin"
                            class="super-admin-checkbox"
                        >
                        <div class="super-admin-label">
                            <span>Super Administrator</span>
                            <span class="super-admin-desc">Has full access to all modules and can manage other admins</span>
                        </div>
                    </label>
                </div>

                <!-- Permissions -->
                <div class="form-group" id="permissions-section">
                    <label class="form-label">Module Permissions</label>
                    <p class="text-hint" style="margin-bottom: 1rem;">Select the modules this admin can access:</p>
                    
                    <div class="permissions-grid">
                        @foreach($modules as $key => $label)
                        <label class="permission-card" data-permission-card>
                            <input 
                                type="checkbox" 
                                name="permissions[]" 
                                value="{{ $key }}"
                                class="permission-checkbox"
                                data-permission-checkbox
                            >
                            <span class="permission-label">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                    
                    @error('permissions')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.manage-admins.index') }}" class="btn btn-cancel">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Create Admin User
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Sidebar -->
        <div class="card" style="height: fit-content;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem;">
                <div style="width: 32px; height: 32px; background: rgba(99, 102, 241, 0.1); color: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                </div>
                <h3 style="font-size: 1.1rem; font-weight: 600;">Information</h3>
            </div>
            
            <ul class="info-list">
                <li>
                    <span class="info-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>
                    <span>Super admins have unrestricted access and can manage other admins.</span>
                </li>
                <li>
                    <span class="info-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>
                    <span>Regular admins can only access assigned modules.</span>
                </li>
                <li>
                    <span class="info-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>
                    <span>Passwords are securely hashed and encrypted.</span>
                </li>
                <li>
                    <span class="info-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>
                    <span>You can deactivate admin access from the list view.</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Handle super admin checkbox toggle
    const superAdminCheckbox = document.getElementById('is_super_admin');
    const permissionCards = document.querySelectorAll('[data-permission-card]');
    const permissionCheckboxes = document.querySelectorAll('[data-permission-checkbox]');
    
    superAdminCheckbox.addEventListener('change', function() {
        const isSuperAdmin = this.checked;
        
        permissionCards.forEach(card => {
            if (isSuperAdmin) {
                card.classList.add('disabled');
            } else {
                card.classList.remove('disabled');
            }
        });
        
        permissionCheckboxes.forEach(checkbox => {
            if (isSuperAdmin) {
                checkbox.checked = false;
                checkbox.disabled = true;
            } else {
                checkbox.disabled = false;
            }
        });
    });
</script>
@endsection
