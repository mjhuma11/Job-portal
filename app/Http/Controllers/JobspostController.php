<?php

namespace App\Http\Controllers;

use App\Models\jobs;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JobspostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = jobs::with('company')
            ->active()
            ->notExpired()
            ->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
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

        jobs::create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job posted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(jobs $job): View
    {
        $job->load('company', 'jobApplications', 'jobViews');
        
        // Increment view count
        $job->jobViews()->create([
            'job_id' => $job->id,
            
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'viewed_at' => now(),
        ]);
        
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jobs $job): View
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jobs $job): RedirectResponse
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255|unique:jobs_post,job_title,' . $job->id,
            'category' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'experience' => 'nullable|string|max:255',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'application_deadline' => 'nullable|date',
            'is_featured' => 'boolean',
            'job_type' => 'nullable|in:full-time,part-time,contractor,remote',
            'status' => 'in:open,closed,draft',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jobs $job): RedirectResponse
    {
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
    
    /**
     * Get featured jobs
     */
    public function featured(): JsonResponse
    {
        $jobs = jobs::featured()
            ->active()
            ->notExpired()
            ->with('company')
            ->limit(10)
            ->get();
            
        return response()->json($jobs);
    }
    
    /**
     * Search jobs
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('query');
        $location = $request->get('location');
        $type = $request->get('type');
        
        $jobs = jobs::active()
            ->notExpired()
            ->where('job_title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->when($location, function ($q) use ($location) {
                return $q->byLocation($location);
            })
            ->when($type, function ($q) use ($type) {
                return $q->byType($type);
            })
            ->with('company')
            ->paginate(10);
            
        return response()->json($jobs);
    }
    
    /**
     * Get jobs by company
     */
    public function byCompany($companyId): JsonResponse
    {
        $jobs = jobs::where('company_id', $companyId)
            ->active()
            ->notExpired()
            ->with('company')
            ->get();
            
        return response()->json($jobs);
    }
}
