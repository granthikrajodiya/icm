<?php

namespace App\Http;

use App\Http\Middleware\API\VerifyApiId;
use App\Http\Middleware\CheckTwoFactorAuthentication;
use App\Http\Middleware\SMTPMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The bootstrap classes for the application.
     *
     * @var string[]
     */
    protected $bootstrappers = [
        \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
        \Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
//        \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
        \App\Bootstrap\HandleExceptions::class,
        \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
        \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
        \Illuminate\Foundation\Bootstrap\BootProviders::class,
    ];

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        // \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                      => \App\Http\Middleware\Authenticate::class,
        'auth.basic'                => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers'             => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'                       => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'                     => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm'          => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed'                    => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'                  => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'                  => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'XSS'                       => \App\Http\Middleware\XSS::class,
        'Tenancy'                   => \App\Http\Middleware\Tenancy::class,
        'verify.create-by-or-admin' => \App\Http\Middleware\VerifyCreateByOrAdmin::class,
        'api-id.check'              => VerifyApiId::class,
        'handle-saml-response'      => \App\Http\Middleware\HandleSamlResponse::class,
        'mail.config'               => SMTPMiddleware::class,
        'two-factor.auth'           => CheckTwoFactorAuthentication::class,
    ];
}
