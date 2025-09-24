@extends('layouts.app')

@section('title', 'Draft Jobs - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Draft Jobs</h1>
            <a href="{{ route('employer.jobs.create') }}" class="inline-flex items-center bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create New Job
            </a>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Your Draft Jobs</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your draft job postings</p>
            </div>
            
            @if(isset($draftJobs) && count($draftJobs) > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($draftJobs as $job)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $job['title'] }}</h3>
                                    <div class="mt-2 flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Last modified: {{ $job['last_modified'] }}
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="#" class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Edit
                                    </a>
                                    <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No draft jobs</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new job posting.</p>
                    <div class="mt-6">
                        <a href="{{ route('employer.jobs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create New Job
                        </a>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="mt-6">
            <a href="{{ route('employer.dashboard') }}" class="text-blue-600 hover:text-blue-800">← Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection