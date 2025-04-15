<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class RecipeListBrowseController extends Controller
{
    /**
     * Display a paginated listing of recipes from other users and chefs.
     */
    public function index()
    {
        // Get the currently logged-in user ID
        $currentUserId = Auth::id();

        // Retrieve recipes excluding the current user's recipes
        $recipes = Recipe::with('user')
            ->where('user_id', '!=', $currentUserId)
            ->latest()
            ->paginate(10);

        return view('recipes.recipes', compact('recipes'));
    }
    public function byUser(\App\Models\User $user)
    {
        // Retrieve the recipes for the specified user (paginated)
        $recipes = \App\Models\Recipe::where('user_id', $user->id)->latest()->paginate(10);

        // Return a view that displays the user's recipe album
        return view('recipes.byuser', compact('user', 'recipes'));
    }

    /**
     * Display a single recipe's details.
     */
    public function show($id)
    {
        $recipe = Recipe::with('user')->findOrFail($id);

        return view('recipes.show', compact('recipe'));
    }
}
