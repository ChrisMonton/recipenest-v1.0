<?php

use Illuminate\Support\Facades\Route;

Route::prefix('prototype')->name('prototype.')->group(function () {
    Route::view('/', 'pages.prototype.users.home.homepage')->name('home');
    Route::view('/chefs', 'pages.prototype.users.chef-list.index')->name('chefs.index');
    Route::view('/chefs/1', 'pages.prototype.users.profile.show')->name('chefs.show');
    Route::view('/chefs/1/portfolio', 'pages.prototype.users.portfolio.main')->name('chefs.portfolio');
    Route::view('/recipes', 'pages.prototype.users.recipe-list.index')->name('recipes.index');
    Route::view('/recipes/1', 'pages.prototype.users.recipe-single.show')->name('recipes.show');
    Route::view('/login', 'pages.prototype.users.auth.login')->name('login');
    Route::view('/register', 'pages.prototype.users.auth.register')->name('register');
    // Dashboard
    Route::view('/authors/home', 'pages.prototype.authors.home.dashboard')->name('authors.home');
    Route::view('/authors/recipes', 'pages.prototype.authors.recipe-list.index')->name('authors.recipes.index');
    Route::view('/authors/recipes/create', 'pages.prototype.authors.recipe-create.create')->name('authors.recipes.create');
    Route::view('/authors/profile/1/edit', 'pages.prototype.authors.profile-edit.edit')->name('authors.profile.edit');

});
