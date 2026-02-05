@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-gradient py-5 px-3" style="min-height: 100vh;">
    <div class="w-100 bg-white p-5 rounded-4 shadow-lg" style="max-width: 28rem;">
        <div>
            <div class="mx-auto bg-purple rounded-circle d-flex align-items-center justify-content-center" style="height: 4rem; width: 4rem;">
                <i class="fas fa-user-plus text-white" style="font-size: 1.875rem;"></i>
            </div>
            <h2 class="mt-4 text-center fw-bold text-dark" style="font-size: 1.875rem;">
                Create your account
            </h2>
            <p class="mt-2 text-center small text-muted">
                Already have an account?
                <a href="{{ route('login') }}" class="fw-medium text-primary text-decoration-none">
                    Sign in here
                </a>
            </p>
        </div>
        <form class="mt-4" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="d-flex flex-column gap-3">
                <div>
                    <label for="name" class="form-label small fw-medium text-dark">Full Name</label>
                    <input id="name" name="name" type="text" required 
                           value="{{ old('name') }}"
                           class="form-control form-control-lg border-secondary">
                </div>
                <div>
                    <label for="email" class="form-label small fw-medium text-dark">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           value="{{ old('email') }}"
                           class="form-control form-control-lg border-secondary">
                </div>
                <div>
                    <label for="password" class="form-label small fw-medium text-dark">Password</label>
                    <input id="password" name="password" type="password" required 
                           class="form-control form-control-lg border-secondary">
                </div>
                <div>
                    <label for="password_confirmation" class="form-label small fw-medium text-dark">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="form-control form-control-lg border-secondary">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" 
                        class="btn btn-purple w-100 py-3 position-relative fw-medium text-white">
                    <span class="position-absolute start-0 top-50 translate-middle-y ps-3">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(to bottom right, #f3e8ff, #fce7f3);
    }
    
    .shadow-lg {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .bg-purple {
        background-color: #9333ea !important;
    }
    
    .btn-purple {
        background-color: #9333ea;
        border-color: #9333ea;
        transition: all 0.15s ease-in-out;
    }
    
    .btn-purple:hover {
        background-color: #7e22ce;
        border-color: #7e22ce;
    }
    
    .btn-purple:focus {
        background-color: #7e22ce;
        border-color: #7e22ce;
        box-shadow: 0 0 0 0.25rem rgba(147, 51, 234, 0.5);
    }
    
    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
    }
    
    .text-primary {
        color: #6366f1 !important;
    }
    
    .text-primary:hover {
        color: #4f46e5 !important;
    }
</style>
@endsection