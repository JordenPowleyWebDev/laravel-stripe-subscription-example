<?php

use App\Http\Controllers\WebApi\Admin\StripeSubscriptionPlanDetailController;
use App\Http\Controllers\WebApi\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web-API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middlewxare group. Enjoy building your API!
|
*/

['host' => $domain] = parse_url(config('app.url'));

Route::domain("admin.{$domain}")->group(function (): void {
    Route::middleware(['logged_in'])->group(function () {
        Route::resource('stripeSubscriptionPlanDetail', StripeSubscriptionPlanDetailController::class)->only(['store', 'update']);
        Route::get('stripeSubscriptionPlanDetail/data', [StripeSubscriptionPlanDetailController::class, "data"])->name('stripeSubscriptionPlanDetail.data');
        Route::get('stripeSubscriptionPlanDetail/datatable', [StripeSubscriptionPlanDetailController::class, "dataTable"])->name('stripeSubscriptionPlanDetail.data-table');

        Route::resource('user', UserController::class)->only(['store', 'update']);
        Route::get('user/data', [UserController::class, "data"])->name('user.data');
        Route::get('user/datatable', [UserController::class, "dataTable"])->name('user.data-table');
    });
});
