<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Notifications\RecipeLiked;

class LikeController extends Controller
{
    public function toggle(Request $request, Recipe $recipe)
    {
        $user = $request->user();

        // If already liked, detach; otherwise attach and notify
        if ($recipe->likes()->where('user_id', $user->id)->exists()) {
            $recipe->likes()->detach($user->id);
        } else {
            $recipe->likes()->attach($user->id);

            // send notification to the recipe owner (if not self)
            if ($recipe->user_id !== $user->id) {
                $recipe->user
                       ->notify(new RecipeLiked($user, $recipe));
            }
        }

        return back();
    }
}
