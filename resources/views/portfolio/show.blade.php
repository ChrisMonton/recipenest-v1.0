@extends('layouts.app')

@section('styles')
<style>
    .portfolio-show-container {
        margin-top: 20px;
    }
    .portfolio-section {
        margin-bottom: 20px;
    }
    .portfolio-section h4 {
        margin-bottom: 10px;
    }
    /* Flex container for the two buttons */
    .portfolio-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="container portfolio-show-container">
    <div class="card">
        <div class="card-header">
            <h3>{{ $user->first_name }}'s Portfolio</h3>
        </div>
        <div class="card-body">
            @if($portfolio && ($portfolio->experience || $portfolio->education || $portfolio->interests || $portfolio->specialties))
                @if($portfolio->experience)
                    <div class="portfolio-section">
                        <h4>Experience</h4>
                        <p>{{ $portfolio->experience }}</p>
                    </div>
                @endif

                @if($portfolio->education)
                    <div class="portfolio-section">
                        <h4>Education</h4>
                        <p>{{ $portfolio->education }}</p>
                    </div>
                @endif

                @if($portfolio->interests)
                    <div class="portfolio-section">
                        <h4>Interests</h4>
                        <p>{{ $portfolio->interests }}</p>
                    </div>
                @endif

                @if($portfolio->specialties)
                    <div class="portfolio-section">
                        <h4>Culinary Skills or Specialties</h4>
                        <p>{{ $portfolio->specialties }}</p>
                    </div>
                @endif
            @else
                <p>No portfolio information available.</p>
            @endif
        </div>
    </div>
    <!-- Two-button section: Back to Profile (Left) and Edit Portfolio (Right) -->
    <div class="portfolio-buttons">
        <a href="{{ route('profile.show', $user->id) }}" class="btn btn-secondary">Back to Profile</a>
        @if(Auth::check() && Auth::id() === $user->id)
                <a href="{{ route('portfolio.edit', $user->id) }}" class="btn btn-secondary mt-3">Edit Portfolio</a>
        @endif
    </div>
</div>
@endsection
