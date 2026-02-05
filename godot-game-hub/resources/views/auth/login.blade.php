@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-gradient py-5 px-3" style="min-height: 100vh;">
    <div class="w-100 bg-white p-5 rounded-4 shadow-lg" style="max-width: 28rem;">
        <div>
            <div class="mx-auto bg-primary rounded-circle d-flex align-items-center justify-content-center" style="height: 4rem; width: 4rem;">
                <i class="fas fa-gamepad text-white" style="font-size: 1.875rem;"></i>
            </div>
            <h2 class="mt-4 text-center fw-bold text-dark" style="font-size: 1.875rem;">
                Sign in to your account
            </h2>
            <p class="mt-2 text-center small text-muted">
                Or
                <a href="{{ route('register') }}" class="fw-medium text-primary text-decoration-none">
                    create a new account
                </a>
            </p>
        </div>
        <form class="mt-4" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="d-flex flex-column gap-3">
                <div>
                    <label for="email" class="form-label small fw-medium text-dark">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           value="{{ old('email') }}"
                           class="form-control form-control-lg border-secondary">
                </div>
                <div>
                    <label for="password" class="form-label small fw-medium text-dark">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                           class="form-control form-control-lg border-secondary">
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mt-3">
                <div class="form-check">
                    <input id="remember" name="remember" type="checkbox" 
                           class="form-check-input">
                    <label for="remember" class="form-check-label small text-dark">
                        Remember me
                    </label>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" 
                        class="btn btn-primary w-100 py-3 position-relative fw-medium">
                    <span class="position-absolute start-0 top-50 translate-middle-y ps-3">
                        <i class="fas fa-sign-in-alt"></i>
                    </span>
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(to bottom right, #e0e7ff, #f3e8ff);
    }
    
    .shadow-lg {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
    }
    
    .form-check-input:checked {
        background-color: #6366f1;
        border-color: #6366f1;
    }
    
    .form-check-input:focus {
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
    
    .btn-primary:focus {
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.5);
    }
    
    .text-primary {
        color: #6366f1 !important;
    }
    
    .text-primary:hover {
        color: #4f46e5 !important;
    }
    
    .bg-primary {
        background-color: #6366f1 !important;
    }
</style>
@endsection