<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\jobs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with dynamically loaded categories and recent jobs.
     */
    public function index(Request $request)
    {
        // Redirect admin users to their dashboard
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        // Fetch active categories with pagination (8 per page)
        $categories = Category::where('status', '1')
            ->orderBy('name')
            ->paginate(8, ['*'], 'categories_page');
        
        // Fetch recent jobs for the browse recent jobs section (only approved jobs)
        $recentJobs = jobs::with('company')
            ->where('status', 'open') // Only show approved jobs
            ->notExpired()
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        return view('home', compact('categories', 'recentJobs'));
    }
}