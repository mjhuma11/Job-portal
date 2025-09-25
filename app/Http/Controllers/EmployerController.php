<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\jobs;
use App\Models\companies;
use App\Models\job_applications;
use App\Models\User;
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
        // Get companies associated with the current employer
        $companies = companies::where('user_id', Auth::id())->get();
        
        return view('admin.employers.jobs.create', compact('companies'));
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

    /**
     * Display user management dashboard.
     */
    public function userManagement(Request $request): View
    {
        $query = User::with(['role', 'jobSeeker', 'company']);

        // Apply filters
        if ($request->filled('role')) {
            $query->whereHas('role', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->status === 'inactive') {
                $query->whereNull('email_verified_at');
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::whereNotNull('email_verified_at')->count(),
            'admins' => User::whereHas('role', function($q) {
                $q->where('name', 'admin');
            })->count(),
            'customers' => User::whereHas('role', function($q) {
                $q->where('name', 'jobseeker');
            })->count(),
        ];

        $roles = \App\Models\Role::all();

        return view('admin.employers.users.index', compact('users', 'stats', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser(): View
    {
        $roles = \App\Models\Role::all();
        return view('admin.employers.users.create', compact('roles'));
    }

    /**
     * Store a newly created user.
     */
    public function storeUser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'email_verified_at' => now(),
        ]);

        // Create appropriate profile based on role
        $role = \App\Models\Role::find($request->role_id);
        if ($role->name === 'jobseeker') {
            \App\Models\job_seekers::create([
                'user_id' => $user->id,
                'availability_status' => 'immediately',
                'remote_preference' => false,
            ]);
        }

        return redirect()->route('employer.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function showUser(User $user): View
    {
        $user->load(['role', 'jobSeeker', 'company']);
        return view('admin.employers.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function editUser(User $user): View
    {
        $roles = \App\Models\Role::all();
        return view('admin.employers.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('employer.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function deleteUser(User $user): RedirectResponse
    {
        // Prevent deleting the current user
        if ($user->id === Auth::id()) {
            return redirect()->route('employer.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('employer.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle user status (active/inactive).
     */
    public function toggleUserStatus(User $user): RedirectResponse
    {
        if ($user->email_verified_at) {
            $user->email_verified_at = null;
            $message = 'User deactivated successfully.';
        } else {
            $user->email_verified_at = now();
            $message = 'User activated successfully.';
        }

        $user->save();

        return redirect()->route('employer.users.index')
            ->with('success', $message);
    }

    /**
     * Display companies for the employer.
     */
    public function companies(): View
    {
        $companies = companies::where('user_id', Auth::id())->paginate(10);
        return view('admin.employers.companies.index', compact('companies'));
    }

    /**
     * Store a newly created company.
     */
    public function storeCompany(Request $request)
    {
        try {
            // Basic validation - only require name and email
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            // Prepare company data
            $companyData = [
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $request->logo, // Will be null if not provided
                'description' => $request->description,
                'industry' => $request->industry,
                'website' => $request->website,
                'phone' => $request->phone,
                'founded_year' => $request->founded_year,
                'featured' => $request->has('featured') ? 1 : 0,
                'verified' => $request->has('verified') ? 1 : 0,
            ];
            
            // Create company using mass assignment
            $company = companies::create($companyData);

            // Return appropriate response
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Company added successfully!',
                    'company' => $company
                ]);
            }

            return redirect()->route('employer.companies.index')
                ->with('success', 'Company added successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating company: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Error creating company: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing a company.
     */
    public function editCompany(companies $company): View
    {
        // Ensure the company belongs to the current user
        if ($company->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.employers.companies.edit', compact('company'));
    }

    /**
     * Update the specified company.
     */
    public function updateCompany(Request $request, companies $company): RedirectResponse
    {
        // Ensure the company belongs to the current user
        if ($company->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'website' => $request->website,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('employer.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified company.
     */
    public function deleteCompany(companies $company): RedirectResponse
    {
        // Ensure the company belongs to the current user
        if ($company->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if company has any jobs
        $jobCount = jobs::where('company_id', $company->id)->count();
        if ($jobCount > 0) {
            return redirect()->route('employer.companies.index')
                ->with('error', 'Cannot delete company with existing job postings.');
        }

        $company->delete();

        return redirect()->route('employer.companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}