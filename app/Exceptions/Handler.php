<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Handle ModelNotFoundException (404 - Resource Not Found)
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 'error',
                'message' => 'RESOURCE_NOT_FOUND',
                'data' => null,
                'server_time' => (int) round(microtime(true) * 1000),
            ], 404);
        }

        // Handle HttpException (e.g., 400 - Bad Request)
        if ($exception instanceof HttpException) {
            return response()->json([
                'status' => 'error',
                'message' => 'BAD_REQUEST',
                'data' => $exception->getMessage(),
                'server_time' => (int) round(microtime(true) * 1000),
            ], $exception->getStatusCode());
        }

        // Handle other general exceptions (500 - Internal Server Error)
        if ($exception instanceof \Exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'INTERNAL_SERVER_ERROR',
                'data' => $exception->getMessage(),
                'server_time' => (int) round(microtime(true) * 1000),
            ], 500);
        }

        // Call the parent render method for other cases (e.g., TokenMismatchException, etc.)
        return parent::render($request, $exception);
    }

}
