<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\CheckTokenExpiration;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'check.expiration' => CheckTokenExpiration::class,
        ]);
        App\Http\Middleware\LogRequest::class;
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Always return JSON for unauthenticated requests (e.g., missing/invalid Sanctum token)
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            // Force JSON for API routes or whenever JSON is expected
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated.',
                ], 401);
            }

            return null; // fall back to default handling for non-API routes
        });
    })->create();
