@extends('layouts.app')

@section('title', 'Job Details - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Dashboard Container -->
    <div class="flex">
        @include('admin.employers.partials.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <span>Employer</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span>My Jobs</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span>Job Details</span>
                </div>
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Job Details</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('employer.jobs.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Back to Jobs
                        </a>
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Edit Job
                        </a>
                    </div>
                </div>
            </div>

            <!-- Job Details Card -->
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $job->job_title }}</h2>
                            <p class="text-gray-600 mt-1">
                                at <span class="font-medium">{{ $job->company->name ?? 'Unknown Company' }}</span>
                            </p>
                        </div>
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full 
                            @if($job->status === 'open') bg-green-100 text-green-800
                            @elseif($job->status === 'closed') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($job->status) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Job Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Category</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $job->category ?? 'Not specified' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Job Type</h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $job->job_type ? ucfirst(str_replace('-', ' ', $job->job_type)) : 'Not specified' }}
                                    </p>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Location</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $job->location ?? 'Not specified' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Salary</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $job->salary ?? 'Not specified' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Experience Required</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $job->experience ?? 'Not specified' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Application Deadline</h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('F d, Y') : 'No deadline' }}
                                    </p>
                                </div>
                                
                                <div class="flex items-center">
                                    <h4 class="text-sm font-medium text-gray-500">Featured Job</h4>
                                    <p class="ml-2 text-sm text-gray-900">
                                        @if($job->is_featured)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Yes
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                No
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Description -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Description</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $job->description ?? 'No description provided' }}</p>
                                </div>
                                
                                @if($job->requirements)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Requirements</h4>
                                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $job->requirements }}</p>
                                </div>
                                @endif
                                
                                @if($job->responsibilities)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Responsibilities</h4>
                                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $job->responsibilities }}</p>
                                </div>
                                @endif
                                
                                @if($job->benefits)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Benefits</h4>
                                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $job->benefits }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Information -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Posted Date</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $job->created_at->format('F d, Y') }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Last Updated</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $job->updated_at->format('F d, Y') }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Applications</h4>
                                <p class="mt-1 text-sm text-gray-900">0 applications</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection