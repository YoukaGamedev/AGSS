@extends('layouts.app')

@section('title', 'Edit Game')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('games.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to Games
        </a>

        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
            <h1 class="text-4xl font-bold mb-3">
                <i class="fas fa-edit mr-3"></i>Edit Game
            </h1>
            <p class="text-lg text-indigo-100">
                Update your game information or replace assets if needed.
            </p>
        </div>
    </div>

    <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data" id="gameEditForm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Info -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-info-circle text-indigo-600 mr-3"></i>
                        Game Information
                    </h2>

                    <!-- Title -->
                    <div class="mb-6">
                        <label class="block font-semibold mb-2">Game Title *</label>
                        <input type="text" name="title" required
                            value="{{ old('title', $game->title) }}"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label class="block font-semibold mb-2">Description *</label>
                        <textarea name="description" rows="6" required
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('description', $game->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-image text-purple-600 mr-3"></i>
                        Game Thumbnail
                    </h2>

                    @if($game->thumbnail)
                        <div class="mb-4">
                            <p class="text-sm font-semibold mb-2">Current Thumbnail</p>
                            <img src="{{ asset('storage/'.$game->thumbnail) }}"
                                 class="w-64 rounded-lg shadow">
                        </div>
                    @endif

                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full border rounded px-3 py-2">
                    <p class="text-xs text-gray-500 mt-1">
                        Leave empty if you don't want to change it.
                    </p>

                    @error('thumbnail')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ZIP -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-file-archive text-green-600 mr-3"></i>
                        Game Files
                    </h2>

                    <input type="file" name="zip_file" accept=".zip"
                        class="w-full border rounded px-3 py-2">

                    <p class="text-xs text-gray-500 mt-2">
                        Upload only if you want to replace the game files.
                    </p>

                    @error('zip_file')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-lg font-bold hover:shadow-xl mb-3">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>

                    <a href="{{ route('games.index') }}"
                        class="block text-center bg-gray-200 py-3 rounded-lg font-semibold">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.getElementById('gameEditForm').addEventListener('submit', function () {
    const btn = this.querySelector('button[type=submit]');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
});
</script>
@endsection
