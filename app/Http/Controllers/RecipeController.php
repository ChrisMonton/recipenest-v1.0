<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Show a listing of the authenticated user's recipes.
     */
    public function myRecipes()
    {
        $recipes = Recipe::where('user_id', Auth::id())
                         ->latest()
                         ->paginate(10);

        return view('recipes.my-recipes', compact('recipes'));
    }

    /**
     * Display the form for creating a new recipe.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created recipe in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data.
        $request->validate([
            'title'            => 'required|max:255',
            'ingredients'      => 'required',
            'instructions'     => 'required',        // Corresponds to your migration field "instructions"
            'full_description' => 'required',        // Corresponds to your migration field "full_description"
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'public'           => 'required|boolean',  // Updated from is_public to public
        ]);

        $recipe = new Recipe();
        $recipe->user_id = Auth::id();
        $recipe->title = $request->input('title');
        $recipe->ingredients = $request->input('ingredients');
        $recipe->instructions = $request->input('instructions');
        $recipe->full_description = $request->input('full_description');
        $recipe->public = $request->input('public');  // Use the column "public" as defined in your migration

        // Handle image upload if provided.
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('recipe-images', 'public');
            $recipe->image = $path;
        }

        $recipe->save();

        return redirect()->route('myrecipes.index')
                         ->with('success', 'Recipe created successfully!');
    }
}
