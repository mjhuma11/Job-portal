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
    public function index()
    {
        // Fetch active categories for the browse by categories section
        $categories = Category::where('status', '1')
            ->orderBy('name')
            ->get();
        
        // Fetch recent jobs for the browse recent jobs section
        $recentJobs = jobs::with('company')
            ->active()
            ->notExpired()
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        return view('home', compact('categories', 'recentJobs'));
    }
}