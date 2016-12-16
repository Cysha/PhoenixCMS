<?php

namespace Cms\Exceptions;

use Cms\Modules\Pages\Http\Controllers\Frontend\PagesController;
use Cms\Modules\Core\Exceptions\NotInstalledException;
use Cms\Modules\Pages\Models\Page;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Theme;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,

        NotInstalledException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof \Cms\Modules\Core\Exceptions\NotInstalledException) {
            return $this->renderNotInstalled($e);
        }

        if ($e instanceof \Cms\Modules\Core\Exceptions\InMaintenanceException) {
            return $this->renderInMaintenance($e);
        }

        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->back()
                ->withError(trans('core::messages.errors.csrf'));
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                && app('modules')->has('Pages')) {
            $page = Page::where('slug', $request->path())->first();
            if ($page) {
                return app(PagesController::class)->getPage($page);
            }
        }

        if (config('app.debug') && class_exists('\Whoops\Run')) {
            return $this->renderExceptionWithWhoops($e, $request);
        }

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return redirect()->back()
                ->withInput()
                ->withError(trans('core::messages.errors.validation'));
        }

        if ($e instanceof \PDOException) {
            return $this->renderPdoException($e);
        }

        return $this->renderErrorPage($e, $request);
        //return parent::render($request, $e);
    }

    /**
     * Render a PDOException.
     *
     * @param \PDOException $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderPdoException(\PDOException $e)
    {
        if (config('app.debug', false) === true) {
            $message = explode(' ', $e->getMessage());
            $dbCode = rtrim($message[1], ']');
            $dbCode = trim($dbCode, '[');

            // codes specific to MySQL
            switch ($dbCode) {
                case 1049:
                    $userMessage = 'Unknown database - probably config error:';
                    break;
                case 2002:
                    $userMessage = 'DATABASE IS DOWN:';
                    break;
                case 1045:
                    $userMessage = 'Incorrect DB Credentials:';
                    break;
                default:
                    $userMessage = 'Untrapped Error:';
                    break;
            }
            $userMessage = $userMessage.'<br>'.$e->getMessage();
        } else {
            // be apologetic but never specific ;)
            $userMessage = 'We are currently experiencing a site wide issue. We are sorry for the inconvenience!';
        }

        return response($userMessage);
    }

    /**
     * Render an exception for notInstalled.
     *
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderNotInstalled(Exception $e)
    {
        die(view('notInstalled'));
    }

    /**
     * Render an exception for inMaintenance.
     *
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderInMaintenance(Exception $e)
    {
        die(view('inMaintenance'));
    }

    /**
     * Render an exception using Whoops.
     *
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderExceptionWithWhoops(Exception $e, $request)
    {
        $whoops = new \Whoops\Run();
        if ($request->ajax()) {
            $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
        } else {
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
        }

        return new \Illuminate\Http\Response(
            $whoops->handleException($e),
            $e->getStatusCode(),
            $e->getHeaders()
        );
    }

    /**
     * Render an error page.
     *
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderErrorPage(Exception $e, $request)
    {
        $code = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

        if (config('app.debug') === true || (Auth::check() && Auth::user()->hasRole('Admin'))) {
            $message = $e->getMessage();
        } else {
            $message = 'Whoops, looks like something went wrong.';
        }

        if ($request->ajax()) {
            $data = [
                'message' => $message,
                'status_code' => (int) $code,
            ];

            if (Auth::check() && Auth::user()->hasRole('Admin')) {
                $data['file'] = $e->getFile().':'.$e->getLine();
                $data['data'] = $request->all();
            }

            return response()->json($data, $code);
        } else {
            $objTheme = Theme::uses(getCurrentTheme())->layout('1-column');

            return $objTheme
                ->scope('partials.theme.errors.'.($code === 500 ? 'whoops' : $code), compact('code', 'message'))
                ->render(($code ?: 500));
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
