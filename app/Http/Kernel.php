<?php namespace Cms\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Cms\Http\Middleware\IsInstalledMiddleware',
        'Cms\Modules\Core\Http\Middleware\ForceSecureMiddleware',
        'Cms\Modules\Core\Http\Middleware\CORSMiddleware',
        'Cms\Http\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Cms\Http\Middleware\InMaintenanceMiddleware',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'Cms\Http\Middleware\VerifyCsrfToken',
        'Cms\Modules\Core\Http\Middleware\ParseJsToBottomMiddleware',
        'Cms\Modules\Core\Http\Middleware\MinifyHtmlMiddleware',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'Cms\Modules\Auth\Http\Middleware\AuthMiddleware',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'Cms\Http\Middleware\RedirectIfAuthenticated',
    ];

}
