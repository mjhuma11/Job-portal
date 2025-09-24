<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                // Eager load the jobSeeker relationship if not already loaded
                if (!$user->relationLoaded('jobSeeker')) {
                    $user->load('jobSeeker');
                }
                $view->with('currentUser', $user);
            }
        });
    }
}