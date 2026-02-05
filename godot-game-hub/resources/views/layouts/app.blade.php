<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Youka Game Station')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/YoukaGamedev.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/YoukaGamedev.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f9fafb;
        }
        
        /* Navbar Styles */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .navbar-brand .gamepad-icon {
            color: #4f46e5;
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }
        
        .navbar-brand .brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
        }
        
        .nav-link {
            color: #374151 !important;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem !important;
        }
        
        .nav-link:hover {
            color: #4f46e5 !important;
        }
        
        .btn-register {
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
        }
        
        .btn-register:hover {
            background-color: #4338ca;
            color: white;
        }
        
        .user-dropdown {
            position: relative;
        }
        
        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #374151;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }
        
        .user-dropdown-btn:hover {
            color: #4f46e5;
        }
        
        .user-dropdown-btn .user-icon {
            font-size: 1.5rem;
        }
        
        .user-dropdown-btn .user-name {
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .user-dropdown-btn .chevron {
            font-size: 0.75rem;
        }
        
        .dropdown-menu-custom {
            min-width: 12rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
        }
        
        .dropdown-item {
            font-size: 0.875rem;
            color: #374151;
            padding: 0.5rem 1rem;
        }
        
        .dropdown-item:hover {
            background-color: #eef2ff;
            color: #4f46e5;
        }
        
        .dropdown-item i {
            margin-right: 0.5rem;
        }
        
        .dropdown-item.text-danger:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }
        
        .dropdown-divider {
            margin: 0.5rem 0;
        }
        
        /* Alert Styles */
        .alert-success-custom {
            background-color: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #047857;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
        }
        
        .alert-danger-custom {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
        }
        
        /* Footer Styles */
        footer {
            background-color: #1f2937;
            color: white;
            margin-top: 4rem;
        }
        
        footer .container {
            padding: 1rem 0;
        }
        
        footer p {
            margin: 0;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: 0.25s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-box {
            background: #fff;
            border-radius: 14px;
            padding: 28px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            transform: scale(0.9);
            transition: 0.25s ease;
        }

        .modal-overlay.show .modal-box {
            transform: scale(1);
        }

        .modal-icon {
            font-size: 48px;
            color: #dc3545;
            margin-bottom: 12px;
        }

        .modal-box h3 {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .modal-box p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 22px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }

        .modal-actions button {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-cancel {
            background: #e9ecef;
            color: #333;
        }

        .btn-cancel:hover {
            background: #dee2e6;
        }

        .btn-delete {
            background: #dc3545;
            color: #fff;
        }

        .btn-delete:hover {
            background: #bb2d3b;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('assets/img/YoukaGamedev.png') }}" alt="Youka Gamedev" style="width: 40px;">
                <!-- <span class="brand-text">AGS</span> -->
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Browse Games</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    @endauth
                </ul>
                
                <div class="d-flex align-items-center">
                    @guest
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-register ms-3">Register</a>
                    @else
                    <div class="dropdown user-dropdown">
                        <button class="user-dropdown-btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle user-icon"></i>
                            <span class="user-name">{{ auth()->user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('games.create') }}">
                                    <i class="bi bi-cloud-upload"></i> Upload Game
                                </a>
                            </li>
                            @if(auth()->user()->isAdmin())
                            <li>
                                <a class="dropdown-item" href="{{ route('users.index') }}">
                                    <i class="bi bi-people"></i> Manage Users
                                </a>
                            </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="container mt-4">
        <div class="alert alert-success-custom alert-dismissible fade show" role="alert">
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="container mt-4">
        <div class="alert alert-danger-custom alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <div id="deleteModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>

            <h3>Delete It?</h3>
            <p>
                This action <strong>cannot be undone</strong>.<br>
                this data and all files will be permanently deleted.
            </p>

            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <button class="btn-delete" onclick="submitDelete()">Yes, Delete</button>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="text-center">
                <p>&copy; 2027 AGS. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
    }

    function submitDelete() {
        document.getElementById('deleteForm').submit();
    }
    </script>

</body>
</html>