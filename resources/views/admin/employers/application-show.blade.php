@extends('layouts.app')

@section('title', 'Application Details - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Application Details</h1>
            <a href="{{ route('employer.applications.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Applications</a>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Applicant Information -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-semibold mb-4">Applicant Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Full Name</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->jobSeeker->full_name ?? 'N/A' }}</p>
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
                            <p class="mt-1 text-sm text-gray-900">{{ $application->jobSeeker->location ?? 'N/A' }}</p>
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
                        
                        <form action="{{ route('employer.applications.update.status', $application) }}" method="POST">
                            @csrf
                            <select name="status" class="w-full border rounded-md px-3 py-2 text-sm mb-3">
                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="reviewed" {{ $application->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="hired" {{ $application->status === 'hired' ? 'selected' : '' }}>Hired</option>
                            </select>
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md text-sm hover:bg-blue-700">
                                Update Status
                            </button>
                        </form>
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
@endsection