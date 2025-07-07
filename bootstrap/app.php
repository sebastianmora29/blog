<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Tus rutas de administrador, protegidas por auth
            Route::middleware(['web', 'auth'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // No es necesario registrar alias aquí si usas Breeze o Jetstream
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
