<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/login';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            /**
             * Map Admin Routes
             */
            Route::middleware('web')->as("admin.")->group(base_path('routes/admin/web.php'));
            Route::middleware('web')->prefix("web-api/admin")->as("web-api.admin.")->group(base_path('routes/admin/web-api.php'));
            Route::middleware('api')->prefix('api/admin')->as("api.admin.")->group(base_path('routes/admin/api.php'));

            /**
             * Map Widget Routes
             */
            Route::middleware('web')->as("widget.")->group(base_path('routes/widget/web.php'));
            Route::middleware('web')->prefix("web-api/widget")->name("web-api.widget.")->group(base_path('routes/widget/web-api.php'));
            Route::middleware('api')->prefix('api/widget')->name("api.widget.")->group(base_path('routes/widget/api.php'));
        });

        /**
         * Bind Specific Modals To Allow For Soft Deleted Views
         */

        Route::bind('user', function ($id) {
            return User::withTrashed()->find($id);
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
