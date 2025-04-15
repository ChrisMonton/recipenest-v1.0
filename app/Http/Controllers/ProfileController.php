<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Recipe;

class ProfileController extends Controller
{
    /**
     * Display the specified user's profile dashboard along with their posted recipes.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */

     public function myProfile()
     {
         // The authenticated user
         $user = Auth::user();
         // Pull the user’s recipes
         $myRecipes = Recipe::where('user_id', $user->id)->latest()->paginate(10);

         // Return the same Blade (resources/views/profile/show.blade.php)
         return view('profile.show', compact('user', 'myRecipes'));
     }

    public function show(User $user)
    {
        // Decide which profile picture to show (from DB or a default)
        $profilePic = $user->profile_picture
            ? asset('storage/' . $user->profile_picture)
            : asset('images/default-profile.png');

        // Retrieve the user's posted recipes (paginated)
        $myRecipes = Recipe::where('user_id', $user->id)->latest()->paginate(10);

        // Pass variables to the view (assumed to be at resources/views/profile/profile.blade.php)
        return view('profile.show', compact('user', 'profilePic', 'myRecipes'));
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


        $user = Auth::user();

        // Validate incoming request data
        $request->validate([
            'bio'             => 'nullable|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'phone'           => 'nullable|string|max:50',
        ]);

        // Update user's bio and phone
        $user->bio   = $request->input('bio');
        $user->phone = $request->input('phone');

        // Handle profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        // Redirect back to the authenticated user's profile page using route model binding
        return redirect()->route('profile.show', $user->id)
                         ->with('success', 'Profile updated successfully!');
    }
}
