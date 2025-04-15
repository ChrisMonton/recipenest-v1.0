<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChefListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RecipeListBrowseController;
use App\Http\Controllers\CommentsController;
// Auth routes (including register/login)
Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

//profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'myProfile'])->name('profile');
       // Show a profile using route model binding
       Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

     // Show edit form for the user's profile
     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

     // Update the user's profile
     Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

 });

//registration route

Route::get('/register', [RegisterController::class, 'showStep12Form'])
    ->name('register.show');

// Form POST after Steps 1 & 2

Route::post('/register', [RegisterController::class, 'processStep12'])
    ->name('register');


// Home route

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');



// My recipes route

Route::middleware('auth')->group(function () {
    // Show authenticated user's recipes
    Route::get('/my-recipes', [RecipeController::class, 'myRecipes'])->name('myrecipes.index');
    //
    Route::get('/recipes/user/{user}', [\App\Http\Controllers\RecipeListBrowseController::class, 'byUser'])
    ->name('recipes.byuser');

    //recipes.show

    //Route::get('/recipes/{recipe}', [\App\Http\Controllers\RecipeController::class, 'show'])->name('recipes.recipes');

    // Display the form for creating a new recipe
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');

    // Handle the form submission to store a new recipe
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');

    //edit recipes route
    Route::get('/recipes/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
    Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipes.recipes');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
});


Route::middleware('auth')->group(function () {
    Route::get('/recipes', [RecipeListBrowseController::class, 'index'])->name('recipes.index');
});

//Recipes browse list route
Route::middleware('auth')->group(function () {
    // Browse Recipes (excluding logged-in user's own recipes)
    Route::get('/browse-recipes', [RecipeListBrowseController::class, 'index'])->name('recipes.browse');

    // Show specific recipe detail
    Route::get('/browse-recipes/{id}', [RecipeListBrowseController::class, 'show'])->name('recipes.browse.show');


// Route to show all chefs/authors
Route::get('/cheflist', [ChefListController::class, 'index'])->name('cheflist.index');

Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');




});
