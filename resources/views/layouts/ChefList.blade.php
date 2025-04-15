@extends('layouts.app')

@section('styles')
<style>
    /* Optional: add a gradient background to the page */
    body {
        background: linear-gradient(to right, #fff, #ff9e46);
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    /* Container heading style (white text for contrast against gradient) */
    .container h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 40px;
    }

    /* Card wrapper */
    .chefcard {
        display: block;            /* So the entire card is clickable */
        background-color: #fff;    /* White card background */
        border-radius: 12px;       /* Softly rounded corners */
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center;
        padding: 20px;
        color: #333;
        position: relative;
        transition: all 0.3s ease;
        text-decoration: none;     /* Remove default link underline */
    }

    /* Card hover effect */
    .chefcard:hover {
        transform: translateY(-5px);
    }

    /* Circular profile image */
    .chef-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;    /* White ring around the photo */
        margin: 0 auto 15px;       /* Center the photo and add spacing below */
        background-color: #fff;
    }

    /* Chef name styling */
    .chef-name {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #333;
    }

    /* Role and specialties */
    .chef-role,
    .chef-specialties {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 8px;
    }

    /* Bold label in front of role or specialties if desired */
    .chef-role strong,
    .chef-specialties strong {
        color: #333;
    }

    /* "View Profile" button */
    .btn-view-profile {
        display: inline-block;
        background-color: #00b8d4; /* Customize button color */
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
        text-decoration: none;
    }

    /* Hover effect for the button */
    .btn-view-profile:hover {
        background-color: #0097a7;
    }

    /* Responsive layout */
    @media (max-width: 576px) {
        .chefcard {
            margin-bottom: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="container my-5">
    <h2>Chefs &amp; Users</h2>

    @if($chefs->count())
        <div class="row justify-content-center">
            @foreach($chefs as $chef)
                <div class="col-md-3 mb-4">
                    <!-- Entire card is clickable, linking to profile -->
                    <a href="{{ route('profile.show', $chef->id) }}" class="chefcard">
                        @php
                            $chefPic = $chef->profile_picture
                                ? asset('storage/' . $chef->profile_picture)
                                : asset('images/default-profile.png');
                        @endphp
                        <!-- Circular profile picture -->
                        <img src="{{ $chefPic }}" alt="Chef Picture" class="chef-photo">

                        <!-- Chef's name, role, and specialties -->
                        <div class="chef-name">
                            {{ ucfirst($chef->first_name) }} {{ ucfirst($chef->surname) }}
                        </div>
                        <div class="chef-role">
                            <strong>Role:</strong> {{ ucfirst($chef->role) }}
                        </div>
                        <div class="chef-specialties">
                            <strong>Specialties:</strong> {{ $chef->specialties ?? 'Not specified' }}
                        </div>

                        <!-- View Profile button -->
                        <span class="btn-view-profile">VIEW PROFILE</span>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $chefs->links() }}
        </div>
    @else
        <p>No chefs found.</p>
    @endif
</div>
@endsection
