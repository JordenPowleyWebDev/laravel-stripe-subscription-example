<?php

use App\Enums\UserRoles;
use App\Models\User;
use App\Policies\UserPolicy;

return [
    'views-namespace'   => 'laravel-permission-helper',
    'roles-enum'        => UserRoles::class,
    'model-bindings'    => [
        'user'              => [
            'model'             => User::class,
            'policy'            => UserPolicy::class,
        ]
    ]
];
