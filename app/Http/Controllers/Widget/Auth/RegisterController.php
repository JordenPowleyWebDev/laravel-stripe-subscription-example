<?php

namespace App\Http\Controllers\Widget\Auth;

use App\Enums\UserRoles;
use App\Helpers\RouteHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * RegisterController::__construct()
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * RegisterController::redirectTo();
     * Overriding redirect function
     *
     * @return string
     */
    public function redirectTo(): string
    {
        try {
            return RouteHelper::home();
        } catch (\Exception $e) {
            return RouteHelper::login();
        }
    }

    /**
     * RegisterController::validator()
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return Validator
     */
    protected function validator(array $data): Validator
    {
        return Validator::make($data, [
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'max:255',
            ],
            'role' => [
                'required',
                'numeric',
                'exists:roles,id'
            ],
            'password' => PasswordRules::register($this->input('email'), true),
        ]);
    }

    /**
     * RegisterController::create()
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data): User
    {
        // Create the user
        /** @var User $user */
        $user = User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'role'          => UserRoles::CUSTOMER,
            'password'      => Hash::make($data['password']),
        ]);

        return $user;
    }
}
