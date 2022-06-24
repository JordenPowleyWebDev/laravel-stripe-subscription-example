<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Admin -> Stripe Subscription Plan Detail -> Index
Breadcrumbs::for('admin.stripeSubscriptionPlanDetail.index', function ($trail) {
    $trail->push('Stripe Subscription Plan Details', route('admin.stripeSubscriptionPlanDetail.index'));
});

// Admin -> Stripe Subscription Plan Detail -> Create
Breadcrumbs::for('admin.stripeSubscriptionPlanDetail.create', function ($trail) {
    $trail->parent('admin.stripeSubscriptionPlanDetail.index');
    $trail->push('Create Stripe Subscription Plan Detail', route('admin.stripeSubscriptionPlanDetail.create'));
});

// Admin -> Stripe Subscription Plan Detail -> Show
Breadcrumbs::for( 'admin.stripeSubscriptionPlanDetail.show', function ($trail, $stripeSubscriptionPlanDetail) {
    $trail->parent('admin.stripeSubscriptionPlanDetail.index');
    $trail->push($stripeSubscriptionPlanDetail->name, route('admin.stripeSubscriptionPlanDetail.show', $stripeSubscriptionPlanDetail));
});

// Admin -> Stripe Subscription Plan Detail -> Show -> Edit
Breadcrumbs::for('admin.stripeSubscriptionPlanDetail.edit', function ($trail, $stripeSubscriptionPlanDetail) {
    $trail->parent('admin.stripeSubscriptionPlanDetail.show', $stripeSubscriptionPlanDetail);
    $trail->push('Edit', route('admin.stripeSubscriptionPlanDetail.edit', $stripeSubscriptionPlanDetail));
});

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
