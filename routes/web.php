<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobSeekersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;

// Test route to check if tables exist
Route::get('/test-tables', function () {
    $tables = [
        'employer_notifications' => Schema::hasTable('employer_notifications'),
        'employer_messages' => Schema::hasTable('employer_messages'),
        'interviews' => Schema::hasTable('interviews'),
        'job_seekers' => Schema::hasTable('job_seekers'),
        'jobs' => Schema::hasTable('jobs'),
        'companies' => Schema::hasTable('companies')
    ];
    
    return response()->json($tables);
});

// Simple test route for home page
Route::get('/test-home', function () {
    return response()->json(['message' => 'Home route is working']);
});

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('redirect.if.admin');

// Public Categories Routes
Route::get('/categories', [CategoryController::class, 'publicIndex'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'publicShow'])->name('categories.show');

// Public Jobs Routes
Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', function () {
        return view('jobs.index');
    })->name('index');
    Route::get('/{job}', function ($job) {
        // In a real application, you would fetch the job from the database
        // For now, we'll just pass a dummy job object
        $dummyJob = (object) [
            'id' => $job,
            'job_title' => 'Senior Frontend Developer',
            'category' => 'Technology',
            'location' => 'San Francisco, CA',
            'salary' => '$90,000 - $120,000',
            'job_type' => 'full-time',
            'experience' => '5+ years',
            'application_deadline' => '2025-12-31',
            'description' => 'We are looking for a talented Senior Frontend Developer to join our team. You will be responsible for developing user-facing web applications using modern JavaScript frameworks.',
            'requirements' => "• Bachelor's degree in Computer Science or related field\n• 5+ years of experience in frontend development\n• Proficiency in React, Vue.js, or Angular\n• Strong knowledge of HTML, CSS, and JavaScript\n• Experience with RESTful APIs\n• Familiarity with testing frameworks",
            'responsibilities' => "• Develop and maintain user-facing web applications\n• Collaborate with UX/UI designers to implement design mockups\n• Optimize applications for maximum speed and scalability\n• Participate in code reviews and contribute to team knowledge sharing\n• Troubleshoot and debug issues\n• Stay up-to-date with the latest frontend technologies",
            'benefits' => "• Competitive salary and equity package\n• Comprehensive health, dental, and vision insurance\n• Flexible work hours and remote work options\n• Professional development budget\n• Unlimited paid time off\n• Catered meals and snacks",
            'created_at' => now(),
            'updated_at' => now(),
            'company' => (object) [
                'name' => 'Tech Innovations Inc.',
                'industry' => 'Technology',
                'description' => 'Tech Innovations Inc. is a leading technology company focused on creating innovative solutions for businesses worldwide.'
            ]
        ];
        return view('jobs.show', compact('dummyJob'));
    })->name('show');
});

// Test route to check jobs
Route::get('/test-jobs', function () {
    // Replicate the exact logic from HomeController
    $recentJobs = \App\Models\jobs::with('company')
        ->active()
        ->notExpired()
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();
    
    return response()->json([
        'count' => $recentJobs->count(),
        'jobs' => $recentJobs->toArray()
    ]);
});

// Test route to check companies
Route::get('/test-companies', function () {
    $companies = \App\Models\companies::all();
    return response()->json([
        'count' => $companies->count(),
        'companies' => $companies->toArray()
    ]);
});

// Test route to check job seeker relationship
Route::get('/test-job-seeker', function () {
    if (Auth::check()) {
        /** @var User $user */
        $user = Auth::user();
        $user->load(['jobSeeker', 'role']);
        return response()->json([
            'user' => $user->toArray(),
            'role' => $user->role ? $user->role->toArray() : null,
            'job_seeker' => $user->jobSeeker ? $user->jobSeeker->toArray() : null,
            'has_job_seeker' => $user->jobSeeker ? true : false,
            'is_job_seeker' => $user->isJobSeeker(),
            'can_apply_for_jobs' => $user->isJobSeeker()
        ]);
    }
    return response()->json(['error' => 'Not authenticated']);
})->middleware('auth');

// Test route to check user roles
Route::get('/test-roles', function () {
    $users = User::with(['role', 'jobSeeker'])->get();
    return response()->json([
        'total_users' => $users->count(),
        'users' => $users->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ? $user->role->name : 'No role',
                'has_job_seeker_profile' => $user->jobSeeker ? true : false,
                'can_apply_for_jobs' => $user->isJobSeeker()
            ];
        })
    ]);
});

