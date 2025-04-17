@extends('layouts.app')

@section('styles')
<style>
  /* Container offset to clear fixed navbar */
  .page-container { padding-top: 60px; }

  /* Card base */
  .recipe-card {
    border: 1px solid #ddd;
    border-radius: .5rem;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: transform .2s;
    background: #fff;
  }
  .recipe-card:hover {
    transform: translateY(-5px);
  }

  /* Image wrapper + blur on hover */
  .recipe-image-container {
    position: relative;
    overflow: hidden;
  }
  .recipe-image {
    width: 100%;
    height: auto;
    transition: filter .3s;
  }
  .recipe-card:hover .recipe-image {
    filter: blur(3px);
  }

  /* Overlay “View Recipe” button */
  .recipe-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity .3s;
  }
  .recipe-card:hover .recipe-overlay {
    opacity: 1;
  }
  .recipe-overlay a {
    background: #a06c24;
    color: #fff;
    padding: .5rem 1rem;
    border-radius: .25rem;
    text-decoration: none;
    font-weight: 600;
  }

  /* Body content */
  .recipe-body { padding: 1rem; }
  .recipe-header {
    display: flex;
    align-items: center;
    margin-bottom: .75rem;
  }
  .recipe-header img {
    width: 32px; height: 32px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: .5rem;
    border: 2px solid #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }
  .chef-name {
    font-size: .9rem;
    font-weight: 600;
    color: #333;
  }
  .recipe-title a {
    color: #333;
    text-decoration: none;
  }
  .recipe-title a:hover {
    text-decoration: underline;
  }
  .recipe-description {
    margin-top: .5rem;
    color: #666;
    font-size: .9rem;
  }

  /* Page title */
  .page-title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    font-weight: bold;
    color: #333;
  }
</style>
@endsection

@section('content')
<div class="page-container">
  <div class="container my-3">
    <h2 class="page-title">Recipes</h2>

    @if($recipes->count())
      <div class="row">
        @foreach($recipes as $recipe)
          <div class="col-md-4 col-sm-6 mb-4">
            <div class="recipe-card">
              {{-- Image + overlay --}}
              <div class="recipe-image-container">
                @if($recipe->image)
                  <img
                    src="{{ asset('storage/'.$recipe->image) }}"
                    alt="{{ $recipe->title }}"
                    class="recipe-image">
                @else
                  <img
                    src="{{ asset('images/default-recipe.png') }}"
                    alt="No image"
                    class="recipe-image">
                @endif
                <div class="recipe-overlay">
                  <a href="{{ route('recipes.show', $recipe) }}">View Recipe</a>
                </div>
              </div>

              {{-- Body --}}
              <div class="recipe-body">
                {{-- Chef info --}}
                <div class="recipe-header">
                  @php $chef = optional($recipe->user); @endphp
                  <img
                    src="{{ $chef->profile_picture
                      ? asset('storage/'.$chef->profile_picture)
                      : asset('images/default-profile.png') }}"
                    alt="{{ $chef->first_name }}">
                  <span class="chef-name">
                    {{ $chef->first_name ? ucfirst($chef->first_name).' '.ucfirst($chef->surname) : 'Unknown Chef' }}
                  </span>
                </div>

                {{-- Title & excerpt --}}
                <h5 class="recipe-title">
                  <a href="{{ route('recipes.show', $recipe) }}">
                    {{ $recipe->title }}
                  </a>
                </h5>
                <p class="recipe-description">
                  {{ Str::limit($recipe->full_description ?? $recipe->description, 80) }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-center">
        {{ $recipes->links() }}
      </div>
    @else
      <p class="text-center">No recipes found.</p>
    @endif
  </div>
</div>
@endsection
