<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Portfolio;  // Make sure you have created this model

class PortfolioController extends Controller
{
    /**
     * Display the specified user's portfolio.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        // Load the portfolio record from the user's relation.
        // This might be null if the user has not set up their portfolio yet.
        $portfolio = $user->portfolio;
        return view('portfolio.show', compact('user', 'portfolio'));
    }

    /**
     * Show the form for editing the authenticated user's portfolio.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        // Ensure that the authenticated user can edit their own portfolio
        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        // Load the portfolio record; if it does not exist, create a new instance (but do not save yet)
        $portfolio = $user->portfolio ?? new Portfolio(['user_id' => $user->id]);
        return view('portfolio.edit', compact('user', 'portfolio'));
    }

    /**
     * Update the specified user's portfolio in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // Validate the input data for multiple fields
        $data = $request->validate([
            'experience'  => 'nullable|string',
            'education'   => 'nullable|string',
            'interests'   => 'nullable|string',
            'specialties' => 'nullable|string',
        ]);

        // Retrieve the portfolio record using a query.
        // This ensures that if a record already exists, we update it.
        $portfolio = \App\Models\Portfolio::where('user_id', $user->id)->first();

        if (!$portfolio) {
            // Create a new portfolio record if one doesn't exist.
            $portfolio = new \App\Models\Portfolio();
            $portfolio->user_id = $user->id;
        }

        // Update the portfolio fields
        $portfolio->experience  = $data['experience']  ?? null;
        $portfolio->education   = $data['education']   ?? null;
        $portfolio->interests   = $data['interests']   ?? null;
        $portfolio->specialties = $data['specialties'] ?? null;
        $portfolio->save();

        return redirect()->route('portfolio.show', $user->id)
                         ->with('success', 'Portfolio updated successfully!');
    }
}
