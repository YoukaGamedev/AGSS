@extends('layouts.app')

@section('title', 'Play ' . $game->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('games.show', $game) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700">
            <i class="fas fa-arrow-left mr-2"></i> Back to Game Details
        </a>
    </div>

    <!-- Game Container -->
    <div class="bg-gray-900 rounded-lg shadow-xl overflow-hidden relative">

        <!-- Fullscreen Button -->
        <button 
            onclick="toggleFullscreen()"
            class="absolute top-3 right-3 z-10 bg-black/70 text-white px-3 py-2 rounded-lg hover:bg-black transition"
            title="Fullscreen">
            <i class="fas fa-expand"></i>
        </button>

        <div id="gameContainer" class="relative mx-auto w-full max-w-4xl h-[450px]">
            @if($game->html_file)
            <iframe 
                id="gameIframe"
                src="{{ asset('storage/' . $game->html_file) }}"
                class="w-full h-full border-0"
                allowfullscreen
                allow="autoplay; fullscreen; gamepad; accelerometer; gyroscope">
            </iframe>
            @else
            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-6xl mb-4"></i>
                    <p class="text-white text-xl">Game file not found</p>
                    <p class="text-gray-400 mt-2">The game may not have been extracted properly</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Game Title -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <h1 class="text-3xl font-bold text-gray-900">{{ $game->title }}</h1>
        <p class="text-gray-600 mt-2">by {{ $game->user->name }}</p>
    </div>

    <!-- Game Controls Info -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
        <h3 class="font-semibold text-blue-900 mb-2">
            <i class="fas fa-gamepad"></i> Game Controls
        </h3>
        <div class="text-sm text-blue-800">
            <p>• Use your keyboard and mouse to play</p>
            <p>• Press the fullscren icon in the game panel for fullscreen mode (browser dependent)</p>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">About This Game</h2>
        <p class="text-gray-700 whitespace-pre-line">{{ $game->description }}</p>
        
        <div class="mt-6 flex gap-4">
            <a href="{{ route('games.show', $game) }}" 
               class="inline-flex items-center bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-150">
                <i class="fas fa-info-circle mr-2"></i> View Details
            </a>
            <a href="{{ route('games.index') }}" 
               class="inline-flex items-center bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-150">
                <i class="fas fa-th mr-2"></i> Browse More Games
            </a>
        </div>
    </div>
</div>
@endsection

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
