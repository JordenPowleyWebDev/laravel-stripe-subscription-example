<?php

use App\Models\User;

return [
    'items' => [
        [
            "type"      => 'grouped',
            "label"     => 'Management',
            "icon"      => 'fas fa-cog fa-fw',
            "items"     => [
                [
                    "label"         => 'Users',
                    "icon"          => null,
                    "name"          => 'user.index',
                    "activeName"    => 'user.',
                    "can"           => [
                        "permission"    => 'viewAny',
                        "model"         => User::class,
                    ],
                ],
                [
                    "label"         => 'My Account',
                    "icon"          => null,
                    "name"          => 'my-account.edit',
                    "activeName"    => 'my-account.',
                ]
            ]
        ],
        [
            "type"      => 'single',
            "label"     => 'Logout',
            "icon"      => 'fas fa-sign-out-alt fa-fw',
            "name"      => 'logout',
        ],
    ]
];
