<?php

use App\Http\Controllers\Widget\Auth\ForgotPasswordController;
use App\Http\Controllers\Widget\Auth\LoginController;
use App\Http\Controllers\Widget\Auth\RegisterController;
use App\Http\Controllers\Widget\Auth\ResetPasswordController;
use App\Http\Controllers\Widget\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Widget Web Routes
|--------------------------------------------------------------------------
*/

['host' => $domain] = parse_url(config('app.url'));

Route::domain("widget.{$domain}")->group(function (): void {
    Route::redirect('/', '/login');

    Route::group(['middleware' => 'guest'], function (): void {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('show-login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('show-registration');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
    });

    Route::any('/logout', [LoginController::class, "logout"])->name('logout');

    Route::middleware(['logged_in'])->group(function () {
        Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
    });
});
