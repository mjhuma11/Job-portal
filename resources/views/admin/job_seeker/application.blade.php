@extends('layouts.app')

@section('title', 'Job Application - CareerBridge')

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
                        <span class="ml-1 text-gray-500 md:ml-2">Applications</span>
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
            <p class="text-gray-600">Fill out the form below to apply for this position</p>
        </div>

        <!-- Job Details Card -->
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $job->title }}</h2>
                    <p class="text-gray-600">{{ $job->company->name ?? 'Company' }} • {{ $job->location }}</p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">{{ ucfirst(str_replace('_', '-', $job->job_type)) }}</span>
                        @if($job->experience_required)
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">{{ $job->experience_required }}</span>
                        @endif
                        @if($job->salary_min && $job->salary_max)
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm rounded-full">${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}</span>
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
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('job_seeker.jobs.apply.submit', $job) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Personal Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" required
                                value="{{ old('full_name', $jobSeeker->name ?? $user->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                value="{{ old('email', $jobSeeker->email ?? $user->email) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required
                                value="{{ old('phone', $jobSeeker->phone ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Current Location</label>
                            <input type="text" id="location" name="location"
                                value="{{ old('location', $jobSeeker->location_preference ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
                
                <!-- Professional Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Professional Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="current_position" class="block text-sm font-medium text-gray-700 mb-1">Current Position</label>
                            <input type="text" id="current_position" name="current_position"
                                value="{{ old('current_position', $jobSeeker->current_position ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">Key Skills (comma separated)</label>
                            <input type="text" id="skills" name="skills"
                                value="{{ old('skills') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g., Laravel, PHP, MySQL, JavaScript">
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
                        </div>
                        
                        <div>
                            <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-1">Cover Letter</label>
                            <textarea id="cover_letter" name="cover_letter" rows="6"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Explain why you're a good fit for this position...">{{ old('cover_letter') }}</textarea>
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
                                <option value="immediately" {{ old('availability', $jobSeeker->availability_status ?? '') == 'immediately' ? 'selected' : '' }}>Immediately</option>
                                <option value="1-week" {{ old('availability') == '1-week' ? 'selected' : '' }}>Within 1 week</option>
                                <option value="2-weeks" {{ old('availability') == '2-weeks' ? 'selected' : '' }}>Within 2 weeks</option>
                                <option value="1-month" {{ old('availability', $jobSeeker->availability_status ?? '') == 'within_month' ? 'selected' : '' }}>Within 1 month</option>
                                <option value="more" {{ old('availability') == 'more' ? 'selected' : '' }}>More than 1 month</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="salary_expectation" class="block text-sm font-medium text-gray-700 mb-1">Salary Expectation (USD)</label>
                            <input type="text" id="salary_expectation" name="salary_expectation"
                                value="{{ old('salary_expectation', $jobSeeker->expected_salary_min ? number_format($jobSeeker->expected_salary_min) . ' - ' . number_format($jobSeeker->expected_salary_max) : '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g., 80000">
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
                        </div>
                    </div>
                </div>
                
                <!-- Terms and Submit -->
                <div class="mb-6">
                    <div class="flex items-start mb-4">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        </div>
                        <label for="terms" class="ml-2 text-sm text-gray-700">
                            I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a> and 
                            <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>. I also consent to having my information 
                            processed for the purpose of this job application.
                        </label>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:justify-end gap-4">
                    <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Save as Draft
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" id="submitBtn">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload preview
    const resumeInput = document.getElementById('resume');
    const resumeLabel = resumeInput.closest('label');
    
    resumeInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileName = file.name;
            const fileSize = (file.size / 1024 / 1024).toFixed(2); // Convert to MB
            
            // Update the label to show selected file
            resumeLabel.innerHTML = `
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="mb-2 text-sm text-gray-700"><span class="font-semibold">Selected:</span> ${fileName}</p>
                    <p class="text-xs text-gray-500">Size: ${fileSize} MB</p>
                    <p class="text-xs text-blue-600 mt-2">Click to change file</p>
                </div>
            `;
        }
    });
    
    // Form submission handling
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Submitting...
        `;
    });
    
    // Auto-save form data to localStorage (optional)
    const formInputs = form.querySelectorAll('input, textarea, select');
    formInputs.forEach(input => {
        // Load saved data
        const savedValue = localStorage.getItem(`job_application_${input.name}`);
        if (savedValue && input.type !== 'file' && input.type !== 'checkbox') {
            input.value = savedValue;
        }
        
        // Save data on change
        input.addEventListener('change', function() {
            if (input.type !== 'file') {
                localStorage.setItem(`job_application_${input.name}`, input.value);
            }
        });
    });
    
    // Clear saved data on successful submission
    form.addEventListener('submit', function() {
        setTimeout(() => {
            formInputs.forEach(input => {
                localStorage.removeItem(`job_application_${input.name}`);
            });
        }, 1000);
    });
});
</script>
@endsection