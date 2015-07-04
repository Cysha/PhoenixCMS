<?php namespace Cms\Http\Middleware;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class InMaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {

        // check for maintenance mode
        if (config('cms.core.app.maintenance', 'false') == 'true') {

            // check to see if the user is logged in, if is, check see if they have admin abilities
            if (!Auth::check() || !Auth::user()->isAdmin()) {

                // check if this route is the login page - we want to be able to login
                if (!in_array($request->url(), [route('pxcms.user.login'), route('pxcms.user.logout')])) {

                    // if none of those things apply, throw the exception
                    throw new \Cms\Modules\Core\Exceptions\InMaintenanceException('This site is in maintenance.');
                }

            }

        }

        return $next($request);
    }
}
