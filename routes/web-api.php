<?php

use App\Http\Controllers\WebApi\UserController;
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

Route::middleware(['logged_in'])->group(function () {
    Route::get('user/datatable', [UserController::class, "dataTable"])->name('user.data-table');
});
