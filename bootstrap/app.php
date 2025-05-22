<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        // Add the auth routes file here

    )

    ->withMiddleware(function (Middleware $middleware) {
        //
        // Add the language middleware to the web middleware group
        $middleware->web(append: [
            \App\Http\Middleware\SetLanguage::class,
        ]);

        //
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
            // 'language' => \App\Http\Middleware\SetLanguage::class,
        ]);

        $middleware->validateCsrfTokens(except: [

            '/api/plates',

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        // 
        //
    })->create();
