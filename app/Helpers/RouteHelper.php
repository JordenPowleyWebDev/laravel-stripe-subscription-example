<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

/**
 * Class RouteHelper
 * @package App\Helpers
 */
class RouteHelper
{
    /**
     * RouteHelper::isAdminDomain()
     *
     * @return bool
     */
    public static function isAdminDomain(): bool
    {
        return str_starts_with(Route::current()->getDomain(), 'admin.');
    }

    /**
     * RouteHelper::home()
     *
     * @return string
     */
    public static function home(): string
    {
        if (self::isAdminDomain()) {
            return route('admin.stripeSubscriptionPlanDetail.index');
        }

        return route('widget.subscription.index');
    }

    /**
     * RouteHelper::login()
     *
     * @return string
     */
    public static function login(): string
    {
        if (self::isAdminDomain()) {
            return route('admin.login');
        }
        return route('widget.login');
    }
}
