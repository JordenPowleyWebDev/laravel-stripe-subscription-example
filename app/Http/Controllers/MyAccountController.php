<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateMyAccountRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

/**
 * Class MyAccountController
 */
class MyAccountController extends Controller
{
    /**
     * MyAccountController::edit()
     *
     * @return Application|Factory
     */
    public function edit()
    {
        return view('pages.my-account.edit', [
            "user"  => Auth::user(),
        ]);
    }

    /**
     * MyAccountController::update()
     *
     * @param UpdateMyAccountRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateMyAccountRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user               = Auth::user();
        $user->first_name   = $data['first_name'];
        $user->last_name    = $data['last_name'];
        $user->email        = $data['email'];

        if (array_key_exists('password', $data) && filled($data['password'])) {
            $user->password = bcrypt('password');
        }

        $user->save();

        return redirect()->route('my-account.edit')
            ->with('success',  'Account Updated.');
    }
}
