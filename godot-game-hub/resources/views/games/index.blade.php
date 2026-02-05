@extends('layouts.app')

@section('title', 'Browse Games')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(to right, #4f46e5, #7c3aed);
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
    }
    
    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .hero-subtitle {
        font-size: 1.125rem;
        color: #e0e7ff;
        margin-bottom: 1.5rem;
    }
    
    .btn-hero {
        background-color: white;
        color: #4f46e5;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transition: background-color 0.15s ease-in-out;
    }
    
    .btn-hero:hover {
        background-color: #f3f4f6;
        color: #4f46e5;
    }
    
    /* Stats Cards */
    .stat-card {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        padding: 1.5rem;
    }
    
    .stat-card.border-indigo {
        border-left: 4px solid #4f46e5;
    }
    
    .stat-card.border-purple {
        border-left: 4px solid #7c3aed;
    }
    
    .stat-card.border-pink {
        border-left: 4px solid #ec4899;
    }
    
    .stat-icon-wrapper {
        border-radius: 50%;
        padding: 1rem;
        margin-right: 1rem;
    }
    
    .stat-icon-wrapper.bg-indigo {
        background-color: #e0e7ff;
    }
    
    .stat-icon-wrapper.bg-purple {
        background-color: #ede9fe;
    }
    
    .stat-icon-wrapper.bg-pink {
        background-color: #fce7f3;
    }
    
    .stat-icon {
        font-size: 1.5rem;
    }
    
    .stat-icon.text-indigo {
        color: #4f46e5;
    }
    
    .stat-icon.text-purple {
        color: #7c3aed;
    }
    
    .stat-icon.text-pink {
        color: #ec4899;
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
    }
    
    /* Filter Section */
    .filter-section {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .search-input {
        padding-left: 2.5rem;
        padding-right: 1rem;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        border: none;
        transition: all 0.15s ease-in-out;
    }
    
    .filter-btn.active-newest {
        background-color: #4f46e5;
        color: white;
    }
    
    .filter-btn.inactive {
        background-color: #f3f4f6;
        color: #374151;
    }
    
    .filter-btn.inactive:hover {
        background-color: #e5e7eb;
    }
    
    .filter-btn.active-popular {
        background-color: #dc2626;
        color: white;
    }
    
    /* Game Cards */
    .game-card {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }
    
    .game-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-0.5rem);
    }
    
    .game-thumbnail {
        position: relative;
        height: 12rem;
        overflow: hidden;
        background: linear-gradient(to bottom right, #4f46e5, #7c3aed, #ec4899);
    }
    
    .game-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }
    
    .game-card:hover .game-thumbnail img {
        transform: scale(1.1);
    }
    
    .game-thumbnail-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
    
    .game-thumbnail-placeholder i {
        color: white;
        font-size: 4rem;
        opacity: 0.4;
    }
    
    .game-overlay {
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
    }
    
    .game-card:hover .game-overlay {
        background-color: rgba(0, 0, 0, 0.4);
    }
    
    .play-now-btn {
        background-color: white;
        color: #4f46e5;
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease-in-out;
    }
    
    .game-card:hover .play-now-btn {
        opacity: 1;
        transform: scale(1);
    }
    
    .play-now-btn:hover {
        background-color: #4f46e5;
        color: white;
    }
    
    .user-badge {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .new-badge {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        background-color: #10b981;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: .5;
        }
    }
    
    .game-info {
        padding: 1.25rem;
    }
    
    .game-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.15s ease-in-out;
    }
    
    .game-card:hover .game-title {
        color: #4f46e5;
    }
    
    .game-description {
        color: #4b5563;
        font-size: 0.875rem;
        margin-bottom: 1rem;
        line-height: 1.625;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .game-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .btn-play-primary {
        flex: 1;
        background: linear-gradient(to right, #4f46e5, #7c3aed);
        color: white;
        padding: 0.625rem 1rem;
        border-radius: 0.5rem;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.15s ease-in-out;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    .btn-play-primary:hover {
        background: linear-gradient(to right, #4338ca, #6d28d9);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .btn-info {
        background-color: #f3f4f6;
        color: #374151;
        padding: 0.625rem 1rem;
        border-radius: 0.5rem;
        transition: background-color 0.15s ease-in-out;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-info:hover {
        background-color: #e5e7eb;
        color: #374151;
    }
    
    .btn-edit {
        flex: 1;
        background-color: #eab308;
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        text-align: center;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.15s ease-in-out;
    }
    
    .btn-edit:hover {
        background-color: #ca8a04;
        color: white;
    }
    
    .btn-delete {
        width: 100%;
        background-color: #ef4444;
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        border: none;
        transition: background-color 0.15s ease-in-out;
        cursor: pointer;
    }
    
    .btn-delete:hover {
        background-color: #dc2626;
    }
    
    /* Empty State */
    .empty-state {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        padding: 3rem;
        text-align: center;
    }
    
    .empty-icon {
        background-color: #e0e7ff;
        border-radius: 50%;
        width: 6rem;
        height: 6rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .empty-icon i {
        color: #4f46e5;
        font-size: 3rem;
    }
    
    /* CTA Section */
    .cta-section {
        background: linear-gradient(to right, #7c3aed, #ec4899);
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        color: white;
        text-align: center;
    }
    
    .btn-cta-primary {
        background-color: white;
        color: #7c3aed;
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transition: background-color 0.15s ease-in-out;
    }
    
    .btn-cta-primary:hover {
        background-color: #f3f4f6;
        color: #7c3aed;
    }
    
    .btn-cta-secondary {
        background-color: rgba(124, 58, 237, 0.5);
        backdrop-filter: blur(4px);
        color: white;
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.15s ease-in-out;
    }
    
    .btn-cta-secondary:hover {
        background-color: rgba(124, 58, 237, 0.7);
        color: white;
    }
    
    @media (min-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
        }
    }
</style>

<div class="container py-4">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="hero-title">
                    <i class="bi bi-controller me-3"></i>Discover Amazing Games
                </h1>
                <p class="hero-subtitle">
                    Play incredible games, right in your browser. No downloads required!
                </p>
                @auth
                <a href="{{ route('games.create') }}" class="btn-hero">
                    <i class="bi bi-cloud-upload"></i> Upload Your Game
                </a>
                @else
                <a href="{{ route('register') }}" class="btn-hero">
                    <i class="bi bi-person-plus"></i> Join & Share Your Games
                </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="stat-card border-indigo">
                <div class="d-flex align-items-center">
                    <div class="stat-icon-wrapper bg-indigo">
                        <i class="bi bi-controller stat-icon text-indigo"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Total Games</p>
                        <p class="stat-value mb-0">{{ $games->total() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card border-purple">
                <div class="d-flex align-items-center">
                    <div class="stat-icon-wrapper bg-purple">
                        <i class="bi bi-people stat-icon text-purple"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">Developers</p>
                        <p class="stat-value mb-0">{{ App\Models\User::count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card border-pink">
                <div class="d-flex align-items-center">
                    <div class="stat-icon-wrapper bg-pink">
                        <i class="bi bi-fire stat-icon text-pink"></i>
                    </div>
                    <div>
                        <p class="stat-label mb-0">New This Week</p>
                        <p class="stat-value mb-0">{{ App\Models\Game::where('created_at', '>=', now()->subWeek())->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="filter-section">
        <div class="row align-items-center g-3">
            <div class="col-12 col-md-6">
                <h2 class="h4 fw-bold text-dark mb-1">
                    <i class="bi bi-grid-3x3-gap me-2"></i>All Games
                </h2>
                <p class="text-muted mb-0">
                    Showing {{ $games->count() }} of {{ $games->total() }} games
                </p>
            </div>

            <!-- SEARCH + FILTER -->
            <div class="col-12 col-md-6">
                <form method="GET" action="{{ route('games.index') }}" class="d-flex flex-wrap gap-2 justify-content-md-end">
                    {{-- Search --}}
                    <div class="position-relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search games..."
                            class="form-control search-input"
                        >
                        <i class="bi bi-search search-icon"></i>
                    </div>

                    {{-- Filter --}}
                    <input type="hidden" name="filter" value="{{ $filter }}">

                    <button
                        name="filter"
                        value="newest"
                        class="btn filter-btn {{ $filter === 'newest' ? 'active-newest' : 'inactive' }}">
                        <i class="bi bi-clock me-1"></i> Newest
                    </button>

                    <button
                        name="filter"
                        value="popular"
                        class="btn filter-btn {{ $filter === 'popular' ? 'active-popular' : 'inactive' }}">
                        <i class="bi bi-fire me-1"></i> Popular
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Games Grid -->
    @if($games->count() > 0)
    <div class="row g-4 mb-4">
        @foreach($games as $game)
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="game-card">
                <!-- Game Thumbnail -->
                <div class="game-thumbnail">
                    @if($game->thumbnail)
                    <img src="{{ asset('storage/' . $game->thumbnail) }}" alt="{{ $game->title }}">
                    @else
                    <div class="game-thumbnail-placeholder">
                        <i class="bi bi-controller"></i>
                    </div>
                    @endif
                    
                    <!-- Overlay on hover -->
                    <div class="game-overlay">
                        <a href="{{ route('games.play', $game) }}" class="play-now-btn">
                            <i class="bi bi-play-fill me-2"></i> Play Now
                        </a>
                    </div>
                    
                    <!-- User Badge -->
                    <div class="user-badge">
                        <i class="bi bi-person me-1"></i> {{ $game->user->name }}
                    </div>

                    <!-- New Badge -->
                    @if($game->created_at->diffInDays(now()) < 7)
                    <div class="new-badge">
                        <i class="bi bi-star-fill me-1"></i> NEW
                    </div>
                    @endif
                </div>

                <!-- Game Info -->
                <div class="game-info">
                    <h3 class="game-title">{{ $game->title }}</h3>
                    <p class="game-description">
                        {{ Str::limit($game->description, 100) }}
                    </p>
                    
                    <div class="game-meta">
                        <span class="d-flex align-items-center">
                            <i class="bi bi-calendar me-1"></i> 
                            {{ $game->created_at->diffForHumans() }}
                        </span>
                        <span class="d-flex align-items-center">
                            <i class="bi bi-eye me-1"></i> 
                            {{ rand(100, 999) }} views
                        </span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 mb-0">
                        <a href="{{ route('games.play', $game) }}" class="btn-play-primary">
                            <i class="bi bi-play-fill me-1"></i> Play
                        </a>
                        <a href="{{ route('games.show', $game) }}" class="btn-info"> Show Game
                            <i class="bi bi-info-circle"></i>
                        </a>
                    </div>

                    <!-- Edit/Delete for owners and admins -->
                    @auth
                    @if(auth()->id() === $game->user_id || auth()->user()->isAdmin())
                    <div class="d-flex gap-2 mt-3 pt-3" style="border-top: 1px solid #f3f4f6;">
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
                    @endif
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state">
        <div class="empty-icon">
            <i class="bi bi-controller"></i>
        </div>
        <h3 class="h4 fw-bold text-dark mb-3">No Games Yet</h3>
        <p class="text-muted mb-4">Be the first to share your amazing game with the community!</p>
        @auth
        <a href="{{ route('games.create') }}" class="btn-cta-primary">
            <i class="bi bi-cloud-upload"></i> Upload First Game
        </a>
        @else
        <div>
            <a href="{{ route('register') }}" class="btn-cta-primary mb-3">
                <i class="bi bi-person-plus"></i> Create Account
            </a>
            <p class="small text-muted">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-decoration-none" style="color: #4f46e5; font-weight: 500;">Sign in</a>
            </p>
        </div>
        @endauth
    </div>
    @endif

    <!-- Pagination -->
    @if($games->hasPages())
    <div class="mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                {{ $games->links() }}
            </div>
        </div>
    </div>
    @endif

    <!-- Call to Action -->
    @guest
    <div class="cta-section">
        <h2 class="h3 fw-bold mb-3">Ready to Share Your Game?</h2>
        <p class="fs-6 mb-4" style="color: #ede9fe; max-width: 42rem; margin-left: auto; margin-right: auto;">
            Join our community of game developers. Upload your games and let players enjoy them instantly in their browsers!
        </p>
        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
            <a href="{{ route('register') }}" class="btn-cta-primary">
                <i class="bi bi-person-plus"></i> Create Free Account
            </a>
            <a href="{{ route('login') }}" class="btn-cta-secondary">
                <i class="bi bi-box-arrow-in-right"></i> Sign In
            </a>
        </div>
    </div>
    @endguest
</div>
@endsection