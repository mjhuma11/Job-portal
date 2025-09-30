@extends('layouts.app')

@section('title', $job->job_title . ' - CareerBridge')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('categories.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Categories</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('categories.show', $job->category) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ $job->category }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($job->job_title, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Job Header -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-start space-x-4">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 w-16 h-16 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-xl">
                                {{ substr($job->company->name ?? 'C', 0, 1) }}
                            </span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $job->job_title }}</h1>
                            <p class="text-lg text-gray-700 mt-1">{{ $job->company->name ?? 'Company Name' }}</p>
                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $job->location ?? 'Location' }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $job->salary ?? 'Salary not specified' }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                    </svg>
                                    {{ $job->job_type ? ucfirst(str_replace('-', ' ', $job->job_type)) : 'Job Type' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0">
                        @auth
                            @if(auth()->user()->isJobSeeker())
                                <button onclick="applyForJob({{ $job->id }})" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg transform hover:scale-105">
                                    Apply Now
                                </button>
                            @else
                                <button disabled class="px-6 py-3 bg-gray-300 text-gray-500 font-bold rounded-xl cursor-not-allowed">
                                    Login as Job Seeker to Apply
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg">
                                Login to Apply
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Job Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <!-- Job Overview -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Job Overview</h2>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Experience</p>
                                    <p class="font-medium">{{ $job->experience ?? 'Not specified' }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Category</p>
                                    <p class="font-medium">{{ $job->category ?? 'Not specified' }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Posted</p>
                                    <p class="font-medium">{{ $job->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Deadline</p>
                                    <p class="font-medium">
                                        {{ $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') : 'No deadline' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Job Description -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Job Description</h2>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 whitespace-pre-line">{{ $job->description ?? 'No description provided' }}</p>
                            </div>
                        </div>

                        <!-- Requirements -->
                        @if($job->requirements)
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Requirements</h2>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 whitespace-pre-line">{{ $job->requirements }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Responsibilities -->
                        @if($job->responsibilities)
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Responsibilities</h2>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 whitespace-pre-line">{{ $job->responsibilities }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Benefits -->
                        @if($job->benefits)
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Benefits</h2>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 whitespace-pre-line">{{ $job->benefits }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div>
                        <!-- Company Info -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Company Information</h3>
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 w-12 h-12 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold">
                                        {{ substr($job->company->name ?? 'C', 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $job->company->name ?? 'Company Name' }}</h4>
                                    <p class="text-sm text-gray-500">{{ $job->company->industry ?? 'Industry' }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit($job->company->description ?? 'No company description available.', 150) }}
                            </p>
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View Company Profile
                            </a>
                        </div>

                        <!-- Job Actions -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Job Actions</h3>
                            <div class="space-y-3">
                                <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    Save Job
                                </button>
                                <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                    </svg>
                                    Share Job
                                </button>
                                <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    Report Job
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Apply Job Modal -->
<div id="applyModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Apply for this position
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                You're about to apply for the position of <span class="font-medium">{{ $job->job_title }}</span> at {{ $job->company->name ?? 'the company' }}.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <a href="{{ route('job_seeker.jobs.apply', $job->id) }}" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Continue to Application
                </a>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function applyForJob(jobId) {
        // Show the modal
        document.getElementById('applyModal').classList.remove('hidden');
    }
    
    function closeModal() {
        // Hide the modal
        document.getElementById('applyModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('applyModal');
        if (modal && !modal.classList.contains('hidden') && event.target === modal) {
            closeModal();
        }
    });
</script>
@endsection