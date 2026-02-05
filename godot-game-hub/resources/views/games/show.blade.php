@extends('layouts.app')

@section('title', $game->title)

@section('content')
<div class="container">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('games.index') }}" class="d-inline-flex align-items-center text-decoration-none text-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Games
        </a>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Game Banner -->
            <div class="card shadow-sm mb-4">
                <div class="position-relative" style="height: 384px; background: linear-gradient(to bottom right, #6366f1, #9333ea);">
                    @if($game->thumbnail)
                    <img src="{{ asset('storage/' . $game->thumbnail) }}" 
                         alt="{{ $game->title }}" 
                         class="w-100 h-100 object-fit-cover">
                    @else
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <i class="fas fa-gamepad text-white" style="font-size: 144px; opacity: 0.3;"></i>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Game Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h1 class="display-5 fw-bold text-dark mb-4">{{ $game->title }}</h1>
                    
                    <div class="d-flex align-items-center gap-4 text-muted small mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user me-2"></i>
                            <span>{{ $game->user->name }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar me-2"></i>
                            <span>{{ $game->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <h2 class="h4 fw-semibold text-dark mb-3">Description</h2>
                    <p class="text-secondary" style="white-space: pre-line; line-height: 1.75;">{{ $game->description }}</p>
                </div>
            </div>

            <!-- Play Button -->
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <a href="{{ route('games.play', $game) }}" 
                       class="btn btn-lg w-100 text-white fw-bold py-3 position-relative overflow-hidden"
                       style="background: linear-gradient(to right, #6366f1, #9333ea); font-size: 1.25rem;">
                        <i class="fas fa-play me-3"></i> Play Now
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Game Stats -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="h5 fw-semibold text-dark mb-4">Game Information</h3>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted">
                                <i class="fas fa-user-circle me-2"></i> Creator
                            </span>
                            <span class="fw-medium text-dark">{{ $game->user->name }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted">
                                <i class="fas fa-calendar-alt me-2"></i> Published
                            </span>
                            <span class="fw-medium text-dark">{{ $game->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted">
                                <i class="fas fa-sync-alt me-2"></i> Updated
                            </span>
                            <span class="fw-medium text-dark">{{ $game->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Management Actions (for owner and admin) -->
            @auth
            @if(auth()->id() === $game->user_id || auth()->user()->isAdmin())
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="h5 fw-semibold text-dark mb-4">Manage Game</h3>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('games.edit', $game) }}" 
                           class="btn btn-warning text-white py-3">
                            <i class="fas fa-edit me-2"></i> Edit Game
                        </a>
                        <form action="{{ route('games.destroy', $game) }}" method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger w-100 py-3" onclick="openDeleteModal()">
                                <i class="bi bi-trash me-2"></i> Delete Game
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endauth

            <!-- Technical Info -->
            <div class="bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded p-4">
                <h4 class="fw-semibold text-primary mb-3">
                    <i class="fas fa-cog"></i> Technical Details
                </h4>
                <div class="small text-primary d-flex flex-column gap-2">
                    <p class="mb-0"><i class="fas fa-globe me-2"></i> Platform: HTML5</p>
                    <p class="mb-0"><i class="fas fa-desktop me-2"></i> Browser playable</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn:hover {
        transform: scale(1.05);
        transition: transform 0.15s ease-in-out;
    }
    
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection