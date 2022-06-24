<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Admin -> User -> Index
Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->push('Users', route('admin.user.index'));
});

// Admin -> User -> Create
Breadcrumbs::for('admin.user.create', function ($trail) {
    $trail->parent('admin.user.index');
    $trail->push('Create User', route('admin.user.create'));
});

// Admin -> User -> Show
Breadcrumbs::for( 'admin.user.show', function ($trail, $user) {
    $trail->parent('admin.user.index');
    $trail->push($user->name, route('admin.user.show', $user));
});

// Admin -> User -> Show -> Edit
Breadcrumbs::for('admin.user.edit', function ($trail, $user) {
    $trail->parent('admin.user.show', $user);
    $trail->push('Edit', route('admin.user.edit', $user));
});

// Admin -> My Account -> Edit
Breadcrumbs::for('admin.my-account.edit', function ($trail) {
    $trail->push('My Account', route('admin.my-account.edit'));
});
