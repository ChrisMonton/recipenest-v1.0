<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the About Us page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('layouts.about');
    }
}
