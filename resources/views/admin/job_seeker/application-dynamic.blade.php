@extends('layouts.app')

@section('title', 'Apply for ' . $job->job_title . ' - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('job_seeker.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('job_seeker.applications') }}" class="ml-1 text-blue-600 hover:text-blue-800 md:ml-2">Applications</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2">Apply for Job</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Job Application</h1>
            <p class="text-gray-600">Apply for the position: <span class="font-semibold">{{ $job->job_title }}</span></p>
        </div>

        <!-- Job Details Card -->
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $job->job_title }}</h2>
                    <p class="text-gray-600">{{ $job->company->company_name ?? 'Company Name' }} • {{ $job->location ?? 'Location' }}</p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @if($job->job_type)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">{{ ucfirst(str_replace('-', ' ', $job->job_type)) }}</span>
                        @endif
                        @if($job->experience)
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">{{ $job->experience }}</span>
                        @endif
                        @if($job->salary)
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm rounded-full">{{ $job->salary }}</span>
                        @endif
                    </div>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="text-sm text-gray-500">Posted: {{ $job->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Application Form -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <form action="{{ route('job_seeker.application.submit', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Personal Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $jobSeeker->name ?? $user->name) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $jobSeeker->email ?? $user->email) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $jobSeeker->phone ?? '') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Current Location</label>
                            <input type="text" id="location" name="location" value="{{ old('location', $jobSeeker->location_preference ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Professional Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Professional Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="current_position" class="block text-sm font-medium text-gray-700 mb-1">Current Position</label>
                            <input type="text" id="current_position" name="current_position" value="{{ old('current_position', $jobSeeker->current_position ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('current_position')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Years of Experience *</label>
                            <select id="experience" name="experience" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select experience</option>
                                <option value="0-1" {{ old('experience') == '0-1' ? 'selected' : '' }}>0-1 years</option>
                                <option value="1-2" {{ old('experience') == '1-2' ? 'selected' : '' }}>1-2 years</option>
                                <option value="2-5" {{ old('experience') == '2-5' ? 'selected' : '' }}>2-5 years</option>
                                <option value="5-10" {{ old('experience') == '5-10' ? 'selected' : '' }}>5-10 years</option>
                                <option value="10+" {{ old('experience') == '10+' ? 'selected' : '' }}>10+ years</option>
                            </select>
                            @error('experience')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">Key Skills (comma separated)</label>
                            <input type="text" id="skills" name="skills" value="{{ old('skills') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g., Laravel, PHP, MySQL, JavaScript">
                            @error('skills')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Resume and Cover Letter Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Documents</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Resume *</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="resume" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PDF, DOC, DOCX (MAX. 5MB)</p>
                                    </div>
                                    <input id="resume" name="resume" type="file" class="hidden" required />
                                </label>
                            </div>
                            @error('resume')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-1">Cover Letter</label>
                            <textarea id="cover_letter" name="cover_letter" rows="6"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Explain why you're a good fit for this position...">{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Additional Questions -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Additional Questions</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">When can you start? *</label>
                            <select id="availability" name="availability" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select availability</option>
                                <option value="immediately" {{ old('availability') == 'immediately' ? 'selected' : '' }}>Immediately</option>
                                <option value="1-week" {{ old('availability') == '1-week' ? 'selected' : '' }}>Within 1 week</option>
                                <option value="2-weeks" {{ old('availability') == '2-weeks' ? 'selected' : '' }}>Within 2 weeks</option>
                                <option value="1-month" {{ old('availability') == '1-month' ? 'selected' : '' }}>Within 1 month</option>
                                <option value="more" {{ old('availability') == 'more' ? 'selected' : '' }}>More than 1 month</option>
                            </select>
                            @error('availability')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="salary_expectation" class="block text-sm font-medium text-gray-700 mb-1">Salary Expectation (USD)</label>
                            <input type="text" id="salary_expectation" name="salary_expectation" value="{{ old('salary_expectation') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g., 80000">
                            @error('salary_expectation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="hear_about" class="block text-sm font-medium text-gray-700 mb-1">How did you hear about this job?</label>
                            <select id="hear_about" name="hear_about"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select an option</option>
                                <option value="job-board" {{ old('hear_about') == 'job-board' ? 'selected' : '' }}>Job Board</option>
                                <option value="company-website" {{ old('hear_about') == 'company-website' ? 'selected' : '' }}>Company Website</option>
                                <option value="referral" {{ old('hear_about') == 'referral' ? 'selected' : '' }}>Referral</option>
                                <option value="social-media" {{ old('hear_about') == 'social-media' ? 'selected' : '' }}>Social Media</option>
                                <option value="recruiter" {{ old('hear_about') == 'recruiter' ? 'selected' : '' }}>Recruiter</option>
                                <option value="other" {{ old('hear_about') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('hear_about')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Terms and Submit -->
                <div class="mb-6">
                    <div class="flex items-start mb-4">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" {{ old('terms') ? 'checked' : '' }} required
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        </div>
                        <label for="terms" class="ml-2 text-sm text-gray-700">
                            I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a> and 
                            <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>. I also consent to having my information 
                            processed for the purpose of this job application.
                        </label>
                    </div>
                    @error('terms')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex flex-col sm:flex-row sm:justify-end gap-4">
                    <a href="{{ route('job_seeker.applications') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-center">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection