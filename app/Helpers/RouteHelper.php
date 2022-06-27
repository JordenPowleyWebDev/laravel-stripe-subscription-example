<?php

namespace App\Helpers;

use App\Models\User;

/**
 * Class RouteHelper
 * @package App\Helpers
 */
class RouteHelper
{
    /**
     * RouteHelper::home()
     *
     * @return string
     */
    public static function home(): string
    {
        return route('admin.stripeSubscriptionPlanDetail.index');
    }

    /**
     * RouteHelper::login()
     *
     * @return string
     */
    public static function login(): string
    {
        return route('admin.login');
    }
}
