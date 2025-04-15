<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showStep12Form()
    {
        return view('auth.register');
    }

    public function processStep12(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'surname'    => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed',
            'phone'      => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'role'          => 'required|in:user,chef',
        ]);

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'date_of_birth' => $request->input('date_of_birth'),
            'role' => $request->input('role'),
        ]);

        Auth::login($user);

        return redirect('home')->with('success', 'Account Created Successfully');
    }
}
