<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Show the Manage Account page.
     */
    public function manage()
    {
        $user = Auth::user();
        return view('account.manage', compact('user'));
    }

    /**
     * Update the authenticated user's account.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request.
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            // Password is optional; if provided, must match confirmation and meet strength requirements.
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update name and email.
        $user->name  = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Update password if provided.
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('account.manage')->with('success', 'Account updated successfully.');
    }
}
