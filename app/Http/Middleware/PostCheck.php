<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\jobs;
use App\Models\companies;

class PostCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var User $user */
        $user = Auth::user();
        
        // Only employers and admins can post jobs
        if (!$user->isEmployer() && !$user->isAdmin()) {
            abort(403, 'Unauthorized action. Only employers can post jobs.');
        }
        
        // If this is an update/delete request, check if user owns the job
        $job = $request->route('job');
        
        if ($job && !$user->isAdmin()) {
            // If job is passed as an ID, find the job model
            if (is_numeric($job)) {
                $job = jobs::findOrFail($job);
            }
            
            // Get the companies associated with this employer
            $companies = companies::where('user_id', $user->id)->get();
            
            if ($companies->isEmpty()) {
                abort(403, 'Unauthorized action. You do not have any companies associated with your account.');
            }
            
            $companyIds = $companies->pluck('id')->toArray();
            
            // Verify that the job belongs to one of the employer's companies
            if (!in_array($job->company_id, $companyIds)) {
                abort(403, 'Unauthorized action. You can only edit jobs posted by your company.');
            }
        }

        return $next($request);
    }
}