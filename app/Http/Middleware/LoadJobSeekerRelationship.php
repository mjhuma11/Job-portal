<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoadJobSeekerRelationship
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is authenticated, load the jobSeeker relationship
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            // Load the jobSeeker relationship
            $user->load('jobSeeker');
        }

        return $next($request);
    }
}