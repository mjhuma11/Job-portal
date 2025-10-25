@extends('layouts.app')

@section('title', 'My Profile - CareerBridge')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-200 py-8 px-4 my-8 mx-6 md:mx-12 lg:mx-24">
    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 text-blue-600 py-12 px-8 relative">
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <!-- Profile Image -->
                <div class="text-center">
                    <img src="{{ ($jobSeeker && $jobSeeker->profile_image) ? asset('storage/' . $jobSeeker->profile_image) : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIiBmaWxsPSIjRTVFN0VCIiByeD0iNzAiLz4KPHBhdGggZD0iTTcwIDcwQzc5LjM4OTMgNzAgODcgNjIuMzg5MyA4NyA1M0M4NyA0My42MTA3IDc5LjM4OTMgMzYgNzAgMzZDNjAuNjEwNyAzNiA1MyA0My42MTA3IDUzIDUzQzUzIDYyLjM4OTMgNjAuNjEwNyA3MCA3MCA3MFoiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTM1IDEyMUMzNSAxMDMuMzI3IDQ5LjMyNzEgODkgNjcgODlINzNDOTAuNjcyOSA4OSAxMDUgMTAzLjMyNyAxMDUgMTIxSDM1WiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K' }}" 
                         alt="Profile Picture" 
                         class="w-32 h-32 md:w-36 md:h-36 rounded-full mx-auto object-cover border-4 border-blue-600/20 shadow-xl transition-transform duration-300 hover:scale-105">
                </div>
                
                <!-- Profile Info -->
                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-2 tracking-tight">{{ $jobSeeker->name ?? $user->name ?? 'Job Seeker' }}</h1>
                    <p class="text-xl opacity-90 mb-5 font-medium">{{ $jobSeeker->professional_title ?? 'Professional' }}</p>
                    
                    <div class="flex flex-wrap justify-center md:justify-start gap-6 mb-0">
                        @if($jobSeeker && $jobSeeker->email)
                            <div class="flex items-center text-sm opacity-95">
                                <svg class="w-5 h-5 mr-2 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $jobSeeker->email }}
                            </div>
                        @endif
                        
                        @if($jobSeeker && $jobSeeker->phone)
                            <div class="flex items-center text-sm opacity-95">
                                <svg class="w-5 h-5 mr-2 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $jobSeeker->phone }}
                            </div>
                        @endif
                        
                        @if($jobSeeker && $jobSeeker->address)
                            <div class="flex items-center text-sm opacity-95">
                                <svg class="w-5 h-5 mr-2 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $jobSeeker->address }}
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('job_seeker.profile.edit.tabs') }}" class="py-3 px-6 rounded-lg font-semibold transition-all duration-300 border-none cursor-pointer min-w-[160px] inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 text-white border-2 border-blue-500/30 backdrop-blur-sm hover:from-blue-700 hover:to-blue-800 hover:border-blue-600/50 hover:transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profile
                    </a>
                    
                    <a href="{{ route('job_seeker.dashboard') }}" class="py-3 px-6 rounded-lg font-semibold transition-all duration-300 border-none cursor-pointer min-w-[160px] inline-flex items-center justify-center bg-gradient-to-r from-indigo-600 to-indigo-700 text-indigo-800 border-2 border-indigo-500/30 backdrop-blur-sm hover:from-indigo-700 hover:to-indigo-800 hover:border-indigo-600/50 hover:transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                    
                </div>
            </div>
        </div>

        <!-- Profile Body -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-0 min-h-[600px]">
            <!-- Main Content -->
            <div class="lg:col-span-2 p-10 bg-white">
                <!-- Personal Information -->
                @if($jobSeeker)
                <div class="mb-10">
                    <div class="text-2xl font-bold mb-6 flex items-center relative pb-3 border-b-2 border-gray-200 text-blue-800">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Personal Information
                    </div>
                    <div class="py-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($jobSeeker->full_name)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300 hover:border-blue-500 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3 text-blue-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-blue-800">Full Name</div>
                                        <div class="text-gray-600">{{ $jobSeeker->full_name }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($jobSeeker->email)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300 hover:border-blue-500 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3 text-blue-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-blue-800">Email</div>
                                        <div class="text-gray-600">{{ $jobSeeker->email }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($jobSeeker->phone)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300 hover:border-blue-500 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3 text-blue-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-blue-800">Phone</div>
                                        <div class="text-gray-600">{{ $jobSeeker->phone }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($jobSeeker->gender)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300 hover:border-blue-500 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3 text-blue-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-blue-800">Gender</div>
                                        <div class="text-gray-600">{{ ucfirst($jobSeeker->gender) }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($jobSeeker->date_of_birth)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300 hover:border-blue-500 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3 text-blue-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-blue-800">Date of Birth</div>
                                        <div class="text-gray-600">
                                            @php
                                                try {
                                                    echo \Carbon\Carbon::parse($jobSeeker->date_of_birth)->format('F j, Y');
                                                } catch(\Exception $e) {
                                                    echo $jobSeeker->date_of_birth;
                                                }
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($jobSeeker->address)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300 hover:border-blue-500 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3 text-blue-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-blue-800">Address</div>
                                        <div class="text-gray-600">{{ $jobSeeker->address }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($jobSeeker->linkedin_url)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300 hover:border-blue-500 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3 text-blue-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-blue-800">LinkedIn</div>
                                        <div class="text-gray-600">{{ $jobSeeker->linkedin_url }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($jobSeeker->github_url)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300 hover:border-blue-500 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3 text-blue-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-blue-800">GitHub</div>
                                        <div class="text-gray-600">{{ $jobSeeker->github_url }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Work Experience -->
                @if($workExperiences && $workExperiences->count() > 0)
                <div class="mb-10">
                    <div class="text-2xl font-bold mb-6 flex items-center relative pb-3 border-b-2 border-gray-200 text-blue-800">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                        </svg>
                        Work Experience
                    </div>
                    <div class="py-5">
                        @foreach($workExperiences as $experience)
                            <div class="pl-8 mb-6 pb-5 relative border-l-2 border-gray-200">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-blue-800 rounded-full border-4 border-white shadow"></div>
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $experience->job_title }}</h4>
                                    <span class="text-sm text-gray-500">
                                        @php
                                            try {
                                                echo \Carbon\Carbon::parse($experience->start_date)->format('M Y');
                                            } catch(\Exception $e) {
                                                echo $experience->start_date;
                                            }
                                        @endphp
                                        - 
                                        @if($experience->end_date)
                                            @php
                                                try {
                                                    echo \Carbon\Carbon::parse($experience->end_date)->format('M Y');
                                                } catch(\Exception $e) {
                                                    echo $experience->end_date;
                                                }
                                            @endphp
                                        @else
                                            Present
                                        @endif
                                    </span>
                                </div>
                                <div class="text-blue-600 font-medium mb-2">{{ $experience->company_name }}</div>
                                @if($experience->location)
                                    <div class="text-gray-500 text-sm mb-3">{{ $experience->location }}</div>
                                @endif
                                @if($experience->description)
                                    <p class="text-gray-700 mb-3">{{ $experience->description }}</p>
                                @endif
                                @if($experience->achievements)
                                    <div class="text-sm bg-white p-3 rounded border border-gray-200">
                                        <strong class="text-blue-800">Key Achievements:</strong>
                                        <p class="text-gray-600 mt-2">{{ $experience->achievements }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Education -->
                @if($educations && $educations->count() > 0)
                <div class="mb-10">
                    <div class="text-2xl font-bold mb-6 flex items-center relative pb-3 border-b-2 border-gray-200 text-blue-800">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                        Education
                    </div>
                    <div class="py-5">
                        @foreach($educations as $education)
                            <div class="pl-8 mb-6 pb-5 relative border-l-2 border-gray-200">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-blue-800 rounded-full border-4 border-white shadow"></div>
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $education->degree_name }}</h4>
                                    <span class="text-sm text-gray-500">{{ $education->passing_year }}</span>
                                </div>
                                <div class="text-blue-600 font-medium mb-2">{{ $education->institute_name }}</div>
                                @if($education->result_value)
                                    <div class="text-gray-600">Grade: {{ $education->result_value }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Projects -->
                @if($projects && $projects->count() > 0)
                <div class="mb-10">
                    <div class="text-2xl font-bold mb-6 flex items-center relative pb-3 border-b-2 border-gray-200 text-blue-800">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Projects
                    </div>
                    <div class="py-5">
                        @foreach($projects as $project)
                            <div class="p-6 mb-5 rounded-xl transition-all duration-300 bg-white border border-gray-200 hover:shadow-lg hover:transform hover:-translate-y-1">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $project->name }}</h4>
                                    @if($project->url)
                                        <a href="{{ $project->url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                                
                                @if($project->role)
                                    <div class="text-blue-600 font-medium mb-3">{{ $project->role }}</div>
                                @endif
                                
                                @if($project->description)
                                    <p class="text-gray-700 mb-4">{{ $project->description }}</p>
                                @endif
                                
                                @if($project->technologies)
                                    <div class="mb-4">
                                        <strong class="text-sm text-gray-600">Technologies:</strong>
                                        <div class="mt-2 flex flex-wrap gap-2">
                                            @foreach(explode(',', $project->technologies) as $tech)
                                                <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">{{ trim($tech) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                @if($project->outcomes)
                                    <div class="text-sm bg-white p-3 rounded border border-gray-200 mb-4">
                                        <strong class="text-blue-800">Outcomes:</strong>
                                        <p class="text-gray-600 mt-2">{{ $project->outcomes }}</p>
                                    </div>
                                @endif
                                
                                <div class="text-xs text-gray-500 mt-4">
                                    @if($project->start_date)
                                        @php
                                            try {
                                                echo \Carbon\Carbon::parse($project->start_date)->format('M Y');
                                            } catch(\Exception $e) {
                                                echo $project->start_date;
                                            }
                                        @endphp
                                    @endif
                                    @if($project->end_date)
                                        - 
                                        @php
                                            try {
                                                echo \Carbon\Carbon::parse($project->end_date)->format('M Y');
                                            } catch(\Exception $e) {
                                                echo $project->end_date;
                                            }
                                        @endphp
                                    @elseif($project->ongoing)
                                        - Present
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="p-10 bg-gradient-to-b from-gray-50 to-gray-100 border-l border-gray-200">
                
                <!-- Skills -->
                @if($skills && $skills->count() > 0)
                <div class="mb-10">
                    <div class="text-xl font-bold mb-6 flex items-center text-blue-800">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Skills
                    </div>
                    <div class="py-5">
                        @foreach($skills->groupBy('category') as $category => $categorySkills)
                            <div class="mb-6">
                                <h5 class="font-semibold text-gray-700 mb-3 text-base">{{ ucfirst($category) }} Skills</h5>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($categorySkills as $skill)
                                        <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $skill->skill_name }}
                                            @if($skill->years_experience)
                                                ({{ $skill->years_experience }}y)
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Social Links -->
                @if($jobSeeker && ($jobSeeker->linkedin_url || $jobSeeker->github_url || $jobSeeker->portfolio_url || $jobSeeker->twitter_url))
                <div class="mb-10">
                    <div class="text-xl font-bold mb-6 flex items-center text-blue-800">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        Social Links
                    </div>
                    <div class="py-5">
                        <div class="flex flex-col gap-3">
                            @if($jobSeeker->linkedin_url)
                                <a href="{{ $jobSeeker->linkedin_url }}" target="_blank" class="flex items-center p-3 bg-white rounded-lg border border-gray-200 text-gray-700 font-medium transition-all duration-300 hover:bg-gray-50 hover:border-blue-500 hover:text-blue-600 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd"></path>
                                    </svg>
                                    LinkedIn
                                </a>
                            @endif
                            
                            @if($jobSeeker->github_url)
                                <a href="{{ $jobSeeker->github_url }}" target="_blank" class="flex items-center p-3 bg-white rounded-lg border border-gray-200 text-gray-700 font-medium transition-all duration-300 hover:bg-gray-50 hover:border-blue-500 hover:text-blue-600 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    GitHub
                                </a>
                            @endif
                            
                            @if($jobSeeker->portfolio_url)
                                <a href="{{ $jobSeeker->portfolio_url }}" target="_blank" class="flex items-center p-3 bg-white rounded-lg border border-gray-200 text-gray-700 font-medium transition-all duration-300 hover:bg-gray-50 hover:border-blue-500 hover:text-blue-600 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                    Portfolio
                                </a>
                            @endif
                            
                            @if($jobSeeker->twitter_url)
                                <a href="{{ $jobSeeker->twitter_url }}" target="_blank" class="flex items-center p-3 bg-white rounded-lg border border-gray-200 text-gray-700 font-medium transition-all duration-300 hover:bg-gray-50 hover:border-blue-500 hover:text-blue-600 hover:transform hover:translate-x-1">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                    Twitter
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Resume Download -->
                @if($jobSeeker && $jobSeeker->resume_file)
                <div>
                    <div class="text-xl font-bold mb-6 flex items-center text-blue-800">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Resume
                    </div>
                    <div class="py-5">
                        <div class="text-center bg-white rounded-xl p-6 border border-gray-200">
                            <div class="mb-5">
                                <svg class="w-12 h-12 mx-auto text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="font-medium text-gray-700 mb-6 truncate">{{ basename($jobSeeker->resume_file) }}</p>
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('job_seeker.resume.view') }}" target="_blank" class="py-3 px-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg font-semibold transition-all duration-300 inline-flex items-center justify-center hover:from-blue-600 hover:to-blue-700 hover:transform hover:-translate-y-1 hover:shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Resume
                                </a>
                                <a href="{{ route('job_seeker.resume.download') }}" class="py-3 px-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg font-semibold transition-all duration-300 inline-flex items-center justify-center hover:from-green-600 hover:to-green-700 hover:transform hover:-translate-y-1 hover:shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download Resume
                                </a>
                                <a href="{{ route('job_seeker.resume.generate') }}" class="py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-lg font-semibold transition-all duration-300 inline-flex items-center justify-center hover:from-amber-600 hover:to-amber-700 hover:transform hover:-translate-y-1 hover:shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Generate Resume
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection