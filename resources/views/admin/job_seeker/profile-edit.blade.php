@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        <!-- Include Sidebar -->
        @include('admin.job_seeker.partials.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Profile</h1>
                        <p class="text-gray-600 mt-1">Manage your personal information and preferences</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('job_seeker.profile') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Profile
                        </a>
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Preview
                        </button>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <form action="{{ route('job_seeker.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Basic Information Card -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                        <p class="text-sm text-gray-500">Update your personal and contact details</p>
                    </div>
                    <div class="px-6 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Current Position -->
                            <div>
                                <label for="current_position" class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Position
                                </label>
                                <input type="text" 
                                       id="current_position" 
                                       name="current_position" 
                                       value="{{ old('current_position', $jobSeeker->current_position ?? '') }}"
                                       maxlength="150"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                       placeholder="e.g., Senior Software Developer">
                                @error('current_position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Experience Years -->
                            <div>
                                <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">
                                    Years of Experience
                                </label>
                                <select id="experience_years" 
                                        name="experience_years" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                                    @for($i = 0; $i <= 20; $i++)
                                        <option value="{{ $i }}" 
                                                {{ old('experience_years', $jobSeeker->experience_years ?? 0) == $i ? 'selected' : '' }}>
                                            {{ $i == 0 ? 'Fresh Graduate' : ($i == 1 ? '1 Year' : $i . ' Years') }}
                                        </option>
                                    @endfor
                                    <option value="21" {{ old('experience_years', $jobSeeker->experience_years ?? 0) > 20 ? 'selected' : '' }}>
                                        20+ Years
                                    </option>
                                </select>
                                @error('experience_years')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Location Preference -->
                            <div>
                                <label for="location_preference" class="block text-sm font-medium text-gray-700 mb-2">
                                    Location Preference
                                </label>
                                <input type="text" 
                                       id="location_preference" 
                                       name="location_preference" 
                                       value="{{ old('location_preference', $jobSeeker->location_preference ?? '') }}"
                                       maxlength="100"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                       placeholder="e.g., Dhaka, Bangladesh">
                                @error('location_preference')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Availability Status -->
                            <div>
                                <label for="availability_status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Availability Status
                                </label>
                                <select id="availability_status" 
                                        name="availability_status" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                                    <option value="immediately" 
                                            {{ old('availability_status', $jobSeeker->availability_status ?? 'immediately') == 'immediately' ? 'selected' : '' }}>
                                        Available Immediately
                                    </option>
                                    <option value="within_month" 
                                            {{ old('availability_status', $jobSeeker->availability_status ?? '') == 'within_month' ? 'selected' : '' }}>
                                        Within 1 Month
                                    </option>
                                    <option value="within_3_months" 
                                            {{ old('availability_status', $jobSeeker->availability_status ?? '') == 'within_3_months' ? 'selected' : '' }}>
                                        Within 3 Months
                                    </option>
                                    <option value="not_looking" 
                                            {{ old('availability_status', $jobSeeker->availability_status ?? '') == 'not_looking' ? 'selected' : '' }}>
                                        Not Looking Currently
                                    </option>
                                </select>
                                @error('availability_status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remote Preference -->
                            <div class="md:col-span-2">
                                <div class="flex items-center">
                                    <input type="hidden" name="remote_preference" value="0">
                                    <input type="checkbox" 
                                           id="remote_preference" 
                                           name="remote_preference" 
                                           value="1"
                                           {{ old('remote_preference', $jobSeeker->remote_preference ?? false) ? 'checked' : '' }}
                                           class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                                    <label for="remote_preference" class="ml-2 block text-sm text-gray-700">
                                        I'm open to remote work opportunities
                                    </label>
                                </div>
                                @error('remote_preference')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Details Card -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Professional Details</h3>
                        <p class="text-sm text-gray-500">Share your professional background and expectations</p>
                    </div>
                    <div class="px-6 py-6">
                        <div class="space-y-6">
                            <!-- Bio -->
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                                    Professional Bio
                                </label>
                                <textarea id="bio" 
                                          name="bio" 
                                          rows="4" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                          placeholder="Tell us about your professional background, skills, and career goals...">{{ old('bio', $jobSeeker->bio ?? '') }}</textarea>
                                @error('bio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expected Salary Range -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="expected_salary_min" class="block text-sm font-medium text-gray-700 mb-2">
                                        Expected Salary (Min) - BDT
                                    </label>
                                    <input type="number" 
                                           id="expected_salary_min" 
                                           name="expected_salary_min" 
                                           value="{{ old('expected_salary_min', $jobSeeker->expected_salary_min ?? '') }}"
                                           min="0"
                                           step="1000"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                           placeholder="e.g., 50000">
                                    @error('expected_salary_min')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="expected_salary_max" class="block text-sm font-medium text-gray-700 mb-2">
                                        Expected Salary (Max) - BDT
                                    </label>
                                    <input type="number" 
                                           id="expected_salary_max" 
                                           name="expected_salary_max" 
                                           value="{{ old('expected_salary_max', $jobSeeker->expected_salary_max ?? '') }}"
                                           min="0"
                                           step="1000"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                           placeholder="e.g., 80000">
                                    @error('expected_salary_max')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Resume Upload -->
                            <div>
                                <label for="resume_file" class="block text-sm font-medium text-gray-700 mb-2">
                                    Resume/CV
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="resume_file" class="relative cursor-pointer bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500">
                                                <span>Upload a file</span>
                                                <input id="resume_file" name="resume_file" type="file" accept=".pdf,.doc,.docx" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 10MB</p>
                                        @if(isset($jobSeeker->resume_file) && $jobSeeker->resume_file)
                                            <p class="text-sm text-green-600 mt-2">
                                                Current file: {{ $jobSeeker->resume_file }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @error('resume_file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Links Card -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Social & Professional Links</h3>
                        <p class="text-sm text-gray-500">Add links to your professional profiles</p>
                    </div>
                    <div class="px-6 py-6">
                        <div class="space-y-6">
                            <!-- LinkedIn URL -->
                            <div>
                                <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    LinkedIn Profile
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="url" 
                                           id="linkedin_url" 
                                           name="linkedin_url" 
                                           value="{{ old('linkedin_url', $jobSeeker->linkedin_url ?? '') }}"
                                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                           placeholder="https://linkedin.com/in/yourprofile">
                                </div>
                                @error('linkedin_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Portfolio URL -->
                            <div>
                                <label for="portfolio_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    Portfolio Website
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9a9 9 0 01-9-9m9 0a9 9 0 00-9 9"></path>
                                        </svg>
                                    </div>
                                    <input type="url" 
                                           id="portfolio_url" 
                                           name="portfolio_url" 
                                           value="{{ old('portfolio_url', $jobSeeker->portfolio_url ?? '') }}"
                                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                           placeholder="https://yourportfolio.com">
                                </div>
                                @error('portfolio_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- GitHub URL -->
                            <div>
                                <label for="github_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    GitHub Profile
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="url" 
                                           id="github_url" 
                                           name="github_url" 
                                           value="{{ old('github_url', $jobSeeker->github_url ?? '') }}"
                                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                           placeholder="https://github.com/yourusername">
                                </div>
                                @error('github_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// File upload preview
document.getElementById('resume_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const fileName = file.name;
        const fileSize = (file.size / 1024 / 1024).toFixed(2); // Convert to MB
        
        // Find the upload area and update it
        const uploadArea = e.target.closest('.border-dashed');
        const textArea = uploadArea.querySelector('.space-y-1');
        
        if (fileSize <= 10) { // Check file size limit
            textArea.innerHTML = `
                <svg class="mx-auto h-12 w-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm text-gray-600">
                    <span class="font-medium text-teal-600">${fileName}</span>
                    <p class="text-gray-500">${fileSize} MB</p>
                </div>
            `;
        } else {
            alert('File size must be less than 10MB');
            e.target.value = '';
        }
    }
});

// Salary validation
document.getElementById('expected_salary_min').addEventListener('input', function() {
    const min = parseFloat(this.value);
    const maxField = document.getElementById('expected_salary_max');
    const max = parseFloat(maxField.value);
    
    if (min && max && min > max) {
        maxField.value = min;
    }
});

document.getElementById('expected_salary_max').addEventListener('input', function() {
    const max = parseFloat(this.value);
    const minField = document.getElementById('expected_salary_min');
    const min = parseFloat(minField.value);
    
    if (min && max && max < min) {
        this.value = min;
    }
});
</script>
@endsection