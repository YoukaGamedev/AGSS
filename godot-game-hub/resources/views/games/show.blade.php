@extends('layouts.app')

@section('title', $game->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('games.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700">
            <i class="fas fa-arrow-left mr-2"></i> Back to Games
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Game Banner -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="relative h-96 bg-gradient-to-br from-indigo-500 to-purple-600">
                    @if($game->thumbnail)
                    <img src="{{ asset('storage/' . $game->thumbnail) }}" 
                         alt="{{ $game->title }}" 
                         class="w-full h-full object-cover">
                    @else
                    <div class="flex items-center justify-center h-full">
                        <i class="fas fa-gamepad text-white text-9xl opacity-30"></i>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Game Info -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $game->title }}</h1>
                
                <div class="flex items-center space-x-6 text-sm text-gray-600 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span>{{ $game->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>{{ $game->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-900 mb-3">Description</h2>
                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $game->description }}</p>
            </div>

            <!-- Play Button -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <a href="{{ route('games.play', $game) }}" 
                   class="block w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center px-8 py-4 rounded-lg text-xl font-bold hover:from-indigo-700 hover:to-purple-700 transition duration-150 transform hover:scale-105">
                    <i class="fas fa-play mr-3"></i> Play Now
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Game Stats -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Game Information</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">
                            <i class="fas fa-user-circle mr-2"></i> Creator
                        </span>
                        <span class="font-medium text-gray-900">{{ $game->user->name }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">
                            <i class="fas fa-calendar-alt mr-2"></i> Published
                        </span>
                        <span class="font-medium text-gray-900">{{ $game->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">
                            <i class="fas fa-sync-alt mr-2"></i> Updated
                        </span>
                        <span class="font-medium text-gray-900">{{ $game->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Management Actions (for owner and admin) -->
            @auth
            @if(auth()->id() === $game->user_id || auth()->user()->isAdmin())
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Manage Game</h3>
                <div class="space-y-3">
                    <a href="{{ route('games.edit', $game) }}" 
                       class="block w-full bg-yellow-500 text-white text-center px-4 py-3 rounded-lg hover:bg-yellow-600 transition duration-150">
                        <i class="fas fa-edit mr-2"></i> Edit Game
                    </a>
                    <form action="{{ route('games.destroy', $game) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this game? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600 transition duration-150">
                            <i class="fas fa-trash mr-2"></i> Delete Game
                        </button>
                    </form>
                </div>
            </div>
            @endif
            @endauth

            <!-- Technical Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="font-semibold text-blue-900 mb-3">
                    <i class="fas fa-cog"></i> Technical Details
                </h4>
                <div class="text-sm text-blue-800 space-y-2">
                    <p><i class="fas fa-globe mr-2"></i> Platform: HTML5</p>
                    <p><i class="fas fa-desktop mr-2"></i> Browser playable</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection