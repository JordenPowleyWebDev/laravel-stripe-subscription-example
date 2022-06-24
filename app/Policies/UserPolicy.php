<?php

namespace App\Policies;

use App\Enums\UserPermissions;
use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * UserPolicy::before()
     *
     * @return void
     */
    public function before()
    {
        // Include Any Super Admin Overrides Here
    }

    /**
     * UserPolicy::viewAny()
     *
     * @param User $authUser
     * @return bool
     */
    public function viewAny(User $authUser): bool
    {
        return $authUser->can(UserPermissions::VIEW_ANY_USER);
    }

    /**
     * UserPolicy::view()
     *
     * @param User $authUser
     * @param User $user
     * @return bool
     */
    public function view(User $authUser, User $user): bool
    {
        return $authUser->can(UserPermissions::VIEW_USER);
    }

    /**
     * UserPolicy::create()
     *
     * @param User $authUser
     * @return bool
     */
    public function create(User $authUser): bool
    {
        return $authUser->can(UserPermissions::STORE_USER);
    }

    /**
     * UserPolicy::update()
     *
     * @param User $authUser
     * @param User $user
     * @return bool
     */
    public function update(User $authUser, User $user): bool
    {
        if ($authUser->role_name !== UserRoles::SUPER_ADMIN && $user->role_name === UserRoles::SUPER_ADMIN) {
            return false;
        }

        if (filled($user->deleted_at)) {
            return false;
        }

        return $authUser->can(UserPermissions::UPDATE_USER);
    }

    /**
     * UserPolicy::delete()
     *
     * @param User $authUser
     * @param User $user
     * @return bool
     */
    public function delete(User $authUser, User $user): bool
    {
        if ($authUser->role_name !== UserRoles::SUPER_ADMIN && $user->role_name === UserRoles::SUPER_ADMIN) {
            return false;
        }

        if ($user->id === $authUser->id) {
            return false;
        }

        return $authUser->can(UserPermissions::DELETE_USER);
    }

    /**
     * UserPolicy::restore()
     *
     * @param User $authUser
     * @param User $user
     * @return bool
     */
    public function restore(User $authUser, User $user): bool
    {
        if ($authUser->role_name !== UserRoles::SUPER_ADMIN && $user->role_name === UserRoles::SUPER_ADMIN) {
            return false;
        }

        return $authUser->can(UserPermissions::RESTORE_USER);
    }

    /**
     * UserPolicy::forceDelete()
     *
     * @param User $authUser
     * @param User $user
     * @return bool
     */
    public function forceDelete(User $authUser, User $user): bool
    {
        if ($authUser->role_name !== UserRoles::SUPER_ADMIN && $user->role_name === UserRoles::SUPER_ADMIN) {
            return false;
        }

        if ($authUser->id === $user->id) {
            return false;
        }

        return $authUser->can(UserPermissions::DELETE_USER);
    }
}
