<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobSeekersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', [HomeController::class, 'index'])->name('home');

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

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('admin');

// Job Seeker Routes - accessible to job seekers and admins
Route::prefix('job-seeker')->name('job_seeker.')->middleware(['auth', 'jobseeker'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.job_seeker.dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [JobSeekersController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [JobSeekersController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [JobSeekersController::class, 'updateProfile'])->name('profile.update');
    
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