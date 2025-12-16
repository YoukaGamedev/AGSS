@extends('layouts.app')

@section('title', 'Upload Game')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8">
        <a href="{{ route('games.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 mb-4 transition duration-150">
            <i class="fas fa-arrow-left mr-2"></i> Back to Games
        </a>
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
            <h1 class="text-4xl font-bold mb-3">
                <i class="fas fa-upload mr-3"></i>Upload Your Game
            </h1>
            <p class="text-lg text-indigo-100">
                Share your amazing Godot game with the community. Let players enjoy your creation instantly in their browsers!
            </p>
        </div>
    </div>

    <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data" id="gameUploadForm">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Game Information Card -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-indigo-600 mr-3"></i>
                        Game Information
                    </h2>

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Game Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" required
                               value="{{ old('title') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                               placeholder="Enter an awesome title for your game">
                        @error('title')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150 resize-none"
                                  placeholder="Describe your game: What's it about? How to play? What makes it special?">{{ old('description') }}</textarea>
                        <p class="mt-2 text-xs text-gray-500">
                            <i class="fas fa-lightbulb mr-1"></i> 
                            Tip: Include gameplay instructions and what makes your game unique!
                        </p>
                        @error('description')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Upload Card -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-image text-purple-600 mr-3"></i>
                        Game Thumbnail
                    </h2>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Upload Thumbnail <span class="text-gray-500 font-normal">(Optional but recommended)</span>
                        </label>
                        
                        <div class="flex flex-col md:flex-row gap-4">
                            <!-- Upload Area -->
                            <label for="thumbnail" class="flex-1 cursor-pointer group">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-indigo-500 hover:bg-indigo-50 transition-all duration-150 group-hover:shadow-md">
                                    <div class="mb-3">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-5xl group-hover:text-indigo-500 transition-colors duration-150"></i>
                                    </div>
                                    <p class="text-gray-700 font-medium group-hover:text-indigo-600">Click to upload</p>
                                    <p class="text-sm text-gray-500 mt-2">PNG, JPG, JPEG up to 2MB</p>
                                    <p class="text-xs text-gray-400 mt-1">Recommended: 800x600px or 16:9 ratio</p>
                                </div>
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden"
                                       onchange="previewImage(this)">
                            </label>
                            
                            <!-- Preview Area -->
                            <div id="thumbnail-preview" class="hidden md:w-64">
                                <div class="bg-gray-100 rounded-xl overflow-hidden shadow-md h-full">
                                    <img id="preview-img" class="w-full h-48 object-cover" alt="Preview">
                                    <div class="p-3 bg-white">
                                        <p class="text-sm font-medium text-gray-700 flex items-center">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            Preview
                                        </p>
                                        <button type="button" onclick="removeImage()" 
                                                class="mt-2 text-xs text-red-600 hover:text-red-700 flex items-center">
                                            <i class="fas fa-times mr-1"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @error('thumbnail')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <!-- ZIP File Upload Card -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-file-archive text-green-600 mr-3"></i>
                        Game Files
                    </h2>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Upload ZIP File <span class="text-red-500">*</span>
                        </label>
                        
                        <label for="zip_file" class="cursor-pointer block">
                            <div id="zip-upload-area" class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-green-500 hover:bg-green-50 transition-all duration-150 hover:shadow-md">
                                <div class="mb-3">
                                    <i class="fas fa-file-archive text-gray-400 text-6xl hover:text-green-500 transition-colors duration-150"></i>
                                </div>
                                <p class="text-gray-700 font-medium text-lg" id="zip-status">
                                    <i class="fas fa-upload mr-2"></i>Choose ZIP file
                                </p>
                                <p class="text-sm text-gray-500 mt-2">Godot HTML5 export (max 100MB)</p>
                                <p id="file-name" class="mt-3 text-sm font-medium text-indigo-600"></p>
                                <div id="file-size" class="text-xs text-gray-500 mt-1"></div>
                            </div>
                            <input type="file" name="zip_file" id="zip_file" accept=".zip" required class="hidden"
                                   onchange="showFileName(this)">
                        </label>
                        
                        @error('zip_file')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Submit Card -->
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">
                        <i class="fas fa-rocket text-indigo-600 mr-2"></i>
                        Ready to Publish?
                    </h3>
                    
                    <button type="submit" id="submitBtn"
                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-4 rounded-lg font-bold text-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-150 shadow-lg hover:shadow-xl transform hover:-translate-y-1 mb-3">
                        <i class="fas fa-upload mr-2"></i> Upload Game
                    </button>
                    
                    <a href="{{ route('games.index') }}" 
                       class="block w-full bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold text-center hover:bg-gray-300 transition duration-150">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500 leading-relaxed">
                            <i class="fas fa-shield-alt mr-1"></i>
                            By uploading, you agree that your game complies with our community guidelines.
                        </p>
                    </div>
                </div>

                <!-- Export Guide Card -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-6">
                    <h4 class="font-bold text-blue-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-question-circle mr-2"></i> How to Export
                    </h4>
                    <ol class="space-y-3 text-sm text-blue-800">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 mt-0.5 font-bold text-xs">1</span>
                            <span>Open your project in <strong>Godot Engine</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 mt-0.5 font-bold text-xs">2</span>
                            <span>Go to <strong>Project → Export</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 mt-0.5 font-bold text-xs">3</span>
                            <span>Add <strong>HTML5</strong> export preset</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 mt-0.5 font-bold text-xs">4</span>
                            <span>Click <strong>Export Project</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 mt-0.5 font-bold text-xs">5</span>
                            <span>Save as <strong>ZIP archive</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 mt-0.5 font-bold text-xs">6</span>
                            <span>Upload the ZIP file here!</span>
                        </li>
                    </ol>
                </div>

                <!-- Tips Card -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 border-2 border-purple-200 rounded-xl p-6">
                    <h4 class="font-bold text-purple-900 mb-3 flex items-center text-lg">
                        <i class="fas fa-lightbulb mr-2"></i> Pro Tips
                    </h4>
                    <ul class="space-y-2 text-sm text-purple-800">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-purple-600 mr-2 mt-0.5"></i>
                            <span>Use an eye-catching thumbnail</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-purple-600 mr-2 mt-0.5"></i>
                            <span>Write clear gameplay instructions</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-purple-600 mr-2 mt-0.5"></i>
                            <span>Test your game before uploading</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-purple-600 mr-2 mt-0.5"></i>
                            <span>Optimize for web performance</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Check file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('File size must be less than 2MB');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('thumbnail-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById('thumbnail').value = '';
    document.getElementById('thumbnail-preview').classList.add('hidden');
}

function showFileName(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileName = file.name;
        const fileSize = (file.size / (1024 * 1024)).toFixed(2);
        
        // Check file size (100MB)
        if (file.size > 100 * 1024 * 1024) {
            alert('File size must be less than 100MB');
            input.value = '';
            return;
        }
        
        document.getElementById('file-name').innerHTML = `<i class="fas fa-file-archive mr-1"></i> ${fileName}`;
        document.getElementById('file-size').textContent = `Size: ${fileSize} MB`;
        document.getElementById('zip-status').innerHTML = '<i class="fas fa-check-circle text-green-600 mr-2"></i>File selected';
        document.getElementById('zip-upload-area').classList.add('border-green-500', 'bg-green-50');
    }
}

// Form submission loading state
document.getElementById('gameUploadForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Uploading...';
    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
});
</script>

@endsection