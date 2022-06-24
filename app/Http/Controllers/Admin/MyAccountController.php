<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateMyAccountRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use function bcrypt;
use function filled;
use function redirect;
use function view;

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
        return view('pages.admin.my-account.edit', [
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

        return redirect()->route('admin.my-account.edit')
            ->with('success', 'Account Updated.');
    }
}
