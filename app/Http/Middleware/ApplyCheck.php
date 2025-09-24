<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\job_seekers;
use App\Models\jobs;

class ApplyCheck
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
        
        // Only job seekers can apply for jobs
        if (!$user->isJobSeeker()) {
            abort(403, 'Unauthorized action. Only job seekers can apply for jobs.');
        }
        
        // Get the job from the route parameter
        $job = $request->route('job');
        
        if ($job) {
            // If job is passed as an ID, find the job model
            if (is_numeric($job)) {
                $job = jobs::findOrFail($job);
            }
            
            // Check if user has already applied for this job
            $jobSeeker = job_seekers::where('user_id', $user->id)->first();
            
            if ($jobSeeker) {
                $existingApplication = $jobSeeker->jobApplications()
                    ->where('job_id', $job->id)
                    ->first();
                    
                if ($existingApplication) {
                    return redirect()->route('job_seeker.applications')
                        ->with('info', 'You have already applied for this job.');
                }
            }
        }

        return $next($request);
    }
}