<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    {{-- Navbar starts testing --}}
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#">RecipeNest</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prototype.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prototype.chefs.index') }}">Chefs</a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Pages
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('prototype.chefs.show') }}">Chef Profile</a>
                        <a class="dropdown-item" href="{{ route('prototype.chefs.portfolio') }}">Chef Portfolio</a>
                        <a class="dropdown-item" href="{{ route('prototype.recipes.index') }}">Recipe List</a>
                        <a class="dropdown-item" href="{{ route('prototype.recipes.show') }}">Recipe Details</a>
                    </div>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Dashboard
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('prototype.authors.home') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('prototype.authors.recipes.index') }}">Recipes</a>
                        <a class="dropdown-item" href="{{ route('prototype.authors.recipes.create') }}">Create
                            Recipe</a>
                        <a class="dropdown-item" href="{{ route('prototype.authors.profile.edit') }}">Update Profile</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prototype.login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prototype.register') }}">Register</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    {{-- Navbar ends --}}

    {{-- Content starts --}}
    <div class="container">
        {{ $slot }}
    </div>
    {{-- Content ends --}}

    {{-- Footer starts --}}

    {{-- Footer ends --}}

    @include('pages.prototype.nav.nav')
</body>

</html>
