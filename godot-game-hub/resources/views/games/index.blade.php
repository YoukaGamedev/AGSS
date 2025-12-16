@extends('layouts.app')

@section('title', 'Browse Games')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                <i class="fas fa-gamepad mr-3"></i>Discover Amazing Games
            </h1>
            <p class="text-lg md:text-xl text-indigo-100 mb-6">
                Play incredible games, right in your browser. No downloads required!
            </p>
            @auth
            <a href="{{ route('games.create') }}" 
               class="inline-flex items-center bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-150 shadow-lg">
                <i class="fas fa-upload mr-2"></i> Upload Your Game
            </a>
            @else
            <a href="{{ route('register') }}" 
               class="inline-flex items-center bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-150 shadow-lg">
                <i class="fas fa-user-plus mr-2"></i> Join & Share Your Games
            </a>
            @endauth
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
            <div class="flex items-center">
                <div class="bg-indigo-100 rounded-full p-4 mr-4">
                    <i class="fas fa-gamepad text-indigo-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Games</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $games->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="bg-purple-100 rounded-full p-4 mr-4">
                    <i class="fas fa-users text-purple-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Developers</p>
                    <p class="text-3xl font-bold text-gray-900">{{ App\Models\User::count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-pink-500">
            <div class="flex items-center">
                <div class="bg-pink-100 rounded-full p-4 mr-4">
                    <i class="fas fa-fire text-pink-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">New This Week</p>
                    <p class="text-3xl font-bold text-gray-900">{{ App\Models\Game::where('created_at', '>=', now()->subWeek())->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-th-large mr-2"></i>All Games
                </h2>
                <p class="text-gray-600 mt-1">
                    Showing {{ $games->count() }} of {{ $games->total() }} games
                </p>
            </div>

            <!-- SEARCH + FILTER -->
            <form method="GET" action="{{ route('games.index') }}" class="flex flex-wrap gap-3">
                {{-- Search --}}
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search games..."
                        class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    >
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>

                {{-- Filter --}}
                <input type="hidden" name="filter" value="{{ $filter }}">

                <button
                    name="filter"
                    value="newest"
                    class="px-4 py-2 rounded-lg font-medium transition duration-150
                    {{ $filter === 'newest' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-clock mr-2"></i> Newest
                </button>

                <button
                    name="filter"
                    value="popular"
                    class="px-4 py-2 rounded-lg font-medium transition duration-150
                    {{ $filter === 'popular' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-fire mr-2"></i> Popular
                </button>
            </form>
        </div>
    </div>

    <!-- Games Grid -->
    @if($games->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @foreach($games as $game)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
            <!-- Game Thumbnail -->
            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
                @if($game->thumbnail)
                <img src="{{ asset('storage/' . $game->thumbnail) }}" 
                     alt="{{ $game->title }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                @else
                <div class="flex items-center justify-center h-full">
                    <i class="fas fa-gamepad text-white text-6xl opacity-40"></i>
                </div>
                @endif
                
                <!-- Overlay on hover -->
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <a href="{{ route('games.play', $game) }}" 
                       class="opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300 bg-white text-indigo-600 px-6 py-3 rounded-full font-bold shadow-lg hover:bg-indigo-600 hover:text-white">
                        <i class="fas fa-play mr-2"></i> Play Now
                    </a>
                </div>
                
                <!-- User Badge -->
                <div class="absolute top-3 right-3">
                    <span class="bg-black bg-opacity-60 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-user mr-1"></i> {{ $game->user->name }}
                    </span>
                </div>

                <!-- New Badge -->
                @if($game->created_at->diffInDays(now()) < 7)
                <div class="absolute top-3 left-3">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                        <i class="fas fa-star mr-1"></i> NEW
                    </span>
                </div>
                @endif
            </div>

            <!-- Game Info -->
            <div class="p-5">
                <h3 class="text-xl font-bold text-gray-900 mb-2 truncate group-hover:text-indigo-600 transition-colors duration-150">
                    {{ $game->title }}
                </h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                    {{ Str::limit($game->description, 100) }}
                </p>
                
                <div class="flex items-center justify-between text-xs text-gray-500 mb-4 pb-4 border-b border-gray-100">
                    <span class="flex items-center">
                        <i class="fas fa-calendar mr-1"></i> 
                        {{ $game->created_at->diffForHumans() }}
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-eye mr-1"></i> 
                        {{ rand(100, 999) }} views
                    </span>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('games.play', $game) }}" 
                       class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2.5 rounded-lg text-center font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-150 shadow-md hover:shadow-lg">
                        <i class="fas fa-play mr-1"></i> Play
                    </a>
                    <a href="{{ route('games.show', $game) }}" 
                       class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-200 transition duration-150 flex items-center justify-center">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </div>

                <!-- Edit/Delete for owners and admins -->
                @auth
                @if(auth()->id() === $game->user_id || auth()->user()->isAdmin())
                <div class="flex gap-2 mt-3 pt-3 border-t border-gray-100">
                    <a href="{{ route('games.edit', $game) }}" 
                       class="flex-1 bg-yellow-500 text-white px-3 py-2 rounded-lg text-sm text-center font-medium hover:bg-yellow-600 transition duration-150">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('games.destroy', $game) }}" method="POST" class="flex-1"
                          onsubmit="return confirm('Are you sure you want to delete this game? This cannot be undone!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-500 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition duration-150">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </form>
                </div>
                @endif
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-xl shadow-md p-12 text-center">
        <div class="max-w-md mx-auto">
            <div class="bg-indigo-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-gamepad text-indigo-600 text-5xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">No Games Yet</h3>
            <p class="text-gray-600 mb-6">Be the first to share your amazing game with the community!</p>
            @auth
            <a href="{{ route('games.create') }}" 
               class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition duration-150 shadow-lg">
                <i class="fas fa-upload mr-2"></i> Upload First Game
            </a>
            @else
            <div class="space-y-3">
                <a href="{{ route('register') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition duration-150 shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i> Create Account
                </a>
                <p class="text-sm text-gray-500">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Sign in</a>
                </p>
            </div>
            @endauth
        </div>
    </div>
    @endif

    <!-- Pagination -->
    @if($games->hasPages())
    <div class="mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            {{ $games->links() }}
        </div>
    </div>
    @endif

    <!-- Call to Action -->
    @guest
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl shadow-xl p-8 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Share Your Game?</h2>
        <p class="text-lg text-purple-100 mb-6 max-w-2xl mx-auto">
            Join our community of game developers. Upload your games and let players enjoy them instantly in their browsers!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="inline-flex items-center justify-center bg-white text-purple-600 px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition duration-150 shadow-lg">
                <i class="fas fa-user-plus mr-2"></i> Create Free Account
            </a>
            <a href="{{ route('login') }}" 
               class="inline-flex items-center justify-center bg-purple-700 bg-opacity-50 backdrop-blur-sm text-white px-8 py-4 rounded-lg font-bold hover:bg-opacity-70 transition duration-150 border-2 border-white border-opacity-30">
                <i class="fas fa-sign-in-alt mr-2"></i> Sign In
            </a>
        </div>
    </div>
    @endguest
</div>
@endsection