@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2>Create a New Recipe</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Recipe Title -->
        <div class="mb-3">
            <label for="recipeTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="recipeTitle" name="title" required>
        </div>

        <!-- Ingredients (List ingredients separated by commas or line breaks) -->
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients</label>
            <textarea class="form-control auto-resize" id="ingredients" name="ingredients" rows="3" required placeholder="e.g. 2 eggs, 1 cup flour, 1/2 cup milk"></textarea>
        </div>

        <!-- Instructions (Detailed steps) -->
        <div class="mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <textarea class="form-control auto-resize" id="instructions" name="instructions" rows="3" required placeholder="Enter detailed steps for preparing the recipe"></textarea>
        </div>

        <!-- Full Description (Additional details about the recipe) -->
        <div class="mb-3">
            <label for="fullDescription" class="form-label">Recipe Description</label>
            <textarea class="form-control auto-resize" id="fullDescription" name="full_description" rows="4" required placeholder="Enter a full description of the recipe"></textarea>
        </div>

        <!-- Upload Image -->
        <div class="mb-3">
            <label for="recipeImage" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="recipeImage" name="image" accept="image/*">
        </div>

       <!-- Public/Private Toggle -->
<div class="mb-3">
    <label class="form-label">Visibility</label>
    <div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="public" id="publicOption" value="1" checked>
            <label class="form-check-label" for="publicOption">Public</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="public" id="privateOption" value="0">
            <label class="form-check-label" for="privateOption">Private</label>
        </div>
    </div>
</div>

        <button type="submit" class="btn btn-primary">Submit Recipe</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
// Auto-resize all textareas based on content.
document.addEventListener('input', function(event) {
    if (event.target.tagName.toLowerCase() !== 'textarea' || !event.target.classList.contains('auto-resize')) {
        return;
    }
    event.target.style.height = 'auto';
    event.target.style.height = event.target.scrollHeight + 'px';
});
</script>
@endsection
