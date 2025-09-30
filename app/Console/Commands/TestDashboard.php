<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\job_seekers;
use App\Models\job_applications;
use Illuminate\Support\Facades\DB;

class TestDashboard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-dashboard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test dashboard functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing dashboard functionality...');
        
        // Test job seeker model
        $this->info('Checking job seekers table...');
        $jobSeekerCount = job_seekers::count();
        $this->line("Found {$jobSeekerCount} job seekers");
        
        if ($jobSeekerCount > 0) {
            $firstJobSeeker = job_seekers::first();
            $this->line("First job seeker ID: {$firstJobSeeker->seeker_id}");
            
            // Test job applications
            $this->info('Checking job applications...');
            $applications = job_applications::where('seeker_id', $firstJobSeeker->seeker_id)->count();
            $this->line("Found {$applications} applications for this job seeker");
        }
        
        // Test database connections
        $this->info('Testing database connections...');
        
        try {
            // Test employer notifications
            $notifications = DB::table('employer_notifications')->count();
            $this->line("Found {$notifications} employer notifications");
        } catch (\Exception $e) {
            $this->error("Error accessing employer_notifications: " . $e->getMessage());
        }
        
        try {
            // Test employer messages
            $messages = DB::table('employer_messages')->count();
            $this->line("Found {$messages} employer messages");
        } catch (\Exception $e) {
            $this->error("Error accessing employer_messages: " . $e->getMessage());
        }
        
        try {
            // Test interviews
            $interviews = DB::table('interviews')->count();
            $this->line("Found {$interviews} interviews");
        } catch (\Exception $e) {
            $this->error("Error accessing interviews: " . $e->getMessage());
        }
        
        $this->info('Dashboard test completed.');
    }
}