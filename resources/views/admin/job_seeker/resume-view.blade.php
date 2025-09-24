@extends('layouts.app')

@section('title', 'My Resume - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        @include('admin.job_seeker.partials.sidebar')
        
        <div class="flex-1 p-8">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">My Resume</h1>
                        <p class="text-gray-600 mt-1">View and manage your professional resume</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('job_seeker.resume.edit') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2 13.586 3.586-3.586a2 2 0 012.828 0L10 11.414V13z"></path>
                            </svg>
                            Edit Resume
                        </a>
                        
                        @if($jobSeeker && ($workExperiences->count() > 0 || $educations->count() > 0 || $skills->count() > 0 || $jobSeeker->bio))
                        <button type="button" onclick="confirmDelete()" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Resume
                        </button>
                        
                        <!-- Hidden delete form -->
                        <form id="delete-resume-form" action="{{ route('job_seeker.resume.destroy') }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        @endif
                        
                        @if($jobSeeker && $jobSeeker->updated_at)
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Last updated: {{ $jobSeeker->updated_at->diffForHumans() }}
                        </div>
                        @endif
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

            @if(session('info'))
                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-md p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm font-medium text-blue-800">{{ session('info') }}</p>
                    </div>
                </div>
            @endif

            <!-- Resume Content -->
            @if(!$jobSeeker || (!$workExperiences->count() && !$educations->count() && !$skills->count() && !$jobSeeker->bio))
                <!-- Empty Resume State -->
                <div class="bg-white shadow rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No Resume Created Yet</h3>
                    <p class="mt-1 text-gray-500">Get started by creating your professional resume.</p>
                    <div class="mt-6">
                        <a href="{{ route('job_seeker.resume.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Resume
                        </a>
                    </div>
                </div>
            @else
            <div class="bg-white shadow rounded-lg p-8">
                <!-- Header -->
                <div class="border-b pb-6 mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-lg text-gray-600 mt-2">{{ $jobSeeker->current_position ?: 'Job Seeker' }}</p>
                    <p class="text-gray-500 mt-1">{{ $jobSeeker->location_preference ?: 'Bangladesh' }}</p>
                </div>

                <!-- Contact & Links -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-600">Email:</span> {{ $user->email }}
                        </div>
                        @if($jobSeeker->expected_salary_min)
                        <div>
                            <span class="text-gray-600">Per Hour Rate:</span> tk {{ number_format($jobSeeker->expected_salary_min) }}
                        </div>
                        @endif
                        @if($jobSeeker->linkedin_url)
                        <div>
                            <span class="text-gray-600">LinkedIn:</span> 
                            <a href="{{ $jobSeeker->linkedin_url }}" target="_blank" class="text-teal-600 hover:underline">
                                {{ $jobSeeker->linkedin_url }}
                            </a>
                        </div>
                        @endif
                        @if($jobSeeker->portfolio_url)
                        <div>
                            <span class="text-gray-600">Website:</span> 
                            <a href="{{ $jobSeeker->portfolio_url }}" target="_blank" class="text-teal-600 hover:underline">
                                {{ $jobSeeker->portfolio_url }}
                            </a>
                        </div>
                        @endif
                        @if($jobSeeker->github_url)
                        <div>
                            <span class="text-gray-600">GitHub:</span> 
                            <a href="{{ $jobSeeker->github_url }}" target="_blank" class="text-teal-600 hover:underline">
                                {{ $jobSeeker->github_url }}
                            </a>
                        </div>
                        @endif
                        @if($jobSeeker->experience_years)
                        <div>
                            <span class="text-gray-600">Age:</span> {{ $jobSeeker->experience_years }} years old
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Professional Summary -->
                @if($jobSeeker->bio)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Professional Summary</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $jobSeeker->bio }}</p>
                </div>
                @endif

                <!-- Work Experience -->
                @if($workExperiences->count() > 0)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Work Experience</h3>
                    <div class="space-y-6">
                        @foreach($workExperiences as $experience)
                        <div class="border-l-2 border-teal-200 pl-4 bg-gray-50 p-4 rounded-r-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $experience->job_title ?: 'Position not specified' }}</h4>
                                    <p class="text-teal-600 font-medium">{{ $experience->company_name ?: 'Company not specified' }}</p>
                                </div>
                                <div class="text-right md:text-left">
                                    <p class="text-gray-500 text-sm">
                                        @if($experience->start_date)
                                            {{ $experience->start_date->format('M Y') }}
                                        @else
                                            Start date not specified
                                        @endif
                                        - 
                                        @if($experience->is_current)
                                            Present
                                        @elseif($experience->end_date)
                                            {{ $experience->end_date->format('M Y') }}
                                        @else
                                            End date not specified
                                        @endif
                                        @if($experience->location) • {{ $experience->location }} @endif
                                    </p>
                                </div>
                            </div>
                            
                            @if($experience->employment_type)
                                <span class="inline-block bg-teal-100 text-teal-800 px-2 py-1 rounded text-xs mb-2">
                                    {{ ucfirst(str_replace('_', ' ', $experience->employment_type)) }}
                                </span>
                            @endif
                            
                            @if($experience->description)
                                <p class="text-gray-700 mt-2">{{ $experience->description }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Education -->
                @if($educations->count() > 0)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Education</h3>
                    <div class="space-y-4">
                        @foreach($educations as $education)
                        <div class="border-l-2 border-blue-200 pl-4 bg-gray-50 p-4 rounded-r-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $education->degree_name ?: 'Degree not specified' }}</h4>
                                    @if($education->field_of_study)
                                        <p class="text-blue-600">{{ $education->field_of_study }}</p>
                                    @endif
                                </div>
                                <div class="text-right md:text-left">
                                    @if($education->start_date && $education->start_date instanceof \Carbon\Carbon)
                                        <span class="text-gray-600">{{ $education->start_date->year }}</span>
                                    @elseif($education->start_year || $education->passing_year)
                                        <span class="text-gray-600">
                                            @if($education->start_year)
                                                {{ $education->start_year }}
                                            @endif
                                            @if($education->start_year && $education->passing_year)
                                                - 
                                            @endif
                                            @if($education->passing_year)
                                                {{ $education->passing_year }}
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($education->institute_name)
                                <p class="text-gray-600 font-medium">{{ $education->institute_name }}</p>
                            @endif
                            
                            @if($education->description)
                                <p class="text-gray-700 mt-2 text-sm">{{ $education->description }}</p>
                            @endif
                            
                            <div class="flex items-center space-x-4 text-sm text-gray-500 mt-2">
                                @if($education->result)
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $education->result }}</span>
                                @endif
                                @if($education->education_level)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded">{{ $education->education_level }}</span>
                                @endif
                                @if($education->status)
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">{{ ucfirst($education->status) }}</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Skills -->
                @if(isset($skills) && $skills->count() > 0)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Skills</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($skills as $skill)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-900">{{ $skill->skill_name }}</span>
                            <div class="flex items-center space-x-2">
                                <div class="w-24 bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $skill->proficiency }}%"></div>
                                </div>
                                <span class="text-sm font-semibold text-gray-600">{{ $skill->proficiency }}%</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Additional Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Experience Level</h4>
                        <p class="text-gray-700">
                            {{ $jobSeeker->experience_years == 0 ? 'Fresh Graduate' : $jobSeeker->experience_years . ' years' }}
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Availability</h4>
                        <p class="text-gray-700">
                            @switch($jobSeeker->availability_status)
                                @case('immediately') Available Immediately @break
                                @case('within_month') Within 1 Month @break
                                @case('within_3_months') Within 3 Months @break
                                @case('not_looking') Not Looking Currently @break
                                @default Not specified
                            @endswitch
                        </p>
                    </div>

                    @if($jobSeeker->expected_salary_min || $jobSeeker->expected_salary_max)
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Expected Salary</h4>
                        <p class="text-gray-700">
                            @if($jobSeeker->expected_salary_min && $jobSeeker->expected_salary_max)
                                tk {{ number_format($jobSeeker->expected_salary_min) }} - tk {{ number_format($jobSeeker->expected_salary_max) }}
                            @elseif($jobSeeker->expected_salary_min)
                                tk {{ number_format($jobSeeker->expected_salary_min) }}+
                            @elseif($jobSeeker->expected_salary_max)
                                Up to tk {{ number_format($jobSeeker->expected_salary_max) }}
                            @endif
                        </p>
                    </div>
                    @endif

                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Work Preference</h4>
                        <p class="text-gray-700">
                            {{ $jobSeeker->remote_preference ? 'Open to remote work' : 'Prefers on-site work' }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.btn-primary { @apply inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700; }
</style>
@endpush

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete your resume? This action cannot be undone. All your work experience, education, and skills data will be permanently removed.')) {
        document.getElementById('delete-resume-form').submit();
    }
}
</script>
@endpush