// Test route to check user management routes
Route::get('/test-user-routes', function () {
    return response()->json([
        'user_management_index' => route('employer.users.index'),
        'user_create' => route('employer.users.create'),
        'routes_working' => 'All user management routes are properly defined'
    ]);
})->middleware('auth');

// Test route to check company routes
Route::get('/test-company-routes', function () {
    return response()->json([
        'company_index' => route('employer.companies.index'),
        'company_store' => route('employer.companies.store'),
        'routes_working' => 'All company routes are properly defined'
    ]);
})->middleware('auth');

// Test route to create a company manually
Route::get('/test-create-company', function () {
    if (!Auth::check()) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    try {
        // First, let's check if the table exists and what columns it has
        $tableInfo = DB::select("DESCRIBE companies");
        
        $company = \App\Models\companies::create([
            'user_id' => Auth::id(),
            'name' => 'Test Company ' . time(),
            'email' => 'test' . time() . '@example.com',
            'description' => 'Test company description',
            'industry' => 'Technology',
            'website' => 'https://example.com',
            'phone' => '+1234567890',
            'founded_year' => 2020,
            'featured' => false,
            'verified' => false,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Test company created successfully',
            'company' => $company,
            'table_info' => $tableInfo
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
})->middleware('auth');

// Test route to check database connection and companies table
Route::get('/test-db-companies', function () {
    try {
        // Check database connection
        DB::connection()->getPdo();
        
        // Check if companies table exists
        $tableExists = DB::getSchemaBuilder()->hasTable('companies');
        
        // Get table structure
        $columns = [];
        if ($tableExists) {
            $columns = DB::select("DESCRIBE companies");
        }
        
        // Get existing companies count
        $companiesCount = $tableExists ? \App\Models\companies::count() : 0;
        
        // Get current user info
        $user = Auth::check() ? Auth::user() : null;
        
        return response()->json([
            'database_connected' => true,
            'companies_table_exists' => $tableExists,
            'companies_count' => $companiesCount,
            'table_columns' => $columns,
            'current_user' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ] : null
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'database_connected' => false,
            'error' => $e->getMessage()
        ]);
    }
});

// Debug page for company creation
Route::get('/debug-company', function () {
    return view('debug-company');
})->middleware('auth');

// Simple test route to create a company directly
Route::get('/simple-create-company', function () {
    if (!Auth::check()) {
        return 'Please login first';
    }
    
    try {
        // Create a simple company with minimal data
        $company = new \App\Models\companies();
        $company->user_id = Auth::id();
        $company->name = 'Simple Test Company ' . time();
        $company->email = 'simple' . time() . '@test.com';
        $company->save();
        
        return 'Company created successfully! ID: ' . $company->id . ', Name: ' . $company->name;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::get('/employers', [AdminController::class, 'employers'])->name('employers');
    Route::get('/employers/create', [AdminController::class, 'createEmployer'])->name('employers.create');
    Route::post('/employers', [AdminController::class, 'storeEmployer'])->name('employers.store');
    Route::get('/employers/{company}', [AdminController::class, 'showEmployer'])->name('employers.show');
    Route::get('/employers/{company}/edit', [AdminController::class, 'editEmployer'])->name('employers.edit');
    Route::put('/employers/{company}', [AdminController::class, 'updateEmployer'])->name('employers.update');
    Route::delete('/employers/{company}', [AdminController::class, 'destroyEmployer'])->name('employers.destroy');
    Route::post('/employers/{company}/approve', [AdminController::class, 'approveEmployer'])->name('employers.approve');
    Route::post('/employers/{company}/suspend', [AdminController::class, 'suspendEmployer'])->name('employers.suspend');
    
    Route::get('/job-seekers', [AdminController::class, 'jobSeekers'])->name('job_seekers');
    Route::get('/job-seekers/{user}', [AdminController::class, 'showJobSeeker'])->name('job_seekers.show');
    Route::post('/job-seekers/{user}/handle-report', [AdminController::class, 'handleReportedJobSeeker'])->name('job_seekers.handle_report');
    
    // Role Management
    Route::get('/roles', [AdminController::class, 'roles'])->name('roles');
    Route::get('/roles/create', [AdminController::class, 'createRole'])->name('roles.create');
    Route::post('/roles', [AdminController::class, 'storeRole'])->name('roles.store');
    Route::get('/roles/{role}/edit', [AdminController::class, 'editRole'])->name('roles.edit');
    Route::put('/roles/{role}', [AdminController::class, 'updateRole'])->name('roles.update');
    Route::delete('/roles/{role}', [AdminController::class, 'destroyRole'])->name('roles.destroy');
    
    // Job Management
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::get('/jobs/{job}', [AdminController::class, 'showJob'])->name('jobs.show');
    Route::post('/jobs/{job}/approve', [AdminController::class, 'approveJob'])->name('jobs.approve');
    Route::post('/jobs/{job}/block', [AdminController::class, 'blockJob'])->name('jobs.block');
    Route::post('/jobs/{job}/feature', [AdminController::class, 'featureJob'])->name('jobs.feature');
    Route::post('/jobs/{job}/unfeature', [AdminController::class, 'unfeatureJob'])->name('jobs.unfeature');
    
    // Category Management
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
    
    // Location Management
    Route::get('/locations', [AdminController::class, 'locations'])->name('locations');
    Route::get('/locations/create', [AdminController::class, 'createLocation'])->name('locations.create');
    Route::post('/locations', [AdminController::class, 'storeLocation'])->name('locations.store');
    Route::get('/locations/{location}/edit', [AdminController::class, 'editLocation'])->name('locations.edit');
    Route::put('/locations/{location}', [AdminController::class, 'updateLocation'])->name('locations.update');
    Route::delete('/locations/{location}', [AdminController::class, 'destroyLocation'])->name('locations.destroy');
    
    // Content Management
    Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
    Route::get('/faqs/create', [AdminController::class, 'createFaq'])->name('faqs.create');
    Route::post('/faqs', [AdminController::class, 'storeFaq'])->name('faqs.store');
    Route::get('/faqs/{faq}/edit', [AdminController::class, 'editFaq'])->name('faqs.edit');
    Route::put('/faqs/{faq}', [AdminController::class, 'updateFaq'])->name('faqs.update');
    Route::delete('/faqs/{faq}', [AdminController::class, 'destroyFaq'])->name('faqs.destroy');
    
    Route::get('/messages', [AdminController::class, 'contactMessages'])->name('messages');
    Route::get('/messages/{message}', [AdminController::class, 'showContactMessage'])->name('messages.show');
    Route::post('/messages/{message}/reply', [AdminController::class, 'replyContactMessage'])->name('messages.reply');
    
    // Analytics
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    
    // Moderation
    Route::get('/reported-content', [AdminController::class, 'reportedContent'])->name('reported_content');
    Route::post('/handle-report', [AdminController::class, 'handleReport'])->name('handle_report');
});

// Job Seeker Routes - accessible to job seekers and admins
Route::prefix('job-seeker')->name('job_seeker.')->middleware(['auth', 'jobseeker'])->group(function () {
    Route::get('/dashboard', [JobSeekersController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/data', [JobSeekersController::class, 'getDashboardData'])->name('dashboard.data');
    Route::post('/notifications/{notification}/read', [JobSeekersController::class, 'markNotificationRead'])->name('notifications.read');
    Route::post('/messages/{message}/read', [JobSeekersController::class, 'markMessageRead'])->name('messages.read');
    
    Route::get('/profile', [JobSeekersController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [JobSeekersController::class, 'editProfileTabs'])->name('profile.edit');
    Route::get('/profile/edit-tabs', [JobSeekersController::class, 'editProfileTabs'])->name('profile.edit.tabs');
    Route::put('/profile', [JobSeekersController::class, 'updateProfileTabs'])->name('profile.update');
    Route::put('/profile/tabs', [JobSeekersController::class, 'updateProfileTabs'])->name('profile.update.tabs');
    
    // Resume Builder Routes
    Route::get('/resume', [JobSeekersController::class, 'showResume'])->name('resume');
    Route::get('/resume/manage', [JobSeekersController::class, 'manageResume'])->name('resume.manage');
    Route::get('/resume/create', [JobSeekersController::class, 'createResume'])->name('resume.create');
    Route::get('/resume/edit', [JobSeekersController::class, 'editResume'])->name('resume.edit');
    Route::post('/resume', [JobSeekersController::class, 'storeResume'])->name('resume.store');
    Route::put('/resume', [JobSeekersController::class, 'updateResume'])->name('resume.update');
    Route::delete('/resume', [JobSeekersController::class, 'destroyResume'])->name('resume.destroy');
    
    // Job Application Routes
    Route::get('/applications', [JobSeekersController::class, 'applications'])->name('applications');
    Route::get('/jobs/{job}/apply', [JobSeekersController::class, 'applyForJob'])->name('jobs.apply');
    Route::post('/jobs/{job}/apply', [JobSeekersController::class, 'submitApplication'])->name('jobs.apply.submit')->middleware('apply.check');
    
    // Test route for debugging
    Route::get('/test-profile-data', [JobSeekersController::class, 'testProfileData'])->name('test.profile.data');
    
    // Resume viewing routes
    Route::get('/resume/view', [JobSeekersController::class, 'viewResume'])->name('resume.view');
    Route::get('/resume/download', [JobSeekersController::class, 'downloadResume'])->name('resume.download');
    Route::get('/resume/serve/{filename}', [JobSeekersController::class, 'serveResume'])->name('resume.serve');
    Route::get('/test-resume-files', [JobSeekersController::class, 'testResumeFiles'])->name('test.resume.files');
    
    // Other job seeker routes
    Route::get('/saved-jobs', [JobSeekersController::class, 'savedJobs'])->name('saved_jobs');
    Route::get('/job-alerts', [JobSeekersController::class, 'jobAlerts'])->name('job_alerts');
});

// Employer Routes - accessible to employers and admins
Route::prefix('employer')->name('employer.')->middleware(['auth', 'employer'])->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');
    Route::get('/jobs', [EmployerController::class, 'jobs'])->name('jobs.index');
    Route::get('/jobs/create', [EmployerController::class, 'createJob'])->name('jobs.create');
    Route::post('/jobs', [EmployerController::class, 'storeJob'])->name('jobs.store')->middleware('post.check');
    Route::get('/jobs/{job}', [EmployerController::class, 'showJob'])->name('jobs.show');
    Route::get('/jobs/{job}/edit', [EmployerController::class, 'editJob'])->name('jobs.edit');
    Route::put('/jobs/{job}', [EmployerController::class, 'updateJob'])->name('jobs.update')->middleware('post.check');
    Route::delete('/jobs/{job}', [EmployerController::class, 'deleteJob'])->name('jobs.destroy')->middleware('post.check');
    Route::get('/jobs/drafts', [EmployerController::class, 'drafts'])->name('jobs.drafts');
    Route::get('/profile', [EmployerController::class, 'profile'])->name('profile');
    
    // Application routes
    Route::get('/applications', [EmployerController::class, 'applications'])->name('applications.index');
    Route::get('/applications/{application}', [EmployerController::class, 'showApplication'])->name('applications.show');
    Route::post('/applications/{application}/status', [EmployerController::class, 'updateStatus'])->name('applications.update.status');
    
    // New application management routes
    Route::get('/applications/{application}/download-cv', [EmployerController::class, 'downloadCV'])->name('applications.download.cv');
    Route::post('/applications/{application}/send-alert', [EmployerController::class, 'sendAlert'])->name('applications.send.alert');
    Route::post('/applications/{application}/send-message', [EmployerController::class, 'sendMessage'])->name('applications.send.message');
    Route::post('/applications/{application}/schedule-interview', [EmployerController::class, 'scheduleInterview'])->name('applications.schedule.interview');
    Route::post('/applications/{application}/add-notes', [EmployerController::class, 'addNotes'])->name('applications.add.notes');
    
    Route::get('/shortlisted', [EmployerController::class, 'shortlisted'])->name('shortlisted');
    
    // Password Management Routes
    Route::get('/password/edit', [EmployerController::class, 'editPassword'])->name('password.edit');
    Route::put('/password', [EmployerController::class, 'updatePassword'])->name('password.update');
    
    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [EmployerController::class, 'userManagement'])->name('index');
        Route::get('/create', [EmployerController::class, 'createUser'])->name('create');
        Route::post('/', [EmployerController::class, 'storeUser'])->name('store');
        Route::get('/{user}', [EmployerController::class, 'showUser'])->name('show');
        Route::get('/{user}/edit', [EmployerController::class, 'editUser'])->name('edit');
        Route::put('/{user}', [EmployerController::class, 'updateUser'])->name('update');
        Route::delete('/{user}', [EmployerController::class, 'deleteUser'])->name('destroy');
        Route::post('/{user}/toggle-status', [EmployerController::class, 'toggleUserStatus'])->name('toggle-status');
    });
    
    // Company Management Routes
    Route::prefix('companies')->name('companies.')->group(function () {
        Route::get('/', [EmployerController::class, 'companies'])->name('index');
        Route::post('/', [EmployerController::class, 'storeCompany'])->name('store');
        Route::get('/{company}/edit', [EmployerController::class, 'editCompany'])->name('edit');
        Route::put('/{company}', [EmployerController::class, 'updateCompany'])->name('update');
        Route::delete('/{company}', [EmployerController::class, 'deleteCompany'])->name('destroy');
    });
    
    // Category Management Routes
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';