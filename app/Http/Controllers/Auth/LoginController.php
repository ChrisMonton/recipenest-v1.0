<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\FlasherHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    protected function authenticated(Request $request, $user)
    {
        FlasherHelper::alert('success', 'Login was successful');
        return redirect()->route('home')->with('message', 'Login Successful');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'home';


    /**
     * Undocumented function
     * Custom Login page
     *
     * @return void
     */
    public function showLoginForm1()
    {
        return view('pages.custom.users.auth.login');  // This will load the default login view
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
