@extends('layouts.app')

@section('title', 'Admin Dashboard - CareerBridge')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <!-- Dashboard Container -->
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <span>Admin</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-teal-600">Dashboard</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}! Here's what's happening today.</p>
            </div>

            <!-- Statistics Cards - Removed as per user request -->
            
            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Recent Jobs -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-teal-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">Recent Jobs</h3>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">{{ $recentJobs->count() }} New</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">Latest job postings</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($recentJobs as $job)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-blue-50 transition-all duration-200">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $job->job_title }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $job->company->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Posted: {{ $job->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full 
                                        @if($job->status === 'open') bg-green-100 text-green-800
                                        @elseif($job->status === 'closed') bg-red-100 text-red-800
                                        @elseif($job->status === 'draft') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8 text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                </svg>
                                <p class="mt-2">No recent jobs found</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('admin.jobs') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300">
                                View all jobs
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Employers -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">Recent Employers</h3>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">{{ $recentEmployers->count() }} New</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">Latest employer registrations</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($recentEmployers as $employer)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-purple-50 transition-all duration-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ substr($employer->name, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $employer->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $employer->user->name }}</p>
                                        <p class="text-xs text-gray-500">Registered: {{ $employer->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full 
                                        @if($employer->verified) bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        @if($employer->verified) Verified @else Pending @endif
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8 text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="mt-2">No recent employers found</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('admin.employers') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-medium rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300">
                                View all employers
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-blue-50">
                    <h3 class="text-xl font-bold text-gray-900">Quick Actions</h3>
                    <p class="text-gray-600 text-sm mt-1">Common administrative tasks</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('admin.employers.create') }}" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl hover:bg-blue-50 transition-all duration-200 border border-gray-200">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900 text-center">Add Employer</h4>
                        </a>
                        
                        <a href="{{ route('admin.categories.create') }}" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl hover:bg-green-50 transition-all duration-200 border border-gray-200">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900 text-center">Add Category</h4>
                        </a>
                        
                        <a href="{{ route('admin.locations.create') }}" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl hover:bg-amber-50 transition-all duration-200 border border-gray-200">
                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900 text-center">Add Location</h4>
                        </a>
                        
                        <a href="{{ route('admin.faqs.create') }}" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl hover:bg-purple-50 transition-all duration-200 border border-gray-200">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900 text-center">Add FAQ</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection