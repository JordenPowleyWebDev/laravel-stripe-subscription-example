<?php

namespace App\Policies;

use App\Enums\UserPermissions;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Cashier\Subscription;

/**
 * Class SubscriptionPolicy
 */
class SubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * SubscriptionPolicy::before()
     *
     * @return void
     */
    public function before()
    {
        // Include Any Super Admin Overrides Here
    }

    /**
     * SubscriptionPolicy::viewAny()
     *
     * @param User $authUser
     * @return bool
     */
    public function viewAny(User $authUser): bool
    {
        return $authUser->can(UserPermissions::VIEW_ANY_SUBSCRIPTION);
    }

    /**
     * SubscriptionPolicy::view()
     *
     * @param User $authUser
     * @param Subscription $subscription
     * @return bool
     */
    public function view(User $authUser, Subscription $subscription): bool
    {
        return $authUser->can(UserPermissions::VIEW_SUBSCRIPTION);
    }

    /**
     * SubscriptionPolicy::create()
     *
     * @param User $authUser
     * @return bool
     */
    public function create(User $authUser): bool
    {
        return $authUser->can(UserPermissions::STORE_SUBSCRIPTION);
    }

    /**
     * SubscriptionPolicy::update()
     *
     * @param User $authUser
     * @param Subscription $subscription
     * @return bool
     */
    public function update(User $authUser, Subscription $subscription): bool
    {
        return $authUser->can(UserPermissions::UPDATE_SUBSCRIPTION);
    }

    /**
     * SubscriptionPolicy::delete()
     *
     * @param User $authUser
     * @param Subscription $subscription
     * @return bool
     */
    public function delete(User $authUser, Subscription $subscription): bool
    {
        return $authUser->can(UserPermissions::DELETE_SUBSCRIPTION);
    }

    /**
     * SubscriptionPolicy::restore()
     *
     * @param User $authUser
     * @param Subscription $subscription
     * @return bool
     */
    public function restore(User $authUser, Subscription $subscription): bool
    {
        return $authUser->can(UserPermissions::RESTORE_SUBSCRIPTION);
    }

    /**
     * SubscriptionPolicy::forceDelete()
     *
     * @param User $authUser
     * @param Subscription $subscription
     * @return bool
     */
    public function forceDelete(User $authUser, Subscription $subscription): bool
    {
        return $authUser->can(UserPermissions::DELETE_SUBSCRIPTION);
    }
}
