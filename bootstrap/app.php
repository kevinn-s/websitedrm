<?php

use App\Http\Middleware\EnsureAlumniIsVerified;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;

use App\Enums\AppError;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(EnsureAlumniIsVerified::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(
            function (TokenExpiredException $exception, Request $request) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => [
                            'type' => AppError::AUTH_TOKEN_EXPIRED->value
                        ]
                    ], 404);
                }
            }
        );

        $exceptions->renderable(function (TokenInvalidException $exception, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => AppError::AUTH_TOKEN_INVALID->value
                    ]
                ], 401);
            }
        });
           $exceptions->renderable(function (TokenBlacklistedException $exception, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => AppError::AUTH_TOKEN_BLACKLISTED->value
                    ]
                ], 401);
            }
        });
    })->create();
