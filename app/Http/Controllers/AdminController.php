<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\companies;
use App\Models\jobs;
use App\Models\Category;
use App\Models\locations;
use App\Models\contact_messages;
use App\Models\faqs;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        // Get recent activities
        $recentJobs = jobs::with('company')->latest()->limit(5)->get();
        $recentEmployers = companies::with('user')->latest()->limit(5)->get();
        $recentJobSeekers = User::whereHas('role', function($query) {
            $query->where('name', 'jobseeker');
        })->with('jobSeeker')->latest()->limit(5)->get();

        // Removed stats data as per user request
        return view('admin.admin-dashboard.dashboard', compact('recentJobs', 'recentEmployers', 'recentJobSeekers'));
    }

    // ==============================
    // USER MANAGEMENT
    // ==============================

    /**
     * Display a listing of employers.
     */
    public function employers()
    {
        $employers = companies::with('user')->paginate(10);
        return view('admin.admin-dashboard.employers.index', compact('employers'));
    }

    /**
     * Show the form for creating a new employer.
     */
    public function createEmployer()
    {
        return view('admin.admin-dashboard.employers.create');
    }

    /**
     * Store a newly created employer in storage.
     */
    public function storeEmployer(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'company_name' => 'required|string|max:255|unique:companies,name',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role_id' => 3, // Employer role ID
        ]);

        // Create company
        $company = companies::create([
            'user_id' => $user->id,
            'name' => $validatedData['company_name'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->route('admin.employers')->with('success', 'Employer created successfully.');
    }

    /**
     * Display the specified employer.
     */
    public function showEmployer(companies $company)
    {
        $company->load('user', 'jobs');
        return view('admin.admin-dashboard.employers.show', compact('company'));
    }

    /**
     * Show the form for editing the specified employer.
     */
    public function editEmployer(companies $company)
    {
        $company->load('user');
        return view('admin.admin-dashboard.employers.edit', compact('company'));
    }

    /**
     * Update the specified employer in storage.
     */
    public function updateEmployer(Request $request, companies $company)
    {
        // Validation rules
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $company->user->id,
            'company_name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'verified' => 'boolean',
            'featured' => 'boolean',
        ]);

        // Update user
        $company->user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Update company
        $company->update([
            'name' => $validatedData['company_name'],
            'email' => $validatedData['email'],
            'verified' => $request->has('verified'),
            'featured' => $request->has('featured'),
        ]);

        return redirect()->route('admin.employers')->with('success', 'Employer updated successfully.');
    }

    /**
     * Remove the specified employer from storage.
     */
    public function destroyEmployer(companies $company)
    {
        // Delete company and associated user
        $company->user->delete();
        $company->delete();

        return redirect()->route('admin.employers')->with('success', 'Employer deleted successfully.');
    }

    /**
     * Approve an employer account.
     */
    public function approveEmployer(companies $company)
    {
        $company->update(['verified' => true]);
        return redirect()->back()->with('success', 'Employer approved successfully.');
    }

    /**
     * Suspend an employer account.
     */
    public function suspendEmployer(companies $company)
    {
        $company->update(['verified' => false]);
        return redirect()->back()->with('success', 'Employer suspended successfully.');
    }

    /**
     * Display a listing of job seekers.
     */
    public function jobSeekers()
    {
        $jobSeekers = User::whereHas('role', function($query) {
            $query->where('name', 'jobseeker');
        })->with('jobSeeker')->paginate(10);
        return view('admin.job_seekers.index', compact('jobSeekers'));
    }

    /**
     * Display the specified job seeker.
     */
    public function showJobSeeker(User $user)
    {
        $user->load('jobSeeker');
        return view('admin.job_seekers.show', compact('user'));
    }

    /**
     * Handle reported fake/spam job seekers.
     */
    public function handleReportedJobSeeker(User $user)
    {
        // Logic to handle reported job seekers
        // This could involve suspending accounts, deleting profiles, etc.
        return redirect()->back()->with('success', 'Report handled successfully.');
    }

    // ==============================
    // ROLE & PERMISSION MANAGEMENT
    // ==============================

    /**
     * Display a listing of roles.
     */
    public function roles()
    {
        $roles = \App\Models\Role::with('users')->get();
        return view('admin.admin-dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function createRole()
    {
        return view('admin.admin-dashboard.roles.create');
    }

    /**
     * Store a newly created role in storage.
     */
    public function storeRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string',
        ]);

        \App\Models\Role::create($validatedData);

        return redirect()->route('admin.roles')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function editRole(\App\Models\Role $role)
    {
        return view('admin.admin-dashboard.roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     */
    public function updateRole(Request $request, \App\Models\Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
        ]);

        $role->update($validatedData);

        return redirect()->route('admin.roles')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroyRole(\App\Models\Role $role)
    {
        // Check if role has users before deleting
        if ($role->users()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete role with assigned users.');
        }

        $role->delete();

        return redirect()->route('admin.roles')->with('success', 'Role deleted successfully.');
    }

    // ==============================
    // JOB MANAGEMENT
    // ==============================

    /**
     * Display a listing of jobs.
     */
    public function jobs()
    {
        $jobs = jobs::with('company')->paginate(10);
        return view('admin.admin-dashboard.jobs.index', compact('jobs'));
    }

    /**
     * Display the specified job.
     */
    public function showJob(jobs $job)
    {
        $job->load('company');
        return view('admin.admin-dashboard.jobs.show', compact('job'));
    }

    /**
     * Approve a job post.
     */
    public function approveJob(jobs $job)
    {
        $job->update(['status' => 'open']);
        return redirect()->back()->with('success', 'Job approved successfully.');
    }

    /**
     * Block/Remove a job post.
     */
    public function blockJob(jobs $job)
    {
        $job->update(['status' => 'closed']);
        return redirect()->back()->with('success', 'Job blocked successfully.');
    }

    /**
     * Feature a job post.
     */
    public function featureJob(jobs $job)
    {
        $job->update(['is_featured' => true]);
        return redirect()->back()->with('success', 'Job featured successfully.');
    }

    /**
     * Unfeature a job post.
     */
    public function unfeatureJob(jobs $job)
    {
        $job->update(['is_featured' => false]);
        return redirect()->back()->with('success', 'Job unfeatured successfully.');
    }

    // ==============================
    // CATEGORY & LOCATION MANAGEMENT
    // ==============================

    /**
     * Display a listing of categories.
     */
    public function categories()
    {
        $categories = Category::paginate(10);
        return view('admin.admin-dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function createCategory()
    {
        return view('admin.admin-dashboard.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function storeCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Generate slug from name
        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['name']);

        Category::create($validatedData);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function editCategory(Category $category)
    {
        return view('admin.admin-dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function updateCategory(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Generate slug from name
        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['name']);

        $category->update($validatedData);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroyCategory(Category $category)
    {
        // Check if category has jobs before deleting
        if ($category->jobs()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category with associated jobs.');
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }

    /**
     * Display a listing of locations.
     */
    public function locations()
    {
        $locations = locations::paginate(10);
        return view('admin.admin-dashboard.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new location.
     */
    public function createLocation()
    {
        return view('admin.admin-dashboard.locations.create');
    }

    /**
     * Store a newly created location in storage.
     */
    public function storeLocation(Request $request)
    {
        $validatedData = $request->validate([
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'is_popular' => 'boolean',
        ]);

        locations::create($validatedData);

        return redirect()->route('admin.locations')->with('success', 'Location created successfully.');
    }

    /**
     * Show the form for editing the specified location.
     */
    public function editLocation(locations $location)
    {
        return view('admin.admin-dashboard.locations.edit', compact('location'));
    }

    /**
     * Update the specified location in storage.
     */
    public function updateLocation(Request $request, locations $location)
    {
        $validatedData = $request->validate([
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'is_popular' => 'boolean',
        ]);

        $location->update($validatedData);

        return redirect()->route('admin.locations')->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified location from storage.
     */
    public function destroyLocation(locations $location)
    {
        $location->delete();

        return redirect()->route('admin.locations')->with('success', 'Location deleted successfully.');
    }

    // ==============================
    // CONTENT MANAGEMENT (CMS)
    // ==============================

    /**
     * Display a listing of FAQs.
     */
    public function faqs()
    {
        $faqs = faqs::paginate(10);
        return view('admin.admin-dashboard.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function createFaq()
    {
        return view('admin.admin-dashboard.faqs.create');
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function storeFaq(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,archived',
            'sort_order' => 'nullable|integer',
        ]);

        faqs::create($validatedData);

        return redirect()->route('admin.faqs')->with('success', 'FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function editFaq(faqs $faq)
    {
        return view('admin.admin-dashboard.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function updateFaq(Request $request, faqs $faq)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,archived',
            'sort_order' => 'nullable|integer',
        ]);

        $faq->update($validatedData);

        return redirect()->route('admin.faqs')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroyFaq(faqs $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs')->with('success', 'FAQ deleted successfully.');
    }

    /**
     * Display a listing of contact messages.
     */
    public function contactMessages()
    {
        $messages = contact_messages::paginate(10);
        return view('admin.admin-dashboard.messages.index', compact('messages'));
    }

    /**
     * Display the specified contact message.
     */
    public function showContactMessage(contact_messages $message)
    {
        // Mark as read if it's unread
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.admin-dashboard.messages.show', compact('message'));
    }

    /**
     * Reply to a contact message.
     */
    public function replyContactMessage(Request $request, contact_messages $message)
    {
        $validatedData = $request->validate([
            'reply' => 'required|string',
        ]);

        $message->update([
            'reply' => $validatedData['reply'],
            'status' => 'replied'
        ]);

        // Here you would typically send an email to the user
        // Mail::to($message->email)->send(new ContactReplyMail($message));

        return redirect()->back()->with('success', 'Reply sent successfully.');
    }

    // ==============================
    // ANALYTICS & REPORTS
    // ==============================

    /**
     * Display analytics dashboard.
     */
    public function analytics()
    {
        // User statistics
        $userStats = [
            'total' => User::count(),
            'admins' => User::whereHas('role', function($query) {
                $query->where('name', 'admin');
            })->count(),
            'employers' => User::whereHas('role', function($query) {
                $query->where('name', 'employer');
            })->count(),
            'job_seekers' => User::whereHas('role', function($query) {
                $query->where('name', 'jobseeker');
            })->count(),
        ];

        // Job statistics
        $jobStats = [
            'total' => jobs::count(),
            'open' => jobs::where('status', 'open')->count(),
            'closed' => jobs::where('status', 'closed')->count(),
            'draft' => jobs::where('status', 'draft')->count(),
            'featured' => jobs::where('is_featured', true)->count(),
        ];

        // Application statistics
        $applicationStats = [
            'total' => DB::table('job_applications')->count(),
            // Add more detailed stats as needed
        ];

        // Category statistics
        $categoryStats = Category::withCount('jobs')->get();

        // Location statistics - using the new method
        $locationStats = locations::all();

        // Fixed the view path to match the actual file location
        return view('admin.admin-dashboard.analytics.index', compact(
            'userStats', 
            'jobStats', 
            'applicationStats', 
            'categoryStats', 
            'locationStats'
        ));
    }

    // ==============================
    // SECURITY & MODERATION
    // ==============================

    /**
     * Display reported content.
     */
    public function reportedContent()
    {
        // This would show reported jobs, employers, seekers, etc.
        // For now, we'll just return a placeholder view
        return view('admin.admin-dashboard.moderation.reported');
    }

    /**
     * Handle a reported item.
     */
    public function handleReport(Request $request)
    {
        // Logic to handle reports
        return redirect()->back()->with('success', 'Report handled successfully.');
    }
}