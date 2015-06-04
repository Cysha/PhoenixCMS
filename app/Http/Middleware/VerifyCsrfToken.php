<?php namespace Cms\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->is(config('cms.core.app.paths.api', 'api/').'*')) {
            return parent::addCookieToResponse($request, $next($request));
        }

        return parent::handle($request, $next);
    }

}
