<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #a06c24;">
    <div class="container">
        <!-- Logo (Image or Text) -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/recipenest-logo.png') }}" alt="RecipeNest Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavCustom"
                aria-controls="navbarNavCustom" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavCustom">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Sample Recipes</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('recipes.index') }}">Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('cheflist.index') }}">Chef List</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('about') }}">About Us</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="javascript:void(0);"
                               data-bs-toggle="modal" data-bs-target="#loginModal">
                                {{ __('Login') }}
                            </a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <!-- Profile with Picture and First Name -->
                    <li class="nav-item d-flex align-items-center me-3">
                        @php
                            $profilePic = Auth::user()->profile_picture
                                ? asset('storage/' . Auth::user()->profile_picture)
                                : asset('images/default-profile.png');
                        @endphp
                        <a class="nav-link text-white d-flex align-items-center" href="{{ route('profile') }}">
                            <img src="{{ $profilePic }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            <span class="ms-2">{{ Auth::user()->first_name }}</span>
                        </a>
                    </li>

                    <!-- Notification Dropdown -->
                    <li class="nav-item dropdown">
                        <a id="notificationsDropdown" class="nav-link dropdown-toggle text-white" href="#"
                           role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 1.985-1.75H6.015A2 2 0 0 0 8 16z"/>
                                <path d="M8 1a5 5 0 0 0-5 5v2c0 .628-.134 1.229-.36 1.77-.232.559-.561
                                         1.065-.954 1.471-.74.762-1.186 1.541-1.186 2.26 0 .552.448 1
                                         1 1h14a1 1 0 0 0 1-1c0-.72-.446-1.498-1.186-2.26a5.304
                                         5.304 0 0 1-.954-1.47c-.226-.542-.36-1.143-.36-1.77V6a5 5
                                         0 0 0-5-5z"/>
                            </svg>
                            Notification
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="badge bg-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                            @if(Auth::user()->notifications->count())
                                @foreach(Auth::user()->notifications as $notification)
                                    <a class="dropdown-item" href="#">
                                        {{ $notification->data['message'] ?? 'New Notification' }}
                                    </a>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="{{ route('notifications.index') }}">View All Notifications</a>
                            @else
                                <span class="dropdown-item">No notifications.</span>
                            @endif
                        </div>
                    </li>

                    <!-- Menu Dropdown -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                           role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">View Profile</a>
                            <a class="dropdown-item" href="#">Manage Account</a>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
