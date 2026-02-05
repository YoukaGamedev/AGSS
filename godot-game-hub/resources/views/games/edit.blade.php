@extends('layouts.app')

@section('title', 'Upload Game')

@section('content')
<style>
    /* Back Link */
    .back-link {
        color: #4f46e5;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        transition: color 0.15s ease-in-out;
    }
    
    .back-link:hover {
        color: #4338ca;
    }
    
    /* Header Section */
    .header-section {
        background: linear-gradient(to right, #4f46e5, #7c3aed);
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
    }
    
    .header-title {
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }
    
    .header-subtitle {
        font-size: 1.125rem;
        color: #e0e7ff;
    }
    
    /* Form Cards */
    .form-card {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .card-title i {
        font-size: 1.5rem;
    }
    
    .card-title .text-indigo {
        color: #4f46e5;
    }
    
    .card-title .text-purple {
        color: #7c3aed;
    }
    
    .card-title .text-green {
        color: #059669;
    }
    
    /* Form Elements */
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .required {
        color: #ef4444;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        transition: all 0.15s ease-in-out;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .form-hint {
        margin-top: 0.5rem;
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    .error-message {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #dc2626;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    /* Upload Areas */
    .upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.15s ease-in-out;
        cursor: pointer;
    }
    
    .upload-area:hover {
        border-color: #4f46e5;
        background-color: #eef2ff;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    .upload-area i {
        font-size: 3rem;
        color: #9ca3af;
        margin-bottom: 0.75rem;
        transition: color 0.15s ease-in-out;
    }
    
    .upload-area:hover i {
        color: #4f46e5;
    }
    
    .upload-text {
        color: #374151;
        font-weight: 500;
    }
    
    .upload-area:hover .upload-text {
        color: #4f46e5;
    }
    
    .upload-hint {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }
    
    .upload-specs {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 0.25rem;
    }
    
    /* ZIP Upload Area */
    .zip-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.15s ease-in-out;
        cursor: pointer;
    }
    
    .zip-upload-area:hover {
        border-color: #059669;
        background-color: #d1fae5;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    .zip-upload-area i {
        font-size: 4rem;
        color: #9ca3af;
        transition: color 0.15s ease-in-out;
    }
    
    .zip-upload-area:hover i {
        color: #059669;
    }
    
    .zip-upload-area.selected {
        border-color: #059669;
        background-color: #d1fae5;
    }
    
    /* Preview Area */
    .preview-card {
        background-color: #f3f4f6;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        height: 100%;
    }
    
    .preview-img {
        width: 100%;
        height: 12rem;
        object-fit: cover;
    }
    
    .preview-footer {
        padding: 0.75rem;
        background-color: white;
    }
    
    /* Submit Card */
    .submit-card {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        position: sticky;
        top: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .submit-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-submit {
        width: 100%;
        background: linear-gradient(to right, #4f46e5, #7c3aed);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 700;
        font-size: 1.125rem;
        border: none;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.15s ease-in-out;
        margin-bottom: 0.75rem;
    }
    
    .btn-submit:hover {
        background: linear-gradient(to right, #4338ca, #6d28d9);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .btn-cancel {
        width: 100%;
        background-color: #e5e7eb;
        color: #374151;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        display: block;
        transition: background-color 0.15s ease-in-out;
    }
    
    .btn-cancel:hover {
        background-color: #d1d5db;
        color: #374151;
    }
    
    .disclaimer {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        font-size: 0.75rem;
        color: #6b7280;
        line-height: 1.5;
    }
    
    /* Guide Cards */
    .guide-card {
        background: linear-gradient(to bottom right, #eff6ff, #eef2ff);
        border: 2px solid #bfdbfe;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .guide-title {
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 1rem;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .guide-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .guide-list li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 0.75rem;
        font-size: 0.875rem;
        color: #1e40af;
    }
    
    .step-number {
        flex-shrink: 0;
        width: 1.5rem;
        height: 1.5rem;
        background-color: #2563eb;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        margin-top: 0.125rem;
        font-weight: 700;
        font-size: 0.75rem;
    }
    
    /* Tips Card */
    .tips-card {
        background: linear-gradient(to bottom right, #fdf4ff, #fce7f3);
        border: 2px solid #f9a8d4;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .tips-title {
        font-weight: 700;
        color: #581c87;
        margin-bottom: 0.75rem;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .tips-list li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        color: #7c2d92;
    }
    
    .tips-list i {
        color: #9333ea;
        margin-right: 0.5rem;
        margin-top: 0.125rem;
    }
</style>

<div class="container py-4" style="max-width: 1024px;">
    <!-- Header Section -->
    <div class="mb-4">
        <a href="{{ route('games.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Games
        </a>
        <div class="header-section">
            <h1 class="header-title">
                <i class="bi bi-pencil-square"></i> Edit Game
            </h1>
            <p class="header-subtitle mb-0">
                Update your game information and files.
            </p>
        </div>
    </div>

    <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Main Form -->
            <div class="col-12 col-lg-8">

                <!-- Game Information -->
                <div class="form-card">
                    <h2 class="card-title">
                        <i class="bi bi-info-circle text-indigo"></i>
                        Game Information
                    </h2>

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="form-label">Game Title <span class="required">*</span></label>
                        <input type="text" name="title" required
                               value="{{ old('title', $game->title) }}"
                               class="form-control form-control-custom">
                        @error('title')
                        <p class="error-message">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-0">
                        <label class="form-label">Description <span class="required">*</span></label>
                        <textarea name="description" rows="6" required
                                  class="form-control form-control-custom"
                                  style="resize:none">{{ old('description', $game->description) }}</textarea>
                        @error('description')
                        <p class="error-message">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail -->
                <div class="form-card">
                    <h2 class="card-title">
                        <i class="bi bi-image text-purple"></i>
                        Game Thumbnail
                    </h2>

                    @if ($game->thumbnail)
                        <div class="mb-3">
                            <p class="fw-medium mb-2">Current Thumbnail</p>
                            <img src="{{ asset('storage/'.$game->thumbnail) }}"
                                 class="img-fluid rounded"
                                 style="max-height:180px">
                        </div>
                    @endif

                    <input type="file" name="thumbnail" class="form-control">
                    <small class="text-muted">Leave empty to keep current thumbnail</small>

                    @error('thumbnail')
                    <p class="error-message">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- ZIP File -->
                <div class="form-card">
                    <h2 class="card-title">
                        <i class="bi bi-file-earmark-zip text-green"></i>
                        Game Files
                    </h2>

                    <p class="text-muted mb-2">
                        Current file:
                        <i class="bi bi-check-circle-fill text-success"></i>
                        Uploaded
                    </p>

                    <input type="file" name="zip_file" accept=".zip" class="form-control">
                    <small class="text-muted">Upload only if you want to replace the existing file</small>

                    @error('zip_file')
                    <p class="error-message">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4">
                <div class="submit-card">
                    <h3 class="submit-title">
                        <i class="bi bi-save text-primary"></i>
                        Save Changes
                    </h3>

                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-check-lg me-2"></i> Update Game
                    </button>

                    <a href="{{ route('games.index') }}" class="btn-cancel">
                        <i class="bi bi-x-lg me-2"></i> Cancel
                    </a>

                    <div class="disclaimer">
                        <i class="bi bi-shield-check me-1"></i>
                        Your changes will be saved immediately.
                    </div>
                </div>

                <!-- Export Guide Card
                <div class="guide-card">
                    <h4 class="guide-title">
                        <i class="bi bi-question-circle"></i> How to Export
                    </h4>
                    <ol class="guide-list">
                        <li>
                            <span class="step-number">1</span>
                            <span>Open your project in <strong>Godot Engine</strong></span>
                        </li>
                        <li>
                            <span class="step-number">2</span>
                            <span>Go to <strong>Project → Export</strong></span>
                        </li>
                        <li>
                            <span class="step-number">3</span>
                            <span>Add <strong>HTML5</strong> export preset</span>
                        </li>
                        <li>
                            <span class="step-number">4</span>
                            <span>Click <strong>Export Project</strong></span>
                        </li>
                        <li>
                            <span class="step-number">5</span>
                            <span>Save as <strong>ZIP archive</strong></span>
                        </li>
                        <li>
                            <span class="step-number">6</span>
                            <span>Upload the ZIP file here!</span>
                        </li>
                    </ol>
                </div> -->

                <!-- Tips Card -->
                <div class="tips-card">
                    <h4 class="tips-title">
                        <i class="bi bi-lightbulb"></i> Pro Tips
                    </h4>
                    <ul class="tips-list">
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Use an eye-catching thumbnail</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Write clear gameplay instructions</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Test your game before uploading</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
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
            document.getElementById('thumbnail-preview').classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById('thumbnail').value = '';
    document.getElementById('thumbnail-preview').classList.add('d-none');
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
        
        document.getElementById('file-name').innerHTML = `<i class="bi bi-file-earmark-zip me-1"></i> ${fileName}`;
        document.getElementById('file-size').textContent = `Size: ${fileSize} MB`;
        document.getElementById('zip-status').innerHTML = '<i class="bi bi-check-circle text-success me-2"></i>File selected';
        document.getElementById('zip-upload-area').classList.add('selected');
    }
}

// Form submission loading state
document.getElementById('gameUploadForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spin me-2"></i> Uploading...';
    submitBtn.style.opacity = '0.75';
    submitBtn.style.cursor = 'not-allowed';
});
</script>

<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.spin {
    animation: spin 1s linear infinite;
    display: inline-block;
}
</style>

@endsection