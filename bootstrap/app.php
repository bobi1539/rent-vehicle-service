<?php

use App\Exceptions\BusinessException;
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
            $response = buildErrorResponse(400, $e->getMessage());
            return response($response, 400);
        });

        $exceptions->renderable(function (BusinessException $e) {
            Log::error($e);
            $response = buildErrorResponse($e->getCode(), $e->getMessage());
            return response($response, $e->getCode());
        });

        $exceptions->renderable(function (Exception $e) {
            Log::error($e);
            $response = buildErrorResponse(500, "Internal Server Error");
            return response($response, 500);
        });
    })->create();
