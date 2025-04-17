<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RecipeLiked;    // you'll need to create this notification
use App\Notifications\RecipeCommented;

class RecipeController extends Controller
{
    /**
     * Display a paginated listing of recipes.
     */
    // RecipeController.php
public function index()
{
    $recipes = Recipe::latest()->paginate(12);
    return view('recipes.index', compact('recipes'));
}


    /**
     * Toggle “like” (love) on a recipe.
     */
    public function like(Recipe $recipe)
    {
        $me = Auth::user();

        // toggle the pivot entry
        if ($recipe->likes()->where('user_id', $me->id)->exists()) {
            $recipe->likes()->detach($me->id);
        } else {
            $recipe->likes()->attach($me->id);

            // notify the owner if it’s not themselves
            if ($recipe->user_id !== $me->id) {
                $recipe->user->notify(new RecipeLiked($me, $recipe));
            }
        }

        return back();
    }

    /**
     * Show a single recipe (if you still need a dedicated detail page).
     */
    public function show(Recipe $recipe)
    {
        $recipe->load(['user', 'comments.user', 'likes']);
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show form to create a new recipe.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created recipe.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|max:255',
            'ingredients'      => 'required',
            'instructions'     => 'required',
            'full_description' => 'required',
            'public'           => 'required|boolean',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        Recipe::create([
            'user_id'          => Auth::id(),
            'title'            => $request->title,
            'ingredients'      => $request->ingredients,
            'instructions'     => $request->instructions,
            'full_description' => $request->full_description,
            'public'           => $request->public,
            'image'            => $request->hasFile('image')
                                    ? $request->file('image')->store('recipe-images','public')
                                    : null,
        ]);

        return redirect()->route('myrecipes.index')
                         ->with('success','Recipe created!');
    }

    /**
     * Show form to edit an existing recipe.
     */
    public function edit(Recipe $recipe)
    {
        if (Auth::id() !== $recipe->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update an existing recipe.
     */
    public function update(Request $request, Recipe $recipe)
    {
        if (Auth::id() !== $recipe->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title'            => 'required|max:255',
            'ingredients'      => 'required',
            'instructions'     => 'required',
            'full_description' => 'required',
            'public'           => 'required|boolean',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only([
            'title','ingredients','instructions','full_description','public'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                                 ->store('recipe-images','public');
        }

        $recipe->update($data);

        return redirect()->route('myrecipes.index')
                         ->with('success','Recipe updated!');
    }

    /**
     * Delete a recipe.
     */
    public function destroy(Recipe $recipe)
    {
        if (Auth::id() !== $recipe->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $recipe->delete();

        return redirect()->route('myrecipes.index')
                         ->with('success','Recipe deleted!');
    }
}
