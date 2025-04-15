<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model

class ChefListController extends Controller
{
    public function __construct()
    {
        // Ensure a user must be logged in to access this controller.
        $this->middleware('auth');
    }

    /**
     * Display the Chef List page.
     *
     * Retrieves a list of users with roles 'chef' and 'user', excluding the current user,
     * and passes them to the view.
     */
    public function index()
    {
        $chefs = User::where('id', '!=', Auth::id())
                     ->whereIn('role', ['chef', 'user'])
                     ->latest()
                     ->paginate(10);

        return view('layouts.ChefList', compact('chefs'));
    }
}
