@extends('layouts.app')

@section('title', 'Play ' . $game->title)

@section('content')
<style>
    /* Back Link */
    .back-link {
        color: #4f46e5;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.15s ease-in-out;
    }
    
    .back-link:hover {
        color: #4338ca;
    }
    
    /* Game Container */
    .game-wrapper {
        background-color: #111827;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    /* Fullscreen Button */
    .fullscreen-btn {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        border: none;
        transition: background-color 0.15s ease-in-out;
        cursor: pointer;
    }
    
    .fullscreen-btn:hover {
        background-color: rgba(0, 0, 0, 0.9);
    }
    
    /* Game Container */
    #gameContainer {
        position: relative;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        max-width: 56rem;
        height: 450px;
    }
    
    #gameIframe {
        width: 100%;
        height: 100%;
        border: 0;
    }
    
    /* Error State */
    .game-error {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .error-content {
        text-align: center;
    }
    
    .error-icon {
        color: #eab308;
        font-size: 4rem;
        margin-bottom: 1rem;
    }
    
    .error-title {
        color: white;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    
    .error-text {
        color: #9ca3af;
        margin-top: 0.5rem;
    }
    
    /* Title Card */
    .title-card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .game-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.5rem;
    }
    
    .game-author {
        color: #4b5563;
    }
    
    /* Controls Info Card */
    .controls-card {
        background-color: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-top: 1.5rem;
    }
    
    .controls-title {
        font-weight: 600;
        color: #1e3a8a;
        margin-bottom: 0.5rem;
    }
    
    .controls-list {
        font-size: 0.875rem;
        color: #1e40af;
        margin: 0;
        padding: 0;
    }
    
    .controls-list p {
        margin: 0.25rem 0;
    }
    
    /* About Card */
    .about-card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .about-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
    }
    
    .about-text {
        color: #374151;
        white-space: pre-line;
    }
    
    /* Action Buttons */
    .btn-primary-action {
        background-color: #4f46e5;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.15s ease-in-out;
    }
    
    .btn-primary-action:hover {
        background-color: #4338ca;
        color: white;
    }
    
    .btn-secondary-action {
        background-color: #e5e7eb;
        color: #374151;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.15s ease-in-out;
    }
    
    .btn-secondary-action:hover {
        background-color: #d1d5db;
        color: #374151;
    }
</style>

<div class="container py-4">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('games.show', $game) }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Game Details
        </a>
    </div>

    <!-- Game Container -->
    <div class="game-wrapper">
        <!-- Fullscreen Button -->
        <button 
            onclick="toggleFullscreen()"
            class="fullscreen-btn"
            title="Fullscreen">
            <i class="bi bi-arrows-fullscreen"></i>
        </button>

        <div id="gameContainer">
            @if($game->html_file)
            <iframe 
                id="gameIframe"
                src="{{ asset('storage/' . $game->html_file) }}"
                allowfullscreen
                allow="autoplay; fullscreen; gamepad; accelerometer; gyroscope">
            </iframe>
            @else
            <div class="game-error">
                <div class="error-content">
                    <i class="bi bi-exclamation-triangle error-icon"></i>
                    <p class="error-title mb-0">Game file not found</p>
                    <p class="error-text mb-0">The game may not have been extracted properly</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Game Title -->
    <div class="title-card">
        <h1 class="game-title mb-2">{{ $game->title }}</h1>
        <p class="game-author mb-0">by {{ $game->user->name }}</p>
    </div>

    <!-- Game Controls Info -->
    <div class="controls-card">
        <h3 class="controls-title">
            <i class="bi bi-controller"></i> Game Controls
        </h3>
        <div class="controls-list">
            <p>• Use your keyboard and mouse to play</p>
            <p>• Press the fullscreen icon in the game panel for fullscreen mode (browser dependent)</p>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="about-card">
        <h2 class="about-title">About This Game</h2>
        <p class="about-text">{{ $game->description }}</p>
        
        <div class="mt-4 d-flex flex-wrap gap-3">
            <a href="{{ route('games.show', $game) }}" class="btn-primary-action">
                <i class="bi bi-info-circle"></i> View Details
            </a>
            <a href="{{ route('games.index') }}" class="btn-secondary-action">
                <i class="bi bi-grid-3x3-gap"></i> Browse More Games
            </a>
        </div>
    </div>
</div>

<script>
function toggleFullscreen() {
    const elem = document.getElementById("gameContainer");

    if (!document.fullscreenElement) {
        elem.requestFullscreen().catch(err => {
            alert(`Error attempting fullscreen: ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
}
</script>

@endsection