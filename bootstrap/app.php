<?php

use App\Http\Middleware\AdminAuthenticated;
use App\Http\Middleware\AdminWebAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.auth'     => AdminAuthenticated::class,    // JWT (API)
            'admin.web.auth' => AdminWebAuthenticated::class, // Session (Web)
        ]);

        $middleware->redirectGuestsTo(fn (Request $request) => match (true) {
            $request->is('admin/*') => route('admin.login'),
            default => route('admin.login'), // Since we don't have a public login yet
        });

        $middleware->redirectUsersTo(fn (Request $request) => match (true) {
            $request->is('admin/*') => route('admin.dashboard'),
            default => route('admin.dashboard'),
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();


