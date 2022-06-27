<?php

namespace App\Http\Controllers\Widget\Auth;

use App\Helpers\RouteHelper;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\View\View;

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

    /**
     * LoginController::__construct()
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * LoginController::showLoginForm()
     * Show the application's login form.
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('pages.widget.auth.login');
    }

    /**
     * LoginController::redirectTo()
     *
     * @return string
     */
    public function redirectTo(): string
    {
        return RouteHelper::home();
    }
}
