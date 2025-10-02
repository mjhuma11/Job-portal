@extends('layouts.app')

@section('title', 'Job Seeker Details - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.job_seekers') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Job Seekers
                </a>
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Job Seeker Details</h1>
                        <p class="text-gray-600 mt-1">View detailed information about this job seeker</p>
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.job_seekers.handle_report', $user) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors"
                                    onclick="return confirm('Are you sure you want to handle this report?')">
                                Handle Report
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Job Seeker Information -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- User Details -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">User Information</h3>
                        
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 h-16 w-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-xl">{{ substr($user->name, 0, 2) }}</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">{{ $user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">User ID:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $user->id }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Joined:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Last Updated:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $user->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Profile Status -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Status</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Profile Completion:</span>
                                <span class="text-sm font-medium text-gray-900">85%</span>
                            </div>
                            
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>
                        
                        @if($user->jobSeeker)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Current Position</label>
                                <p class="text-sm font-medium text-gray-900">{{ $user->jobSeeker->current_position ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Experience</label>
                                <p class="text-sm font-medium text-gray-900">{{ $user->jobSeeker->experience_years ?? 'Not specified' }} years</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Expected Salary</label>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $user->jobSeeker->expected_salary_min ? '$' . number_format($user->jobSeeker->expected_salary_min) : 'Not specified' }}
                                    {{ $user->jobSeeker->expected_salary_max ? ' - $' . number_format($user->jobSeeker->expected_salary_max) : '' }}
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Availability</label>
                                <p class="text-sm font-medium text-gray-900">{{ $user->jobSeeker->availability_status ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Location Preference</label>
                                <p class="text-sm font-medium text-gray-900">{{ $user->jobSeeker->location_preference ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Remote Work</label>
                                <p class="text-sm font-medium text-gray-900">
                                    @if($user->jobSeeker->remote_preference)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Available
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Not Available
                                    </span>
                                    @endif
                                </p>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-1">Bio</label>
                                <p class="text-sm font-medium text-gray-900">{{ $user->jobSeeker->bio ?? 'No bio provided' }}</p>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="mt-2">No profile information available</p>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Applications -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Job Applications</h3>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $user->jobSeeker ? $user->jobSeeker->jobApplications()->count() : 0 }} applications
                            </span>
                        </div>
                        
                        @if($user->jobSeeker && $user->jobSeeker->jobApplications()->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($user->jobSeeker->jobApplications as $application)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $application->job->job_title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $application->job->company->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($application->status === 'reviewed') bg-blue-100 text-blue-800
                                                @elseif($application->status === 'accepted') bg-green-100 text-green-800
                                                @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $application->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="mt-2">No job applications yet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection