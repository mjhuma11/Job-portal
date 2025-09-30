@extends('layouts.app')

@section('title', 'My Profile - CareerBridge')

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
                        <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
                        <p class="text-gray-600 mt-1">View and manage your professional information</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('job_seeker.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Quick Edit
                        </a>
                        <a href="{{ route('job_seeker.profile.edit.tabs') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Complete Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('warning'))
                <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-yellow-800">{{ session('warning') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($jobSeeker)
                <!-- Debug Information (Remove in production) -->
                @if(config('app.debug'))
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <h4 class="text-sm font-medium text-yellow-800 mb-2">Debug Info (Development Only)</h4>
                    <div class="text-xs text-yellow-700">
                        <p><strong>JobSeeker ID:</strong> {{ $jobSeeker->seeker_id ?? 'NULL' }}</p>
                        <p><strong>User ID:</strong> {{ $user->id }}</p>
                        <p><strong>Name:</strong> {{ $jobSeeker->name ?? 'NULL' }}</p>
                        <p><strong>Email:</strong> {{ $jobSeeker->email ?? 'NULL' }}</p>
                        <p><strong>Phone:</strong> {{ $jobSeeker->phone ?? 'NULL' }}</p>
                        <p><strong>Address:</strong> {{ $jobSeeker->address ?? 'NULL' }}</p>
                        <p><strong>Gender:</strong> {{ $jobSeeker->gender ?? 'NULL' }}</p>
                        <p><strong>Date of Birth:</strong> {{ $jobSeeker->date_of_birth ?? 'NULL' }}</p>
                        <p><strong>Resume File:</strong> {{ $jobSeeker->resume_file ?? 'NULL' }}</p>
                        <p><strong>Profile Image:</strong> {{ $jobSeeker->profile_image ?? 'NULL' }}</p>
                        <p><strong>Updated At:</strong> {{ $jobSeeker->updated_at ?? 'NULL' }}</p>
                    </div>
                </div>
                @endif

                <!-- Profile Completion Section -->
                @php
                    $completionData = [
                        'basic_info' => $jobSeeker && $jobSeeker->name && $jobSeeker->email && $jobSeeker->phone,
                        'profile_image' => $jobSeeker && $jobSeeker->profile_image,
                        'resume_file' => $jobSeeker && $jobSeeker->resume_file,
                        'social_links' => $jobSeeker && ($jobSeeker->linkedin_url || $jobSeeker->github_url || $jobSeeker->portfolio_url || $jobSeeker->twitter_url),
                        'education' => $educations && $educations->count() > 0,
                        'skills' => $skills && $skills->count() > 0,
                        'experience' => $workExperiences && $workExperiences->count() > 0,
                        'projects' => $projects && $projects->count() > 0,
                    ];
                    $completedItems = collect($completionData)->filter(function($value) { return $value === true; })->count();
                    $totalItems = count($completionData);
                    $completionPercentage = $totalItems > 0 ? round(($completedItems / $totalItems) * 100) : 0;
                @endphp

                <div class="profile-completion-card rounded-lg shadow-lg mb-6 text-white">
                    <div class="px-6 py-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Profile Completion</h3>
                                <p class="text-blue-100 text-sm">Complete your profile to get better job matches</p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold">{{ $completionPercentage }}%</div>
                                <div class="text-blue-100 text-sm">Complete</div>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="mt-4">
                            <div class="w-full bg-blue-400 bg-opacity-30 rounded-full h-2">
                                <div class="completion-progress-bar bg-white h-2 rounded-full" style="--progress-width: {{ $completionPercentage }}%; width: {{ $completionPercentage }}%"></div>
                            </div>
                        </div>

                        <!-- Completion Items -->
                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div class="completion-item flex items-center text-sm">
                                @if($completionData['basic_info'])
                                    <svg class="completion-check w-4 h-4 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="completion-cross w-4 h-4 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                Basic Info
                            </div>
                            
                            <div class="flex items-center text-sm">
                                @if($completionData['profile_image'])
                                    <svg class="w-4 h-4 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                Photo
                            </div>
                            
                            <div class="flex items-center text-sm">
                                @if($completionData['resume_file'])
                                    <svg class="w-4 h-4 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                Resume
                            </div>
                            
                            <div class="flex items-center text-sm">
                                @if($completionData['social_links'])
                                    <svg class="w-4 h-4 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                Social Links
                            </div>
                            
                            <div class="flex items-center text-sm">
                                @if($completionData['education'])
                                    <svg class="w-4 h-4 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                Education
                            </div>
                            
                            <div class="flex items-center text-sm">
                                @if($completionData['skills'])
                                    <svg class="w-4 h-4 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                Skills
                            </div>
                            
                            <div class="flex items-center text-sm">
                                @if($completionData['experience'])
                                    <svg class="w-4 h-4 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                Experience
                            </div>
                            
                            <div class="flex items-center text-sm">
                                @if($completionData['projects'])
                                    <svg class="w-4 h-4 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                Projects
                            </div>
                        </div>

                        @if($completionPercentage < 100)
                        <div class="mt-4 text-center">
                            <a href="{{ route('job_seeker.profile.edit.tabs') }}" class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Complete Profile
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Profile Header with Photo -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-6 py-6">
                        <div class="flex items-center space-x-6">
                            <div class="flex-shrink-0">
                                <img class="h-20 w-20 rounded-full object-cover" 
                                     src="{{ ($jobSeeker->profile_image) ? asset('storage/' . $jobSeeker->profile_image) : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjgwIiBoZWlnaHQ9IjgwIiBmaWxsPSIjRTVFN0VCIiByeD0iNDAiLz4KPHA+' }}" 
                                     alt="Profile Photo">
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-gray-900">{{ $jobSeeker->name ?? $user->name }}</h2>
                                <p class="text-lg text-gray-600">{{ $jobSeeker->current_position ?: 'Job Seeker' }}</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    @if($jobSeeker->phone)
                                        <span class="text-sm text-gray-500">📞 {{ $jobSeeker->phone }}</span>
                                    @endif
                                    @if($jobSeeker->address)
                                        <span class="text-sm text-gray-500">📍 {{ $jobSeeker->address }}</span>
                                    @endif
                                    @if($jobSeeker->date_of_birth)
                                        <span class="text-sm text-gray-500">🎂 {{ $jobSeeker->date_of_birth->age }} years old</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Information Cards -->
                <div class="space-y-6">
                    <!-- Basic Information Card -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Full Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $jobSeeker->name ?? $user->name ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Email Address</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $jobSeeker->email ?? $user->email ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Phone Number</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($jobSeeker && $jobSeeker->phone)
                                            {{ $jobSeeker->phone }}
                                        @else
                                            <span class="text-orange-600">Not specified</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Gender</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($jobSeeker && $jobSeeker->gender)
                                            {{ ucfirst($jobSeeker->gender) }}
                                        @else
                                            <span class="text-orange-600">Not specified</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Date of Birth</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($jobSeeker && $jobSeeker->date_of_birth)
                                            {{ $jobSeeker->date_of_birth->format('F d, Y') }} ({{ $jobSeeker->date_of_birth->age }} years old)
                                        @else
                                            <span class="text-orange-600">Not specified</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Address</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($jobSeeker && $jobSeeker->address)
                                            {{ $jobSeeker->address }}
                                        @else
                                            <span class="text-orange-600">Not specified</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resume File Section -->
                    @if($jobSeeker && $jobSeeker->resume_file)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Resume File</h3>
                        </div>
                        <div class="px-6 py-6">
                            <!-- Debug Info for Resume -->
                            @if(config('app.debug'))
                            <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <h5 class="text-xs font-medium text-yellow-800 mb-1">Resume Debug Info</h5>
                                <div class="text-xs text-yellow-700">
                                    <p><strong>File Path:</strong> {{ $jobSeeker->resume_file }}</p>
                                    <p><strong>Asset URL:</strong> {{ asset('storage/' . $jobSeeker->resume_file) }}</p>
                                    <p><strong>Storage URL:</strong> {{ \Storage::disk('public')->url($jobSeeker->resume_file) }}</p>
                                    <p><strong>File Exists:</strong> {{ \Storage::disk('public')->exists($jobSeeker->resume_file) ? 'Yes' : 'No' }}</p>
                                    <p><strong>File Size:</strong> {{ \Storage::disk('public')->exists($jobSeeker->resume_file) ? number_format(\Storage::disk('public')->size($jobSeeker->resume_file) / 1024, 1) . ' KB' : 'N/A' }}</p>
                                    <p><strong>Public File Exists:</strong> {{ file_exists(public_path('storage/' . $jobSeeker->resume_file)) ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex items-center justify-between p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-blue-900">{{ basename($jobSeeker->resume_file) }}</p>
                                        <p class="text-xs text-blue-700">Uploaded {{ $jobSeeker->updated_at->diffForHumans() }}</p>
                                        @if(\Storage::disk('public')->exists($jobSeeker->resume_file))
                                            <p class="text-xs text-green-600">✓ File exists ({{ number_format(\Storage::disk('public')->size($jobSeeker->resume_file) / 1024, 1) }} KB)</p>
                                        @else
                                            <p class="text-xs text-red-600">✗ File not found</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('job_seeker.resume.view') }}" target="_blank" 
                                       class="inline-flex items-center px-3 py-1 border border-blue-300 text-xs font-medium rounded text-blue-700 bg-white hover:bg-blue-50">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('job_seeker.resume.download') }}" 
                                       class="inline-flex items-center px-3 py-1 border border-green-300 text-xs font-medium rounded text-green-700 bg-white hover:bg-green-50">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Download
                                    </a>
                                    <!-- Direct serve link -->
                                    <a href="{{ route('job_seeker.resume.serve', basename($jobSeeker->resume_file)) }}" target="_blank" 
                                       class="inline-flex items-center px-3 py-1 border border-purple-300 text-xs font-medium rounded text-purple-700 bg-white hover:bg-purple-50">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        Serve
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Social Media Links -->
                    @if($jobSeeker->linkedin_url || $jobSeeker->github_url || $jobSeeker->portfolio_url || $jobSeeker->twitter_url)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Social Media & Links</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($jobSeeker->linkedin_url)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ $jobSeeker->linkedin_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800">LinkedIn Profile</a>
                                </div>
                                @endif
                                @if($jobSeeker->github_url)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-900 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ $jobSeeker->github_url }}" target="_blank" class="text-sm text-gray-900 hover:text-gray-700">GitHub Profile</a>
                                </div>
                                @endif
                                @if($jobSeeker->portfolio_url)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9a9 9 0 01-9-9m9 0a9 9 0 00-9 9"></path>
                                    </svg>
                                    <a href="{{ $jobSeeker->portfolio_url }}" target="_blank" class="text-sm text-purple-600 hover:text-purple-800">Portfolio Website</a>
                                </div>
                                @endif
                                @if($jobSeeker->twitter_url)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                    <a href="{{ $jobSeeker->twitter_url }}" target="_blank" class="text-sm text-blue-400 hover:text-blue-600">Twitter Profile</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Education Section -->
                    @if($educations->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Education</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="space-y-4">
                                @foreach($educations as $education)
                                <div class="border-l-4 border-blue-400 pl-4 py-2">
                                    <h4 class="font-semibold text-gray-900">{{ $education->degree_name }}</h4>
                                    <p class="text-blue-600">{{ $education->institute_name }}</p>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-sm text-gray-500">{{ $education->passing_year }}</span>
                                        @if($education->result_value)
                                            <span class="text-sm font-medium text-green-600">{{ $education->result_value }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Skills Section -->
                    @if($skills->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Skills</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($skills as $skill)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <span class="font-medium text-gray-900">{{ $skill->skill_name }}</span>
                                        @if($skill->category)
                                            <span class="text-xs text-gray-500 ml-2">({{ ucfirst($skill->category) }})</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($skill->proficiency)
                                            <div class="w-20 bg-gray-200 rounded-full h-2">
                                                @php
                                                    $proficiencyMap = ['beginner' => 25, 'intermediate' => 50, 'advanced' => 75, 'expert' => 100];
                                                    $percentage = $proficiencyMap[$skill->proficiency] ?? 50;
                                                @endphp
                                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span class="text-xs text-gray-600">{{ ucfirst($skill->proficiency) }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Work Experience Section -->
                    @if($workExperiences->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Work Experience</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="space-y-6">
                                @foreach($workExperiences as $experience)
                                <div class="border-l-4 border-green-400 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $experience->job_title }}</h4>
                                            <p class="text-green-600 font-medium">{{ $experience->company_name }}</p>
                                            @if($experience->location)
                                                <p class="text-sm text-gray-500">{{ $experience->location }}</p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">
                                                {{ $experience->start_date ? $experience->start_date->format('M Y') : 'Start date not specified' }}
                                                - 
                                                @if($experience->is_current)
                                                    Present
                                                @else
                                                    {{ $experience->end_date ? $experience->end_date->format('M Y') : 'End date not specified' }}
                                                @endif
                                            </p>
                                            @if($experience->employment_type)
                                                <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs mt-1">
                                                    {{ ucfirst(str_replace('_', ' ', $experience->employment_type)) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($experience->description)
                                        <p class="text-gray-700 mt-2 text-sm">{{ $experience->description }}</p>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Projects Section -->
                    @if($projects->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Projects</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($projects as $project)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-semibold text-gray-900">{{ $project->name }}</h4>
                                        @if($project->category)
                                            <span class="inline-block bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs">
                                                {{ ucfirst(str_replace('_', ' ', $project->category)) }}
                                            </span>
                                        @endif
                                    </div>
                                    @if($project->role)
                                        <p class="text-purple-600 text-sm font-medium">{{ $project->role }}</p>
                                    @endif
                                    @if($project->description)
                                        <p class="text-gray-700 text-sm mt-2">{{ $project->description }}</p>
                                    @endif
                                    @if($project->technologies)
                                        <div class="mt-2">
                                            <p class="text-xs text-gray-500">Technologies: {{ $project->technologies }}</p>
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-center mt-3">
                                        @if($project->start_date)
                                            <span class="text-xs text-gray-500">
                                                {{ $project->start_date->format('M Y') }}
                                                @if($project->ongoing)
                                                    - Present
                                                @elseif($project->end_date)
                                                    - {{ $project->end_date->format('M Y') }}
                                                @endif
                                            </span>
                                        @endif
                                        @if($project->url)
                                            <a href="{{ $project->url }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800">View Project</a>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Career Preferences Card -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Career Preferences</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Current Position -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Current Position</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $jobSeeker->current_position ?: 'Not specified' }}</p>
                                </div>

                                <!-- Experience Years -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Years of Experience</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($jobSeeker->experience_years == 0)
                                            Fresh Graduate
                                        @elseif($jobSeeker->experience_years == 1)
                                            1 Year
                                        @else
                                            {{ $jobSeeker->experience_years }} Years
                                        @endif
                                    </p>
                                </div>

                                <!-- Location Preference -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Location Preference</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $jobSeeker->location_preference ?: 'Not specified' }}</p>
                                </div>

                                <!-- Availability Status -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Availability Status</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($jobSeeker->availability_status == 'immediately') bg-green-100 text-green-800
                                            @elseif($jobSeeker->availability_status == 'within_month') bg-yellow-100 text-yellow-800  
                                            @elseif($jobSeeker->availability_status == 'within_3_months') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            @switch($jobSeeker->availability_status)
                                                @case('immediately')
                                                    Available Immediately
                                                    @break
                                                @case('within_month')
                                                    Within 1 Month
                                                    @break
                                                @case('within_3_months')
                                                    Within 3 Months
                                                    @break
                                                @case('not_looking')
                                                    Not Looking Currently
                                                    @break
                                                @default
                                                    Not specified
                                            @endswitch
                                        </span>
                                    </p>
                                </div>

                                <!-- Remote Preference -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-500">Remote Work Preference</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($jobSeeker->remote_preference)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Open to remote work
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Prefers on-site work
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Details Card -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Professional Details</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="space-y-6">
                                <!-- Bio -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Professional Bio</label>
                                    <div class="mt-1 text-sm text-gray-900">
                                        @if($jobSeeker->bio)
                                            <p class="whitespace-pre-wrap">{{ $jobSeeker->bio }}</p>
                                        @else
                                            <p class="text-gray-400 italic">No bio provided</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Expected Salary Range -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Expected Salary (Min)</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            @if($jobSeeker->expected_salary_min)
                                                BDT {{ number_format($jobSeeker->expected_salary_min) }}
                                            @else
                                                Not specified
                                            @endif
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Expected Salary (Max)</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            @if($jobSeeker->expected_salary_max)
                                                BDT {{ number_format($jobSeeker->expected_salary_max) }}
                                            @else
                                                Not specified
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Resume -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Resume/CV</label>
                                    <div class="mt-1">
                                        @if($jobSeeker->resume_file)
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-8 w-8 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900">{{ $jobSeeker->resume_file }}</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <a href="{{ asset('uploads/resumes/' . $jobSeeker->resume_file) }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-teal-700 bg-teal-100 hover:bg-teal-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-sm text-gray-400 italic">No resume uploaded</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social & Professional Links Card -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Social & Professional Links</h3>
                        </div>
                        <div class="px-6 py-6">
                            <div class="space-y-4">
                                <!-- LinkedIn URL -->
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-500">LinkedIn Profile</label>
                                        @if($jobSeeker->linkedin_url)
                                            <a href="{{ $jobSeeker->linkedin_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800">{{ $jobSeeker->linkedin_url }}</a>
                                        @else
                                            <p class="text-sm text-gray-400 italic">Not provided</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Portfolio URL -->
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9a9 9 0 01-9-9m9 0a9 9 0 00-9 9"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-500">Portfolio Website</label>
                                        @if($jobSeeker->portfolio_url)
                                            <a href="{{ $jobSeeker->portfolio_url }}" target="_blank" class="text-sm text-purple-600 hover:text-purple-800">{{ $jobSeeker->portfolio_url }}</a>
                                        @else
                                            <p class="text-sm text-gray-400 italic">Not provided</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- GitHub URL -->
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-500">GitHub Profile</label>
                                        @if($jobSeeker->github_url)
                                            <a href="{{ $jobSeeker->github_url }}" target="_blank" class="text-sm text-gray-900 hover:text-gray-700">{{ $jobSeeker->github_url }}</a>
                                        @else
                                            <p class="text-sm text-gray-400 italic">Not provided</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Completion Card -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Profile Completion</h3>
                        </div>
                        <div class="px-6 py-6">
                            @php
                                $completion = 0;
                                $total = 13;
                                
                                if($user->name) $completion++;
                                if($user->email) $completion++;
                                if($jobSeeker->phone) $completion++;
                                if($jobSeeker->address) $completion++;
                                if($jobSeeker->current_position) $completion++;
                                if($jobSeeker->experience_years > 0) $completion++;
                                if($jobSeeker->location_preference) $completion++;
                                if($jobSeeker->availability_status) $completion++;
                                if($jobSeeker->bio) $completion++;
                                if($jobSeeker->expected_salary_min) $completion++;
                                if($jobSeeker->expected_salary_max) $completion++;
                                if($jobSeeker->resume_file) $completion++;
                                if($jobSeeker->linkedin_url || $jobSeeker->portfolio_url || $jobSeeker->github_url) $completion++;
                                
                                $percentage = round(($completion / $total) * 100);
                            @endphp
                            
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Profile Completion</span>
                                <span class="text-sm font-medium text-gray-700">{{ $percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-teal-600 h-2 rounded-full transition-all duration-300" style="width: {{ $percentage }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                Complete your profile to increase your visibility to employers
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Profile Card -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No profile found</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating your professional profile.</p>
                        <div class="mt-6">
                            <a href="{{ route('job_seeker.profile.edit.tabs') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Create Complete Profile
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection