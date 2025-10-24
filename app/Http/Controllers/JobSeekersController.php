<?php

namespace App\Http\Controllers;

use App\Models\education;
use App\Models\job_applications;
use App\Models\job_seekers;
use App\Models\jobs;
use App\Models\SeekerSkill;
use App\Models\work_experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class JobSeekersController extends Controller
{
    /**
     * Display the job seeker's dashboard with dynamic content.
     */
    public function dashboard(): View|\Illuminate\Http\RedirectResponse
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login to access your dashboard.');
            }
            
            $jobSeeker = job_seekers::where('user_id', $user->id)->first();
            
            if (!$jobSeeker) {
                // Create a basic jobSeeker record if it doesn't exist
                $jobSeeker = new job_seekers();
                $jobSeeker->user_id = $user->id;
                $jobSeeker->full_name = $user->name ?? 'Job Seeker';
                $jobSeeker->email = $user->email;
                $jobSeeker->save();
            }
        
            // Get job applications (with error handling)
            try {
                $applications = job_applications::where('seeker_id', $jobSeeker->seeker_id)
                    ->with(['job.company'])
                    ->orderBy('applied_at', 'desc')
                    ->get();
            } catch (\Exception $e) {
                $applications = collect(); // Empty collection if there's an error
            }
            
            // Get notifications from employers (with error handling)
            try {
                // Check if table exists before querying
                if (\Schema::hasTable('employer_notifications')) {
                    $notifications = \DB::table('employer_notifications')
                        ->where('seeker_id', $jobSeeker->seeker_id)
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                } else {
                    $notifications = collect();
                }
            } catch (\Exception $e) {
                $notifications = collect(); // Empty collection if table doesn't exist
            }
            
            // Get messages from employers (with error handling)
            try {
                // Check if table exists before querying
                if (\Schema::hasTable('employer_messages')) {
                    $messages = \DB::table('employer_messages')
                        ->where('seeker_id', $jobSeeker->seeker_id)
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                } else {
                    $messages = collect();
                }
            } catch (\Exception $e) {
                $messages = collect(); // Empty collection if table doesn't exist
            }
            
            // Get scheduled interviews (with error handling)
            try {
                // Check if table exists before querying
                if (\Schema::hasTable('interviews')) {
                    $interviews = \DB::table('interviews')
                        ->where('seeker_id', $jobSeeker->seeker_id)
                        ->where('status', 'scheduled')
                        ->orderBy('interview_date', 'asc')
                        ->get();
                } else {
                    $interviews = collect();
                }
            } catch (\Exception $e) {
                $interviews = collect(); // Empty collection if table doesn't exist
            }
        
            // Calculate statistics
            $stats = [
                'total_applications' => $applications->count(),
                'pending_applications' => $applications->where('application_status', 'pending')->count(),
                'interview_scheduled' => $applications->where('application_status', 'interview_scheduled')->count(),
                'shortlisted' => $applications->where('application_status', 'shortlisted')->count(),
                'hired' => $applications->where('application_status', 'hired')->count(),
                'rejected' => $applications->where('application_status', 'rejected')->count(),
                'unread_notifications' => $notifications->where('status', 'pending')->count(),
                'unread_messages' => $messages->where('status', 'sent')->count(),
                'upcoming_interviews' => $interviews->count(),
                'saved_jobs' => 0, // Placeholder for saved jobs count
                'profile_views' => 3, // Placeholder for profile views
                'job_alerts' => 0 // Placeholder for job alerts
            ];
            
            // Get recent job recommendations (jobs in same category as applied jobs)
            $appliedCategories = $applications->pluck('job.category')->unique()->filter();
            $recommendedJobs = collect(); // Default to empty collection
            
            if ($appliedCategories->isNotEmpty()) {
                try {
                    $recommendedJobs = jobs::whereIn('category', $appliedCategories)
                        ->where('status', 'open') // Use 'open' instead of 'active'
                        ->whereNotIn('id', $applications->pluck('job_id'))
                        ->with(['company', 'category', 'location'])
                        ->limit(5)
                        ->get();
                } catch (\Exception $e) {
                    $recommendedJobs = collect();
                }
            }
            
            // If no recommendations based on applied categories, get general recommendations
            if ($recommendedJobs->isEmpty()) {
                try {
                    $recommendedJobs = jobs::where('status', 'open')
                        ->with(['company', 'category', 'location'])
                        ->latest()
                        ->limit(5)
                        ->get();
                } catch (\Exception $e) {
                    $recommendedJobs = collect();
                }
            }
            
            // Get recent activities for the activity feed
            $recentActivities = collect([
                [
                    'type' => 'job_match',
                    'title' => 'New job match found',
                    'description' => 'Senior Developer at TechCorp',
                    'time' => '2 hours ago',
                    'icon' => 'briefcase',
                    'color' => 'blue'
                ],
                [
                    'type' => 'profile_view',
                    'title' => 'Profile viewed by employer',
                    'description' => 'InnovateTech Solutions',
                    'time' => '5 hours ago',
                    'icon' => 'eye',
                    'color' => 'green'
                ],
                [
                    'type' => 'application_update',
                    'title' => 'Application status updated',
                    'description' => 'Frontend Developer role',
                    'time' => '1 day ago',
                    'icon' => 'chat',
                    'color' => 'yellow'
                ]
            ]);
            
            return view('admin.job_seeker.dashboard', compact(
                'jobSeeker', 
                'applications', 
                'notifications', 
                'messages', 
                'interviews', 
                'stats', 
                'recommendedJobs',
                'recentActivities'
            ));
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Dashboard error: ' . $e->getMessage());
            
            // Return a simple error view or redirect
            return redirect()->route('job_seeker.profile.edit.tabs')
                ->with('error', 'There was an issue loading your dashboard. Please try again.');
        }
    }

    /**
     * Mark notification as read
     */
    public function markNotificationRead(Request $request, $notificationId)
    {
        try {
            $user = Auth::user();
            $jobSeeker = job_seekers::where('user_id', $user->id)->first();
            
            if (!$jobSeeker) {
                return response()->json(['success' => false, 'message' => 'Job seeker profile not found'], 404);
            }
            
            \DB::table('employer_notifications')
                ->where('id', $notificationId)
                ->where('seeker_id', $jobSeeker->seeker_id)
                ->update([
                    'status' => 'sent',
                    'sent_at' => now()
                ]);

            if ($request->ajax()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Notification marked as read.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
            return redirect()->back()->with('error', 'Failed to mark notification as read.');
        }
    }

    /**
     * Mark message as read
     */
    public function markMessageRead(Request $request, $messageId)
    {
        try {
            $user = Auth::user();
            $jobSeeker = job_seekers::where('user_id', $user->id)->first();
            
            if (!$jobSeeker) {
                return response()->json(['success' => false, 'message' => 'Job seeker profile not found'], 404);
            }
            
            \DB::table('employer_messages')
                ->where('id', $messageId)
                ->where('seeker_id', $jobSeeker->seeker_id)
                ->update([
                    'status' => 'read',
                    'read_at' => now()
                ]);

            if ($request->ajax()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Message marked as read.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
            return redirect()->back()->with('error', 'Failed to mark message as read.');
        }
    }

    /**
     * Get dashboard data via AJAX for dynamic updates
     */
    public function getDashboardData(Request $request)
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        if (!$jobSeeker) {
            return response()->json(['error' => 'Job seeker profile not found'], 404);
        }
        
        // Get fresh data
        $notifications = \DB::table('employer_notifications')
            ->where('seeker_id', $jobSeeker->seeker_id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        $messages = \DB::table('employer_messages')
            ->where('seeker_id', $jobSeeker->seeker_id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        $interviews = \DB::table('interviews')
            ->where('seeker_id', $jobSeeker->seeker_id)
            ->where('status', 'scheduled')
            ->orderBy('interview_date', 'asc')
            ->get();
        
        $applications = job_applications::where('seeker_id', $jobSeeker->seeker_id)
            ->with(['job.company'])
            ->orderBy('applied_at', 'desc')
            ->get();
        
        $stats = [
            'total_applications' => $applications->count(),
            'pending_applications' => $applications->where('application_status', 'pending')->count(),
            'interview_scheduled' => $applications->where('application_status', 'interview_scheduled')->count(),
            'shortlisted' => $applications->where('application_status', 'shortlisted')->count(),
            'hired' => $applications->where('application_status', 'hired')->count(),
            'rejected' => $applications->where('application_status', 'rejected')->count(),
            'unread_notifications' => $notifications->where('status', 'pending')->count(),
            'unread_messages' => $messages->where('status', 'sent')->count(),
            'upcoming_interviews' => $interviews->count()
        ];
        
        return response()->json([
            'success' => true,
            'data' => [
                'notifications' => $notifications,
                'messages' => $messages,
                'interviews' => $interviews,
                'stats' => $stats,
                'applications' => $applications
            ]
        ]);
    }

    /**
     * Display the job seeker's profile.
     */
    public function showProfile(): View|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        // If no profile exists, redirect to create profile
        if (!$jobSeeker) {
            return redirect()->route('job_seeker.profile.edit.tabs')
                ->with('info', 'Please complete your profile to continue.');
        }

        // Initialize empty collections
        $workExperiences = collect();
        $educations = collect();
        $skills = collect();
        $projects = collect();

        // Get existing data
        try {
            $workExperiences = work_experience::where('seeker_id', $jobSeeker->seeker_id)
                ->orderBy('start_date', 'desc')
                ->get();
        } catch (\Exception $e) {
            $workExperiences = collect();
        }

        try {
            $educations = education::where('user_id', $user->id)
                ->orderBy('passing_year', 'desc')
                ->get();
        } catch (\Exception $e) {
            $educations = collect();
        }

        try {
            $skills = SeekerSkill::where('seeker_id', $jobSeeker->seeker_id)
                ->orderBy('proficiency', 'desc')
                ->get();
        } catch (\Exception $e) {
            $skills = collect();
        }

        try {
            if (class_exists('\App\Models\Project')) {
                $projects = \App\Models\Project::where('seeker_id', $jobSeeker->seeker_id)
                    ->orderBy('start_date', 'desc')
                    ->get();
            }
        } catch (\Exception $e) {
            $projects = collect();
        }

        return view('admin.job_seeker.job_seekerprofile', compact('jobSeeker', 'user', 'workExperiences', 'educations', 'skills', 'projects'));
    }

    /**
     * Show the form for editing the job seeker's profile.
     */
    public function editProfile(): \Illuminate\Http\RedirectResponse
    {
        // Redirect to the comprehensive tabbed profile edit form
        return redirect()->route('job_seeker.profile.edit.tabs');
    }

    /**
     * Show the tabbed profile edit form.
     */
    public function editProfileTabs(): View
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        // Initialize empty collections
        $workExperiences = collect();
        $educations = collect();
        $skills = collect();
        $projects = collect();

        // Get existing data if jobSeeker exists
        if ($jobSeeker) {
            $workExperiences = work_experience::where('seeker_id', $jobSeeker->seeker_id)
                ->orderBy('start_date', 'desc')
                ->get();

            $educations = education::where('user_id', $user->id)
                ->orderBy('passing_year', 'desc')
                ->get();

            $skills = SeekerSkill::where('seeker_id', $jobSeeker->seeker_id)
                ->orderBy('proficiency', 'desc')
                ->get();

            $projects = \App\Models\Project::where('seeker_id', $jobSeeker->seeker_id)
                ->orderBy('start_date', 'desc')
                ->get();
        } else {
            // Create a basic jobSeeker object with default values for new users
            $jobSeeker = new job_seekers([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }

        return view('admin.job_seeker.profile-edit-tabs', compact('jobSeeker', 'user', 'workExperiences', 'educations', 'skills', 'projects'));
    }

    /**
     * Update the job seeker's profile from tabbed form.
     */
    public function updateProfileTabs(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validate the request
        $validated = $request->validate([
            // Basic Information
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'linkedin_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',

            // Education
            'ssc_institution' => 'nullable|string|max:255',
            'ssc_year' => 'nullable|integer|min:1980|max:2030',
            'ssc_grade' => 'nullable|string|max:10',
            'hsc_institution' => 'nullable|string|max:255',
            'hsc_year' => 'nullable|integer|min:1980|max:2030',
            'hsc_grade' => 'nullable|string|max:10',
            'graduation_institution' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:1980|max:2030',
            'graduation_grade' => 'nullable|string|max:10',
            'graduation_major' => 'nullable|string|max:100',
            'masters_institution' => 'nullable|string|max:255',
            'masters_year' => 'nullable|integer|min:1980|max:2030',
            'masters_grade' => 'nullable|string|max:10',
            'masters_major' => 'nullable|string|max:100',

            // Skills
            'skills' => 'nullable|array',
            'skills.*.name' => 'required_with:skills|string|max:100',
            'skills.*.proficiency' => 'nullable|in:beginner,intermediate,advanced,expert',
            'skills.*.years' => 'nullable|integer|min:0|max:50',
            'skills.*.category' => 'nullable|in:technical,soft,language,other',
            'skills.*.certification' => 'nullable|string|max:255',

            // Experience
            'experiences' => 'nullable|array',
            'experiences.*.title' => 'required_with:experiences|string|max:150',
            'experiences.*.company' => 'required_with:experiences|string|max:200',
            'experiences.*.location' => 'nullable|string|max:150',
            'experiences.*.type' => 'nullable|in:full-time,part-time,contract,internship',
            'experiences.*.start_date' => 'required_with:experiences|date',
            'experiences.*.end_date' => 'nullable|date|after:experiences.*.start_date',
            'experiences.*.currently_working' => 'nullable|boolean',
            'experiences.*.description' => 'nullable|string',
            'experiences.*.achievements' => 'nullable|string',

            // Projects
            'projects' => 'nullable|array',
            'projects.*.name' => 'required_with:projects|string|max:200',
            'projects.*.role' => 'nullable|string|max:100',
            'projects.*.category' => 'nullable|in:professional,academic,personal,open-source',
            'projects.*.url' => 'nullable|url|max:255',
            'projects.*.start_date' => 'nullable|date',
            'projects.*.end_date' => 'nullable|date|after:projects.*.start_date',
            'projects.*.ongoing' => 'nullable|boolean',
            'projects.*.description' => 'nullable|string',
            'projects.*.technologies' => 'nullable|string|max:500',
            'projects.*.outcomes' => 'nullable|string',
        ]);

        // Handle file uploads
        $profileImagePath = null;
        $resumeFilePath = null;

        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        if ($request->hasFile('resume_file')) {
            // Delete old resume if exists
            $existingJobSeeker = job_seekers::where('user_id', $user->id)->first();
            if ($existingJobSeeker && $existingJobSeeker->resume_file) {
                \Storage::disk('public')->delete($existingJobSeeker->resume_file);
            }
            
            $resumeFilePath = $request->file('resume_file')->store('resumes', 'public');
        }

        // Update user information
        $user->update([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
        ]);

        // Update or create job seeker profile
        $jobSeekerData = [
            'user_id' => $user->id,
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'address' => $validated['address'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'portfolio_url' => $validated['portfolio_url'] ?? null,
            'twitter_url' => $validated['twitter_url'] ?? null,
        ];

        if ($profileImagePath) {
            $jobSeekerData['profile_image'] = $profileImagePath;
        }

        if ($resumeFilePath) {
            $jobSeekerData['resume_file'] = $resumeFilePath;
        }

        $jobSeeker = job_seekers::updateOrCreate(
            ['user_id' => $user->id],
            $jobSeekerData
        );

        // Debug: Log the saved data
        \Log::info('JobSeeker Profile Updated:', [
            'user_id' => $user->id,
            'jobSeeker_id' => $jobSeeker->seeker_id,
            'data_saved' => $jobSeekerData,
            'resume_file' => $resumeFilePath,
            'profile_image' => $profileImagePath,
            'validated_data' => $validated
        ]);

        // Handle Education Data
        $this->handleEducationData($user, $validated);

        // Handle Skills Data
        if (isset($validated['skills'])) {
            $this->handleSkillsData($jobSeeker, $validated['skills']);
        }

        // Handle Experience Data
        if (isset($validated['experiences'])) {
            $this->handleExperienceData($jobSeeker, $validated['experiences']);
        }

        // Handle Projects Data
        if (isset($validated['projects'])) {
            $this->handleProjectsData($jobSeeker, $validated['projects']);
        }

        return redirect()->route('job_seeker.profile')
            ->with('success', 'Profile updated successfully! Data saved for JobSeeker ID: ' . $jobSeeker->seeker_id);
    }

    /**
     * Test method to check profile data
     */
    public function testProfileData()
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        $resumeInfo = null;
        if ($jobSeeker && $jobSeeker->resume_file) {
            $resumeInfo = [
                'resume_file_path' => $jobSeeker->resume_file,
                'full_url' => asset('storage/' . $jobSeeker->resume_file),
                'storage_path' => storage_path('app/public/' . $jobSeeker->resume_file),
                'file_exists' => \Storage::disk('public')->exists($jobSeeker->resume_file),
                'public_path' => public_path('storage/' . $jobSeeker->resume_file),
                'public_file_exists' => file_exists(public_path('storage/' . $jobSeeker->resume_file))
            ];
        }
        
        return response()->json([
            'user' => $user,
            'jobSeeker' => $jobSeeker,
            'resume_info' => $resumeInfo,
            'message' => 'Profile data retrieved successfully'
        ]);
    }

    /**
     * View resume file
     */
    public function viewResume()
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        if (!$jobSeeker || !$jobSeeker->resume_file) {
            return redirect()->route('job_seeker.profile')
                ->with('error', 'No resume file found. Please upload your resume first.');
        }
        
        $filePath = storage_path('app/public/' . $jobSeeker->resume_file);
        
        if (!file_exists($filePath)) {
            return redirect()->route('job_seeker.profile')
                ->with('error', 'Resume file not found on server. Please re-upload your resume.');
        }
        
        // Return the file with proper headers for viewing in browser
        $mimeType = mime_content_type($filePath);
        $fileName = basename($jobSeeker->resume_file);
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }
    
    /**
     * Download resume file
     */
    public function downloadResume()
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        if (!$jobSeeker || !$jobSeeker->resume_file) {
            return redirect()->route('job_seeker.profile')
                ->with('error', 'No resume file found. Please upload your resume first.');
        }
        
        $filePath = storage_path('app/public/' . $jobSeeker->resume_file);
        
        if (!file_exists($filePath)) {
            return redirect()->route('job_seeker.profile')
                ->with('error', 'Resume file not found on server. Please re-upload your resume.');
        }
        
        $fileName = $jobSeeker->name ? $jobSeeker->name . '_Resume.' . pathinfo($jobSeeker->resume_file, PATHINFO_EXTENSION) : basename($jobSeeker->resume_file);
        
        return response()->download($filePath, $fileName);
    }
    
    /**
     * Test resume files accessibility
     */
    public function testResumeFiles()
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        $resumeFiles = \Storage::disk('public')->files('resumes');
        $resumeInfo = [];
        
        foreach ($resumeFiles as $file) {
            $resumeInfo[] = [
                'file' => $file,
                'size' => \Storage::disk('public')->size($file),
                'asset_url' => asset('storage/' . $file),
                'storage_url' => \Storage::disk('public')->url($file),
                'exists' => \Storage::disk('public')->exists($file),
                'public_path' => public_path('storage/' . $file),
                'public_exists' => file_exists(public_path('storage/' . $file))
            ];
        }
        
        return response()->json([
            'user_resume' => $jobSeeker ? $jobSeeker->resume_file : null,
            'all_resume_files' => $resumeInfo,
            'storage_path' => storage_path('app/public/resumes'),
            'public_storage_path' => public_path('storage/resumes'),
            'storage_link_exists' => is_link(public_path('storage')),
            'app_url' => config('app.url'),
            'request_url' => request()->getSchemeAndHttpHost()
        ]);
    }
    
    /**
     * Serve resume file directly
     */
    public function serveResume($filename)
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        if (!$jobSeeker || !$jobSeeker->resume_file) {
            abort(404, 'Resume not found');
        }
        
        // Security check: make sure the requested file belongs to the current user
        if (basename($jobSeeker->resume_file) !== $filename) {
            abort(403, 'Unauthorized access');
        }
        
        $filePath = storage_path('app/public/' . $jobSeeker->resume_file);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found on server');
        }
        
        $mimeType = mime_content_type($filePath);
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    /**
     * Generate and download resume as PDF
     */
    public function generateResume()
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        if (!$jobSeeker) {
            return redirect()->route('job_seeker.profile.edit.tabs')
                ->with('error', 'Please complete your profile first to generate a resume.');
        }

        // Get all profile data
        $workExperiences = collect();
        $educations = collect();
        $skills = collect();
        $projects = collect();

        try {
            $workExperiences = work_experience::where('seeker_id', $jobSeeker->seeker_id)
                ->orderBy('start_date', 'desc')
                ->get();
        } catch (\Exception $e) {
            $workExperiences = collect();
        }

        try {
            $educations = education::where('user_id', $user->id)
                ->orderBy('passing_year', 'desc')
                ->get();
        } catch (\Exception $e) {
            $educations = collect();
        }

        try {
            $skills = SeekerSkill::where('seeker_id', $jobSeeker->seeker_id)
                ->orderBy('proficiency', 'desc')
                ->get();
        } catch (\Exception $e) {
            $skills = collect();
        }

        try {
            if (class_exists('\App\Models\Project')) {
                $projects = \App\Models\Project::where('seeker_id', $jobSeeker->seeker_id)
                    ->orderBy('start_date', 'desc')
                    ->get();
            }
        } catch (\Exception $e) {
            $projects = collect();
        }

        // Generate HTML content for the resume
        $html = view('admin.job_seeker.resume-template', compact('jobSeeker', 'user', 'workExperiences', 'educations', 'skills', 'projects'))->render();
        
        // For now, we'll return the HTML view directly
        // In a production environment, you would use a PDF library like DomPDF or wkhtmltopdf
        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'attachment; filename="' . ($jobSeeker->name ?? 'resume') . '_resume.html"');
    }

    /**
     * Generate proper storage URL
     */
    private function getStorageUrl($filePath)
    {
        // Use Laravel's Storage facade to generate proper URLs
        return \Storage::disk('public')->url($filePath);
    }

    /**
     * Handle education data storage
     */
    private function handleEducationData($user, $validated)
    {
        // Clear existing education records
        education::where('user_id', $user->id)->delete();

        // Add SSC if provided
        if (!empty($validated['ssc_institution'])) {
            education::create([
                'user_id' => $user->id,
                'degree_name' => 'SSC',
                'institute_name' => $validated['ssc_institution'],
                'passing_year' => $validated['ssc_year'],
                'result_value' => $validated['ssc_grade'],
            ]);
        }

        // Add HSC if provided
        if (!empty($validated['hsc_institution'])) {
            education::create([
                'user_id' => $user->id,
                'degree_name' => 'HSC',
                'institute_name' => $validated['hsc_institution'],
                'passing_year' => $validated['hsc_year'],
                'result_value' => $validated['hsc_grade'],
            ]);
        }

        // Add Graduation if provided
        if (!empty($validated['graduation_institution'])) {
            education::create([
                'user_id' => $user->id,
                'degree_name' => 'Bachelor\'s Degree',
                'institute_name' => $validated['graduation_institution'],
                'passing_year' => $validated['graduation_year'],
                'result_value' => $validated['graduation_grade'],
                'major_subject' => $validated['graduation_major'],
            ]);
        }

        // Add Masters if provided
        if (!empty($validated['masters_institution'])) {
            education::create([
                'user_id' => $user->id,
                'degree_name' => 'Master\'s Degree',
                'institute_name' => $validated['masters_institution'],
                'passing_year' => $validated['masters_year'],
                'result_value' => $validated['masters_grade'],
                'major_subject' => $validated['masters_major'],
            ]);
        }
    }

    /**
     * Handle skills data storage
     */
    private function handleSkillsData($jobSeeker, $skills)
    {
        // Clear existing skills
        SeekerSkill::where('seeker_id', $jobSeeker->seeker_id)->delete();

        foreach ($skills as $skillData) {
            if (!empty($skillData['name'])) {
                SeekerSkill::create([
                    'seeker_id' => $jobSeeker->seeker_id,
                    'skill_name' => $skillData['name'],
                    'proficiency' => $this->mapProficiencyToNumber($skillData['proficiency'] ?? 'intermediate'),
                    'years_experience' => $skillData['years'] ?? null,
                    'category' => $skillData['category'] ?? 'technical',
                    'certification' => $skillData['certification'] ?? null,
                ]);
            }
        }
    }

    /**
     * Handle experience data storage
     */
    private function handleExperienceData($jobSeeker, $experiences)
    {
        // Clear existing experiences
        work_experience::where('seeker_id', $jobSeeker->seeker_id)->delete();

        foreach ($experiences as $expData) {
            if (!empty($expData['title']) && !empty($expData['company'])) {
                work_experience::create([
                    'seeker_id' => $jobSeeker->seeker_id,
                    'job_title' => $expData['title'],
                    'company_name' => $expData['company'],
                    'location' => $expData['location'] ?? null,
                    'employment_type' => str_replace('-', '_', $expData['type'] ?? 'full_time'),
                    'start_date' => $expData['start_date'],
                    'end_date' => isset($expData['currently_working']) && $expData['currently_working'] ? null : $expData['end_date'],
                    'is_current' => isset($expData['currently_working']) && $expData['currently_working'],
                    'description' => $expData['description'] ?? null,
                    'achievements' => $expData['achievements'] ?? null,
                ]);
            }
        }
    }

    /**
     * Handle projects data storage
     */
    private function handleProjectsData($jobSeeker, $projects)
    {
        // Clear existing projects
        \App\Models\Project::where('seeker_id', $jobSeeker->seeker_id)->delete();

        foreach ($projects as $projectData) {
            if (!empty($projectData['name'])) {
                \App\Models\Project::create([
                    'seeker_id' => $jobSeeker->seeker_id,
                    'name' => $projectData['name'],
                    'role' => $projectData['role'] ?? null,
                    'category' => $projectData['category'] ?? 'personal',
                    'url' => $projectData['url'] ?? null,
                    'start_date' => $projectData['start_date'] ?? null,
                    'end_date' => isset($projectData['ongoing']) && $projectData['ongoing'] ? null : $projectData['end_date'],
                    'ongoing' => isset($projectData['ongoing']) && $projectData['ongoing'],
                    'description' => $projectData['description'] ?? null,
                    'technologies' => $projectData['technologies'] ?? null,
                    'outcomes' => $projectData['outcomes'] ?? null,
                ]);
            }
        }
    }

    /**
     * Map proficiency text to number for database storage
     */
    private function mapProficiencyToNumber($proficiency)
    {
        $mapping = [
            'beginner' => 1,
            'intermediate' => 2,
            'advanced' => 3,
            'expert' => 4,
        ];

        return $mapping[$proficiency] ?? 2;
    }

    /**
     * Update the job seeker's profile.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
            'current_position' => 'nullable|string|max:150',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'expected_salary_min' => 'nullable|numeric|min:0',
            'expected_salary_max' => 'nullable|numeric|min:0|gte:expected_salary_min',
            'availability_status' => 'nullable|in:immediately,within_month,within_3_months,not_looking',
            'location_preference' => 'nullable|string|max:100',
            'remote_preference' => 'boolean',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
        ]);

        // Update user information
        /** @var \App\Models\User $user */
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update or create job seeker profile
        $jobSeekerData = array_merge($validated, ['user_id' => $user->id]);
        $jobSeeker = job_seekers::updateOrCreate(
            ['user_id' => $user->id],
            $jobSeekerData
        );

        return redirect()->route('job_seeker.profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Show job applications for current user
     */
    public function applications(): View|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        if (!$jobSeeker) {
            return redirect()->route('job_seeker.profile')
                ->with('warning', 'Please complete your profile first.');
        }

        $applications = $jobSeeker->jobApplications()
            ->with(['job.company'])
            ->orderBy('applied_at', 'desc')
            ->paginate(10);

        return view('admin.job_seeker.applications', compact('applications'));
    }

    /**
     * Show the job application form for a specific job
     */
    public function applyForJob(jobs $job): View|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        // If no profile exists, redirect to create profile
        if (!$jobSeeker) {
            return redirect()->route('job_seeker.profile.edit')
                ->with('info', 'Please complete your profile before applying for jobs.');
        }

        // Check if user has already applied for this job
        $existingApplication = $jobSeeker->jobApplications()
            ->where('job_id', $job->id)
            ->first();

        if ($existingApplication) {
            return redirect()->route('job_seeker.applications')
                ->with('info', 'You have already applied for this job.');
        }

        return view('admin.job_seeker.application', compact('job', 'jobSeeker', 'user'));
    }

    /**
     * Submit a job application
     */
    public function submitApplication(Request $request, jobs $job): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        // Debug logging
        \Log::info('Job application submission started', [
            'user_id' => $user->id,
            'job_id' => $job->id,
            'has_job_seeker' => !!$jobSeeker
        ]);

        // If no profile exists, redirect to create profile
        if (!$jobSeeker) {
            \Log::warning('Job application failed: No job seeker profile', ['user_id' => $user->id]);
            return redirect()->route('job_seeker.profile.edit')
                ->with('info', 'Please complete your profile before applying for jobs.');
        }

        // Check if user has already applied for this job
        $existingApplication = job_applications::where('job_id', $job->id)
            ->where('seeker_id', $jobSeeker->seeker_id)
            ->first();

        if ($existingApplication) {
            return redirect()->route('job_seeker.applications')
                ->with('info', 'You have already applied for this job.');
        }

        // Debug: Log request data
        \Log::info('Job application request data', [
            'user_id' => $user->id,
            'job_id' => $job->id,
            'has_resume_file' => $request->hasFile('resume'),
            'resume_file_info' => $request->hasFile('resume') ? [
                'name' => $request->file('resume')->getClientOriginalName(),
                'size' => $request->file('resume')->getSize(),
                'mime' => $request->file('resume')->getMimeType(),
            ] : null,
            'all_files' => array_keys($request->allFiles()),
            'form_data_keys' => array_keys($request->except(['resume', '_token'])),
            'request_method' => $request->method(),
            'content_type' => $request->header('Content-Type')
        ]);

        // Validate the request
        try {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'location' => 'nullable|string|max:255',
                'current_position' => 'nullable|string|max:150',
                'experience' => 'required|string|max:50',
                'skills' => 'nullable|string|max:500',
                'resume' => 'nullable|file|mimes:pdf,doc,docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:5120', // 5MB max - temporarily optional for testing
                'cover_letter' => 'nullable|string|max:5000',
                'availability' => 'required|string|max:50',
                'salary_expectation' => 'nullable|string|max:50',
                'hear_about' => 'nullable|string|max:50',
                'terms' => 'required|accepted',
            ]);

            \Log::info('Job application validation passed', [
                'user_id' => $user->id,
                'job_id' => $job->id,
                'fields' => array_keys($validated)
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Job application validation failed', [
                'user_id' => $user->id,
                'job_id' => $job->id,
                'errors' => $e->errors()
            ]);
            throw $e;
        }

        // Handle file upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            try {
                $resumePath = $request->file('resume')->store('resumes', 'public');
                \Log::info('Resume uploaded successfully', [
                    'user_id' => $user->id,
                    'file_path' => $resumePath,
                    'original_name' => $request->file('resume')->getClientOriginalName()
                ]);
            } catch (\Exception $e) {
                \Log::error('Resume upload failed', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
                return redirect()->back()
                    ->withErrors(['resume' => 'Failed to upload resume file. Please try again.'])
                    ->withInput();
            }
        } else {
            \Log::warning('No resume file received', [
                'user_id' => $user->id,
                'all_files' => $request->allFiles(),
                'has_files' => $request->hasFile('resume')
            ]);
        }

        // Generate unique application ID (integer only)
        $applicationId = (int) (time() + $jobSeeker->seeker_id);

        try {
            // Create job application
            job_applications::create([
                'application_id' => $applicationId,
                'job_id' => $job->id,
                'seeker_id' => $jobSeeker->seeker_id,
                'cover_letter' => $validated['cover_letter'],
                'resume_file' => $resumePath,
                'application_status' => 'pending',
                'applied_at' => now(),
                'status_updated_at' => now(),
                'notes' => json_encode([
                    'full_name' => $validated['full_name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'location' => $validated['location'],
                    'current_position' => $validated['current_position'],
                    'experience' => $validated['experience'],
                    'skills' => $validated['skills'],
                    'availability' => $validated['availability'],
                    'salary_expectation' => $validated['salary_expectation'],
                    'hear_about' => $validated['hear_about'],
                ])
            ]);
        } catch (\Exception $e) {
            \Log::error('Job application submission failed: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'job_id' => $job->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Failed to submit application. Please try again.'])
                ->withInput();
        }

        \Log::info('Job application submitted successfully', [
            'user_id' => $user->id,
            'job_id' => $job->id,
            'application_id' => $applicationId
        ]);

        return redirect()->route('job_seeker.applications')
            ->with([
                'success' => 'Your application has been submitted successfully!',
                'swal' => [
                    'title' => 'Success!',
                    'text' => 'Your application has been submitted successfully!',
                    'icon' => 'success',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK'
                ]
            ]);
    }

    /**
     * Show saved jobs for current user
     */
    public function savedJobs(): View|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        if (!$jobSeeker) {
            return redirect()->route('job_seeker.profile')
                ->with('warning', 'Please complete your profile first.');
        }

        $savedJobs = $jobSeeker->savedJobs()
            ->with(['job.company'])
            ->orderBy('saved_at', 'desc')
            ->paginate(10);

        return view('admin.job_seeker.saved_jobs', compact('savedJobs'));
    }

    /**
     * Show job alerts for current user
     */
    public function jobAlerts(): View
    {
        $user = Auth::user();

        // Get job alerts through the relationship or directly from the model
        $jobAlerts = \App\Models\job_alerts::where('seeker_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.job_seeker.job_alerts', compact('jobAlerts'));
    }

    /**
     * Show the current user's resume
     */
    public function showResume(): \Illuminate\Http\RedirectResponse
    {
        // Redirect to the comprehensive profile page which includes resume information
        return redirect()->route('job_seeker.profile')
            ->with('info', 'Your resume information is displayed in your profile.');
    }

    /**
     * Show the resume management dashboard with CRUD operations
     */
    public function manageResume(): \Illuminate\Http\RedirectResponse
    {
        // Redirect to the comprehensive profile page which includes resume management
        return redirect()->route('job_seeker.profile')
            ->with('info', 'Manage your resume through your profile page.');
    }

    /**
     * Show the form to create a new resume
     */
    public function createResume(): \Illuminate\Http\RedirectResponse
    {
        // Redirect to the comprehensive profile edit form
        return redirect()->route('job_seeker.profile.edit.tabs')
            ->with('info', 'Complete your profile to create your resume.');
    }

    /**
     * Show the form to edit the current user's resume
     */
    public function editResume(): \Illuminate\Http\RedirectResponse
    {
        // Redirect to the comprehensive profile edit form
        return redirect()->route('job_seeker.profile.edit.tabs')
            ->with('info', 'Edit your profile to update your resume information.');
    }

    /**
     * Store a new resume
     */
    public function storeResume(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validate basic info
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'age' => 'nullable|integer|min:16|max:100',
            'bio' => 'nullable|string',
            'current_position' => 'nullable|string|max:150',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'expected_salary_min' => 'nullable|numeric|min:0',
            'expected_salary_max' => 'nullable|numeric|min:0|gte:expected_salary_min',
            'availability_status' => 'nullable|in:immediately,within_month,within_3_months,not_looking',
            'location_preference' => 'nullable|string|max:100',
            'remote_preference' => 'boolean',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',

            // Work Experience validation
            'work_experiences' => 'nullable|array',
            'work_experiences.*.company_name' => 'required_with:work_experiences|string|max:200',
            'work_experiences.*.job_title' => 'required_with:work_experiences|string|max:150',
            'work_experiences.*.employment_type' => 'nullable|in:full_time,part_time,contract,internship,freelance',
            'work_experiences.*.start_date' => 'required_with:work_experiences|date',
            'work_experiences.*.end_date' => 'nullable|date|after:work_experiences.*.start_date',
            'work_experiences.*.is_current' => 'boolean',
            'work_experiences.*.location' => 'nullable|string|max:150',
            'work_experiences.*.description' => 'nullable|string',

            // Education validation
            'educations' => 'nullable|array',
            'educations.*.degree_name' => 'required_with:educations|string|max:255',
            'educations.*.institute_name' => 'required_with:educations|string|max:255',
            'educations.*.field_of_study' => 'nullable|string|max:100',
            'educations.*.start_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
            'educations.*.passing_year' => 'required_with:educations|integer|min:1900|max:' . (date('Y') + 5),
            'educations.*.result_type' => 'nullable|in:grade,division,percentage',
            'educations.*.result_value' => 'nullable|string|max:10',
            'educations.*.description' => 'nullable|string',

            // Skills validation
            'skills' => 'nullable|array',
            'skills.*.skill_name' => 'required_with:skills|string|max:50',
            'skills.*.proficiency' => 'required_with:skills|integer|min:1|max:5',
        ]);

        // Update or create job seeker profile
        $jobSeekerData = [
            'user_id' => $user->id,
            'name' => $validated['name'] ?? $user->name,
            'email' => $validated['email'] ?? $user->email,
            'bio' => $validated['bio'] ?? null,
            'current_position' => $validated['current_position'] ?? null,
            'experience_years' => $validated['experience_years'] ?? null,
            'expected_salary_min' => $validated['expected_salary_min'] ?? null,
            'expected_salary_max' => $validated['expected_salary_max'] ?? null,
            'availability_status' => $validated['availability_status'] ?? 'not_looking',
            'location_preference' => $validated['location_preference'] ?? null,
            'remote_preference' => $validated['remote_preference'] ?? false,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'portfolio_url' => $validated['portfolio_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
        ];

        // Convert age to date_of_birth if age is provided
        if (isset($validated['age']) && $validated['age']) {
            $jobSeekerData['date_of_birth'] = now()->subYears($validated['age'])->format('Y-m-d');
        }

        $jobSeeker = job_seekers::updateOrCreate(
            ['user_id' => $user->id],
            $jobSeekerData
        );

        // Handle work experiences
        if (isset($validated['work_experiences'])) {
            foreach ($validated['work_experiences'] as $expData) {
                if (!empty($expData['company_name']) && !empty($expData['job_title'])) {
                    work_experience::updateOrCreate(
                        [
                            'seeker_id' => $jobSeeker->seeker_id,
                            'company_name' => $expData['company_name'],
                            'job_title' => $expData['job_title'],
                            'start_date' => $expData['start_date'],
                        ],
                        [
                            'employment_type' => $expData['employment_type'] ?? null,
                            'end_date' => $expData['end_date'] ?? null,
                            'is_current' => $expData['is_current'] ?? false,
                            'location' => $expData['location'] ?? null,
                            'description' => $expData['description'] ?? null,
                        ]
                    );
                }
            }
        }

        // Handle educations
        if (isset($validated['educations'])) {
            foreach ($validated['educations'] as $eduData) {
                if (!empty($eduData['degree_name']) && !empty($eduData['institute_name'])) {
                    education::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'degree_name' => $eduData['degree_name'],
                            'institute_name' => $eduData['institute_name'],
                            'passing_year' => $eduData['passing_year'],
                        ],
                        [
                            'field_of_study' => $eduData['field_of_study'] ?? null,
                            'start_year' => $eduData['start_year'] ?? null,
                            'result_type' => $eduData['result_type'] ?? null,
                            'result_value' => $eduData['result_value'] ?? null,
                            'description' => $eduData['description'] ?? null,
                        ]
                    );
                }
            }
        }

        // Handle skills
        if (isset($validated['skills'])) {
            foreach ($validated['skills'] as $skillData) {
                if (!empty($skillData['skill_name'])) {
                    SeekerSkill::updateOrCreate(
                        [
                            'seeker_id' => $jobSeeker->seeker_id,
                            'skill_name' => $skillData['skill_name'],
                        ],
                        [
                            'proficiency' => $skillData['proficiency'] ?? 3,
                        ]
                    );
                }
            }
        }

        $message = $request->isMethod('put') ? 'Resume updated successfully!' : 'Resume created successfully!';

        return redirect()->route('job_seeker.resume')
            ->with('success', $message);
    }

    /**
     * Update an existing resume
     */
    public function updateResume(Request $request): RedirectResponse
    {
        return $this->storeResume($request);
    }

    /**
     * Delete the current user's resume
     */
    public function destroyResume(): RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        if ($jobSeeker) {
            // Delete related data
            work_experience::where('seeker_id', $jobSeeker->seeker_id)->delete();
            education::where('user_id', $user->id)->delete();
            SeekerSkill::where('seeker_id', $jobSeeker->seeker_id)->delete();

            // Delete job seeker profile
            $jobSeeker->delete();
        }

        return redirect()->route('job_seeker.resume.create')
            ->with('success', 'Resume deleted successfully!');
    }

    /**
     * Save a job for later
     */
    public function saveJob(Request $request, $jobId)
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        if (!$jobSeeker) {
            return response()->json(['success' => false, 'message' => 'Profile not found']);
        }

        // Implementation for saving jobs - you can add this later
        return response()->json(['success' => true, 'message' => 'Job saved successfully']);
    }

    /**
     * Remove a saved job
     */
    public function unsaveJob($jobId)
    {
        // Implementation for removing saved jobs
        return redirect()->back()->with('success', 'Job removed from saved list');
    }

    /**
     * Create a new job alert
     */
    public function createJobAlert(Request $request)
    {
        $request->validate([
            'keywords' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'job_type' => 'nullable|string',
            'salary_min' => 'nullable|numeric',
        ]);

        // Implementation for creating job alerts
        return redirect()->back()->with('success', 'Job alert created successfully');
    }

    /**
     * Update a job alert
     */
    public function updateJobAlert(Request $request, $alertId)
    {
        // Implementation for updating job alerts
        return redirect()->back()->with('success', 'Job alert updated successfully');
    }

    /**
     * Delete a job alert
     */
    public function deleteJobAlert($alertId)
    {
        // Implementation for deleting job alerts
        return redirect()->back()->with('success', 'Job alert deleted successfully');
    }

    /**
     * Show companies the user is following
     */
    public function following(): View
    {
        $user = Auth::user();
        
        // For now, return empty collection - you can implement following functionality later
        $followingCompanies = collect();

        return view('admin.job_seeker.following', compact('followingCompanies'));
    }

    /**
     * Follow a company
     */
    public function followCompany($companyId)
    {
        // Implementation for following companies
        return redirect()->back()->with('success', 'Company followed successfully');
    }

    /**
     * Unfollow a company
     */
    public function unfollowCompany($companyId)
    {
        // Implementation for unfollowing companies
        return redirect()->back()->with('success', 'Company unfollowed successfully');
    }

    /**
     * Show messages
     */
    public function messages(): View
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();

        if (!$jobSeeker) {
            return view('admin.job_seeker.messages', ['messages' => collect()]);
        }

        // Get messages from the existing messages collection
        $messages = $this->messages ?? collect();

        return view('admin.job_seeker.messages', compact('messages'));
    }

    /**
     * Show a specific message
     */
    public function showMessage($messageId): View
    {
        // Implementation for showing individual messages
        $message = (object) [
            'id' => $messageId,
            'subject' => 'Sample Message',
            'content' => 'This is a sample message content.',
            'sender' => 'HR Department',
            'created_at' => now()
        ];

        return view('admin.job_seeker.message_show', compact('message'));
    }

    /**
     * Reply to a message
     */
    public function replyMessage(Request $request, $messageId)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);

        // Implementation for replying to messages
        return redirect()->back()->with('success', 'Reply sent successfully');
    }

    /**
     * Show security settings
     */
    public function security(): View
    {
        $user = Auth::user();
        return view('admin.job_seeker.security', compact('user'));
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    /**
     * Update email
     */
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'email' => $request->email,
            'email_verified_at' => null // Reset email verification
        ]);

        return redirect()->back()->with('success', 'Email updated successfully. Please verify your new email.');
    }

    /**
     * Enable two-factor authentication
     */
    public function enableTwoFactor(Request $request)
    {
        // Implementation for two-factor authentication
        return redirect()->back()->with('success', 'Two-factor authentication enabled successfully');
    }

    /**
     * Get page content for AJAX requests
     */
    public function getPageContent($page)
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        // Get basic stats for all pages
        $stats = [
            'total_applications' => 1,
            'saved_jobs' => 0,
            'profile_views' => 3,
            'upcoming_interviews' => 0,
            'unread_messages' => 3
        ];
        
        switch($page) {
            case 'dashboard':
                // Get dashboard specific data
                $recentActivities = collect([
                    [
                        'type' => 'job_match',
                        'title' => 'New job match found',
                        'description' => 'Senior Developer at TechCorp',
                        'time' => '2 hours ago',
                        'icon' => 'briefcase',
                        'color' => 'blue'
                    ],
                    [
                        'type' => 'profile_view',
                        'title' => 'Profile viewed by employer',
                        'description' => 'InnovateTech Solutions',
                        'time' => '5 hours ago',
                        'icon' => 'eye',
                        'color' => 'green'
                    ],
                    [
                        'type' => 'application_update',
                        'title' => 'Application status updated',
                        'description' => 'Frontend Developer role',
                        'time' => '1 day ago',
                        'icon' => 'chat',
                        'color' => 'yellow'
                    ]
                ]);
                
                $recommendedJobs = collect([
                    (object) [
                        'job_title' => 'PHP Developer',
                        'company' => (object) ['name' => 'TechnoSoft'],
                        'remote_work' => true,
                        'job_type' => 'full-time',
                        'created_at' => now()->subDays(2),
                        'salary_min' => 5000,
                        'salary_max' => 8000
                    ],
                    (object) [
                        'job_title' => 'Frontend Developer',
                        'company' => (object) ['name' => 'WebCorp'],
                        'remote_work' => false,
                        'job_type' => 'full-time',
                        'created_at' => now()->subDays(3),
                        'salary_min' => 6000,
                        'salary_max' => 10000
                    ]
                ]);
                
                return view('admin.job_seeker.partials.dashboard_content', compact('stats', 'recentActivities', 'recommendedJobs'));
                
            case 'profile':
                return view('admin.job_seeker.partials.profile_content', compact('user', 'jobSeeker'));
                
            case 'resume':
                return view('admin.job_seeker.partials.resume_content', compact('user', 'jobSeeker'));
                
            case 'resume-builder':
                return view('admin.job_seeker.partials.resume_builder_content');
                
            case 'applications':
                $applications = collect(); // Empty for now
                return view('admin.job_seeker.partials.applications_content', compact('applications'));
                
            case 'job-alerts':
                $jobAlerts = collect(); // Empty for now
                return view('admin.job_seeker.partials.job_alerts_content', compact('jobAlerts'));
                
            case 'saved-jobs':
                $savedJobs = collect(); // Empty for now
                return view('admin.job_seeker.partials.saved_jobs_content', compact('savedJobs'));
                
            case 'following':
                $followingCompanies = collect(); // Empty for now
                return view('admin.job_seeker.partials.following_content', compact('followingCompanies'));
                
            case 'messages':
                $messages = collect(); // Empty for now
                return view('admin.job_seeker.partials.messages_content', compact('messages'));
                
            case 'security':
                return view('admin.job_seeker.partials.security_content', compact('user'));
                
            default:
                $recentActivities = collect([
                    [
                        'type' => 'job_match',
                        'title' => 'New job match found',
                        'description' => 'Senior Developer at TechCorp',
                        'time' => '2 hours ago',
                        'icon' => 'briefcase',
                        'color' => 'blue'
                    ]
                ]);
                
                $recommendedJobs = collect([
                    (object) [
                        'job_title' => 'PHP Developer',
                        'company' => (object) ['name' => 'TechnoSoft'],
                        'remote_work' => true,
                        'job_type' => 'full-time',
                        'created_at' => now()->subDays(2),
                        'salary_min' => 5000,
                        'salary_max' => 8000
                    ]
                ]);
                
                return view('admin.job_seeker.partials.dashboard_content', compact('stats', 'recentActivities', 'recommendedJobs'));
        }
    }
}
