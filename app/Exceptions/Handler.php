<?php

namespace Cms\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Theme;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
        'Cms\Modules\Core\Exceptions\NotInstalledException',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     *
     * @return void
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

        if (config('app.debug') && class_exists('\Whoops\Run')) {
            return $this->renderExceptionWithWhoops($e);
        }

        if ($e instanceof \PDOException) {
            return $this->renderPdoException($e);
        }

        return $this->renderErrorPage($e);
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
    protected function renderExceptionWithWhoops(Exception $e)
    {
        $whoops = new \Whoops\Run();
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

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
    protected function renderErrorPage(Exception $e)
    {
        $objTheme = Theme::uses(getCurrentTheme())->layout('1-column');

        $code = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

        if (config('app.debug') === true) {
            $message = $e->getMessage().':'.$e->getLine();
        } else {
            $message = 'Whoops, looks like something went wrong.';
        }

        return $objTheme
            ->scope('partials.theme.errors.'.($code === 500 ? 'whoops' : $code), compact('code', 'message'))
            ->render(($code ?: 500));
    }
}
