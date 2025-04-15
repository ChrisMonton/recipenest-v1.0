@extends('layouts.app')

@section('styles')
<style>
    /* Profile page specific styles */
    .profile-container {
        margin-top: 2rem;
    }
    .profile-card {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background-color: #fff;
    }
    .profile-card .card-body {
        text-align: center;
    }
    .dashboard-info {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background-color: #fff;
    }
    .recipes-feed .card {
        margin-bottom: 20px;
    }
    /* Enlarge image in modal, but limit to 300x300 so it won't be huge */
    .modal-enlarged-img {
        width: auto;
        height: auto;
        max-width: 300px;
        max-height: 300px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="container profile-container">
    <div class="row">
        <!-- LEFT COLUMN: Profile Summary -->
        <div class="col-md-4">
            <div class="card profile-card">
                <div class="card-body">
                    <!-- Use the $user passed from the controller -->
                    @php
                        $profilePic = $user->profile_picture
                            ? asset('storage/' . $user->profile_picture)
                            : asset('images/default-profile.png');
                    @endphp

                    <!-- Profile Picture with Modal Trigger -->
                    <img src="{{ $profilePic }}"
                         alt="User Picture"
                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); cursor: pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#profilePicModal">

                    <h4 class="fw-bold mt-3">{{ $user->first_name }} {{ $user->surname }}</h4>
                    <p class="text-muted">{{ $user->bio ?? 'No bio provided.' }}</p>

                    @if(Auth::check() && Auth::id() === $user->id)
                        <!-- If viewing your own profile, show personal controls -->
                        <div class="mb-3">
                            <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-sm me-2">Create Recipe</a>
                            <a href="{{ route('myrecipes.index') }}" class="btn btn-warning btn-sm me-2">My Recipes</a>
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary btn-sm">Edit Profile</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Recipes Feed -->
        <div class="col-md-8">
            <div class="card dashboard-info">
                <div class="card-header">
                    <h5>
                        @if(Auth::check() && Auth::id() === $user->id)
                            Posts
                        @else
                            {{ $user->first_name }}'s Posts
                        @endif
                    </h5>
                </div>
                <div class="card-body recipes-feed">
                    @if(isset($myRecipes) && $myRecipes->count())
                        <div class="row">
                            @foreach($myRecipes as $recipe)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card">
                                        @if($recipe->image)
                                            <img src="{{ asset('storage/' . $recipe->image) }}" class="card-img-top" alt="Recipe Image">
                                        @else
                                            <img src="{{ asset('images/default-recipe.png') }}" class="card-img-top" alt="Default Recipe Image">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $recipe->title }}</h5>
                                            <p class="card-text"><small class="text-muted">{{ $recipe->created_at->diffForHumans() }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            {{ $myRecipes->links() }}
                        </div>
                    @else
                        <p class="text-muted">No recipes posted yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Picture Modal -->
<div class="modal fade" id="profilePicModal" tabindex="-1" aria-labelledby="profilePicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="profilePicModalLabel">Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body: Enlarged Profile Image -->
            <div class="modal-body text-center">
                <img src="{{ $profilePic }}" alt="User Picture" class="modal-enlarged-img">
            </div>
        </div>
    </div>
</div>
@endsection
