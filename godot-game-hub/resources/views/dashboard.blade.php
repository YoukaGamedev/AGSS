@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="mt-2 text-gray-600">Manage your games and explore new content</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-indigo-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Games</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalGames }}</p>
                </div>
                <div class="bg-indigo-100 rounded-full p-3">
                    <i class="fas fa-gamepad text-indigo-600 text-2xl"></i>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-users text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">My Games</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $myGames }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-star text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('games.create') }}" 
               class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition duration-150">
                <div class="bg-indigo-600 rounded-full p-3 mr-4">
                    <i class="fas fa-upload text-white"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Upload Game</p>
                    <p class="text-sm text-gray-600">Add a new game</p>
                </div>
            </a>

            <a href="{{ route('home') }}" 
               class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-150">
                <div class="bg-green-600 rounded-full p-3 mr-4">
                    <i class="fas fa-th text-white"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Browse Games</p>
                    <p class="text-sm text-gray-600">Explore all games</p>
                </div>
            </a>

            @if(auth()->user()->isAdmin())
            <a href="{{ route('users.index') }}" 
               class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-150">
                <div class="bg-purple-600 rounded-full p-3 mr-4">
                    <i class="fas fa-users-cog text-white"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Manage Users</p>
                    <p class="text-sm text-gray-600">User management</p>
                </div>
            </a>
            @endif
        </div>
    </div>

    <!-- Recent Games -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Games</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Game</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentGames as $game)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($game->thumbnail)
                                    <img class="h-10 w-10 rounded object-cover" src="{{ asset('storage/' . $game->thumbnail) }}" alt="{{ $game->title }}">
                                    @else
                                    <div class="h-10 w-10 rounded bg-indigo-100 flex items-center justify-center">
                                        <i class="fas fa-gamepad text-indigo-600"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $game->title }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $game->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $game->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('games.play', $game) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fas fa-play"></i> Play
                            </a>
                            <a href="{{ route('games.show', $game) }}" class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-info-circle"></i> Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No games uploaded yet
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection