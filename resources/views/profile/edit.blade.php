@extends('layouts.app')

@section('title', 'Profile Settings - Professional Todo App')

@section('content')
<div class="container-fluid px-2 px-md-3 py-4">
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <!-- Profile Avatar -->
                    <div class="position-relative d-inline-block mb-3">
                        <div class="bg-gradient-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 120px; height: 120px; font-size: 3rem; font-weight: 700; box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="position-absolute bottom-0 end-0">
                            <span class="badge bg-success rounded-circle p-2 border border-2 border-white">
                                <i class="fas fa-check fa-xs"></i>
                            </span>
                        </div>
                    </div>
                    
                    <h4 class="mb-1 fw-bold">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge bg-primary-light text-primary px-3 py-2">
                            <i class="fas fa-crown me-1"></i> Premium
                        </span>
                        <span class="badge bg-success-light text-success px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> Verified
                        </span>
                    </div>
                    
                    <div class="text-muted small">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Member since {{ $user->created_at->format('F j, Y') }}
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body p-4">
                    <h6 class="text-muted mb-3">Account Overview</h6>
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="bg-light rounded p-3">
                                <h5 class="mb-1 text-primary">128</h5>
                                <small class="text-muted">Total Tasks</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="bg-light rounded p-3">
                                <h5 class="mb-1 text-success">95%</h5>
                                <small class="text-muted">Completed</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Success Message -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Profile Information -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-edit me-3"></i>
                        <h5 class="mb-0">Profile Information</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="fas fa-user me-2 text-primary"></i>Full Name
                                </label>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" 
                                       placeholder="Enter your full name" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                                </label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" 
                                       placeholder="Enter your email" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    @if ($user->email_verified_at)
                                        <span class="text-success"><i class="fas fa-check-circle me-1"></i>Email verified</span>
                                    @else
                                        <span class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>Email not verified</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Change -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-warning text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock me-3"></i>
                        <h5 class="mb-0">Change Password</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('password.update') }}" id="passwordForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="current_password" class="form-label fw-semibold">
                                    <i class="fas fa-key me-2 text-warning"></i>Current Password
                                </label>
                                <input type="password" class="form-control form-control-lg @error('current_password') is-invalid @enderror" 
                                       id="current_password" name="current_password" 
                                       placeholder="Enter current password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-warning"></i>New Password
                                </label>
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" name="password" 
                                       placeholder="Enter new password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-warning"></i>Confirm New Password
                                </label>
                                <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Confirm new password" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning btn-lg px-4">
                                <i class="fas fa-shield-alt me-2"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-danger text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-3"></i>
                        <h5 class="mb-0">Danger Zone</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> Once you delete your account, all data will be permanently removed and cannot be recovered.
                    </div>
                    
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="mb-2">Delete Account</h6>
                            <p class="text-muted mb-0">Permanently delete your account and all associated data. This action cannot be undone.</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                <i class="fas fa-trash-alt me-2"></i>Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Delete Account
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-trash-alt fa-2x text-danger"></i>
                    </div>
                    <h5 class="mb-2">Are you absolutely sure?</h5>
                    <p class="text-muted">This action cannot be undone. This will permanently delete your account and remove all your data from our servers.</p>
                </div>
                
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    
                    <div class="mb-3">
                        <label for="delete_password" class="form-label fw-semibold">Confirm with password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="delete_password" name="password" placeholder="Enter your password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirmDelete" required>
                        <label class="form-check-label" for="confirmDelete">
                            I understand that this action is irreversible
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="deleteAccountModal" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-2"></i>Delete My Account
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}
.bg-gradient-danger {
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
}
.bg-primary-light {
    background-color: rgba(99, 102, 241, 0.1);
}
.bg-success-light {
    background-color: rgba(34, 197, 94, 0.1);
}
</style>
@endsection
