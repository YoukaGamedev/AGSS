@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Stats Cards */
    .stat-card {
        background-color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        padding: 1.5rem;
    }
    
    .stat-card.border-indigo {
        border-left: 4px solid #4f46e5;
    }
    
    .stat-card.border-green {
        border-left: 4px solid #059669;
    }
    
    .stat-card.border-purple {
        border-left: 4px solid #7c3aed;
    }
    
    .stat-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #4b5563;
    }
    
    .stat-value {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
        margin-top: 0.5rem;
    }
    
    .stat-icon-wrapper {
        border-radius: 50%;
        padding: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-icon-wrapper.bg-indigo {
        background-color: #e0e7ff;
    }
    
    .stat-icon-wrapper.bg-green {
        background-color: #d1fae5;
    }
    
    .stat-icon-wrapper.bg-purple {
        background-color: #ede9fe;
    }
    
    .stat-icon {
        font-size: 1.5rem;
    }
    
    .stat-icon.text-indigo {
        color: #4f46e5;
    }
    
    .stat-icon.text-green {
        color: #059669;
    }
    
    .stat-icon.text-purple {
        color: #7c3aed;
    }
    
    /* Quick Actions */
    .quick-action-card {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: 0.5rem;
        transition: all 0.15s ease-in-out;
        text-decoration: none;
    }
    
    .quick-action-card.bg-indigo-light {
        background-color: #eef2ff;
    }
    
    .quick-action-card.bg-indigo-light:hover {
        background-color: #e0e7ff;
    }
    
    .quick-action-card.bg-green-light {
        background-color: #d1fae5;
    }
    
    .quick-action-card.bg-green-light:hover {
        background-color: #a7f3d0;
    }
    
    .quick-action-card.bg-purple-light {
        background-color: #f3e8ff;
    }
    
    .quick-action-card.bg-purple-light:hover {
        background-color: #e9d5ff;
    }
    
    .quick-action-icon {
        border-radius: 50%;
        padding: 0.75rem;
        margin-right: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .quick-action-icon.bg-indigo-solid {
        background-color: #4f46e5;
    }
    
    .quick-action-icon.bg-green-solid {
        background-color: #059669;
    }
    
    .quick-action-icon.bg-purple-solid {
        background-color: #7c3aed;
    }
    
    .quick-action-icon i {
        color: white;
    }
    
    .quick-action-title {
        font-weight: 600;
        color: #111827;
        margin-bottom: 0;
    }
    
    .quick-action-desc {
        font-size: 0.875rem;
        color: #4b5563;
        margin-bottom: 0;
    }
    
    /* Table Styles */
    .table-custom {
        margin-bottom: 0;
    }
    
    .table-custom thead {
        background-color: #f9fafb;
    }
    
    .table-custom th {
        padding: 0.75rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .table-custom td {
        padding: 1rem 1.5rem;
        white-space: nowrap;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .game-thumbnail {
        height: 2.5rem;
        width: 2.5rem;
        border-radius: 0.25rem;
        object-fit: cover;
    }
    
    .game-thumbnail-placeholder {
        height: 2.5rem;
        width: 2.5rem;
        border-radius: 0.25rem;
        background-color: #e0e7ff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .game-thumbnail-placeholder i {
        color: #4f46e5;
    }
    
    .game-title {
        font-size: 0.875rem;
        font-weight: 500;
        color: #111827;
        margin-bottom: 0;
    }
    
    .table-text-sm {
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .action-link {
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        margin-right: 0.75rem;
    }
    
    .action-link.text-indigo {
        color: #4f46e5;
    }
    
    .action-link.text-indigo:hover {
        color: #4338ca;
    }
    
    .action-link.text-gray {
        color: #4b5563;
    }
    
    .action-link.text-gray:hover {
        color: #111827;
    }
</style>

<div class="container py-4">
    <div class="mb-4">
        <h1 class="display-6 fw-bold text-dark">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-muted mt-2">Manage your games and explore new content</p>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="stat-card border-indigo">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label">Total Games</p>
                        <p class="stat-value">{{ $totalGames }}</p>
                    </div>
                    <div class="stat-icon-wrapper bg-indigo">
                        <i class="fas fa-gamepad stat-icon text-indigo"></i>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
        <div class="col-12 col-md-4">
            <div class="stat-card border-green">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label">Total Users</p>
                        <p class="stat-value">{{ $totalUsers }}</p>
                    </div>
                    <div class="stat-icon-wrapper bg-green">
                        <i class="fas fa-users stat-icon text-green"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-12 col-md-4">
            <div class="stat-card border-purple">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label">My Games</p>
                        <p class="stat-value">{{ $myGames }}</p>
                    </div>
                    <div class="stat-icon-wrapper bg-purple">
                        <i class="fas fa-star stat-icon text-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="h5 fw-bold text-dark mb-4">Quick Actions</h2>
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <a href="{{ route('games.create') }}" class="quick-action-card bg-indigo-light">
                        <div class="quick-action-icon bg-indigo-solid">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div>
                            <p class="quick-action-title">Upload Game</p>
                            <p class="quick-action-desc">Add a new game</p>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md-4">
                    <a href="{{ route('home') }}" class="quick-action-card bg-green-light">
                        <div class="quick-action-icon bg-green-solid">
                            <i class="fas fa-th"></i>
                        </div>
                        <div>
                            <p class="quick-action-title">Browse Games</p>
                            <p class="quick-action-desc">Explore all games</p>
                        </div>
                    </a>
                </div>

                @if(auth()->user()->isAdmin())
                <div class="col-12 col-md-4">
                    <a href="{{ route('users.index') }}" class="quick-action-card bg-purple-light">
                        <div class="quick-action-icon bg-purple-solid">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div>
                            <p class="quick-action-title">Manage Users</p>
                            <p class="quick-action-desc">User management</p>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Games -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="h5 fw-bold text-dark mb-4">Recent Games</h2>
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>Game</th>
                            <th>Uploaded By</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentGames as $game)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        @if($game->thumbnail)
                                        <img class="game-thumbnail" src="{{ asset('storage/' . $game->thumbnail) }}" alt="{{ $game->title }}">
                                        @else
                                        <div class="game-thumbnail-placeholder">
                                            <i class="fas fa-gamepad"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        <p class="game-title">{{ $game->title }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="table-text-sm">
                                {{ $game->user->name }}
                            </td>
                            <td class="table-text-sm">
                                {{ $game->created_at->diffForHumans() }}
                            </td>
                            <td>
                                <a href="{{ route('games.play', $game) }}" class="action-link text-indigo">
                                    <i class="fas fa-play"></i> Play
                                </a>
                                <a href="{{ route('games.show', $game) }}" class="action-link text-gray">
                                    <i class="fas fa-info-circle"></i> Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No games uploaded yet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection