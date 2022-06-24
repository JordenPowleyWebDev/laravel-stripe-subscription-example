<?php

use App\Models\StripeSubscriptionPlanDetail;
use App\Models\User;

return [
    'items' => [
        [
            "type"      => 'grouped',
            "label"     => 'Management',
            "icon"      => 'fas fa-cog fa-fw',
            "items"     => [
                [
                    "label"         => 'Stripe Subscription Plan Details',
                    "icon"          => null,
                    "name"          => 'admin.stripeSubscriptionPlanDetail.index',
                    "activeName"    => 'admin.stripeSubscriptionPlanDetail.',
                    "can"           => [
                        "permission"    => 'viewAny',
                        "model"         => StripeSubscriptionPlanDetail::class,
                    ],
                ],
                [
                    "label"         => 'Users',
                    "icon"          => null,
                    "name"          => 'admin.user.index',
                    "activeName"    => 'admin.user.',
                    "can"           => [
                        "permission"    => 'viewAny',
                        "model"         => User::class,
                    ],
                ],
                [
                    "label"         => 'My Account',
                    "icon"          => null,
                    "name"          => 'admin.my-account.edit',
                    "activeName"    => 'admin.my-account.',
                ]
            ]
        ],
        [
            "type"      => 'single',
            "label"     => 'Logout',
            "icon"      => 'fas fa-sign-out-alt fa-fw',
            "name"      => 'admin.logout',
        ],
    ]
];
