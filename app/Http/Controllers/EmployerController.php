<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\jobs;
use App\Models\companies;
use App\Models\job_applications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    /**
     * Display the employer dashboard.
     */
    public function dashboard(): View
    {
        // Sample data for the dashboard
        $stats = [
            'posted_jobs' => 45,
            'total_applications' => 523,
            'shortlisted_candidates' => 89,
            'hired_candidates' => 23,
        ];

        $recentJobs = [
            [
                'title' => 'Senior Laravel Developer',
                'applications' => 25,
                'status' => 'Active',
                'posted_date' => '2025-01-15',
                'deadline' => '2025-02-15',
            ],
            [
                'title' => 'Frontend React Developer',
                'applications' => 18,
                'status' => 'Active',
                'posted_date' => '2025-01-10',
                'deadline' => '2025-02-10',
            ],
            [
                'title' => 'UI/UX Designer',
                'applications' => 32,
                'status' => 'Closed',
                'posted_date' => '2025-01-05',
                'deadline' => '2025-01-20',
            ],
        ];

        $recentApplications = [
            [
                'candidate_name' => 'John Doe',
                'job_title' => 'Senior Laravel Developer',
                'applied_date' => '2025-01-20',
                'status' => 'Under Review',
                'experience' => '5 years',
            ],
            [
                'candidate_name' => 'Jane Smith',
                'job_title' => 'Frontend React Developer',
                'applied_date' => '2025-01-19',
                'status' => 'Shortlisted',
                'experience' => '3 years',
            ],
            [
                'candidate_name' => 'Mike Johnson',
                'job_title' => 'UI/UX Designer',
                'applied_date' => '2025-01-18',
                'status' => 'Interview Scheduled',
                'experience' => '4 years',
            ],
        ];

        return view('admin.employers.dashboard', compact('stats', 'recentJobs', 'recentApplications'));
    }

    /**
     * Display all jobs posted by the employer.
     */
    public function jobs(): View
    {
        $jobs = jobs::with('company')->paginate(10);
        
        return view('admin.employers.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job posting.
     */
    public function createJob(): View
    {
        return view('admin.employers.jobs.create');
    }

    /**
     * Store a newly created job in storage.
     */
    public function storeJob(Request $request): RedirectResponse
    {
        // Get the authenticated employer's user ID
        $employerId = Auth::id();
        
        // Validate the request
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'job_title' => 'required|string|max:255|unique:jobs_post',
            'category' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'experience' => 'nullable|string|max:255',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'application_deadline' => 'nullable|date|after:today',
            'is_featured' => 'boolean',
            'job_type' => 'nullable|in:full-time,part-time,contractor,remote',
            'status' => 'in:open,closed,draft',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        // Verify that the selected company belongs to the authenticated employer
        $company = companies::where('id', $validated['company_id'])
                           ->where('user_id', $employerId)
                           ->first();
                           
        if (!$company) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['company_id' => 'You are not authorized to post jobs for this company.']);
        }

        // Convert checkbox value to boolean
        $validated['is_featured'] = $request->has('is_featured');

        try {
            jobs::create($validated);
            
            return redirect()->route('employer.jobs.index')
                ->with('success', 'Job posted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create job. Please try again.']);
        }
    }

    /**
     * Display the specified job.
     */
    public function showJob($id)
    {
        $job = jobs::findOrFail($id);
        $this->authorizeJobAccess($job);
        return view('admin.employers.jobs.show', compact('job'));
    }
    
    /**
     * Show the form for editing the specified job.
     */
    public function editJob($id)
    {
        $job = jobs::findOrFail($id);
        $this->authorizeJobAccess($job);
        $companies = companies::where('user_id', Auth::id())->get();
        return view('admin.employers.jobs.edit', compact('job', 'companies'));
    }
    
    /**
     * Update the specified job in storage.
     */
    public function updateJob(Request $request, $id)
    {
        $job = jobs::findOrFail($id);
        $this->authorizeJobAccess($job);
        
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'job_title' => 'required|string|max:255|unique:jobs_post,job_title,' . $id,
            'category' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'experience' => 'nullable|string|max:255',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'application_deadline' => 'nullable|date|after:today',
            'is_featured' => 'boolean',
            'job_type' => 'nullable|in:full-time,part-time,contractor,remote',
            'status' => 'in:open,closed,draft',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);
        
        // Verify that the selected company belongs to the authenticated employer
        $company = companies::where('id', $validated['company_id'])
                           ->where('user_id', Auth::id())
                           ->first();
                           
        if (!$company) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['company_id' => 'You are not authorized to update jobs for this company.']);
        }
        
        try {
            $validated['is_featured'] = $request->has('is_featured');
            $job->update($validated);
            
            return redirect()->route('employer.jobs.index')
                ->with('success', 'Job updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update job. Please try again.']);
        }
    }
    
    /**
     * Remove the specified job from storage.
     */
    public function deleteJob($id)
    {
        $job = jobs::findOrFail($id);
        $this->authorizeJobAccess($job);
        
        try {
            $job->delete();
            return redirect()->route('employer.jobs.index')
                ->with('success', 'Job deleted successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete job. Please try again.']);
        }
    }
    
    /**
     * Authorize that the job belongs to the employer's company.
     */
    protected function authorizeJobAccess($job)
    {
        $companies = companies::where('user_id', Auth::id())->get();
        
        if ($companies->isEmpty()) {
            abort(403, 'Unauthorized action.');
        }
        
        $companyIds = $companies->pluck('id')->toArray();
        
        if (!in_array($job->company_id, $companyIds)) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display employer profile.
     */
    public function profile(): View
    {
        return view('admin.employers.profile');
    }

    /**
     * Display all job applications for the employer's jobs
     */
    public function applications()
    {
        // Get the authenticated employer's user ID
        $employerId = Auth::id();
        
        // Get the companies associated with this employer
        $companies = companies::where('user_id', $employerId)->get();
        
        if ($companies->isEmpty()) {
            // If no companies found, return empty applications
            $applications = job_applications::with(['job', 'jobSeeker'])
                ->whereNull('job_id') // This ensures no results
                ->orderBy('applied_at', 'desc')
                ->paginate(10);
        } else {
            $companyIds = $companies->pluck('id')->toArray();
            
            // Get all applications for the employer's jobs with related data
            $applications = job_applications::with(['job', 'jobSeeker'])
                ->whereHas('job', function($query) use ($companyIds) {
                    $query->whereIn('company_id', $companyIds);
                })
                ->orderBy('applied_at', 'desc')
                ->paginate(10);
        }
            
        return view('admin.employers.application-management', compact('applications'));
    }
    
    /**
     * Show a specific job application
     */
    public function showApplication(job_applications $application)
    {
        // Get the authenticated employer's user ID
        $employerId = Auth::id();
        
        // Get the companies associated with this employer
        $companies = companies::where('user_id', $employerId)->get();
        
        if ($companies->isEmpty()) {
            abort(403, 'Unauthorized action.');
        }
        
        $companyIds = $companies->pluck('id')->toArray();
        
        // Verify that the application belongs to the employer's job
        if (!in_array($application->job->company_id, $companyIds)) {
            abort(403, 'Unauthorized action.');
        }
        
        $application->load(['job', 'jobSeeker']);
        
        return view('admin.employers.application-show', compact('application'));
    }
    
    /**
     * Update application status
     */
    public function updateStatus(Request $request, job_applications $application)
    {
        // Get the authenticated employer's user ID
        $employerId = Auth::id();
        
        // Get the companies associated with this employer
        $companies = companies::where('user_id', $employerId)->get();
        
        if ($companies->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }
        
        $companyIds = $companies->pluck('id')->toArray();
        
        // Verify that the application belongs to the employer's job
        if (!in_array($application->job->company_id, $companyIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }
        
        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected,hired'
        ]);
        
        try {
            $application->status = $request->status;
            $application->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Application status updated successfully',
                'status' => $application->status
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update application status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display shortlisted candidates.
     */
    public function shortlisted(): View
    {
        return view('admin.employers.shortlisted');
    }

    /**
     * Display draft jobs.
     */
    public function drafts(): View
    {
        // Sample data for draft jobs
        $draftJobs = [
            [
                'title' => 'Mobile App Developer',
                'last_modified' => '2025-01-20',
                'created_date' => '2025-01-15',
            ],
            [
                'title' => 'Data Scientist',
                'last_modified' => '2025-01-18',
                'created_date' => '2025-01-10',
            ],
        ];

        return view('admin.employers.jobs.drafts', compact('draftJobs'));
    }

    /**
     * Show the form for editing the password.
     */
    public function editPassword(): View
    {
        return view('admin.employers.password.edit');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('employer.password.edit')
            ->with('success', 'Password updated successfully.');
    }
}