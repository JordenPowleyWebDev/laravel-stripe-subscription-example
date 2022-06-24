<?php

namespace App\Policies;

use App\Enums\UserPermissions;
use App\Models\StripeSubscriptionPlanDetail;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class StripeSubscriptionPlanDetailPolicy
 */
class StripeSubscriptionPlanDetailPolicy
{
    use HandlesAuthorization;

    /**
     * StripeSubscriptionPlanDetailPolicy::before()
     *
     * @return void
     */
    public function before()
    {
        // Include Any Super Admin Overrides Here
    }

    /**
     * StripeSubscriptionPlanDetailPolicy::viewAny()
     *
     * @param User $authUser
     * @return bool
     */
    public function viewAny(User $authUser): bool
    {
        return $authUser->can(UserPermissions::VIEW_ANY_STRIPE_SUBSCRIPTION_PLAN_DETAIL);
    }

    /**
     * StripeSubscriptionPlanDetailPolicy::view()
     *
     * @param User $authUser
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return bool
     */
    public function view(User $authUser, StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): bool
    {
        return $authUser->can(UserPermissions::VIEW_STRIPE_SUBSCRIPTION_PLAN_DETAIL);
    }

    /**
     * StripeSubscriptionPlanDetailPolicy::create()
     *
     * @param User $authUser
     * @return bool
     */
    public function create(User $authUser): bool
    {
        return $authUser->can(UserPermissions::STORE_STRIPE_SUBSCRIPTION_PLAN_DETAIL);
    }

    /**
     * StripeSubscriptionPlanDetailPolicy::update()
     *
     * @param User $authUser
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return bool
     */
    public function update(User $authUser, StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): bool
    {
        return $authUser->can(UserPermissions::UPDATE_STRIPE_SUBSCRIPTION_PLAN_DETAIL);
    }

    /**
     * StripeSubscriptionPlanDetailPolicy::delete()
     *
     * @param User $authUser
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return bool
     */
    public function delete(User $authUser, StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): bool
    {
        return $authUser->can(UserPermissions::DELETE_STRIPE_SUBSCRIPTION_PLAN_DETAIL);
    }

    /**
     * StripeSubscriptionPlanDetailPolicy::restore()
     *
     * @param User $authUser
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return bool
     */
    public function restore(User $authUser, StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): bool
    {
        return $authUser->can(UserPermissions::RESTORE_STRIPE_SUBSCRIPTION_PLAN_DETAIL);
    }

    /**
     * StripeSubscriptionPlanDetailPolicy::forceDelete()
     *
     * @param User $authUser
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return bool
     */
    public function forceDelete(User $authUser, StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): bool
    {
        return $authUser->can(UserPermissions::DELETE_STRIPE_SUBSCRIPTION_PLAN_DETAIL);
    }
}
