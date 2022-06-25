<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use function bcrypt;
use function blank;
use function filled;
use function redirect;
use function view;

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * UserController::__construct().
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * UserController::index()
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.admin.user.index');
    }

    /**
     * UserController::show()
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        $userRoles = null;
        foreach ($user->getRoleNames() as $role) {
            if (blank($userRoles)) {
                $userRoles = Str::title($role);
            } else {
                $userRoles .= ", ".Str::title($role);
            }
        }

        return view('pages.admin.user.show', [
            "user"      => $user,
            "userRoles" => $userRoles
        ]);
    }

    /**
     * UserController::create()
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::orderBy("name", "ASC")->get()->transform(function ($role) {
            return [
                "value" => strval($role->id),
                "label" => UserRoles::toLabel($role->name),
            ];
        });

        return view('pages.admin.user.create', [
            "roles" => $roles,
        ]);
    }

    /**
     * UserController::edit()
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('pages.admin.user.edit', [
            "user"  => $user
        ]);
    }

    /**
     * UserController::delete()
     *
     * @param User $user
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function delete(User $user)
    {
        $this->authorize('delete', $user);

        return view('pages.admin.user.delete', [
            "user"  => $user
        ]);
    }

    /**
     * UserController::destroy()
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An Error Occurred Archiving User: '.$user->name);
        }

        return redirect()->route('admin.user.index')
            ->with('success', 'User: '.$user->name.' Archived.');
    }

    /**
     * UserController::restore()
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function restore(User $user): RedirectResponse
    {
        $user->restore();

        return redirect()->route('admin.user.show', ['user' => $user->id])
            ->with('success', 'User: '.$user->name.' Restored.');
    }
}
