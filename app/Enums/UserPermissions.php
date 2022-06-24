<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class UserPermissions
 * @package App\Enums
 */
final class UserPermissions extends Enum
{
    const VIEW_ANY_USER = "view-any-user";
    const VIEW_USER     = "view-user";
    const STORE_USER    = "store-user";
    const UPDATE_USER   = "update-user";
    const DELETE_USER   = "delete-user";
    const RESTORE_USER  = "restore-user";

    const VIEW_ANY_SUBSCRIPTION = "view-any-subscription";
    const VIEW_SUBSCRIPTION     = "view-subscription";
    const STORE_SUBSCRIPTION    = "store-subscription";
    const UPDATE_SUBSCRIPTION   = "update-subscription";
    const DELETE_SUBSCRIPTION   = "delete-subscription";
    const RESTORE_SUBSCRIPTION  = "restore-subscription";

    const VIEW_ANY_STRIPE_SUBSCRIPTION_PLAN_DETAIL  = "view-any-stripe-subscription-plan-detail";
    const VIEW_STRIPE_SUBSCRIPTION_PLAN_DETAIL      = "view-stripe-subscription-plan-detail";
    const STORE_STRIPE_SUBSCRIPTION_PLAN_DETAIL     = "store-stripe-subscription-plan-detail";
    const UPDATE_STRIPE_SUBSCRIPTION_PLAN_DETAIL    = "update-stripe-subscription-plan-detail";
    const DELETE_STRIPE_SUBSCRIPTION_PLAN_DETAIL    = "delete-stripe-subscription-plan-detail";
    const RESTORE_STRIPE_SUBSCRIPTION_PLAN_DETAIL   = "restore-stripe-subscription-plan-detail";
}
