<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the combined Step 1 & 2 registration form.
     */
    public function showStep12Form()
    {
        return view('auth.register');
    }

    /**
     * Process registration, send verification email, and log the user in.
     */
    public function processStep12(Request $request)
    {
        // 1) Validate everything from step 1 & 2
        $data = $request->validate([
            'first_name'        => 'required|string|max:50',
            'surname'           => 'required|string|max:50',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|confirmed|min:8',
            'phone_code'        => 'required|string',      // if you keep the country‑code select
            'phone'             => 'required|string|max:20',
            'date_of_birth'     => 'required|date',
            'role'              => 'required|in:user,chef',
        ]);

        // 2) Create the user (email remains unverified)
        $user = User::create([
            'first_name'    => $data['first_name'],
            'surname'       => $data['surname'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'phone'         => $data['phone_code'] . $data['phone'],
            'date_of_birth' => $data['date_of_birth'],
            'role'          => $data['role'],
        ]);

        // 3) Fire the Registered event — Laravel sends the verification email
        event(new Registered($user));

        // 4) Log the user in
        Auth::login($user);

        // 5) Redirect to the verify‑notice page
        return redirect()
            ->route('verification.notice')
            ->with('status', 'A verification link has been sent to your email address.');
    }
}
