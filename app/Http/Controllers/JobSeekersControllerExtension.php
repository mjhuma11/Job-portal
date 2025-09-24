    /**
     * Submit a job application
     */
    public function submitApplication(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $jobSeeker = job_seekers::where('user_id', $user->id)->first();
        
        // If no job seeker profile exists, create one
        if (!$jobSeeker) {
            $jobSeeker = job_seekers::create([
                'user_id' => $user->id,
                'bio' => null,
                'current_position' => null,
                'experience_years' => 0,
                'expected_salary_min' => null,
                'expected_salary_max' => null,
                'availability_status' => 'not_looking',
                'location_preference' => null,
                'remote_preference' => false,
                'linkedin_url' => null,
                'portfolio_url' => null,
                'github_url' => null,
                'resume_file' => null,
            ]);
        }
        
        // Validate the application form data
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:100',
            'cover_letter' => 'required|string',
            'experience' => 'required|in:0-1,1-3,3-5,5-10,10+',
            'skills' => 'required|string|max:500',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'availability' => 'required|in:immediate,2-weeks,1-month,negotiable',
            'salary_expectation' => 'nullable|string|max:100',
            'linkedin' => 'nullable|url|max:255',
        ]);
        
        // Handle resume file upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/applications'), $fileName);
            $resumePath = 'uploads/applications/' . $fileName;
        }
        
        // Create or update job application
        // In a real application, you would save this to a job_applications table
        // For now, we'll just simulate the process
        
        // Update job seeker profile with any new information
        $jobSeeker->update([
            'current_position' => $validated['full_name'],
            'location_preference' => $validated['location'],
            'linkedin_url' => $validated['linkedin'] ?? $jobSeeker->linkedin_url,
        ]);
        
        // Redirect back with success message
        return redirect()->route('job_seeker.applications')
            ->with('success', 'Your application has been submitted successfully!');
    }