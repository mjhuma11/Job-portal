@extends('layouts.app')

@section('title', 'Category Details - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        @include('admin.employers.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <span>Employer</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span>Categories</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-blue-600">Details</span>
                </div>
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Category Details</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('employer.categories.index') }}" class="inline-flex items-center bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                        <a href="{{ route('employer.categories.edit', $category) }}" class="inline-flex items-center bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Category
                        </a>
                    </div>
                </div>
            </div>

            <!-- Category Details -->
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Category Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                            <p class="text-gray-900">{{ $category->name }}</p>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                            <p class="text-gray-900">{{ $category->slug }}</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $category->status == '1' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $category->status == '1' ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <!-- Created At -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Created At</label>
                            <p class="text-gray-900">{{ $category->created_at->format('M d, Y H:i') }}</p>
                        </div>

                        <!-- Updated At -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                            <p class="text-gray-900">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                        </div>

                        <!-- Icon -->
                        @if($category->icon)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Icon</label>
                            <div class="flex items-center">
                                <span class="text-teal-600 mr-2">{!! $category->icon !!}</span>
                                <code class="text-sm bg-gray-100 px-2 py-1 rounded">{{ $category->icon }}</code>
                            </div>
                        </div>
                        @endif

                        <!-- Image -->
                        @if($category->image)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Image</label>
                            <div class="mt-1">
                                <img src="{{ $category->image }}" alt="{{ $category->name }}" class="h-16 w-16 object-cover rounded">
                                <p class="text-xs text-gray-500 mt-1 truncate">{{ $category->image }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($category->description)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Description</label>
                        <p class="text-gray-900">{{ $category->description }}</p>
                    </div>
                    @endif

                    <!-- Jobs Count -->
                    <div class="mt-6 pt-6 border-t">
                        <h4 class="text-md font-semibold text-gray-900 mb-3">Related Information</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h5 class="text-sm font-medium text-gray-900">Jobs in this Category</h5>
                                    <p class="text-sm text-gray-500">{{ $category->jobs->count() }} jobs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection