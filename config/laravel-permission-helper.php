<?php

use App\Enums\UserRoles;
use App\Models\StripeSubscriptionPlanDetail;
use App\Models\User;
use App\Policies\StripeSubscriptionPlanDetailPolicy;
use App\Policies\SubscriptionPolicy;
use App\Policies\UserPolicy;
use Laravel\Cashier\Subscription;

return [
    'views-namespace'   => 'laravel-permission-helper',
    'roles-enum'        => UserRoles::class,
    'model-bindings'    => [
        'user' => [
            'model'             => User::class,
            'policy'            => UserPolicy::class,
        ],
        'subscription' => [
            'model'             => Subscription::class,
            'policy'            => SubscriptionPolicy::class,
        ],
        'stripeSubscriptionPlanDetail' => [
            'model'             => StripeSubscriptionPlanDetail::class,
            'policy'            => StripeSubscriptionPlanDetailPolicy::class,
        ]
    ]
];
