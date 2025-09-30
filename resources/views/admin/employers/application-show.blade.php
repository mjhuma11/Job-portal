@extends('layouts.app')

@section('title', 'Application Details - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('employer.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('employer.applications.index') }}" class="ml-1 text-blue-600 hover:text-blue-800 md:ml-2">Applications</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2">Application Details</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Application Details</h1>
            <p class="text-gray-600">Review and manage this job application</p>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Candidate Information -->
                <div class="lg:col-span-2">
                    <h2 class="text-xl font-semibold mb-4">Candidate Information</h2>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Full Name</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->jobSeeker->name ?? 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Email</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->jobSeeker->email ?? 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Phone</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->jobSeeker->phone ?? 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Location</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->jobSeeker->location_preference ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Application Status -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Application Status</h2>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-medium text-gray-500">Current Status</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $application->status === 'reviewed' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $application->status === 'shortlisted' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $application->status === 'hired' ? 'bg-green-100 text-green-800' : '' }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                        
                        <form id="statusForm" action="{{ route('employer.applications.update.status', $application) }}" method="POST">
                            @csrf
                            <select name="status" class="w-full border rounded-md px-3 py-2 text-sm mb-3">
                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="reviewed" {{ $application->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="hired" {{ $application->status === 'hired' ? 'selected' : '' }}>Hired</option>
                            </select>
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md text-sm hover:bg-blue-700" id="updateStatusBtn">
                                Update Status
                            </button>
                        </form>
                        <div id="statusMessage" class="mt-2 text-sm hidden"></div>
                    </div>
                </div>
            </div>
            
            <!-- Job Information -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h2 class="text-xl font-semibold mb-4">Job Information</h2>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Job Title</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->job->job_title ?? 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Company</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->job->company->name ?? 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Applied On</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->applied_at->format('F d, Y') }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Location</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->job->location ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Resume -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h2 class="text-xl font-semibold mb-4">Resume</h2>
                
                @if($application->resume_path)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Attached Resume</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ basename($application->resume_path) }}</p>
                            </div>
                            <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" 
                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Download Resume
                            </a>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">No resume attached.</p>
                @endif
            </div>
            
            <!-- Cover Letter -->
            @if($application->cover_letter)
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h2 class="text-xl font-semibold mb-4">Cover Letter</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-900 whitespace-pre-line">{{ $application->cover_letter }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('statusForm');
    const updateBtn = document.getElementById('updateStatusBtn');
    const messageDiv = document.getElementById('statusMessage');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const originalBtnText = updateBtn.innerHTML;
        updateBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Updating...';
        updateBtn.disabled = true;
        
        // Hide any previous messages
        messageDiv.classList.add('hidden');
        
        // Get form data
        const formData = new FormData(form);
        
        // Send AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                messageDiv.innerHTML = `<div class="text-green-600">${data.message}</div>`;
                messageDiv.classList.remove('hidden');
                
                // Update the status badge
                const statusBadge = document.querySelector('.inline-flex.rounded-full');
                statusBadge.className = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' +
                    (data.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '') +
                    (data.status === 'reviewed' ? 'bg-blue-100 text-blue-800' : '') +
                    (data.status === 'shortlisted' ? 'bg-green-100 text-green-800' : '') +
                    (data.status === 'rejected' ? 'bg-red-100 text-red-800' : '') +
                    (data.status === 'hired' ? 'bg-green-100 text-green-800' : '');
                statusBadge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                
                // Update select option
                const select = document.querySelector('select[name="status"]');
                select.value = data.status;
            } else {
                // Show error message
                messageDiv.innerHTML = `<div class="text-red-600">${data.message}</div>`;
                messageDiv.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            messageDiv.innerHTML = '<div class="text-red-600">An error occurred while updating the status.</div>';
            messageDiv.classList.remove('hidden');
        })
        .finally(() => {
            // Restore button state
            updateBtn.innerHTML = originalBtnText;
            updateBtn.disabled = false;
        });
    });
});
</script>
@endsection