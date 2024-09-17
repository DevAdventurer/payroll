<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            if ($statusCode === 404) {
                if (request()->segment(1) == 'admin') {
                    return response()->view('admin.errors.404', [], 404);
                }
                return response()->view('web.errors.404', [], 404);
            } elseif ($statusCode === 500) {
                if (!config('app.debug')) {
                    if (request()->segment(1) == 'admin') {
                        return response()->view('admin.errors.500', [], 500);
                    }
                }
                return response()->view('web.errors.500', [], 500);
            }
        } elseif ($exception instanceof \Exception) {
            if (!config('app.debug')) {
                if (request()->segment(1) == 'admin') {
                    return response()->view('admin.errors.500', [], 500);
                }
                return response()->view('errors.500', [], 500);
            }
        }

        return parent::render($request, $exception);
    }

    /**
     * Determine if the exception is an HTTP exception.
     *
     * @param \Throwable $exception
     * @return bool
     */
    protected function isHttpException(Throwable $exception)
    {
        return $exception instanceof HttpException;
    }
}
