<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\MyAccountController;
use App\Http\Controllers\Admin\StripeSubscriptionPlanDetailController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

['host' => $domain] = parse_url(config('app.url'));

Route::domain("admin.{$domain}")->group(function (): void {
    Route::redirect('/', '/login');

    Route::group(['middleware' => 'guest'], function (): void {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('show-login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    });

    Route::any('/logout', [LoginController::class, "logout"])->name('logout');

    Route::middleware(['logged_in'])->group(function () {
        Route::resource('user', UserController::class)->except(['store', 'update']);
        Route::patch('user/{user}/restore', [UserController::class, "restore"])->name('user.restore');

        Route::resource('stripeSubscriptionPlanDetail', StripeSubscriptionPlanDetailController::class);
        Route::patch('stripeSubscriptionPlanDetail/{stripeSubscriptionPlanDetail}/restore', [StripeSubscriptionPlanDetailController::class, "restore"])->name('stripeSubscriptionPlanDetail.restore');

        Route::get('my-account', [MyAccountController::class, 'edit'])->name('my-account.edit');
        Route::patch('my-account', [MyAccountController::class, 'update'])->name('my-account.update');
    });

});
