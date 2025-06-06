<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'user.auth' => \App\Http\Middleware\UserAuth::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'phonepe/callback',      // no leading slash
            'webhook/phonepe',       // add more if needed
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
