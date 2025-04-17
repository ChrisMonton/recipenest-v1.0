<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FollowController extends Controller
{
    /**
     * Follow the given user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follow(User $user)
    {
        // Check if the authenticated user is not already following the user:
        if (!Auth::user()->following()->where('followed_id', $user->id)->exists()) {
            // Add the followed user using your many-to-many relationship.
            Auth::user()->following()->attach($user->id);
        }

        return redirect()->back()->with('success', 'You are now following ' . $user->first_name);
    }

    /**
     * Unfollow the given user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unfollow(User $user)
    {
        // Remove the relationship from the following pivot table.
        Auth::user()->following()->detach($user->id);

        return redirect()->back()->with('success', 'You have unfollowed ' . $user->first_name);
    }
}
