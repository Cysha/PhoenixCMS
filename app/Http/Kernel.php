<?php

namespace Cms\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Cms\Http\Middleware\IsInstalledMiddleware::class,
        \Cms\Http\Middleware\InMaintenanceMiddleware::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Cms\Http\Middleware\EncryptCookies::class,
            \Cms\Modules\Core\Http\Middleware\ForceSecureMiddleware::class,
            \Cms\Modules\Core\Http\Middleware\CORSMiddleware::class,
            \Cms\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \BeatSwitch\Lock\Integrations\Laravel\Middleware\BootstrapLockPermissions::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Cms\Http\Middleware\VerifyCsrfToken::class,
            \Cms\Modules\Core\Http\Middleware\ParseJsToBottomMiddleware::class,
            \Cms\Modules\Core\Http\Middleware\MinifyHtmlMiddleware::class,
            \Cms\Modules\Auth\Http\Middleware\EnforceUserActionsMiddleware::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Cms\Modules\Core\Http\Middleware\MenuMiddleware::class,
        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Cms\Modules\Auth\Http\Middleware\AuthMiddleware::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \Cms\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
