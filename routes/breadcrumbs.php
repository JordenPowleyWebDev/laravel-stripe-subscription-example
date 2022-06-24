<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// User -> Index
Breadcrumbs::for('user.index', function ($trail) {
    $trail->push('Users', route('user.index'));
});

// User -> Create
Breadcrumbs::for('user.create', function ($trail) {
    $trail->parent('user.index');
    $trail->push('Create User', route('user.create'));
});

//  User -> Show
Breadcrumbs::for( 'user.show', function ($trail, $user) {
    $trail->parent('user.index');
    $trail->push($user->name, route('user.show', $user));
});

// User -> Show -> Edit
Breadcrumbs::for('user.edit', function ($trail, $user) {
    $trail->parent('user.show', $user);
    $trail->push('Edit', route('user.edit', $user));
});

// My Account -> Edit
Breadcrumbs::for('my-account.edit', function ($trail) {
    $trail->push('My Account', route('my-account.edit'));
});
