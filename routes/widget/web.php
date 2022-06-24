<?php

use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Widget Web Routes
|--------------------------------------------------------------------------
*/

['host' => $domain] = parse_url(config('app.url'));

Route::domain("widget.{$domain}")->group(function (): void {
    Route::get('/', [WidgetController::class, 'index'])->name('widget.index');
});
