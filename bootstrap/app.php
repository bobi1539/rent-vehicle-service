<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

function buildErrorResponse($code, $message)
{
    return [
        "code" => $code,
        "message" => $message
    ];
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            "/api/rent-vehicle-service/*"
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->renderable(function (ValidationException $e) {
            Log::error($e);
            return response(buildErrorResponse(400, $e->getMessage()), 400);
        });

        $exceptions->renderable(function (Exception $e) {
            Log::error($e);
            return response(buildErrorResponse(500, "Internal Server error"), 500);
        });
    })->create();
