@extends('layouts.app')

@section('title', 'Job Details - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.jobs') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Job Management
                </a>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                            <span>Admin</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Job Posts</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span class="text-teal-600">Job Details</span>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900">Job Details</h1>
                        <p class="text-gray-600 mt-1">View and manage job posting details</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.jobs.edit', $job) }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Job
                        </a>
                        
                        @if($job->status === 'pending')
                        <form action="{{ route('admin.jobs.approve', $job) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors"
                                    onclick="return confirm('Are you sure you want to approve this job?')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Approve
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.jobs.reject', $job) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors"
                                    onclick="return confirm('Are you sure you want to reject this job?')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reject
                            </button>
                        </form>
                        @endif
                        
                        @if($job->status === 'open')
                        @if(!$job->is_featured)
                        <form action="{{ route('admin.jobs.feature', $job) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition-colors"
                                    onclick="return confirm('Are you sure you want to feature this job?')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                Feature
                            </button>
                        </form>
                        @else
                        <form action="{{ route('admin.jobs.unfeature', $job) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors"
                                    onclick="return confirm('Are you sure you want to unfeature this job?')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                Unfeature
                            </button>
                        </form>
                        @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Job Information -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Job Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $job->job_title }}</h3>
                                <p class="text-gray-600 mt-1">{{ $job->company->name }}</p>
                            </div>
                            @if($job->is_featured)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Featured</span>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Category</label>
                                <p class="text-sm font-medium text-gray-900">{{ $job->category ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Location</label>
                                <p class="text-sm font-medium text-gray-900">{{ $job->location ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Job Type</label>
                                <p class="text-sm font-medium text-gray-900">{{ $job->job_type ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Salary</label>
                                <p class="text-sm font-medium text-gray-900">{{ $job->salary ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Experience</label>
                                <p class="text-sm font-medium text-gray-900">{{ $job->experience ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Application Deadline</label>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $job->application_deadline ? $job->application_deadline->format('M d, Y') : 'Not specified' }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Description</label>
                            <div class="text-sm text-gray-900 prose max-w-none">
                                {!! nl2br(e($job->description ?? 'No description provided')) !!}
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Requirements</label>
                            <div class="text-sm text-gray-900 prose max-w-none">
                                {!! nl2br(e($job->requirements ?? 'No requirements specified')) !!}
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Responsibilities</label>
                            <div class="text-sm text-gray-900 prose max-w-none">
                                {!! nl2br(e($job->responsibilities ?? 'No responsibilities specified')) !!}
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Benefits</label>
                            <div class="text-sm text-gray-900 prose max-w-none">
                                {!! nl2br(e($job->benefits ?? 'No benefits specified')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Status -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Job Status</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Current Status:</span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($job->status === 'open') bg-green-100 text-green-800
                                    @elseif($job->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($job->status === 'rejected') bg-red-100 text-red-800
                                    @elseif($job->status === 'closed') bg-gray-100 text-gray-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    @if($job->status === 'open') Approved
                                    @elseif($job->status === 'pending') Pending
                                    @elseif($job->status === 'rejected') Rejected
                                    @else {{ ucfirst($job->status) }}
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Featured:</span>
                                @if($job->is_featured)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Yes
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    No
                                </span>
                                @endif
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Posted:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $job->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Last Updated:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $job->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Company Info -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>
                        
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">{{ substr($job->company->name, 0, 2) }}</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">{{ $job->company->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $job->company->industry ?? 'Industry not specified' }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Email:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $job->company->email ?? 'Not provided' }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Website:</span>
                                <span class="text-sm font-medium text-gray-900">
                                    @if($job->company->website)
                                    <a href="{{ $job->company->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        {{ $job->company->website }}
                                    </a>
                                    @else
                                    Not provided
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Verified:</span>
                                <span class="text-sm font-medium text-gray-900">
                                    @if($job->company->verified)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Verified
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('admin.employers.show', $job->company) }}" 
                               class="text-sm text-blue-600 hover:text-blue-800">
                                View Company Details
                            </a>
                        </div>
                    </div>
                    
                    <!-- Applications -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Applications</h3>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $job->applications()->count() }} received
                            </span>
                        </div>
                        
                        <a href="#" class="block w-full text-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            View Applications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection