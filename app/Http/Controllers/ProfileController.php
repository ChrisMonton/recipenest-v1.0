<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Recipe;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile dashboard along with their posted recipes.
     */
    public function myProfile()
    {
        // The authenticated user
        $user = Auth::user();
        // Pull the user’s recipes with pagination
        $myRecipes = Recipe::where('user_id', $user->id)->latest()->paginate(10);
        // Define the profile picture variable
        $profilePic = $user->profile_picture
            ? asset('storage/' . $user->profile_picture)
            : asset('images/default-profile.png');

        // When viewing your own profile, you don't need follow/unfollow
        $isFollowing = false;
        // Calculate followers count (assuming the followers() relationship exists)
        $followersCount = $user->followers()->count();

        return view('profile.show', compact('user', 'profilePic', 'myRecipes', 'isFollowing', 'followersCount'));
    }

    /**
     * Display the specified user's profile dashboard along with their posted recipes.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
{
    // Define profile picture variable
    $profilePic = $user->profile_picture
        ? asset('storage/' . $user->profile_picture)
        : asset('images/default-profile.png');

    // Retrieve the user's recipes (paginated)
    $myRecipes = Recipe::where('user_id', $user->id)->latest()->paginate(10);

    // Check if the authenticated user is following this profile
    if (Auth::check() && Auth::id() !== $user->id) {
        $isFollowing = $user->followers()->where('follower_id', Auth::id())->exists();
    } else {
        $isFollowing = false;
    }

    // Count of followers
    $followersCount = $user->followers()->count();

    return view('profile.show', compact('user', 'profilePic', 'myRecipes', 'isFollowing', 'followersCount'));

    $myRecipes = Recipe::with('comments')
    ->where('user_id', $user->id)
    ->latest()
    ->paginate(10);
}


    /**
     * Show an edit form for the authenticated user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Handle the update request for the authenticated user's profile.
     */
    public function update(Request $request)
    {
        $options = [
            'Soups','Stews','Stir-fries','Grills / Barbecues','Roasts','Curries',
            'Bakes / Casseroles','Sandwiches / Wraps / Burgers','Noodles / Pasta',
            'Rice dishes','Pies / Tarts','Pancakes / Crepes / Waffles','Dumplings',
            'Skewers / Kebabs','Sushi / Sashimi','Pickles / Fermented foods',
            'Dips / Spreads','Smoothies / Shakes'
        ];

        $request->validate([
            'bio'         => 'nullable|max:1000',
            'phone'       => 'nullable|string|max:50',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

            // specialties array validation:
            'specialties'   => 'nullable|array|max:3',
            'specialties.*' => 'in:' . implode(',', $options),
        ]);

        $user = Auth::user();
        $user->bio   = $request->input('bio');
        $user->phone = $request->input('phone');
        $user->specialties = $request->input('specialties', []);

        // handle picture upload …
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')
                            ->store('profile-pictures','public');
            $user->profile_picture = $path;
        }

        $user->save();

        return back()->with('success','Profile updated successfully!');
    }

    // …

}
