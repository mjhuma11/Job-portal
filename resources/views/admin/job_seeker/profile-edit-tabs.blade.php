@extends('layouts.app')

@section('title', 'Edit Profile - CareerBridge')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile-tabs.css') }}">
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Your Profile</h1>
            <p class="text-gray-600">Complete your profile to get better job recommendations</p>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-lg shadow-sm border mb-6">
            <div class="flex overflow-x-auto">
                <button class="tab-btn active flex-1 px-6 py-4 text-sm font-medium border-b-2 border-blue-500 text-blue-600 whitespace-nowrap" data-tab="basic">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Basic Information
                </button>
                <button class="tab-btn flex-1 px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 whitespace-nowrap" data-tab="education">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                    Education
                </button>
                <button class="tab-btn flex-1 px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 whitespace-nowrap" data-tab="skills">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    Skills
                </button>
                <button class="tab-btn flex-1 px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 whitespace-nowrap" data-tab="experience">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                    Experience
                </button>
                <button class="tab-btn flex-1 px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 whitespace-nowrap" data-tab="projects">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Projects
                </button>
            </div>
        </div>



        <!-- Form Container -->
        <form id="profileForm" method="POST" action="{{ route('job_seeker.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')           
 <!-- Tab Content Container -->
            <div class="bg-white rounded-lg shadow-sm border p-6">
                
                <!-- Basic Information Tab -->
                <div id="basic-tab" class="tab-content active">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Basic Information</h3>
                    
                    <!-- Profile Image -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img id="profile-preview" class="h-16 w-16 object-cover rounded-full" 
                                     src="{{ ($jobSeeker && $jobSeeker->profile_image) ? asset('storage/' . $jobSeeker->profile_image) : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjRTVFN0VCIi8+CjxwYXRoIGQ9Ik0zMiAzMkMzNi40MTgzIDMyIDQwIDI4LjQxODMgNDAgMjRDNDAgMTkuNTgxNyAzNi40MTgzIDE2IDMyIDE2QzI3LjU4MTcgMTYgMjQgMTkuNTgxNyAyNCAyNEMyNCAyOC40MTgzIDI3LjU4MTcgMzIgMzIgMzJaIiBmaWxsPSIjOUNBM0FGIi8+CjxwYXRoIGQ9Ik0xNiA1NkMxNiA0OC4yNjggMjMuMjY4IDQyIDMyIDQyQzQwLjczMiA0MiA0OCA0OC4yNjggNDggNTZIMTZaIiBmaWxsPSIjOUNBM0FGIi8+Cjwvc3ZnPgo=' }}" 
                                     alt="Profile preview">
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" id="profile_image" name="profile_image" accept="image/*" 
                                       class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" required
                                   value="{{ old('full_name', ($jobSeeker && $jobSeeker->name ? $jobSeeker->name : $user->name)) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="male" {{ old('gender', ($jobSeeker->gender ?? '')) == 'male' ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Male</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="female" {{ old('gender', ($jobSeeker->gender ?? '')) == 'female' ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Female</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="other" {{ old('gender', ($jobSeeker->gender ?? '')) == 'other' ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Other</span>
                                </label>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   value="{{ old('email', ($jobSeeker && $jobSeeker->email ? $jobSeeker->email : $user->email)) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required
                                   value="{{ old('phone', ($jobSeeker && $jobSeeker->phone ? $jobSeeker->phone : '')) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth"
                                   value="{{ old('date_of_birth', ($jobSeeker && $jobSeeker->date_of_birth ? $jobSeeker->date_of_birth->format('Y-m-d') : '')) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mt-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea id="address" name="address" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('address', ($jobSeeker->address ?? '')) }}</textarea>
                    </div>

                    <!-- Social Media Links -->
                    <div class="mt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Social Media Links</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                                <input type="url" id="linkedin_url" name="linkedin_url"
                                       value="{{ old('linkedin_url', ($jobSeeker->linkedin_url ?? '')) }}"
                                       placeholder="https://linkedin.com/in/yourprofile"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="github_url" class="block text-sm font-medium text-gray-700 mb-1">GitHub</label>
                                <input type="url" id="github_url" name="github_url"
                                       value="{{ old('github_url', ($jobSeeker->github_url ?? '')) }}"
                                       placeholder="https://github.com/yourusername"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="portfolio_url" class="block text-sm font-medium text-gray-700 mb-1">Portfolio</label>
                                <input type="url" id="portfolio_url" name="portfolio_url"
                                       value="{{ old('portfolio_url', ($jobSeeker->portfolio_url ?? '')) }}"
                                       placeholder="https://yourportfolio.com"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                                <input type="url" id="twitter_url" name="twitter_url"
                                       value="{{ old('twitter_url', ($jobSeeker->twitter_url ?? '')) }}"
                                       placeholder="https://twitter.com/yourusername"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Resume Upload -->
                    <div class="mt-6">
                        <label for="resume_file" class="block text-sm font-medium text-gray-700 mb-2">Resume File (PDF/DOC)</label>
                        
                        @if($jobSeeker && $jobSeeker->resume_file)
                            <!-- Current Resume Display -->
                            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-blue-900">Current Resume</p>
                                            <p class="text-xs text-blue-700">{{ basename($jobSeeker->resume_file) }}</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ asset('storage/' . $jobSeeker->resume_file) }}" target="_blank" 
                                           class="inline-flex items-center px-3 py-1 border border-blue-300 text-xs font-medium rounded text-blue-700 bg-white hover:bg-blue-50">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>
                                        <a href="{{ asset('storage/' . $jobSeeker->resume_file) }}" download 
                                           class="inline-flex items-center px-3 py-1 border border-green-300 text-xs font-medium rounded text-green-700 bg-white hover:bg-green-50">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Upload New Resume -->
                        <div class="flex items-center justify-center w-full">
                            <label for="resume_file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200" id="resume-upload-area">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-content">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">{{ $jobSeeker && $jobSeeker->resume_file ? 'Upload new resume' : 'Click to upload' }}</span> 
                                        or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PDF, DOC, DOCX (MAX. 5MB)</p>
                                </div>
                                <input id="resume_file" name="resume_file" type="file" class="hidden" accept=".pdf,.doc,.docx" />
                            </label>
                        </div>
                        
                        <!-- File Preview -->
                        <div id="file-preview" class="mt-3 hidden">
                            <div class="flex items-center p-3 bg-green-50 border border-green-200 rounded-lg">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span id="file-name" class="text-sm text-green-800 font-medium"></span>
                                <button type="button" id="remove-file" class="ml-auto text-green-600 hover:text-green-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-end mt-8">
                        <button type="button" class="next-btn px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-next="education">
                            Save & Next
                            <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>  
              <!-- Education Tab -->
                <div id="education-tab" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Education</h3>
                    
                    <!-- SSC -->
                    <div class="education-level mb-8" data-level="ssc">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-medium text-gray-900">SSC (Secondary School Certificate)</h4>
                            <label class="flex items-center">
                                <input type="checkbox" class="education-toggle mr-2" data-level="ssc">
                                <span class="text-sm text-gray-600">Add SSC</span>
                            </label>
                        </div>
                        <div class="education-fields hidden grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">School/Board</label>
                                <input type="text" name="ssc_institution" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
                                <input type="number" name="ssc_year" min="1980" max="2030" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">GPA/Grade</label>
                                <input type="text" name="ssc_grade" placeholder="e.g., 4.5 or A+" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- HSC -->
                    <div class="education-level mb-8" data-level="hsc">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-medium text-gray-900">HSC (Higher Secondary Certificate)</h4>
                            <label class="flex items-center">
                                <input type="checkbox" class="education-toggle mr-2" data-level="hsc">
                                <span class="text-sm text-gray-600">Add HSC</span>
                            </label>
                        </div>
                        <div class="education-fields hidden grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">College/Board</label>
                                <input type="text" name="hsc_institution" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
                                <input type="number" name="hsc_year" min="1980" max="2030" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">GPA/Grade</label>
                                <input type="text" name="hsc_grade" placeholder="e.g., 4.5 or A+" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Graduation -->
                    <div class="education-level mb-8" data-level="graduation">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-medium text-gray-900">Graduation (Bachelor's Degree)</h4>
                            <label class="flex items-center">
                                <input type="checkbox" class="education-toggle mr-2" data-level="graduation">
                                <span class="text-sm text-gray-600">Add Graduation</span>
                            </label>
                        </div>
                        <div class="education-fields hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">University/Institution</label>
                                <input type="text" name="graduation_institution" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
                                <input type="number" name="graduation_year" min="1980" max="2030" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CGPA/Grade</label>
                                <input type="text" name="graduation_grade" placeholder="e.g., 3.5 or First Class" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Major/Subject</label>
                                <input type="text" name="graduation_major" placeholder="e.g., Computer Science" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Masters -->
                    <div class="education-level mb-8" data-level="masters">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-medium text-gray-900">Master's Degree</h4>
                            <label class="flex items-center">
                                <input type="checkbox" class="education-toggle mr-2" data-level="masters">
                                <span class="text-sm text-gray-600">Add Master's</span>
                            </label>
                        </div>
                        <div class="education-fields hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">University/Institution</label>
                                <input type="text" name="masters_institution" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
                                <input type="number" name="masters_year" min="1980" max="2030" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CGPA/Grade</label>
                                <input type="text" name="masters_grade" placeholder="e.g., 3.8 or First Class" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Major/Subject</label>
                                <input type="text" name="masters_major" placeholder="e.g., Software Engineering" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" class="prev-btn px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors" data-prev="basic">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </button>
                        <button type="button" class="next-btn px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-next="skills">
                            Save & Next
                            <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div> 
               <!-- Skills Tab -->
                <div id="skills-tab" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Skills</h3>
                    
                    <div id="skills-container">
                        <!-- Skills will be dynamically added here -->
                    </div>

                    <!-- Add Skill Button -->
                    <button type="button" id="add-skill-btn" class="mb-6 px-4 py-2 border-2 border-dashed border-gray-300 text-gray-600 rounded-lg hover:border-blue-500 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Skill
                    </button>

                    <!-- Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" class="prev-btn px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors" data-prev="education">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </button>
                        <button type="button" class="next-btn px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-next="experience">
                            Save & Next
                            <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Experience Tab -->
                <div id="experience-tab" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Work Experience</h3>
                    
                    <div id="experience-container">
                        <!-- Experience entries will be dynamically added here -->
                    </div>

                    <!-- Add Experience Button -->
                    <button type="button" id="add-experience-btn" class="mb-6 px-4 py-2 border-2 border-dashed border-gray-300 text-gray-600 rounded-lg hover:border-blue-500 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Experience
                    </button>

                    <!-- Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" class="prev-btn px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors" data-prev="skills">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </button>
                        <button type="button" class="next-btn px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-next="projects">
                            Save & Next
                            <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Projects Tab -->
                <div id="projects-tab" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Projects</h3>
                    
                    <div id="projects-container">
                        <!-- Project entries will be dynamically added here -->
                    </div>

                    <!-- Add Project Button -->
                    <button type="button" id="add-project-btn" class="mb-6 px-4 py-2 border-2 border-dashed border-gray-300 text-gray-600 rounded-lg hover:border-blue-500 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Project
                    </button>

                    <!-- Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" class="prev-btn px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors" data-prev="experience">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </button>
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Profile
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div><!
-- JavaScript for Tab Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let skillCounter = 0;
    let experienceCounter = 0;
    let projectCounter = 0;

    // Tab Navigation
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    const nextBtns = document.querySelectorAll('.next-btn');
    const prevBtns = document.querySelectorAll('.prev-btn');

    // Tab switching function
    function switchTab(targetTab) {
        // Update tab buttons
        tabBtns.forEach(btn => {
            btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        
        // Update tab contents
        tabContents.forEach(content => {
            content.classList.add('hidden');
            content.classList.remove('active');
        });

        // Activate target tab
        const targetBtn = document.querySelector(`[data-tab="${targetTab}"]`);
        const targetContent = document.getElementById(`${targetTab}-tab`);
        
        if (targetBtn && targetContent) {
            targetBtn.classList.add('active', 'border-blue-500', 'text-blue-600');
            targetBtn.classList.remove('border-transparent', 'text-gray-500');
            targetContent.classList.remove('hidden');
            targetContent.classList.add('active');
        }
    }

    // Tab button click handlers
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            switchTab(targetTab);
        });
    });

    // Next button handlers
    nextBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const currentTab = this.closest('.tab-content').id.replace('-tab', '');
            const nextTab = this.getAttribute('data-next');
            
            // Validate current tab before proceeding
            if (validateTab(currentTab)) {
                saveTabData(currentTab);
                switchTab(nextTab);
            }
        });
    });

    // Previous button handlers
    prevBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const prevTab = this.getAttribute('data-prev');
            switchTab(prevTab);
        });
    });

    // Tab validation function
    function validateTab(tabName) {
        const tabContent = document.getElementById(`${tabName}-tab`);
        const requiredFields = tabContent.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        // Special validation for date fields
        const dateFields = tabContent.querySelectorAll('input[type="date"]');
        dateFields.forEach(field => {
            if (field.value && !isValidDate(field.value)) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            alert('Please fill in all required fields correctly before proceeding.');
        }

        return isValid;
    }

    // Date validation helper
    function isValidDate(dateString) {
        if (!dateString) return true; // Empty dates are allowed
        const date = new Date(dateString);
        return date instanceof Date && !isNaN(date);
    }

    // Save tab data function (for AJAX if needed)
    function saveTabData(tabName) {
        // This can be extended to save data via AJAX
        console.log(`Saving data for ${tabName} tab`);
    }

    // Education level toggle functionality
    const educationToggles = document.querySelectorAll('.education-toggle');
    educationToggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const level = this.getAttribute('data-level');
            const fields = this.closest('.education-level').querySelector('.education-fields');
            
            if (this.checked) {
                fields.classList.remove('hidden');
                fields.classList.add('grid');
            } else {
                fields.classList.add('hidden');
                fields.classList.remove('grid');
                // Clear fields when hiding
                fields.querySelectorAll('input').forEach(input => input.value = '');
            }
        });
    });

    // Profile image preview
    const profileImageInput = document.getElementById('profile_image');
    const profilePreview = document.getElementById('profile-preview');
    
    profileImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Resume file upload handling
    const resumeFileInput = document.getElementById('resume_file');
    const resumeUploadArea = document.getElementById('resume-upload-area');
    const filePreview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    const removeFileBtn = document.getElementById('remove-file');
    const uploadContent = document.getElementById('upload-content');

    // Handle file selection
    resumeFileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file type
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please select a valid file type (PDF, DOC, DOCX)');
                this.value = '';
                return;
            }

            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB');
                this.value = '';
                return;
            }

            // Show file preview
            fileName.textContent = file.name;
            filePreview.classList.remove('hidden');
            
            // Update upload area appearance
            resumeUploadArea.classList.add('border-green-300', 'bg-green-50');
            resumeUploadArea.classList.remove('border-gray-300', 'bg-gray-50');
        }
    });

    // Handle file removal
    if (removeFileBtn) {
        removeFileBtn.addEventListener('click', function() {
            resumeFileInput.value = '';
            filePreview.classList.add('hidden');
            resumeUploadArea.classList.remove('border-green-300', 'bg-green-50');
            resumeUploadArea.classList.add('border-gray-300', 'bg-gray-50');
        });
    }

    // Drag and drop functionality
    resumeUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-blue-400', 'bg-blue-50');
    });

    resumeUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-400', 'bg-blue-50');
    });

    resumeUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-400', 'bg-blue-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            resumeFileInput.files = files;
            resumeFileInput.dispatchEvent(new Event('change'));
        }
    });

    // Add Skill functionality
    document.getElementById('add-skill-btn').addEventListener('click', function() {
        addSkillEntry();
    });

    function addSkillEntry(data = {}) {
        skillCounter++;
        const skillHtml = `
            <div class="skill-entry bg-gray-50 p-4 rounded-lg mb-4" data-skill="${skillCounter}">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="font-medium text-gray-900">Skill #${skillCounter}</h5>
                    <button type="button" class="remove-skill text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Skill Name *</label>
                        <input type="text" name="skills[${skillCounter}][name]" value="${data.name || ''}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Proficiency Level</label>
                        <select name="skills[${skillCounter}][proficiency]" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="beginner" ${data.proficiency === 'beginner' ? 'selected' : ''}>Beginner</option>
                            <option value="intermediate" ${data.proficiency === 'intermediate' ? 'selected' : ''}>Intermediate</option>
                            <option value="advanced" ${data.proficiency === 'advanced' ? 'selected' : ''}>Advanced</option>
                            <option value="expert" ${data.proficiency === 'expert' ? 'selected' : ''}>Expert</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label>
                        <input type="number" name="skills[${skillCounter}][years]" value="${data.years || ''}" min="0" max="50"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="skills[${skillCounter}][category]" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="technical" ${data.category === 'technical' ? 'selected' : ''}>Technical</option>
                            <option value="soft" ${data.category === 'soft' ? 'selected' : ''}>Soft Skill</option>
                            <option value="language" ${data.category === 'language' ? 'selected' : ''}>Language</option>
                            <option value="other" ${data.category === 'other' ? 'selected' : ''}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Certification/Training (Optional)</label>
                    <input type="text" name="skills[${skillCounter}][certification]" value="${data.certification || ''}"
                           placeholder="e.g., AWS Certified, Google Analytics Certified"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        `;
        
        document.getElementById('skills-container').insertAdjacentHTML('beforeend', skillHtml);
        
        // Add remove functionality
        const removeBtn = document.querySelector(`[data-skill="${skillCounter}"] .remove-skill`);
        removeBtn.addEventListener('click', function() {
            this.closest('.skill-entry').remove();
        });
    }

    // Add Experience functionality
    document.getElementById('add-experience-btn').addEventListener('click', function() {
        addExperienceEntry();
    });

    function addExperienceEntry(data = {}) {
        experienceCounter++;
        const experienceHtml = `
            <div class="experience-entry bg-gray-50 p-4 rounded-lg mb-4" data-experience="${experienceCounter}">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="font-medium text-gray-900">Experience #${experienceCounter}</h5>
                    <button type="button" class="remove-experience text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Job Title *</label>
                        <input type="text" name="experiences[${experienceCounter}][title]" value="${data.title || ''}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                        <input type="text" name="experiences[${experienceCounter}][company]" value="${data.company || ''}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="experiences[${experienceCounter}][location]" value="${data.location || ''}"
                               placeholder="City, Country"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type</label>
                        <select name="experiences[${experienceCounter}][type]" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="full-time" ${data.type === 'full-time' ? 'selected' : ''}>Full-time</option>
                            <option value="part-time" ${data.type === 'part-time' ? 'selected' : ''}>Part-time</option>
                            <option value="contract" ${data.type === 'contract' ? 'selected' : ''}>Contract</option>
                            <option value="internship" ${data.type === 'internship' ? 'selected' : ''}>Internship</option>
                            <option value="freelance" ${data.type === 'freelance' ? 'selected' : ''}>Freelance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                        <input type="date" name="experiences[${experienceCounter}][start_date]" value="${data.start_date || ''}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" name="experiences[${experienceCounter}][end_date]" value="${data.end_date || ''}"
                               class="end-date-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <label class="flex items-center mt-2">
                            <input type="checkbox" name="experiences[${experienceCounter}][currently_working]" value="1" 
                                   class="currently-working mr-2" ${data.currently_working ? 'checked' : ''}>
                            <span class="text-sm text-gray-600">Currently working here</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="experiences[${experienceCounter}][description]" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Describe your responsibilities and achievements...">${data.description || ''}</textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Key Achievements (Optional)</label>
                    <textarea name="experiences[${experienceCounter}][achievements]" rows="2"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="List your key accomplishments in this role...">${data.achievements || ''}</textarea>
                </div>
            </div>
        `;
        
        document.getElementById('experience-container').insertAdjacentHTML('beforeend', experienceHtml);
        
        // Add remove functionality
        const removeBtn = document.querySelector(`[data-experience="${experienceCounter}"] .remove-experience`);
        removeBtn.addEventListener('click', function() {
            this.closest('.experience-entry').remove();
        });

        // Add currently working toggle functionality
        const currentlyWorkingCheckbox = document.querySelector(`[data-experience="${experienceCounter}"] .currently-working`);
        const endDateInput = document.querySelector(`[data-experience="${experienceCounter}"] .end-date-input`);
        
        currentlyWorkingCheckbox.addEventListener('change', function() {
            if (this.checked) {
                endDateInput.disabled = true;
                endDateInput.value = '';
                endDateInput.classList.add('bg-gray-100');
            } else {
                endDateInput.disabled = false;
                endDateInput.classList.remove('bg-gray-100');
            }
        });

        // Initialize the state
        if (currentlyWorkingCheckbox.checked) {
            endDateInput.disabled = true;
            endDateInput.classList.add('bg-gray-100');
        }
    }

    // Add Project functionality
    document.getElementById('add-project-btn').addEventListener('click', function() {
        addProjectEntry();
    });

    function addProjectEntry(data = {}) {
        projectCounter++;
        const projectHtml = `
            <div class="project-entry bg-gray-50 p-4 rounded-lg mb-4" data-project="${projectCounter}">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="font-medium text-gray-900">Project #${projectCounter}</h5>
                    <button type="button" class="remove-project text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Project Name *</label>
                        <input type="text" name="projects[${projectCounter}][name]" value="${data.name || ''}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Role</label>
                        <input type="text" name="projects[${projectCounter}][role]" value="${data.role || ''}"
                               placeholder="e.g., Developer, Designer, Team Lead"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="projects[${projectCounter}][category]" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="professional" ${data.category === 'professional' ? 'selected' : ''}>Professional</option>
                            <option value="academic" ${data.category === 'academic' ? 'selected' : ''}>Academic</option>
                            <option value="personal" ${data.category === 'personal' ? 'selected' : ''}>Personal</option>
                            <option value="open-source" ${data.category === 'open-source' ? 'selected' : ''}>Open Source</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Project URL</label>
                        <input type="url" name="projects[${projectCounter}][url]" value="${data.url || ''}"
                               placeholder="https://github.com/user/project"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" name="projects[${projectCounter}][start_date]" value="${data.start_date || ''}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" name="projects[${projectCounter}][end_date]" value="${data.end_date || ''}"
                               class="project-end-date w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <label class="flex items-center mt-2">
                            <input type="checkbox" name="projects[${projectCounter}][ongoing]" value="1" 
                                   class="project-ongoing mr-2" ${data.ongoing ? 'checked' : ''}>
                            <span class="text-sm text-gray-600">Ongoing project</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="projects[${projectCounter}][description]" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Describe the project and your contributions...">${data.description || ''}</textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Technologies Used</label>
                    <input type="text" name="projects[${projectCounter}][technologies]" value="${data.technologies || ''}"
                           placeholder="e.g., React, Node.js, MongoDB, AWS"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Outcomes/Achievements</label>
                    <textarea name="projects[${projectCounter}][outcomes]" rows="2"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="What were the results or impact of this project?">${data.outcomes || ''}</textarea>
                </div>
            </div>
        `;
        
        document.getElementById('projects-container').insertAdjacentHTML('beforeend', projectHtml);
        
        // Add remove functionality
        const removeBtn = document.querySelector(`[data-project="${projectCounter}"] .remove-project`);
        removeBtn.addEventListener('click', function() {
            this.closest('.project-entry').remove();
        });

        // Add ongoing project toggle functionality
        const ongoingCheckbox = document.querySelector(`[data-project="${projectCounter}"] .project-ongoing`);
        const endDateInput = document.querySelector(`[data-project="${projectCounter}"] .project-end-date`);
        
        ongoingCheckbox.addEventListener('change', function() {
            if (this.checked) {
                endDateInput.disabled = true;
                endDateInput.value = '';
                endDateInput.classList.add('bg-gray-100');
            } else {
                endDateInput.disabled = false;
                endDateInput.classList.remove('bg-gray-100');
            }
        });

        // Initialize the state
        if (ongoingCheckbox.checked) {
            endDateInput.disabled = true;
            endDateInput.classList.add('bg-gray-100');
        }
    }

    // Form submission handler
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            // Clean up date fields before submission
            const dateFields = this.querySelectorAll('input[type="date"]');
            dateFields.forEach(field => {
                if (field.value && !isValidDate(field.value)) {
                    field.value = ''; // Clear invalid dates
                }
            });

            // Validate all tabs
            let allValid = true;
            const tabNames = ['basic', 'education', 'skills', 'experience', 'projects'];
            
            tabNames.forEach(tabName => {
                if (!validateTab(tabName)) {
                    allValid = false;
                }
            });

            if (!allValid) {
                e.preventDefault();
                alert('Please fix all validation errors before submitting.');
                return false;
            }
        });
    }

    // Initialize with one entry for each section
    addSkillEntry();
    addExperienceEntry();
    addProjectEntry();
});
</script>

@endsection