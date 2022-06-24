<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Widget Web-API Routes
|--------------------------------------------------------------------------
*/

['host' => $domain] = parse_url(config('app.url'));

Route::domain("widget.{$domain}")->group(function (): void {
    // TODO - Include Routes Here
});
