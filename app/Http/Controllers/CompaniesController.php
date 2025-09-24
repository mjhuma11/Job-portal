<?php

namespace App\Http\Controllers;

use App\Models\companies;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companies = companies::with('user')->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255|unique:companies',
            'logo' => 'required|string|max:255',
            'description' => 'required|string',
            'industry' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'phone' => 'nullable|string|max:20',
            'founded_year' => 'nullable|string|max:4',
            'featured' => 'boolean',
            'verified' => 'nullable|string',
        ]);

        companies::create($validated);

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(companies $company): View
    {
        $company->load('user', 'jobs');
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(companies $company): View
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, companies $company): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'logo' => 'required|string|max:255',
            'description' => 'required|string',
            'industry' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'phone' => 'nullable|string|max:20',
            'founded_year' => 'nullable|string|max:4',
            'featured' => 'boolean',
            'verified' => 'nullable|string',
        ]);

        $company->update($validated);

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(companies $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
    
    /**
     * Get featured companies for API
     */
    public function featured(): JsonResponse
    {
        $companies = companies::where('featured', true)
            ->with('user')
            ->limit(10)
            ->get();
            
        return response()->json($companies);
    }
    
    /**
     * Search companies
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('query');
        
        $companies = companies::where('name', 'LIKE', "%{$query}%")
            ->orWhere('industry', 'LIKE', "%{$query}%")
            ->with('user')
            ->limit(10)
            ->get();
            
        return response()->json($companies);
    }
}
