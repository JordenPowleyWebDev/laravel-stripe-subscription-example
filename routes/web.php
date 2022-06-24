<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\UserController;
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

Route::redirect('/', '/login');
Auth::routes(['register' => false, "logout" => false]);
Route::any('/logout', [LoginController::class, "logout"])->name('logout');

Route::middleware(['logged_in'])->group(function () {
    Route::resource('user', UserController::class);
    Route::patch('user/{user}/restore', [UserController::class, "restore"])->name('user.restore');

    Route::get('my-account', [MyAccountController::class, 'edit'])->name('my-account.edit');
    Route::patch('my-account', [MyAccountController::class, 'update'])->name('my-account.update');
});
