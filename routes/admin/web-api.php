<?php

use App\Http\Controllers\WebApi\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web-API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middleware group. Enjoy building your API!
|
*/

['host' => $domain] = parse_url(config('app.url'));

Route::domain("admin.{$domain}")->group(function (): void {
    Route::middleware(['logged_in'])->group(function () {
        Route::get('user/datatable', [UserController::class, "dataTable"])->name('user.data-table');
    });
});
