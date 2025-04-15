<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Recipe;

class CommentsController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'body'      => 'required|max:3000',
        ]);

        // Create the comment
        $comment = new Comment();
        $comment->recipe_id = $request->input('recipe_id');
        $comment->user_id   = Auth::id(); // The currently logged-in user
        $comment->body      = $request->input('body');
        $comment->save();

        // Redirect back to the previous page (or anywhere you prefer)
        return redirect()->back()->with('success', 'Comment posted successfully!');
    }
}
