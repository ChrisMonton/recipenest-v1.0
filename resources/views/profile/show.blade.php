@extends('layouts.app')

@section('styles')
<style>
  /* Container spacing */
  .profile-container { margin-top: 2rem; }

  /* Left profile card */
  .profile-card {
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  .profile-card .card-body {
    padding: 2rem;
    text-align: center;
  }

  .profile-pic {
    width: 120px; height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 1rem;
    cursor: pointer;
  }

  /* Gold button */
  .btn-gold {
    background-color: #a06c24;
    color: #fff;
    border: none;
  }
  .btn-gold:hover {
    opacity: 0.9;
  }

  /* Yellow button (My Recipes) */
  .btn-yellow {
    background-color: #FFD500;
    color: #000;
    border: none;
  }
  .btn-yellow:hover {
    opacity: 0.9;
  }

  /* Right posts feed */
  .dashboard-info {
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  .recipes-feed .card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    overflow: hidden;
  }
  .recipes-feed img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }
  .recipes-feed .card-body {
    text-align: center;
    padding: 1rem;
  }
  .recipes-feed h5 {
    margin-bottom: .5rem;
  }
  .recipes-feed .text-muted {
    margin-bottom: 1rem;
  }

  /* Modal images */
  .modal-enlarged-img {
    max-width: 300px; max-height: 300px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  .modal-image {
    width: 100%;
    max-height: 300px;
    object-fit: cover;
  }
</style>
@endsection

@section('content')
<div class="container profile-container">
  <div class="row">
    {{-- LEFT COLUMN --}}
    <div class="col-md-4">
      <div class="card profile-card mb-4">
        <div class="card-body">
          @php
            $profilePic  = $user->profile_picture
                             ? asset('storage/'.$user->profile_picture)
                             : asset('images/default-profile.png');
            $specialties = json_decode($user->specialties, true) ?: [];
          @endphp

          {{-- Profile Picture --}}
          <img src="{{ $profilePic }}"
               class="profile-pic"
               data-bs-toggle="modal"
               data-bs-target="#profilePicModal"
               alt="User Picture">

          <h4 class="fw-bold">{{ $user->first_name }} {{ $user->surname }}</h4>
          <p class="text-muted">{{ $user->bio ?? 'No bio provided.' }}</p>

          {{-- Followers + Follow/Unfollow --}}
          <div class="mb-2">
            <strong>{{ $followersCount }}</strong> Followers
            @if(Auth::check() && Auth::id() !== $user->id)
              @if($isFollowing)
                <a href="{{ route('unfollow', $user->id) }}"
                   class="btn btn-gold btn-sm ms-2">
                  Unfollow
                </a>
              @else
                <a href="{{ route('follow', $user->id) }}"
                   class="btn btn-gold btn-sm ms-2">
                  Follow
                </a>
              @endif
            @endif
          </div>

          {{-- Email --}}
          <p><strong>Email:</strong> {{ $user->email }}</p>

          {{-- Specialties --}}
          <p>
            <strong>Specialties:</strong>
            @if(count($specialties))
              {{ implode(', ', $specialties) }}
            @else
              N/A
            @endif
          </p>

          {{-- View Portfolio --}}
          <a href="{{ route('portfolio.show', $user->id) }}"
             class="btn btn-gold w-100 mb-3">
            View Portfolio
          </a>

          @if(Auth::check() && Auth::id() === $user->id)
            {{-- Own Profile Controls --}}
            <div class="d-flex gap-2">
              <a href="{{ route('recipes.create') }}"
                 class="btn btn-gold flex-fill">
                Create Recipe
              </a>
              <a href="{{ route('recipes.index') }}"
                 class="btn btn-yellow flex-fill">
                My Recipes
              </a>
              <a href="{{ route('profile.edit') }}"
                 class="btn btn-secondary flex-fill">
                Edit Profile
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>

    {{-- RIGHT COLUMN --}}
    <div class="col-md-8">
      <div class="card dashboard-info mb-4">
        <div class="card-header bg-white border-0">
          <h5 class="mb-0">
            @if(Auth::id() === $user->id)
              Posts
            @else
              {{ $user->first_name }}'s Posts
            @endif
          </h5>
        </div>
        <div class="card-body recipes-feed">
          @if($myRecipes->count())
            <div class="row">
              @foreach($myRecipes as $recipe)
                <div class="col-md-6 col-lg-4 mb-4">
                  <div class="card">
                    <img src="{{ $recipe->image
                                 ? asset('storage/'.$recipe->image)
                                 : asset('images/default-recipe.png') }}"
                         class="card-img-top"
                         alt="Recipe Image">
                    <div class="card-body">
                      <h5 class="card-title">{{ $recipe->title }}</h5>
                      <p class="text-muted">{{ $recipe->created_at->diffForHumans() }}</p>
                      <button class="btn btn-gold"
                              data-bs-toggle="modal"
                              data-bs-target="#recipeModal-{{ $recipe->id }}">
                        View Recipe
                      </button>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            {{ $myRecipes->links() }}
          @else
            <p class="text-muted">No recipes posted yet.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

{{-- PROFILE PIC MODAL --}}
<div class="modal fade" id="profilePicModal" tabindex="-1"
     aria-labelledby="profilePicModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profilePicModalLabel">Profile Picture</h5>
        <button type="button" class="btn-close"
                data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ $profilePic }}"
             class="modal-enlarged-img"
             alt="User Picture">
      </div>
    </div>
  </div>
</div>

{{-- RECIPE DETAIL MODALS --}}
@foreach($myRecipes as $recipe)
  <div class="modal fade" id="recipeModal-{{ $recipe->id }}"
       tabindex="-1"
       aria-labelledby="recipeModalLabel-{{ $recipe->id }}"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"
              id="recipeModalLabel-{{ $recipe->id }}">
            {{ $recipe->title }}
          </h5>
          <button type="button" class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            {{-- Left: Image & Love --}}
            <div class="col-md-5 text-center">
              <img src="{{ $recipe->image
                           ? asset('storage/'.$recipe->image)
                           : asset('images/default-recipe.png') }}"
                   class="img-fluid modal-image mb-3"
                   alt="{{ $recipe->title }}">
              <button class="btn btn-outline-danger">
                <i class="bi bi-heart"></i> Love
              </button>
            </div>
            {{-- Right: Details --}}
            <div class="col-md-7">
              @php
                $chef = optional($recipe->user);
                $chefPic = $chef->profile_picture
                           ? asset('storage/'.$chef->profile_picture)
                           : asset('images/default-profile.png');
              @endphp

              <div class="d-flex align-items-center mb-2">
                <img src="{{ $chefPic }}"
                     class="rounded-circle me-2"
                     width="40" height="40"
                     style="object-fit:cover;">
                <strong>{{ $chef->first_name }} {{ $chef->surname }}</strong>
              </div>

              <h4 class="mb-2">{{ $recipe->title }}</h4>
              <p><strong>Description:</strong> {{ $recipe->full_description }}</p>
              <p><strong>Procedures:</strong> {{ $recipe->instructions }}</p>
              <p><strong>Ingredients:</strong> {{ $recipe->ingredients }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection
