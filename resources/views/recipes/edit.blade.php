@extends('layouts.app')

@section('styles')
<style>
  .page-container { padding-top: 100px; }
  .form-label { font-weight: 600; }
</style>
@endsection

@section('content')
<div class="page-container">
  <div class="container my-5">
    <h2>Edit Recipe</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Title -->
      <div class="mb-3">
        <label class="form-label" for="title">Title</label>
        <input type="text"
               class="form-control"
               id="title"
               name="title"
               value="{{ old('title', $recipe->title) }}"
               required>
      </div>

      <!-- Ingredients -->
      <div class="mb-3">
        <label class="form-label" for="ingredients">Ingredients</label>
        <textarea class="form-control"
                  id="ingredients"
                  name="ingredients"
                  rows="3"
                  required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
      </div>

      <!-- Instructions -->
      <div class="mb-3">
        <label class="form-label" for="instructions">Procedures</label>
        <textarea class="form-control"
                  id="instructions"
                  name="instructions"
                  rows="4"
                  required>{{ old('instructions', $recipe->instructions) }}</textarea>
      </div>

      <!-- Full Description -->
      <div class="mb-3">
        <label class="form-label" for="full_description">Description</label>
        <textarea class="form-control"
                  id="full_description"
                  name="full_description"
                  rows="4"
                  required>{{ old('full_description', $recipe->full_description) }}</textarea>
      </div>

      <!-- Visibility -->
      <div class="mb-3">
        <label class="form-label">Visibility</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="public" id="publicYes" value="1"
                   {{ old('public', $recipe->public) ? 'checked' : '' }}>
            <label class="form-check-label" for="publicYes">Public</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="public" id="publicNo" value="0"
                   {{ old('public', $recipe->public) ? '' : 'checked' }}>
            <label class="form-check-label" for="publicNo">Private</label>
          </div>
        </div>
      </div>

      <!-- Image Upload -->
      <div class="mb-4">
        <label class="form-label" for="image">Upload Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if($recipe->image)
          <small class="text-muted">Current: {{ basename($recipe->image) }}</small>
        @endif
      </div>

      <button type="submit" class="btn btn-primary">Save Changes</button>
      <a href="{{ route('myrecipes.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
@endsection
