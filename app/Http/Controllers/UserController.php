<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

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
        return view('pages.user.index');
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

        return view('pages.user.show', [
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

        return view('pages.user.create', [
            "roles" => $roles,
        ]);
    }

    /**
     * UserController::store()
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = new User();
        $user->fill($data);
        if (array_key_exists('password', $data) && filled($data['password'])) {
            $user->password = bcrypt('password');
        }

        $user->save();

        $role = Role::findOrFail($data['role']);
        $user->syncRoles([$role]);

        return redirect()->route('user.show', ["user" => $user->id])
            ->with('success', 'User: '.$user->name.' Created.');
    }

    /**
     * UserController::edit()
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy("name", "ASC")->get()->transform(function ($role) {
            return [
                "value" => strval($role->id),
                "label" => UserRoles::toLabel($role->name),
            ];
        });

        return view('pages.user.edit', [
            "roles" => $roles,
            "user"  => $user
        ]);
    }

    /**
     * UserController::update()
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        $user->first_name   = $data['first_name'];
        $user->last_name    = $data['last_name'];
        $user->email        = $data['email'];

        if (array_key_exists('password', $data) && filled($data['password'])) {
            $user->password = bcrypt('password');
        }

        $user->save();

        $role = Role::findOrFail($data['role']);
        $user->syncRoles([$role]);

        return redirect()->route('user.show', ["user" => $user->id])
            ->with('success', 'User: '.$user->name.' Updated.');
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

        return view('pages.user.delete', [
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

        return redirect()->route('user.index')
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

        return redirect()->route('user.show', ['user' => $user->id])
            ->with('success', 'User: '.$user->name.' Restored.');
    }
}
