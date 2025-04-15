@extends('layouts.app')

@section('styles')
<style>
    /* Recipe Card Styles */
    .recipe-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }
    .recipe-card:hover {
        transform: translateY(-5px);
    }
    /* Header with Chef's Profile */
    .recipe-header {
        display: flex;
        align-items: center;
        padding: 10px;
        background-color: #f8f9fa;
    }
    .recipe-header img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
        border: 2px solid #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .chef-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
    }
    /* Recipe Body */
    .recipe-body {
        padding: 15px;
    }
    .recipe-body img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .recipe-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-top: 10px;
        color: #333;
    }
    .recipe-description {
        margin-top: 10px;
        color: #555;
    }
    .recipe-category {
        font-size: 0.9rem;
        color: #007bff;
        margin-top: 10px;
        font-weight: 600;
    }
    /* Recipe Image Overlay Effect */
    .recipe-image-container {
        position: relative;
        overflow: hidden;
    }
    .recipe-image-container img.recipe-image {
        width: 100%;
        height: auto;
        transition: filter 0.3s ease;
    }
    .recipe-image-container:hover img.recipe-image {
        filter: blur(3px);
    }
    .recipe-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-size: 1.25rem;
        font-weight: bold;
    }
    .recipe-image-container:hover .recipe-overlay {
        opacity: 1;
    }
    .recipe-overlay a {
        color: #fff;
        text-decoration: none;
        cursor: pointer;
    }
    /* Modal image size */
    .modal-image {
        max-height: 500px !important;
        width: auto !important;
        object-fit: contain !important;
    }
</style>
@endsection

@section('content')
<div class="container my-5">
    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-md-4">
                <div class="recipe-card">
                    <!-- Recipe Header: Chef's Profile (clickable) -->
                    <div class="recipe-header">
                        @php
                            // Assuming the Recipe model has a "user" relationship.
                            $chef = optional($recipe->user);
                            $chefPic = $chef->profile_picture
                                ? asset('storage/' . $chef->profile_picture)
                                : asset('images/default-profile.png');
                        @endphp
                        <a href="{{ route('profile.show', $chef->id) }}" style="display: flex; align-items: center; text-decoration: none;">
                            <img src="{{ $chefPic }}" alt="{{ $chef->first_name ?? 'Unknown' }} {{ $chef->surname ?? 'Chef' }}">
                            <div class="chef-name">
                                {{ ($chef->first_name && $chef->surname) ? ucfirst($chef->first_name) . ' ' . ucfirst($chef->surname) : 'Unknown Chef' }}
                            </div>
                        </a>
                    </div>
                    <!-- Recipe Body: Image overlay with "View Recipe", Title, Description, Category -->
                    <div class="recipe-body">
                        <div class="recipe-image-container">
                            @if($recipe->image)
                                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="recipe-image">
                            @else
                                <img src="{{ asset('images/default-recipe.png') }}" alt="Default Recipe Image" class="recipe-image">
                            @endif
                            <div class="recipe-overlay">
                                <!-- Trigger modal -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewRecipeModal-{{ $recipe->id }}">View Recipe</a>
                            </div>
                        </div>
                        <div class="recipe-title">{{ $recipe->title }}</div>
                        <div class="recipe-description">
                            {{ Str::limit($recipe->description, 100) }}
                        </div>
                        <div class="recipe-category">
                            Category: {{ $recipe->category->name ?? 'Uncategorized' }}
                        </div>
                    </div>
                </div>

                <!-- Recipe Detail Modal -->
                <div class="modal fade" id="viewRecipeModal-{{ $recipe->id }}" tabindex="-1" aria-labelledby="viewRecipeModalLabel-{{ $recipe->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- Optional: Leave title empty if you include it in right column -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <!-- LEFT COLUMN: Recipe Image & Love Button -->
                                    <div class="col-md-5 text-center">
                                        @if($recipe->image)
                                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="img-fluid modal-image">
                                        @else
                                            <img src="{{ asset('images/default-recipe.png') }}" alt="Default Recipe Image" class="img-fluid modal-image">
                                        @endif
                                        <div class="mt-3">
                                            <button class="btn btn-outline-danger">
                                                <i class="bi bi-heart"></i> Love
                                            </button>
                                        </div>
                                    </div>
                                    <!-- RIGHT COLUMN: Recipe Details & Comments -->
                                    <div class="col-md-7">
                                        <!-- Red Box: Creator Info -->
                                        <div class="p-3 mb-2" style="background-color: #f8d7da; border-radius: 5px;">
                                            @php
                                                $chef = optional($recipe->user);
                                                $chefPic = $chef->profile_picture
                                                    ? asset('storage/' . $chef->profile_picture)
                                                    : asset('images/default-profile.png');
                                            @endphp
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $chefPic }}" alt="Creator Picture" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                                <span class="ms-2"><strong>{{ $chef->first_name }} {{ $chef->surname }}</strong></span>
                                            </div>
                                        </div>
                                        <!-- Blue Box: Recipe Title -->
                                        <div class="p-3 mb-2" style="background-color: #cfe2ff; border-radius: 5px;">
                                            <h4 class="mb-0">{{ $recipe->title }}</h4>
                                        </div>
                                        <!-- Orange Box: Recipe Details -->
                                        <div class="p-3 mb-2" style="background-color: #ffe5d9; border-radius: 5px;">
                                            <p><strong>Description:</strong> {{ $recipe->full_description }}</p>
                                            <p><strong>Procedures:</strong> {{ $recipe->instructions }}</p>
                                            <p><strong>Ingredients:</strong> {{ $recipe->ingredients }}</p>
                                        </div>
                                        <!-- Comments Section -->
                                        <div class="p-3" style="background-color: #f1f1f1; border-radius: 5px;">
                                            <h5>Comments</h5>

                                            @if(isset($recipe->comments) && $recipe->comments->count())
                                                @foreach($recipe->comments as $comment)
                                                    <div class="d-flex align-items-start mb-3">
                                                        <img src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('images/default-profile.png') }}" alt="Commenter Picture" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                                        <div class="ms-2">
                                                            <strong>{{ $comment->user->first_name }} {{ $comment->user->surname }}</strong>
                                                            <p class="mb-0">{{ $comment->body }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-muted">No comments yet.</p>
                                            @endif

                                            <!-- Comment Form -->
                                            @auth
                                                <form method="POST" action="{{ route('comments.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                                                    <div class="mb-3">
                                                        <textarea name="body" class="form-control" placeholder="Write a comment..." rows="3" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Post</button>
                                                </form>
                                            @else
                                                <p><a href="{{ route('login') }}">Log in</a> to write a comment.</p>
                                            @endauth
                                        </div>
                                    </div>
                                </div><!-- /row -->
                            </div><!-- /modal-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /modal-content -->
                    </div><!-- /modal-dialog -->
                </div><!-- /modal -->
            </div>
        @endforeach
    </div>
    <!-- Pagination, if needed -->
    <div class="mt-3">
        {{ $recipes->links() }}
    </div>
</div>
@endsection
