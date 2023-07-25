<?php

namespace App\Exceptions;

class CustomExceptionHandler extends Handler
{
    // Override the render method to handle all exceptions
    public function render($request, \Throwable $exception)
    {
        // Handle exceptions here
        // Return a custom JSON response for all exceptions
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong.',
            'data' => $exception->getMessage(),
            'server_time' => (int) round(microtime(true) * 1000),
        ], 500);
    }
}
