<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Recipe;
use App\Notifications\RecipeCommented;

class CommentsController extends Controller
{
    /**
     * Store a new comment and notify the recipe owner.
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'body'      => 'required|string',
        ]);

        $comment = Comment::create([
            'user_id'   => $request->user()->id,
            'recipe_id' => $request->input('recipe_id'),
            'body'      => $request->input('body'),
        ]);

        // Notify recipe owner
        $recipe = Recipe::find($comment->recipe_id);
        if ($recipe->user_id !== $request->user()->id) {
            $recipe->user->notify(new RecipeCommented(
                $request->user(),
                $recipe,
                $comment
            ));
        }

        return back()->with('success', 'Comment posted!');
    }

    /**
     * Show the edit form for an existing comment.
     */
    public function edit(Comment $comment)
    {
        // only the owner may edit
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update an existing comment.
     */
    public function update(Request $request, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'body' => 'required|string',
        ]);

        $comment->body = $request->input('body');
        $comment->save();

        return back()->with('success', 'Comment updated!');
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }
}
