@extends('layouts.app')

@section('title', 'Edit Employer - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.employers') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Employers
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Edit Employer</h1>
                <p class="text-gray-600 mt-1">Update employer and company information</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <form action="{{ route('admin.employers.update', $company) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">User Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                                    <input type="text" name="name" id="name" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="Enter full name" value="{{ old('name', $company->user->name) }}" required>
                                    @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                                    <input type="email" name="email" id="email" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="Enter email address" value="{{ old('email', $company->user->email) }}" required>
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Company Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                                    <input type="text" name="company_name" id="company_name" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="Enter company name" value="{{ old('company_name', $company->name) }}" required>
                                    @error('company_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="company_email" class="block text-sm font-medium text-gray-700 mb-1">Company Email</label>
                                    <input type="email" name="company_email" id="company_email" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="Enter company email" value="{{ old('company_email', $company->email) }}">
                                </div>
                                
                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                                    <input type="text" name="industry" id="industry" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="Enter industry" value="{{ old('industry', $company->industry) }}">
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" name="verified" id="verified" 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                           {{ old('verified', $company->verified) ? 'checked' : '' }}>
                                    <label for="verified" class="ml-2 block text-sm text-gray-700">
                                        Verified Company
                                    </label>
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" name="featured" id="featured" 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                           {{ old('featured', $company->featured) ? 'checked' : '' }}>
                                    <label for="featured" class="ml-2 block text-sm text-gray-700">
                                        Featured Company
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.employers') }}" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                            Update Employer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection