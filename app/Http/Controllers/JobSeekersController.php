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
use Illuminate\View\View;

class JobSeekersController extends Controller
{
    /**
     * Display the job seeker's profile.
     */
    public function showProfile(): View|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        // If no profile exists, redirect to create profile
        if (!$jobSeeker) {
            return redirect()->route('job_seeker.profile.edit')
                ->with('info', 'Please complete your profile to continue.');
        }
        
        return view('admin.job_seeker.profile-view', compact('jobSeeker', 'user'));
    }

    /**
     * Show the form for editing the job seeker's profile.
     */
    public function editProfile(): View
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        return view('admin.job_seeker.profile-edit', compact('jobSeeker', 'user'));
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
            'experiences.*.type' => 'nullable|in:full-time,part-time,contract,internship,freelance',
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
            ->with('success', 'Profile updated successfully!');
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
        
        // If no profile exists, redirect to create profile
        if (!$jobSeeker) {
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
        
        // Validate the request
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'nullable|string|max:255',
            'current_position' => 'nullable|string|max:150',
            'experience' => 'required|string|max:50',
            'skills' => 'nullable|string|max:500',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'cover_letter' => 'nullable|string|max:5000',
            'availability' => 'required|string|max:50',
            'salary_expectation' => 'nullable|string|max:50',
            'hear_about' => 'nullable|string|max:50',
            'terms' => 'required|accepted',
        ]);
        
        // Handle file upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }
        
        // Generate unique application ID
        $applicationId = time() . $jobSeeker->seeker_id;
        
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
        
        return redirect()->route('job_seeker.applications')
            ->with([
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
    public function showResume(): View|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        if (!$jobSeeker) {
            return redirect()->route('job_seeker.resume.create')
                ->with('info', 'Create your resume to get started!');
        }
        
        $workExperiences = work_experience::where('seeker_id', $jobSeeker->seeker_id)
            ->orderBy('start_date', 'desc')
            ->get();
            
        $educations = education::where('user_id', $user->id)
            ->orderBy('passing_year', 'desc')
            ->get();
            
        $skills = SeekerSkill::where('seeker_id', $jobSeeker->seeker_id)
            ->orderBy('proficiency', 'desc')
            ->get();
        
        return view('admin.job_seeker.resume-view', compact('jobSeeker', 'user', 'workExperiences', 'educations', 'skills'));
    }
    
    /**
     * Show the resume management dashboard with CRUD operations
     */
    public function manageResume(): View
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        $workExperiences = collect();
        $educations = collect();
        $skills = collect();
        
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
        }
        
        return view('admin.job_seeker.resume-management', compact('jobSeeker', 'user', 'workExperiences', 'educations', 'skills'));
    }
    
    /**
     * Show the form to create a new resume
     */
    public function createResume(): View
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        return view('admin.job_seeker.resume-create', compact('user', 'jobSeeker'));
    }
    
    /**
     * Show the form to edit the current user's resume
     */
    public function editResume(): View|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        if (!$jobSeeker) {
            return redirect()->route('job_seeker.resume.create')
                ->with('info', 'Create your resume first!');
        }
        
        $workExperiences = work_experience::where('seeker_id', $jobSeeker->seeker_id)
            ->orderBy('start_date', 'desc')
            ->get();
            
        $educations = education::where('user_id', $user->id)
            ->orderBy('passing_year', 'desc')
            ->get();
            
        $skills = SeekerSkill::where('seeker_id', $jobSeeker->seeker_id)
            ->orderBy('proficiency', 'desc')
            ->get();
        
        return view('admin.job_seeker.resume-edit', compact('jobSeeker', 'user', 'workExperiences', 'educations', 'skills'));
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
            'educations.*.passing_year' => 'required_with:educations|integer|min:1900|max:' . (date('Y') + 5),
            'educations.*.result_type' => 'nullable|in:grade,division,percentage',
            'educations.*.result_value' => 'nullable|string|max:10',
            'educations.*.major_subject' => 'nullable|string|max:100',
            
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
            'age' => $validated['age'] ?? null,
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
                            'result_type' => $eduData['result_type'] ?? null,
                            'result_value' => $eduData['result_value'] ?? null,
                            'major_subject' => $eduData['major_subject'] ?? null,
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
}