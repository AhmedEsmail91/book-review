<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
/**
 * using ratelimiting in middleware: which randerning every request of the application,
 * we have here some logic that can be run before or after the request.
 * Ex:ConvertEmptyStringToNULL is used to convert empty string values to null if they are not required (not filled by user)
 * in the example we have a **Handle** method class \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class;
 * which implements this middleware and contains some logic  to handle it.
 * like making every string of value to be null value
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    /**
     * Here also having a groups each Group has its own collection of classes needed to handle while coding in some different logic:
     * Web-routes for Web-Application, Api for making APIs
     * Ex-Web:
     * ShareErrorFromSession: responsible for giving  error messages from session if any exists. @error
     * Authenticate (web, Api): responsible for checking if user is logged in or not.
     * VerifyCsrfToken: checks csrf token in case of forms submitted through.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    /**
     * MoreOver
     * You can also add some specific middleware for every single route or to the group of routes so if you need some specific logic to be run before a specific route you can apply some special middleware.
     * 
     * 
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        /*
        Throttle: That's here to make an alies for the class which handling a special request which,
        RateLimiter Implemented in it which controls how many special route can be run in given time frame,
        and we gonna use it in this application to limit the time of route execution given certain criteria.
        */
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
