@extends('layouts.app')

@section('title', 'Saved Jobs - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-teal-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">CB</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800">CareerBridge</span>
                </div>
            </div>
            
            <div class="p-4">
                <div class="mb-6">
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name, 0, 2) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-500">Job Seeker</p>
                        </div>
                    </div>
                </div>

                <nav class="space-y-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">DASHBOARD</div>
                    
                    <a href="{{ route('job_seeker.dashboard') }}" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('job_seeker.saved_jobs') }}" class="flex items-center space-x-3 p-3 bg-blue-50 text-blue-600 border-l-4 border-blue-600 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>Saved Jobs</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-white border-b border-gray-200 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Saved Jobs</h1>
                        <p class="text-gray-600">Jobs you've saved for later review</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @if($savedJobs->count() > 0)
                    <div class="space-y-4">
                        @foreach($savedJobs as $savedJob)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ substr($savedJob->job->job_title, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $savedJob->job->job_title }}</h3>
                                        <p class="text-gray-600">{{ $savedJob->job->company->name }}</p>
                                        <p class="text-sm text-gray-500">Saved: {{ $savedJob->saved_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <button class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors">
                                        Apply Now
                                    </button>
                                    <form action="{{ route('job_seeker.saved_jobs.remove', $savedJob->job->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mt-4">No saved jobs yet</h3>
                        <p class="text-gray-500 mt-2">Start browsing jobs and save the ones you're interested in!</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors">
                            Browse Jobs
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection