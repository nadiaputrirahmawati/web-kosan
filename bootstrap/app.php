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
        $middleware->validateCsrfTokens(except: [
            'user/room/contract/payment/*',
        ]);
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'check-sewa' => \App\Http\Middleware\CheckSewa::class,
            'check-profile' => \App\Http\Middleware\CheckProfile::class
        ]);

        // Mengarahkan guest ke halaman login
        $middleware->redirectGuestsTo(fn() => route('user.login'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
