@extends('layouts.app')

@section('title', 'My Profile - CareerBridge')

@push('styles')
<style>
    /* Reset and base styles */
    * {
        box-sizing: border-box;
    }
    
    .profile-page {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #374151;
    }
    
    .profile-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        margin-bottom: 24px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    
    .section-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 16px 24px;
        font-weight: 600;
        font-size: 18px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .section-content {
        padding: 24px;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px 0;
        position: relative;
        overflow: hidden;
    }
    
    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        object-fit: cover;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
    }
    
    .skill-tag {
        display: inline-block;
        background: #f3f4f6;
        color: #374151;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        margin: 4px;
        border: 1px solid #e5e7eb;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .skill-tag:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .skill-tag.expert { 
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); 
        color: #166534; 
        border-color: #bbf7d0; 
    }
    .skill-tag.advanced { 
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); 
        color: #1e40af; 
        border-color: #bfdbfe; 
    }
    .skill-tag.intermediate { 
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); 
        color: #92400e; 
        border-color: #fde68a; 
    }
    .skill-tag.beginner { 
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); 
        color: #991b1b; 
        border-color: #fecaca; 
    }
    
    .timeline-item {
        position: relative;
        padding-left: 32px;
        margin-bottom: 24px;
        padding-bottom: 16px;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 8px;
        width: 12px;
        height: 12px;
        background: #667eea;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 2px #667eea;
        z-index: 2;
    }
    
    .timeline-item::after {
        content: '';
        position: absolute;
        left: 13px;
        top: 24px;
        width: 2px;
        height: calc(100% - 16px);
        background: linear-gradient(to bottom, #667eea, #e5e7eb);
        z-index: 1;
    }
    
    .timeline-item:last-child::after {
        display: none;
    }
    
    .social-link {
        display: inline-flex;
        align-items: center;
        padding: 10px 16px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        color: #374151;
        text-decoration: none;
        margin: 4px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .social-link:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        color: #374151;
    }
    
    .download-btn {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
        border: none;
        cursor: pointer;
    }
    
    .download-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .edit-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
        border: none;
        cursor: pointer;
    }
    
    .edit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 16px;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        padding: 16px;
        background: #f9fafb;
        border-radius: 8px;
        border-left: 4px solid #667eea;
        transition: all 0.2s ease;
    }
    
    .info-item:hover {
        background: #f3f4f6;
        transform: translateX(4px);
    }
    
    .info-icon {
        width: 20px;
        height: 20px;
        margin-right: 12px;
        color: #667eea;
        flex-shrink: 0;
    }
    
    .project-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        background: white;
    }
    
    .project-card:hover {
        border-color: #667eea;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        transform: translateY(-2px);
    }
    
    .tech-tag {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        margin: 2px;
        font-weight: 500;
        box-shadow: 0 1px 3px rgba(102, 126, 234, 0.3);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-header {
            padding: 24px 0;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
        }
        
        .section-content {
            padding: 16px;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .timeline-item {
            padding-left: 24px;
        }
        
        .timeline-item::before {
            left: 4px;
        }
        
        .timeline-item::after {
            left: 9px;
        }
        
        .download-btn, .edit-btn {
            padding: 10px 16px;
            font-size: 14px;
        }
        
        .skill-tag {
            font-size: 12px;
            padding: 4px 8px;
        }
    }
    
    @media (max-width: 480px) {
        .max-w-6xl {
            padding: 0 16px;
        }
        
        .grid.lg\\:grid-cols-3 {
            grid-template-columns: 1fr;
        }
        
        .flex.flex-wrap.gap-4 {
            flex-direction: column;
            align-items: stretch;
        }
        
        .download-btn, .edit-btn {
            justify-content: center;
            width: 100%;
            margin-bottom: 8px;
        }
    }
    
    /* Animation improvements */
    .profile-section {
        animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Additional fixes */
    .profile-page img {
        max-width: 100%;
        height: auto;
    }
    
    .profile-page a {
        color: inherit;
        text-decoration: none;
    }
    
    .profile-page a:hover {
        text-decoration: none;
    }
    
    /* Fix for potential Tailwind conflicts */
    .profile-page .grid {
        display: grid;
    }
    
    .profile-page .flex {
        display: flex;
    }
    
    .profile-page .hidden {
        display: none;
    }
    
    /* Ensure proper spacing */
    .profile-page .space-y-6 > * + * {
        margin-top: 1.5rem;
    }
    
    .profile-page .gap-8 {
        gap: 2rem;
    }
    
    .profile-page .gap-4 {
        gap: 1rem;
    }
    
    /* Fix button alignment */
    .profile-page .justify-center {
        justify-content: center;
    }
    
    .profile-page .justify-start {
        justify-content: flex-start;
    }
    
    .profile-page .items-center {
        align-items: center;
    }
    
    /* Print styles */
    @media print {
        .download-btn, .edit-btn {
            display: none;
        }
        
        .profile-section {
            box-shadow: none;
            border: 1px solid #e5e7eb;
            break-inside: avoid;
        }
        
        .profile-header {
            background: #667eea !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-page min-h-screen bg-gray-50">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                <!-- Profile Image -->
                <div class="flex-shrink-0">
                    <img src="{{ ($jobSeeker && $jobSeeker->profile_image) ? asset('storage/' . $jobSeeker->profile_image) : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiBmaWxsPSIjRTVFN0VCIi8+CjxwYXRoIGQ9Ik02MCA2MEM2OC44MzY2IDYwIDc2IDUyLjgzNjYgNzYgNDRDNzYgMzUuMTYzNCA2OC44MzY2IDI4IDYwIDI4QzUxLjE2MzQgMjggNDQgMzUuMTYzNCA0NCA0NEM0NCA1Mi44MzY2IDUxLjE2MzQgNjAgNjAgNjBaIiBmaWxsPSIjOUNBM0FGIi8+CjxwYXRoIGQ9Ik0yOCAxMDRDMjggODguNTM2IDQwLjUzNiA3NiA1NiA3Nkg2NEM3OS40NjQgNzYgOTIgODguNTM2IDkyIDEwNEgyOFoiIGZpbGw9IiM5Q0EzQUYiLz4KPC9zdmc+Cg==' }}" 
                         alt="Profile Picture" 
                         class="profile-avatar">
                </div>
                
                <!-- Profile Info -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl font-bold mb-2">{{ $jobSeeker->name ?? $user->name ?? 'Job Seeker' }}</h1>
                    <p class="text-xl opacity-90 mb-4">{{ $jobSeeker->professional_title ?? 'Professional' }}</p>
                    
                    <div class="flex flex-wrap justify-center md:justify-start gap-4 mb-6">
                        @if($jobSeeker && $jobSeeker->email)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $jobSeeker->email }}
                            </div>
                        @endif
                        
                        @if($jobSeeker && $jobSeeker->phone)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $jobSeeker->phone }}
                            </div>
                        @endif
                        
                        @if($jobSeeker && $jobSeeker->address)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $jobSeeker->address }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-4">
                        <a href="{{ route('job_seeker.profile.edit.tabs') }}" class="edit-btn">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Profile
                        </a>
                        
                        @if($jobSeeker && $jobSeeker->resume_file)
                            <a href="{{ route('job_seeker.resume.download') }}" class="download-btn">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download Resume
                            </a>
                        @endif
                        
                        <a href="{{ route('job_seeker.resume.generate') }}" class="download-btn" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Generate Resume
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Personal Information -->
                @if($jobSeeker)
                <div class="profile-section">
                    <div class="section-header">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Personal Information
                    </div>
                    <div class="section-content">
                        <div class="info-grid">
                            @if($jobSeeker->gender)
                                <div class="info-item">
                                    <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium">Gender</div>
                                        <div class="text-gray-600">{{ ucfirst($jobSeeker->gender) }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($jobSeeker->date_of_birth)
                                <div class="info-item">
                                    <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium">Date of Birth</div>
                                        <div class="text-gray-600">
                                            @try
                                                {{ \Carbon\Carbon::parse($jobSeeker->date_of_birth)->format('F j, Y') }}
                                            @catch(\Exception $e)
                                                {{ $jobSeeker->date_of_birth }}
                                            @endtry
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Work Experience -->
                @if($workExperiences && $workExperiences->count() > 0)
                <div class="profile-section">
                    <div class="section-header">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                        </svg>
                        Work Experience
                    </div>
                    <div class="section-content">
                        @foreach($workExperiences as $experience)
                            <div class="timeline-item">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $experience->job_title }}</h4>
                                    <span class="text-sm text-gray-500">
                                        @try
                                            {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }}
                                        @catch(\Exception $e)
                                            {{ $experience->start_date }}
                                        @endtry
                                        - 
                                        @if($experience->end_date)
                                            @try
                                                {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                                            @catch(\Exception $e)
                                                {{ $experience->end_date }}
                                            @endtry
                                        @else
                                            Present
                                        @endif
                                    </span>
                                </div>
                                <div class="text-blue-600 font-medium mb-1">{{ $experience->company_name }}</div>
                                @if($experience->location)
                                    <div class="text-gray-500 text-sm mb-2">{{ $experience->location }}</div>
                                @endif
                                @if($experience->description)
                                    <p class="text-gray-700 mb-2">{{ $experience->description }}</p>
                                @endif
                                @if($experience->achievements)
                                    <div class="text-sm">
                                        <strong>Key Achievements:</strong>
                                        <p class="text-gray-600 mt-1">{{ $experience->achievements }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Education -->
                @if($educations && $educations->count() > 0)
                <div class="profile-section">
                    <div class="section-header">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                        Education
                    </div>
                    <div class="section-content">
                        @foreach($educations as $education)
                            <div class="timeline-item">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $education->degree_name }}</h4>
                                    <span class="text-sm text-gray-500">{{ $education->passing_year }}</span>
                                </div>
                                <div class="text-blue-600 font-medium mb-1">{{ $education->institute_name }}</div>
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
                <div class="profile-section">
                    <div class="section-header">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Projects
                    </div>
                    <div class="section-content">
                        @foreach($projects as $project)
                            <div class="project-card">
                                <div class="flex justify-between items-start mb-3">
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
                                    <div class="text-blue-600 font-medium mb-2">{{ $project->role }}</div>
                                @endif
                                
                                @if($project->description)
                                    <p class="text-gray-700 mb-3">{{ $project->description }}</p>
                                @endif
                                
                                @if($project->technologies)
                                    <div class="mb-3">
                                        <strong class="text-sm text-gray-600">Technologies:</strong>
                                        <div class="mt-1">
                                            @foreach(explode(',', $project->technologies) as $tech)
                                                <span class="tech-tag">{{ trim($tech) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                @if($project->outcomes)
                                    <div class="text-sm">
                                        <strong>Outcomes:</strong>
                                        <p class="text-gray-600 mt-1">{{ $project->outcomes }}</p>
                                    </div>
                                @endif
                                
                                <div class="text-xs text-gray-500 mt-3">
                                    @if($project->start_date)
                                        @try
                                            {{ \Carbon\Carbon::parse($project->start_date)->format('M Y') }}
                                        @catch(\Exception $e)
                                            {{ $project->start_date }}
                                        @endtry
                                    @endif
                                    @if($project->end_date)
                                        - 
                                        @try
                                            {{ \Carbon\Carbon::parse($project->end_date)->format('M Y') }}
                                        @catch(\Exception $e)
                                            {{ $project->end_date }}
                                        @endtry
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

            <!-- Right Column -->
            <div class="space-y-6">
                
                <!-- Skills -->
                @if($skills && $skills->count() > 0)
                <div class="profile-section">
                    <div class="section-header">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Skills
                    </div>
                    <div class="section-content">
                        @foreach($skills->groupBy('category') as $category => $categorySkills)
                            <div class="mb-4">
                                <h5 class="font-medium text-gray-900 mb-2">{{ ucfirst($category) }} Skills</h5>
                                <div class="flex flex-wrap">
                                    @foreach($categorySkills as $skill)
                                        <span class="skill-tag {{ $skill->proficiency }}">
                                            {{ $skill->name }}
                                            @if($skill->years)
                                                ({{ $skill->years }}y)
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
                <div class="profile-section">
                    <div class="section-header">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        Social Links
                    </div>
                    <div class="section-content">
                        <div class="space-y-2">
                            @if($jobSeeker->linkedin_url)
                                <a href="{{ $jobSeeker->linkedin_url }}" target="_blank" class="social-link w-full">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd"></path>
                                    </svg>
                                    LinkedIn
                                </a>
                            @endif
                            
                            @if($jobSeeker->github_url)
                                <a href="{{ $jobSeeker->github_url }}" target="_blank" class="social-link w-full">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    GitHub
                                </a>
                            @endif
                            
                            @if($jobSeeker->portfolio_url)
                                <a href="{{ $jobSeeker->portfolio_url }}" target="_blank" class="social-link w-full">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                    Portfolio
                                </a>
                            @endif
                            
                            @if($jobSeeker->twitter_url)
                                <a href="{{ $jobSeeker->twitter_url }}" target="_blank" class="social-link w-full">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
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
                <div class="profile-section">
                    <div class="section-header">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Resume
                    </div>
                    <div class="section-content">
                        <div class="text-center">
                            <div class="mb-4">
                                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 mb-4">{{ basename($jobSeeker->resume_file) }}</p>
                            <div class="space-y-2">
                                <a href="{{ route('job_seeker.resume.view') }}" target="_blank" class="block w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Resume
                                </a>
                                <a href="{{ route('job_seeker.resume.download') }}" class="block w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download Resume
                                </a>
                                <a href="{{ route('job_seeker.resume.generate') }}" class="block w-full px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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