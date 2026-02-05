@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container" style="max-width: 42rem;">
    <div class="card shadow-sm">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <h1 class="h2 fw-bold text-dark">Create User</h1>
                <p class="mt-2 text-muted">Add a new user to the system</p>
            </div>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="form-label small fw-medium text-dark">
                        Full Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name') }}"
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
                           value="{{ old('email') }}"
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
                        <option value="">-- Select Role --</option>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="bg-info bg-opacity-10 border border-info border-opacity-25 rounded p-4 mb-4">
                    <h4 class="h6 fw-semibold text-info mb-3">
                        <i class="fas fa-lock"></i> Account Password
                    </h4>

                    <div class="mb-3">
                        <label for="password" class="form-label small fw-medium text-dark">
                            Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password" id="password" required
                               class="form-control form-control-lg"
                               placeholder="••••••••">
                        @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label small fw-medium text-dark">
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="form-control form-control-lg"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex gap-3">
                    <button type="submit" 
                            class="btn btn-primary flex-fill py-3 fw-medium">
                        <i class="fas fa-user-plus me-2"></i> Create User
                    </button>
                    <a href="{{ route('users.index') }}" 
                       class="btn btn-secondary flex-fill py-3 fw-medium text-center">
                        <i class="fas fa-arrow-left me-2"></i> Cancel
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
    
    .text-info {
        color: #1e3a8a !important;
    }
    
    .bg-info {
        background-color: #dbeafe !important;
    }
    
    .border-info {
        border-color: #bfdbfe !important;
    }
</style>
@endsection