@extends('layouts.app')

@section('title', 'Profile Settings - Professional Todo App')

@section('content')
<div class="message-container" id="messageContainer" aria-live="assertive" aria-atomic="true" aria-relevant="additions"></div>

<!-- Quick Actions Bar -->
<div class="quick-actions-bar" id="quickActionsBar" role="toolbar" aria-label="Quick actions">
    <button class="quick-btn quick-btn-primary" data-tooltip="Back to Todos" aria-label="Back to Todos" onclick="window.location.href='{{ route('todos.index') }}'">
        <i class="fas fa-arrow-left"></i>
    </button>
    <button class="quick-btn quick-btn-success" data-tooltip="Save Profile" aria-label="Save Profile" onclick="document.querySelector('#profileForm').submit()">
        <i class="fas fa-save"></i>
    </button>
    <button class="quick-btn" data-tooltip="Toggle Theme" aria-label="Toggle Theme" onclick="toggleTheme()" style="background: linear-gradient(135deg, #8b5cf6, #ec4899)">
        <i class="fas fa-moon" id="themeIcon"></i>
    </button>
</div>

<div class="container-fluid px-2 px-md-3">
    <!-- Professional Welcome Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 bg-gradient-primary text-white shadow-lg" style="border-radius: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-8">
                            <div class="d-flex align-items-center gap-4 mb-4">
                                <div class="avatar-circle bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="fas fa-user fs-1"></i>
                                </div>
                                <div>
                                    <h1 class="mb-1 fw-bold" style="font-size: 2.5rem; letter-spacing: -0.5px;">
                                        Welcome, {{ Auth::user()->name }}!
                                    </h1>
                                    <p class="mb-0 opacity-75" style="font-size: 1.1rem;">
                                        Manage your profile settings and preferences
                                    </p>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="stat-card bg-white bg-opacity-10 rounded-3 p-3 text-center">
                                        <i class="fas fa-tasks fs-3 mb-2 d-block"></i>
                                        <div class="fs-2 fw-bold">{{ Auth::user()->todos()->count() }}</div>
                                        <div class="small opacity-75">Total Tasks</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="stat-card bg-white bg-opacity-10 rounded-3 p-3 text-center">
                                        <i class="fas fa-calendar-check fs-3 mb-2 d-block"></i>
                                        <div class="fs-2 fw-bold">{{ Auth::user()->created_at->format('M Y') }}</div>
                                        <div class="small opacity-75">Member Since</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="stat-card bg-white bg-opacity-10 rounded-3 p-3 text-center">
                                        <i class="fas fa-clock fs-3 mb-2 d-block"></i>
                                        <div class="fs-2 fw-bold">{{ Auth::user()->updated_at->diffForHumans() }}</div>
                                        <div class="small opacity-75">Last Updated</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="stat-card bg-white bg-opacity-10 rounded-3 p-3 text-center">
                                        <i class="fas fa-shield-alt fs-3 mb-2 d-block"></i>
                                        <div class="fs-2 fw-bold">Active</div>
                                        <div class="small opacity-75">Account Status</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 text-md-end">
                            <div class="d-flex flex-column gap-2 align-items-md-end">
                                <a href="{{ route('todos.index') }}" class="btn btn-light btn-lg px-4" style="border-radius: 50px; font-weight: 600;">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Todos
                                </a>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light btn-lg px-4" style="border-radius: 50px; font-weight: 600;">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4">
        <!-- Profile Information Section -->
        <div class="col-12 col-lg-8">
            <div class="card glass-effect border-0 mb-4 shadow-lg">
                <div class="card-header bg-gradient-primary text-white d-flex align-items-center gap-3 py-4">
                    <div class="icon-box bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="fas fa-user-edit fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0 fs-4">Profile Information</h5>
                        <small class="opacity-75">Update your personal details</small>
                    </div>
                </div>
                <div class="card-body">
                    <form id="profileForm" method="POST" action="{{ route('profile.update') }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PATCH')
                        
                        <div class="row g-3">
                            <!-- Name Field -->
                            <div class="col-12">
                                <label for="name" class="form-label fw-semibold fs-6">
                                    <i class="fas fa-user me-2 text-primary"></i>Full Name
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name', Auth::user()->name) }}"
                                    class="form-control form-control-lg border-2 border-primary-subtle"
                                    required
                                    autocomplete="name"
                                    placeholder="Enter your full name"
                                    style="border-radius: 12px; transition: all 0.3s ease;"
                                >
                                @error('name')
                                    <div class="invalid-feedback d-block mt-2 fs-6">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Email Field -->
                            <div class="col-12">
                                <label for="email" class="form-label fw-semibold fs-6">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email', Auth::user()->email) }}"
                                    class="form-control form-control-lg border-2 border-primary-subtle"
                                    required
                                    autocomplete="email"
                                    placeholder="Enter your email address"
                                    style="border-radius: 12px; transition: all 0.3s ease;"
                                >
                                @error('email')
                                    <div class="invalid-feedback d-block mt-2 fs-6">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-5" style="border-radius: 12px; padding: 12px 30px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                                
                                @if (session('status') === 'profile-updated')
                                    <div class="alert alert-success alert-sm mt-3 d-inline-flex align-items-center animate-pulse">
                                        <i class="fas fa-check-circle me-2"></i>Profile updated successfully!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="card glass-effect border-0 shadow-lg">
                <div class="card-header bg-gradient-warning text-white d-flex align-items-center gap-3 py-4">
                    <div class="icon-box bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="fas fa-key fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0 fs-4">Update Password</h5>
                        <small class="opacity-75">Change your account password</small>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <!-- Current Password -->
                            <div class="col-12">
                                <label for="current_password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-warning"></i>Current Password
                                </label>
                                <input 
                                    type="password" 
                                    name="current_password" 
                                    id="current_password" 
                                    class="form-control form-control-lg"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Enter your current password"
                                >
                                @error('current_password')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- New Password -->
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock-open me-2 text-warning"></i>New Password
                                </label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-control form-control-lg"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Enter new password"
                                >
                                @error('password')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-warning"></i>Confirm Password
                                </label>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation" 
                                    class="form-control form-control-lg"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Confirm new password"
                                >
                            </div>
                            
                            <!-- Password Requirements -->
                            <div class="col-12">
                                <div class="alert alert-info alert-sm">
                                    <h6 class="alert-heading mb-2">
                                        <i class="fas fa-info-circle me-2"></i>Password Requirements:
                                    </h6>
                                    <ul class="mb-0 small">
                                        <li><i class="fas fa-check text-success me-1"></i>At least 8 characters long</li>
                                        <li><i class="fas fa-check text-success me-1"></i>Contains at least one uppercase letter</li>
                                        <li><i class="fas fa-check text-success me-1"></i>Contains at least one number</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-warning btn-lg px-5">
                                    <i class="fas fa-key me-2"></i>Update Password
                                </button>
                                
                                @if (session('status') === 'password-updated')
                                    <div class="alert alert-success alert-sm mt-3 d-inline-flex align-items-center animate-pulse">
                                        <i class="fas fa-check-circle me-2"></i>Password updated successfully!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <!-- Account Summary Card -->
            <div class="card glass-effect border-0 mb-4 shadow-lg">
                <div class="card-header bg-gradient-info text-white d-flex align-items-center gap-3 py-4">
                    <div class="icon-box bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="fas fa-info-circle fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0 fs-4">Account Summary</h5>
                        <small class="opacity-75">Your account details</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="space-y-3">
                        <!-- User ID -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-lg flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-fingerprint text-primary"></i>
                                <span class="fw-medium">User ID</span>
                            </div>
                            <span class="badge bg-primary text-white">
                                #{{ Auth::user()->id }}
                            </span>
                        </div>
                        
                        <!-- Full Name -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-lg flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-user text-primary"></i>
                                <span class="fw-medium">Full Name</span>
                            </div>
                            <span class="badge bg-secondary text-white">
                                {{ Auth::user()->name }}
                            </span>
                        </div>
                        
                        <!-- Email Address -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-lg flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-envelope text-primary"></i>
                                <span class="fw-medium">Email</span>
                            </div>
                            <small class="text-muted text-truncate flex-grow-1" style="max-width: 200px;">
                                {{ Auth::user()->email }}
                            </small>
                        </div>
                        
                        <!-- Member Since -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-lg flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-calendar-alt text-primary"></i>
                                <span class="fw-medium">Member Since</span>
                            </div>
                            <span class="badge bg-primary text-white">
                                {{ Auth::user()->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        
                        <!-- Last Updated -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-lg flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-clock text-info"></i>
                                <span class="fw-medium">Last Updated</span>
                            </div>
                            <span class="badge bg-info text-white">
                                {{ Auth::user()->updated_at->format('M d, Y') }}
                            </span>
                        </div>
                                                
                        <!-- Total Tasks -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-lg flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-tasks text-info"></i>
                                <span class="fw-medium">Total Tasks</span>
                            </div>
                            <span class="badge bg-info text-white">
                                {{ Auth::user()->todos()->count() }}
                            </span>
                        </div>
                        
                        <!-- Account Status -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-lg flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-check-circle text-success"></i>
                                <span class="fw-medium">Account Status</span>
                            </div>
                            <span class="badge bg-success text-white">
                                Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone Card -->
            <div class="card glass-effect border-0 border-danger border-2 shadow-lg">
                <div class="card-header bg-gradient-danger text-white d-flex align-items-center gap-3 py-4">
                    <div class="icon-box bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="fas fa-exclamation-triangle fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0 fs-4">Danger Zone</h5>
                        <small class="opacity-75">Irreversible actions</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger alert-sm mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> Once you delete your account, all of your data including todos, tasks, and settings will be permanently deleted. This action cannot be undone.
                    </div>
                    
                    <button 
                        type="button" 
                        onclick="document.getElementById('confirm-user-deletion').classList.remove('hidden')"
                        class="btn btn-danger btn-lg w-100"
                    >
                        <i class="fas fa-trash-alt me-2"></i>Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div id="confirm-user-deletion" class="modal fade" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Delete Account
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="document.getElementById('confirm-user-deletion').classList.add('hidden')"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                    <div>
                        <strong>Final Warning:</strong> This action cannot be undone. All your todos, settings, and account data will be permanently deleted.
                    </div>
                </div>
                
                <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4">
                    @csrf
                    @method('DELETE')
                    
                    <div class="mb-3">
                        <label for="delete_password" class="form-label fw-semibold">
                            <i class="fas fa-lock me-2 text-danger"></i>Confirm Password
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="delete_password" 
                            class="form-control form-control-lg"
                            placeholder="Enter your password to confirm deletion"
                            required
                            autocomplete="current-password"
                        >
                        @error('password')
                            <div class="invalid-feedback d-block mt-2">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2 justify-content-end">
                        <button 
                            type="button" 
                            class="btn btn-secondary btn-lg"
                            onclick="document.getElementById('confirm-user-deletion').classList.add('hidden')"
                        >
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="btn btn-danger btn-lg"
                        >
                            <i class="fas fa-trash-alt me-2"></i>Delete Forever
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Custom tooltip functionality
    document.querySelectorAll('[data-tooltip]').forEach(element => {
        element.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = this.getAttribute('data-tooltip');
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
            
            setTimeout(() => tooltip.classList.add('show'), 10);
        });
        
        element.addEventListener('mouseleave', function() {
            const tooltip = document.querySelector('.custom-tooltip');
            if (tooltip) {
                tooltip.classList.remove('show');
                setTimeout(() => tooltip.remove(), 200);
            }
        });
    });

    // Modal functionality
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideModal('confirm-user-deletion');
        }
    });

    // Close modal on backdrop click
    document.getElementById('confirm-user-deletion').addEventListener('click', function(e) {
        if (e.target === this) {
            hideModal('confirm-user-deletion');
        }
    });

    // Show delete confirmation modal
    window.showDeleteModal = function() {
        showModal('confirm-user-deletion');
    };

    // Auto-hide success messages after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.animate-pulse').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 5000);

    // Theme toggle functionality
    window.toggleTheme = function() {
        const html = document.documentElement;
        const themeIcon = document.getElementById('themeIcon');
        
        if (html.getAttribute('data-theme') === 'dark') {
            html.setAttribute('data-theme', 'light');
            themeIcon.className = 'fas fa-moon';
            localStorage.setItem('theme', 'light');
        } else {
            html.setAttribute('data-theme', 'dark');
            themeIcon.className = 'fas fa-sun';
            localStorage.setItem('theme', 'dark');
        }
    };

    // Initialize theme on load
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        const themeIcon = document.getElementById('themeIcon');
        
        if (savedTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            if (themeIcon) themeIcon.className = 'fas fa-sun';
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            if (themeIcon) themeIcon.className = 'fas fa-moon';
        }
    });

    // Form validation
    document.querySelectorAll('.needs-validation').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
</script>
@endpush
@endsection
