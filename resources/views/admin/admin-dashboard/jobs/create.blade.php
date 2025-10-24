@extends('layouts.app')

@section('title', 'Add Job Post - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <span>Admin</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span>Job Posts</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-teal-600">Add Job Post</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Add New Job Post</h1>
                <p class="text-gray-600 mt-1">Create a new job posting for the platform</p>
            </div>

            <!-- Job Creation Form -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.jobs.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Job Title -->
                        <div class="lg:col-span-2">
                            <label for="job_title" class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                            <input type="text" name="job_title" id="job_title" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('job_title') border-red-500 @enderror" 
                                   placeholder="e.g. Senior Software Engineer" 
                                   value="{{ old('job_title') }}" required>
                            @error('job_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company -->
                        <div>
                            <label for="company_id" class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                            <select name="company_id" id="company_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('company_id') border-red-500 @enderror" required>
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select name="category_id" id="category_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('category_id') border-red-500 @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location_id" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                            <select name="location_id" id="location_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('location_id') border-red-500 @enderror" required>
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->city }}, {{ $location->state }} {{ $location->country }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Job Type -->
                        <div>
                            <label for="job_type" class="block text-sm font-medium text-gray-700 mb-2">Job Type *</label>
                            <select name="job_type" id="job_type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('job_type') border-red-500 @enderror" required>
                                <option value="">Select Job Type</option>
                                <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                            @error('job_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Experience Level -->
                        <div>
                            <label for="experience_level" class="block text-sm font-medium text-gray-700 mb-2">Experience Level *</label>
                            <select name="experience_level" id="experience_level" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('experience_level') border-red-500 @enderror" required>
                                <option value="">Select Experience Level</option>
                                <option value="entry" {{ old('experience_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                <option value="mid" {{ old('experience_level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                                <option value="senior" {{ old('experience_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                                <option value="executive" {{ old('experience_level') == 'executive' ? 'selected' : '' }}>Executive</option>
                            </select>
                            @error('experience_level')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Salary Range -->
                        <div>
                            <label for="salary_min" class="block text-sm font-medium text-gray-700 mb-2">Minimum Salary</label>
                            <input type="number" name="salary_min" id="salary_min" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('salary_min') border-red-500 @enderror" 
                                   placeholder="e.g. 50000" 
                                   value="{{ old('salary_min') }}">
                            @error('salary_min')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="salary_max" class="block text-sm font-medium text-gray-700 mb-2">Maximum Salary</label>
                            <input type="number" name="salary_max" id="salary_max" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('salary_max') border-red-500 @enderror" 
                                   placeholder="e.g. 80000" 
                                   value="{{ old('salary_max') }}">
                            @error('salary_max')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Salary Type -->
                        <div>
                            <label for="salary_type" class="block text-sm font-medium text-gray-700 mb-2">Salary Type *</label>
                            <select name="salary_type" id="salary_type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('salary_type') border-red-500 @enderror" required>
                                <option value="">Select Salary Type</option>
                                <option value="hourly" {{ old('salary_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                                <option value="monthly" {{ old('salary_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="yearly" {{ old('salary_type') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            </select>
                            @error('salary_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Application Deadline -->
                        <div>
                            <label for="application_deadline" class="block text-sm font-medium text-gray-700 mb-2">Application Deadline</label>
                            <input type="date" name="application_deadline" id="application_deadline" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('application_deadline') border-red-500 @enderror" 
                                   value="{{ old('application_deadline') }}">
                            @error('application_deadline')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Job Description -->
                        <div class="lg:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description *</label>
                            <textarea name="description" id="description" rows="6" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('description') border-red-500 @enderror" 
                                      placeholder="Describe the job role, responsibilities, and what you're looking for..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Requirements -->
                        <div class="lg:col-span-2">
                            <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements *</label>
                            <textarea name="requirements" id="requirements" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('requirements') border-red-500 @enderror" 
                                      placeholder="List the required skills, qualifications, and experience..." required>{{ old('requirements') }}</textarea>
                            @error('requirements')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Benefits -->
                        <div class="lg:col-span-2">
                            <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">Benefits</label>
                            <textarea name="benefits" id="benefits" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('benefits') border-red-500 @enderror" 
                                      placeholder="List the benefits and perks offered...">{{ old('benefits') }}</textarea>
                            @error('benefits')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select name="status" id="status" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('status') border-red-500 @enderror" required>
                                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Approved (Open)</option>
                                <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending Approval</option>
                                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Options -->
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="remote_work" id="remote_work" 
                                       class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded" 
                                       {{ old('remote_work') ? 'checked' : '' }}>
                                <label for="remote_work" class="ml-2 block text-sm text-gray-700">
                                    Remote Work Available
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_featured" id="is_featured" 
                                       class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded" 
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                                    Featured Job Post
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.jobs') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300">
                            Create Job Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection