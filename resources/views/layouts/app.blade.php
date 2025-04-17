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

  <!-- Vite Scripts (includes Bootstrap) -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <style>
    /* Fixed Navbar */
    .navbar {
      position: fixed;
      top: 0; left: 0; width: 100%;
      z-index: 1000;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    body { padding-top: 70px; }

    /* Card lift effect */
    .card {
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: transform .3s;
    }
    .card:hover { transform: translateY(-5px); }

    .card-body { padding: 15px; text-align: center; }
    .card-title { font-size: 1.25rem; font-weight: bold; color: #333; }
    .card-text  { color: #555; font-size: 1rem; }
    .btn-primary { background-color: #a06c24; border: none; }

    /* Offset for sample recipes */
    #sample-recipes { margin-top: 120px; }
  </style>

  {{-- Page-specific styles --}}
  @yield('styles')
</head>
<body>
  <div id="app">
    {{-- Navbar --}}
    @include('partials.navbar')

    <main>
      @yield('content')

      {{-- Sample Recipes for Guests --}}
      @if(Auth::guest() && Route::currentRouteName() !== 'about')
        <div id="sample-recipes" class="container my-5">
          <h3 class="text-center mb-4">Sample Recipes</h3>
          <div class="row">
            <!-- Sample Recipe Card 1 -->
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Recipe Image">
                <div class="card-body">
                  <h5 class="card-title">Sample Recipe 1</h5>
                  <p class="card-text">A delicious recipe for you to try! Quick and easy.</p>
                  <a href="#" class="btn btn-primary">View Recipe</a>
                </div>
              </div>
            </div>
            <!-- Sample Recipe Card 2 -->
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Recipe Image">
                <div class="card-body">
                  <h5 class="card-title">Sample Recipe 2</h5>
                  <p class="card-text">A healthy and nutritious meal for everyone!</p>
                  <a href="#" class="btn btn-primary">View Recipe</a>
                </div>
              </div>
            </div>
            <!-- Sample Recipe Card 3 -->
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Recipe Image">
                <div class="card-body">
                  <h5 class="card-title">Sample Recipe 3</h5>
                  <p class="card-text">An easy recipe for a quick meal after a busy day.</p>
                  <a href="#" class="btn btn-primary">View Recipe</a>
                </div>
              </div>
            </div>
            <!-- Sample Recipe Card 4 -->
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Recipe Image">
                <div class="card-body">
                  <h5 class="card-title">Sample Recipe 4</h5>
                  <p class="card-text">A flavorful recipe that's both healthy and delicious.</p>
                  <a href="#" class="btn btn-primary">View Recipe</a>
                </div>
              </div>
            </div>
            <!-- Sample Recipe Card 5 -->
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Recipe Image">
                <div class="card-body">
                  <h5 class="card-title">Sample Recipe 5</h5>
                  <p class="card-text">Quick, easy, and tasty! A must-try recipe for busy nights.</p>
                  <a href="#" class="btn btn-primary">View Recipe</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    </main>

    {{-- LOGIN MODAL --}}
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">{{ __('Login') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control" name="password" required>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
              </div>
              <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
          </div>
        </div>
      </div>
    </div>
    {{-- END LOGIN MODAL --}}

    {{-- CREATE RECIPE MODAL --}}
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
              <!-- Short Ingredients -->
              <div class="mb-3">
                <label for="recipeIngredients" class="form-label">Ingredients</label>
                <textarea class="form-control" id="recipeIngredients" name="ingredients" rows="3" required></textarea>
              </div>
              <!-- Detailed Ingredients -->
              <div class="mb-3">
                <label for="detailedIngredients" class="form-label">Recipe Ingredients</label>
                <textarea class="form-control" id="detailedIngredients" name="recipe_ingredients" rows="3" required></textarea>
              </div>
              <!-- Description -->
              <div class="mb-3">
                <label for="recipeDescription" class="form-label">Recipe Description</label>
                <textarea class="form-control" id="recipeDescription" name="recipe_description" rows="4" required></textarea>
              </div>
              <!-- Upload Image -->
              <div class="mb-3">
                <label for="recipeImage" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="recipeImage" name="image" accept="image/*">
              </div>
              <!-- Visibility -->
              <div class="mb-3">
                <label class="form-label">Visibility</label>
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="public" id="publicOption" value="1" checked>
                    <label class="form-check-label" for="publicOption">Public</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="public" id="privateOption" value="0">
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
    {{-- END CREATE RECIPE MODAL --}}
  </div> {{-- /#app --}}

  {{-- Page-specific scripts --}}
  @stack('scripts')
</body>
</html>
