@extends('layouts.app')

@section('title', 'Add New Role - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.roles') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Roles
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Add New Role</h1>
                <p class="text-gray-600 mt-1">Create a new user role with custom permissions</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Role Name *</label>
                            <input type="text" name="name" id="name" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Enter role name" value="{{ old('name') }}" required>
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                      placeholder="Enter role description">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Permissions Section -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Permissions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-2">User Management</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="view_users" value="view_users" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="view_users" class="ml-2 block text-sm text-gray-700">
                                                View Users
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="edit_users" value="edit_users" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="edit_users" class="ml-2 block text-sm text-gray-700">
                                                Edit Users
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="delete_users" value="delete_users" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="delete_users" class="ml-2 block text-sm text-gray-700">
                                                Delete Users
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-2">Content Management</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="view_content" value="view_content" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="view_content" class="ml-2 block text-sm text-gray-700">
                                                View Content
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="edit_content" value="edit_content" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="edit_content" class="ml-2 block text-sm text-gray-700">
                                                Edit Content
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="delete_content" value="delete_content" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="delete_content" class="ml-2 block text-sm text-gray-700">
                                                Delete Content
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-2">Job Management</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="view_jobs" value="view_jobs" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="view_jobs" class="ml-2 block text-sm text-gray-700">
                                                View Jobs
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="approve_jobs" value="approve_jobs" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="approve_jobs" class="ml-2 block text-sm text-gray-700">
                                                Approve Jobs
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="delete_jobs" value="delete_jobs" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="delete_jobs" class="ml-2 block text-sm text-gray-700">
                                                Delete Jobs
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-2">Reports & Analytics</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="view_reports" value="view_reports" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="view_reports" class="ml-2 block text-sm text-gray-700">
                                                View Reports
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" id="export_reports" value="export_reports" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="export_reports" class="ml-2 block text-sm text-gray-700">
                                                Export Reports
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.roles') }}" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                            Create Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection