<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\RouteHelper;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'token' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
            ],
            'password' => PasswordRules::register(request()->input('email'), true),
        ];
    }

    /**
     * ResetPasswordController::redirectTo()
     *
     * @return string
     */
    public function redirectTo(): string
    {
        return RouteHelper::home();
    }
}
