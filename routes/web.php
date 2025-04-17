<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChefListController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeListBrowseController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\RegisterController;

// Authentication / Registration
Auth::routes([
    'register' => false,    // turn off the default GET/POST /register
    'verify'   => true,     // turn on email verification routes
]);

// Our custom registration pages
Route::get('register', [RegisterController::class, 'showStep12Form'])
     ->name('register');

Route::post('register', [RegisterController::class, 'processStep12'])
     ->name('register.process');

// Protect your home/dashboard so only verified users can see it
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified']);

// Public pages
Route::get('/',        [HomeController::class, 'index'])->name('homepage');
Route::get('/home',    [HomeController::class, 'index'])->name('home');
Route::get('/about',   [AboutController::class, 'index'])->name('about');


// All routes below require authentication
Route::middleware('auth')->group(function () {

    //
    // Notifications
    //
    Route::get('/notifications', [NotificationController::class, 'index'])
         ->name('notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAllAsRead'])
         ->name('notifications.markAllAsRead');

    //
    // Likes (toggle)
    //
    Route::post('/recipes/{recipe}/like', [LikeController::class, 'toggle'])
         ->name('recipes.like');

    //
    // Profile
    //
    Route::get('/profile',           [ProfileController::class, 'myProfile'])
         ->name('profile');
    Route::get('/profile/edit',      [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::put('/profile/update',    [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::get('/profile/{user}',    [ProfileController::class, 'show'])
         ->name('profile.show');

    //
    // Follow / Unfollow
    //
    Route::get('/follow/{user}',   [FollowController::class, 'follow'])
         ->name('follow');
    Route::get('/unfollow/{user}', [FollowController::class, 'unfollow'])
         ->name('unfollow');

    //
    // Account management (name, email, password)
    //
    Route::get('/account/manage', [AccountController::class, 'manage'])
         ->name('account.manage');
    Route::put('/account/manage', [AccountController::class, 'update'])
         ->name('account.update');

    //
    // Chef List (directory of users)
    //
    Route::get('/cheflist', [ChefListController::class, 'index'])
         ->name('cheflist.index');

    //
    // Portfolio
    //
    Route::get('/portfolio/{user}',      [PortfolioController::class, 'show'])
         ->name('portfolio.show');
    Route::get('/portfolio/{user}/edit', [PortfolioController::class, 'edit'])
         ->name('portfolio.edit');
    Route::put('/portfolio/{user}',      [PortfolioController::class, 'update'])
         ->name('portfolio.update');

    //
    // Recipe CRUD
    //
    //  • Browse all recipes

    //  • Create
    Route::get('/recipes/create',      [RecipeController::class, 'create'])
         ->name('recipes.create');
    Route::post('/recipes',            [RecipeController::class, 'store'])
         ->name('recipes.store');

    //  • Read / Detail
    Route::get('/recipes/{recipe}',    [RecipeController::class, 'show'])
         ->name('recipes.show');

    //  • Update
    Route::get('/recipes/{recipe}/edit',[RecipeController::class, 'edit'])
         ->name('recipes.edit');
    Route::put('/recipes/{recipe}',    [RecipeController::class, 'update'])
         ->name('recipes.update');

    //  • Delete
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])
         ->name('recipes.destroy');

         Route::get('/recipes', [RecipeController::class,'index'])
     ->name('recipes.index');



    //
    // A separate “browse” path if you need to exclude the owner’s own recipes
    //
    Route::get('/browse-recipes',      [RecipeListBrowseController::class, 'index'])
         ->name('recipes.browse');
    Route::get('/browse-recipes/{id}', [RecipeListBrowseController::class, 'show'])
         ->name('recipes.browse.show');

    //
    // Comments
    //
    Route::post('/comments',                [CommentsController::class, 'store'])
         ->name('comments.store');
    Route::get('/comments/{comment}/edit',  [CommentsController::class, 'edit'])
         ->name('comments.edit');
    Route::put('/comments/{comment}',       [CommentsController::class, 'update'])
         ->name('comments.update');
    Route::delete('/comments/{comment}',    [CommentsController::class, 'destroy'])
         ->name('comments.destroy');
});
