<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\App\Http\Middleware\LoadJobSeekerRelationship::class);
        
        // Register middleware aliases
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'admin' => \App\Http\Middleware\AdminAccess::class,
            'employer' => \App\Http\Middleware\EmployerAccess::class,
            'jobseeker' => \App\Http\Middleware\JobSeekerAccess::class,
            'apply.check' => \App\Http\Middleware\ApplyCheck::class,
            'post.check' => \App\Http\Middleware\PostCheck::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();