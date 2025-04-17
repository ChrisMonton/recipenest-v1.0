{{-- resources/views/recipes/show.blade.php --}}
@extends('layouts.app')

@section('styles')
<style>
  /* offset under fixed navbar */
  .page-container {
    padding-top: 60px;
  }

  /* recipe detail card */
  .recipe-detail-card {
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    border: none;
    border-radius: .5rem;
    overflow: hidden;
    margin-bottom: 2rem;
  }
  .recipe-detail-card .row {
    margin: 0;
  }
  .recipe-detail-card img {
    width: 100%;
    object-fit: cover;
  }

  /* like button */
  .btn-like {
    border: 1px solid #dc3545;
    color: #dc3545;
    background: transparent;
  }
  .btn-like.loved {
    background: #dc3545;
    color: #fff;
  }

  /* comments */
  .comment-box {
    margin-bottom: 1rem;
    padding: 1rem;
    border-radius: .5rem;
    background: #f8f9fa;
  }
  .edit-comment-form {
    margin-top: .5rem;
  }
</style>
@endsection

@section('content')
<div class="page-container">
  <div class="container my-4">
    {{-- Back to index --}}
    <a href="{{ route('recipes.index') }}" class="btn btn-secondary mb-3">← Back to Recipes</a>

    {{-- Recipe Detail Card --}}
    <div class="card recipe-detail-card">
      <div class="row g-0">
        {{-- Image --}}
        <div class="col-md-5">
          @if($recipe->image)
            <img src="{{ asset('storage/'.$recipe->image) }}" alt="{{ $recipe->title }}">
          @else
            <img src="{{ asset('images/default-recipe.png') }}" alt="No image">
          @endif
        </div>
        {{-- Body --}}
        <div class="col-md-7">
          <div class="card-body">
            <h2 class="card-title">{{ $recipe->title }}</h2>
            <p class="card-text">{{ $recipe->full_description }}</p>

            <hr>

            <p><strong>Ingredients:</strong> {{ $recipe->ingredients }}</p>
            <p><strong>Procedures:</strong> {{ $recipe->instructions }}</p>

            {{-- Love Button --}}
            <form action="{{ route('recipes.like', $recipe) }}" method="POST" class="d-inline">
              @csrf
              <button
                type="submit"
                class="btn btn-like {{ $recipe->likes->contains(Auth::id()) ? 'loved' : '' }}">
                <i class="bi bi-heart"></i>
                {{ $recipe->likes->contains(Auth::id()) ? 'Unlike' : 'Love' }}
              </button>
            </form>
            <span class="ms-2">{{ $recipe->likes->count() }} ❤️</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Comments Section --}}
    <div class="mb-4">
      <h4>Comments ({{ $recipe->comments->count() }})</h4>

      @foreach($recipe->comments as $comment)
        <div class="comment-box" id="comment-box-{{ $comment->id }}">
          {{-- Static display --}}
          <div class="comment-content" id="comment-content-{{ $comment->id }}">
            <div class="d-flex mb-2">
              <img
                src="{{ $comment->user->profile_picture
                         ? asset('storage/'.$comment->user->profile_picture)
                         : asset('images/default-profile.png') }}"
                class="rounded-circle me-2" width="40" height="40"
                style="object-fit:cover"
                alt="Avatar">
              <div>
                <strong>{{ $comment->user->first_name }} {{ $comment->user->surname }}</strong>
                <small class="text-muted">• {{ $comment->created_at->diffForHumans() }}</small>
                <p class="mt-1 mb-1">{{ $comment->body }}</p>
                {{-- Edit/Delete controls --}}
                @if(Auth::id() === $comment->user_id)
                  <button
                    type="button"
                    class="btn btn-sm btn-outline-secondary btn-edit-comment"
                    data-id="{{ $comment->id }}">
                    Edit
                  </button>
                  <form
                    action="{{ route('comments.destroy', $comment) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Delete this comment?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                      Delete
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>

          {{-- Inline edit form (hidden by default) --}}
          @if(Auth::id() === $comment->user_id)
            <form
              id="edit-form-{{ $comment->id }}"
              class="edit-comment-form d-none"
              action="{{ route('comments.update', $comment) }}"
              method="POST">
              @csrf
              @method('PUT')
              <textarea
                name="body"
                class="form-control mb-2"
                rows="3"
                required>{{ old('body', $comment->body) }}</textarea>
              <button type="submit" class="btn btn-sm btn-primary">Save</button>
              <button
                type="button"
                class="btn btn-sm btn-secondary btn-cancel-edit"
                data-id="{{ $comment->id }}">
                Cancel
              </button>
            </form>
          @endif
        </div>
      @endforeach

      {{-- Post New Comment --}}
      @auth
        <div class="card p-3">
          <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
            <div class="mb-3">
              <textarea
                name="body"
                class="form-control"
                rows="3"
                placeholder="Write a comment…"
                required>{{ old('body') }}</textarea>
            </div>
            <button class="btn btn-primary">Post Comment</button>
          </form>
        </div>
      @else
        <p class="mt-3">
          <a href="{{ route('login') }}">Log in</a> to post a comment.
        </p>
      @endauth
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // SHOW edit form
    document.querySelectorAll('.btn-edit-comment').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        document.getElementById(`comment-content-${id}`).classList.add('d-none');
        document.getElementById(`edit-form-${id}`).classList.remove('d-none');
      });
    });

    // CANCEL edit form
    document.querySelectorAll('.btn-cancel-edit').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        document.getElementById(`edit-form-${id}`).classList.add('d-none');
        document.getElementById(`comment-content-${id}`).classList.remove('d-none');
      });
    });
  });
</script>
@endpush
