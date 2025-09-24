<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(): View
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.employers.categories.index', compact('categories'));
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category): View
    {
        return view('admin.employers.categories.show', compact('category'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('admin.employers.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Create categories directory if it doesn't exist
            $destinationPath = public_path('images/categories');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            // Generate unique filename
            $filename = time() . '_' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            
            // Move the file to the destination
            $request->file('image')->move($destinationPath, $filename);
            
            // Store the relative path in the database
            $validated['image'] = '/images/categories/' . $filename;
        }

        $category = Category::create($validated);

        // If this is an AJAX request (from modal), return JSON response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully!',
                'category' => $category
            ]);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        return view('admin.employers.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && File::exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }

            // Create categories directory if it doesn't exist
            $destinationPath = public_path('images/categories');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            // Generate unique filename
            $filename = time() . '_' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            
            // Move the file to the destination
            $request->file('image')->move($destinationPath, $filename);
            
            // Store the relative path in the database
            $validated['image'] = '/images/categories/' . $filename;
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        // Delete image if exists
        if ($category->image && File::exists(public_path($category->image))) {
            File::delete(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
