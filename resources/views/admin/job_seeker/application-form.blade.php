@extends('layouts.app')

@section('title', 'Job Application Form - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 mb-6">
            <a href="{{ route('job_seeker.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Job Application</span>
        </nav>

        <!-- Application Form -->
        <div class="bg-white rounded-lg shadow-sm border">
            <div class="px-6 py-4 border-b">
                <h1 class="text-2xl font-bold text-gray-900">Job Application Form</h1>
                <p class="text-gray-600 mt-1">Apply for the position you're interested in</p>
            </div>

            <form action="{{ route('job_seeker.applications.submit') }}" method="POST" class="p-6" enctype="multipart/form-data">
                @csrf
                
                <!-- Job Information -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Job Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="job_title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                            <input type="text" id="job_title" name="job_title" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                            <input type="text" id="company_name" name="company_name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
                
                <!-- Personal Information -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="full_name" name="full_name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" id="location" name="location" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
                
                <!-- Professional Information -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Professional Information</h2>
                    <div class="space-y-6">
                        <div>
                            <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-1">Cover Letter</label>
                            <textarea id="cover_letter" name="cover_letter" rows="5" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Explain why you're a good fit for this position..."></textarea>
                        </div>
                        
                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label>
                            <select id="experience" name="experience" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select experience level</option>
                                <option value="0-1">0-1 years</option>
                                <option value="1-3">1-3 years</option>
                                <option value="3-5">3-5 years</option>
                                <option value="5-10">5-10 years</option>
                                <option value="10+">10+ years</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">Relevant Skills</label>
                            <input type="text" id="skills" name="skills" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g., PHP, Laravel, JavaScript, MySQL">
                        </div>
                    </div>
                </div>
                
                <!-- Resume Upload -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Resume/CV</h2>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="resume" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                <span>Upload a file</span>
                                <input id="resume" name="resume" type="file" class="sr-only" accept=".pdf,.doc,.docx,.txt">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 5MB</p>
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h2>
                    <div class="space-y-6">
                        <div>
                            <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">Availability</label>
                            <select id="availability" name="availability" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select your availability</option>
                                <option value="immediate">Immediate</option>
                                <option value="2-weeks">2 Weeks Notice</option>
                                <option value="1-month">1 Month Notice</option>
                                <option value="negotiable">Negotiable</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="salary_expectation" class="block text-sm font-medium text-gray-700 mb-1">Salary Expectation (Optional)</label>
                            <input type="text" id="salary_expectation" name="salary_expectation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g., $50,000 - $60,000">
                        </div>
                        
                        <div>
                            <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn Profile (Optional)</label>
                            <input type="url" id="linkedin" name="linkedin"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://linkedin.com/in/yourprofile">
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('job_seeker.dashboard') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection