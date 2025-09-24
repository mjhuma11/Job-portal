@extends('layouts.app')

@section('title', 'Resume Management - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        @include('admin.job_seeker.partials.sidebar')
        
        <div class="flex-1 p-8">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Resume Management</h1>
                        <p class="text-gray-600 mt-1">Complete CRUD operations for your professional resume</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- CRUD Operations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Create Resume -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-green-600">C</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Create</h3>
                    <p class="text-gray-600 text-sm mb-4">Build a new professional resume from scratch</p>
                    <a href="{{ route('job_seeker.resume.create') }}" class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors text-center block">
                        Create New Resume
                    </a>
                </div>

                <!-- Read Resume -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-blue-600">R</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Read</h3>
                    <p class="text-gray-600 text-sm mb-4">View your current resume details and information</p>
                    <a href="{{ route('job_seeker.resume') }}" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-center block">
                        View Resume
                    </a>
                </div>

                <!-- Update Resume -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-yellow-600">U</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Update</h3>
                    <p class="text-gray-600 text-sm mb-4">Edit and modify your existing resume content</p>
                    @if($jobSeeker)
                        <a href="{{ route('job_seeker.resume.edit') }}" class="w-full bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 transition-colors text-center block">
                            Edit Resume
                        </a>
                    @else
                        <span class="w-full bg-gray-300 text-gray-500 px-4 py-2 rounded-md text-center block cursor-not-allowed">
                            No Resume Found
                        </span>
                    @endif
                </div>

                <!-- Delete Resume -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-red-100 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-red-600">D</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete</h3>
                    <p class="text-gray-600 text-sm mb-4">Remove your resume and all associated data</p>
                    @if($jobSeeker && ($workExperiences->count() > 0 || $educations->count() > 0 || $skills->count() > 0 || $jobSeeker->bio))
                        <button onclick="confirmDelete()" class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors text-center block">
                            Delete Resume
                        </button>
                        <!-- Hidden delete form -->
                        <form id="delete-resume-form" action="{{ route('job_seeker.resume.destroy') }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @else
                        <span class="w-full bg-gray-300 text-gray-500 px-4 py-2 rounded-md text-center block cursor-not-allowed">
                            No Resume Found
                        </span>
                    @endif
                </div>
            </div>

            <!-- Resume Status Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Resume Status</h2>
                
                @if($jobSeeker)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Basic Info -->
                        <div class="text-center">
                            <div class="p-4 bg-blue-50 rounded-lg mb-3">
                                <svg class="w-8 h-8 text-blue-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900">Basic Information</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $jobSeeker->current_position ? 'Complete' : 'Incomplete' }}
                            </p>
                            <div class="mt-2">
                                @if($jobSeeker->current_position)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        ✓ Complete
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        ⚠ Incomplete
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Experience & Education -->
                        <div class="text-center">
                            <div class="p-4 bg-green-50 rounded-lg mb-3">
                                <svg class="w-8 h-8 text-green-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900">Experience & Education</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $workExperiences->count() }} work, {{ $educations->count() }} education
                            </p>
                            <div class="mt-2">
                                @if($workExperiences->count() > 0 || $educations->count() > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        ✓ {{ $workExperiences->count() + $educations->count() }} entries
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        ✗ No entries
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="text-center">
                            <div class="p-4 bg-purple-50 rounded-lg mb-3">
                                <svg class="w-8 h-8 text-purple-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900">Skills</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $skills->count() }} skills added
                            </p>
                            <div class="mt-2">
                                @if($skills->count() > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        ✓ {{ $skills->count() }} skills
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        ✗ No skills
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Last Updated -->
                    @if($jobSeeker->updated_at)
                        <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                            <p class="text-sm text-gray-600">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Last updated: {{ $jobSeeker->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No Resume Found</h3>
                        <p class="mt-1 text-gray-500">Get started by creating your first professional resume.</p>
                        <div class="mt-6">
                            <a href="{{ route('job_seeker.resume.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create Your First Resume
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete your resume? This action cannot be undone. All your work experience, education, and skills data will be permanently removed.')) {
        document.getElementById('delete-resume-form').submit();
    }
}
</script>
@endpush