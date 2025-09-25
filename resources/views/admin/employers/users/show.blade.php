@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        <!-- Include Sidebar -->
        @include('admin.employers.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">User Details</h1>
                        <p class="text-gray-600 mt-1">View detailed information about {{ $user->name }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('employer.users.edit', $user) }}" 
                           class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit User
                        </a>
                        <a href="{{ route('employer.users.index') }}" 
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m0 7h18"></path>
                            </svg>
                            Back to Users
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="max-w-4xl mx-auto">
                    <!-- User Profile Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-20 w-20">
                                    <div class="h-20 w-20 rounded-full bg-gradient-to-r from-blue-500 to-teal-500 flex items-center justify-center">
                                        <span class="text-white font-bold text-2xl">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-6">
                                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                                    <p class="text-gray-600">{{ $user->email }}</p>
                                    <div class="flex items-center mt-2">
                                        @if($user->role)
                                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                                @if($user->role->name === 'admin') bg-red-100 text-red-800
                                                @elseif($user->role->name === 'employer') bg-blue-100 text-blue-800
                                                @else bg-green-100 text-green-800 @endif">
                                                {{ ucfirst($user->role->name) }}
                                            </span>
                                        @endif
                                        
                                        @if($user->email_verified_at)
                                            <span class="ml-3 inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="ml-3 inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Member since</p>
                                <p class="font-semibold">{{ $user->created_at->format('M j, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Account Information -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">User ID</label>
                                    <p class="text-gray-900">{{ $user->id }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Full Name</label>
                                    <p class="text-gray-900">{{ $user->name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Email Address</label>
                                    <p class="text-gray-900">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Role</label>
                                    <p class="text-gray-900">{{ $user->role ? ucfirst($user->role->name) : 'No role assigned' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Account Status</label>
                                    <p class="text-gray-900">{{ $user->email_verified_at ? 'Active' : 'Inactive' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Activity Information -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Activity Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Created At</label>
                                    <p class="text-gray-900">{{ $user->created_at->format('M j, Y g:i A') }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Last Updated</label>
                                    <p class="text-gray-900">{{ $user->updated_at->format('M j, Y g:i A') }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Email Verified</label>
                                    <p class="text-gray-900">
                                        {{ $user->email_verified_at ? $user->email_verified_at->format('M j, Y g:i A') : 'Not verified' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Profile Views</label>
                                    <p class="text-gray-900">{{ rand(50, 500) }} views</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Total Inquiries</label>
                                    <p class="text-gray-900">{{ rand(5, 50) }} inquiries</p>
                                </div>
                            </div>
                        </div>

                        <!-- Job Seeker Profile (if applicable) -->
                        @if($user->jobSeeker)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Seeker Profile</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Current Position</label>
                                    <p class="text-gray-900">{{ $user->jobSeeker->current_position ?: 'Not specified' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Experience Years</label>
                                    <p class="text-gray-900">{{ $user->jobSeeker->experience_years }} years</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Availability Status</label>
                                    <p class="text-gray-900">{{ ucfirst(str_replace('_', ' ', $user->jobSeeker->availability_status)) }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Remote Preference</label>
                                    <p class="text-gray-900">{{ $user->jobSeeker->remote_preference ? 'Yes' : 'No' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Location Preference</label>
                                    <p class="text-gray-900">{{ $user->jobSeeker->location_preference ?: 'Not specified' }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Company Profile (if applicable) -->
                        @if($user->company)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Profile</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Company Name</label>
                                    <p class="text-gray-900">{{ $user->company->name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Company Email</label>
                                    <p class="text-gray-900">{{ $user->company->email }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Description</label>
                                    <p class="text-gray-900">{{ $user->company->description ?: 'No description provided' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Website</label>
                                    <p class="text-gray-900">{{ $user->company->website ?: 'Not specified' }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('employer.users.edit', $user) }}" 
                               class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit User
                            </a>
                            
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('employer.users.toggle-status', $user) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                    </svg>
                                    {{ $user->email_verified_at ? 'Deactivate User' : 'Activate User' }}
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('employer.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete User
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection