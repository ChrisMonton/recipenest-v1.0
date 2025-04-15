<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'RecipeNest') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Vite Scripts (includes Bootstrap if set up in Laravel) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        /* Reset default margins/padding */
        html, body {
            margin: 0;
            padding: 0;
        }
        /* Remove any navbar bottom margin */
        .navbar {
            margin-bottom: 0;
        }
        /* Remove extra padding from main */
        main {
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="app">
        {{-- Include the Navbar Partial --}}
        @include('partials.navbar')

        <!-- Main Content Yield -->
        <main>
            @yield('content')
        </main>

        <!-- LOGIN MODAL -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">{{ __('Login') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                    </div>
                    <!-- Modal Body with Login Form -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control"
                                       name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control"
                                       name="password" required>
                            </div>
                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Login') }}
                            </button>
                        </form>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END LOGIN MODAL -->

        <!-- Create Recipe Modal -->
        <div class="modal fade" id="createRecipeModal" tabindex="-1" aria-labelledby="createRecipeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRecipeModalLabel">Create Recipe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Title -->
                            <div class="mb-3">
                                <label for="recipeTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="recipeTitle" name="title" required>
                            </div>

                            <!-- Ingredients (short list or brief overview) -->
                            <div class="mb-3">
                                <label for="recipeIngredients" class="form-label">Ingredients</label>
                                <textarea class="form-control" id="recipeIngredients" name="ingredients" rows="3" required></textarea>
                            </div>

                            <!-- Recipe Ingredients (detailed list) -->
                            <div class="mb-3">
                                <label for="detailedIngredients" class="form-label">Recipe Ingredients</label>
                                <textarea class="form-control" id="detailedIngredients" name="recipe_ingredients" rows="3" required></textarea>
                            </div>

                            <!-- Recipe Description -->
                            <div class="mb-3">
                                <label for="recipeDescription" class="form-label">Recipe Description</label>
                                <textarea class="form-control" id="recipeDescription" name="recipe_description" rows="4" required></textarea>
                            </div>

                            <!-- Upload Image -->
                            <div class="mb-3">
                                <label for="recipeImage" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="recipeImage" name="image" accept="image/*">
                            </div>

                            <!-- Public/Private Toggle -->
                            <div class="mb-3">
                                <label class="form-label">Visibility</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_public" id="publicOption" value="1" checked>
                                        <label class="form-check-label" for="publicOption">Public</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_public" id="privateOption" value="0">
                                        <label class="form-check-label" for="privateOption">Private</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Recipe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
