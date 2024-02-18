<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
            /*
                This service provider is explicitly telling laravel that for the routes 
                defined inside this web page PHP file it should apply the middleware that is defined inside 
                web group inside the kernel which is **web** 
            */
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
    /**
     * onfigure the rate limiters for the application
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            /*
            The ? after user() means that if there's not user which in that way won't be authenticated (checking if authenticated) 
            * Return a response if the request hits the max limit.
            * In this case, we return a JSON response with an error message.
            */
            return Limit::perMinute(5)->by($request->user()?->id ?: $request->ip());
        });

        /*Let's make our own: */
        RateLimiter::for('reviews'/*Adding the throttling group name called Reviews*/, function (Request $request) {
            
            return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip());
            /*This will terminate any adding request(reviews), which won't be happen with the same id or ip after one hour*/
            // let's apply the middleware in the ModelController
            // this will return an error 429 which is Too Many Requests
        });
    }
}
