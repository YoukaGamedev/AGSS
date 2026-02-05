@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container" style="max-width: 42rem;">
    <div class="card shadow-sm">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <h1 class="h2 fw-bold text-dark">Edit User</h1>
                <p class="mt-2 text-muted">Update user information</p>
            </div>

            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="form-label small fw-medium text-dark">
                        Full Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name', $user->name) }}"
                           class="form-control form-control-lg"
                           placeholder="John Doe">
                    @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="form-label small fw-medium text-dark">
                        Email Address <span class="text-danger">*</span>
                    </label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email', $user->email) }}"
                           class="form-control form-control-lg"
                           placeholder="john@example.com">
                    @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="form-label small fw-medium text-dark">
                        Role <span class="text-danger">*</span>
                    </label>
                    <select name="role" id="role" required
                            class="form-select form-select-lg">
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Section -->
                <div class="bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded p-4 mb-4">
                    <h4 class="h6 fw-semibold text-warning-emphasis mb-3">
                        <i class="fas fa-key"></i> Change Password (Optional)
                    </h4>
                    <p class="small text-warning-emphasis mb-3">Leave blank to keep current password</p>
                    
                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-medium text-dark">
                            New Password
                        </label>
                        <input type="password" name="password" id="password"
                               class="form-control form-control-lg"
                               placeholder="••••••••">
                        @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="form-label small fw-medium text-dark">
                            Confirm New Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control form-control-lg"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- User Stats -->
                <div class="bg-light rounded p-4 mb-4">
                    <h4 class="h6 fw-semibold text-dark mb-3">User Statistics</h4>
                    <div class="row g-3 small">
                        <div class="col-6">
                            <p class="text-muted mb-1">Games Uploaded</p>
                            <p class="fw-semibold text-dark fs-5 mb-0">{{ $user->games->count() }}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-muted mb-1">Member Since</p>
                            <p class="fw-semibold text-dark fs-5 mb-0">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex gap-3">
                    <button type="submit" 
                            class="btn btn-primary flex-fill py-3 fw-medium">
                        <i class="fas fa-save me-2"></i> Save Changes
                    </button>
                    <a href="{{ route('users.index') }}" 
                       class="btn btn-secondary flex-fill py-3 fw-medium text-center">
                        <i class="fas fa-times me-2"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control:focus,
    .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
    }
    
    .btn-primary {
        background-color: #6366f1;
        border-color: #6366f1;
        transition: all 0.15s ease-in-out;
    }
    
    .btn-primary:hover {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }
    
    .btn-secondary {
        background-color: #e5e7eb;
        border-color: #e5e7eb;
        color: #374151;
        transition: all 0.15s ease-in-out;
    }
    
    .btn-secondary:hover {
        background-color: #d1d5db;
        border-color: #d1d5db;
        color: #374151;
    }
    
    .text-warning-emphasis {
        color: #854d0e !important;
    }
    
    .bg-warning {
        background-color: #fef3c7 !important;
    }
    
    .border-warning {
        border-color: #fde68a !important;
    }
</style>
@endsection