@extends('layouts.app')

@section('title', 'CareerBridge - Find Your Career to Make a Better Life')

@section('content')
    <!-- Hero Section with Carousel -->
    <section class="hero-section py-8 relative overflow-hidden" id="heroSection">
        <!-- Dynamic Background Images -->
        <div class="absolute inset-0 transition-opacity duration-1000 opacity-100 bg-cover bg-center bg-no-repeat" 
             id="bg1" style="background-image: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.8)), url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=1920&h=1080&fit=crop');"></div>
        <div class="absolute inset-0 transition-opacity duration-1000 opacity-0 bg-cover bg-center bg-no-repeat" 
             id="bg2" style="background-image: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.8)), url('https://images.unsplash.com/photo-1560472355-536de3962603?w=1920&h=1080&fit=crop');"></div>
        <div class="absolute inset-0 transition-opacity duration-1000 opacity-0 bg-cover bg-center bg-no-repeat" 
             id="bg3" style="background-image: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.8)), url('https://images.unsplash.com/photo-1553877522-43269d4ea984?w=1920&h=1080&fit=crop');"></div>
        
        <!-- Decorative Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-8 left-4 w-32 h-32 rounded-full" style="background: var(--accent-color);"></div>
            <div class="absolute bottom-8 right-4 w-40 h-40 rounded-full" style="background: var(--secondary-color);"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 h-full">
            <!-- Single Content Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-center h-full">
                <!-- Hero Content -->
                <div class="hero-content space-y-4">
                    <div class="carousel-content">
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight text-white transition-all duration-500" id="heroTitle">
                            Find Your Career to 
                            <span style="color: var(--accent-color);">Make a Better Life</span>
                        </h1>
                        <p class="text-base lg:text-lg opacity-90 transition-all duration-500" style="color: var(--bg-light);" id="heroDescription">
                            Discover thousands of job opportunities with all the information you need. 
                            Connect with top employers and take the next step in your career journey.
                        </p>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button class="btn-accent px-5 py-2.5 rounded-lg font-semibold text-white transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105" id="primaryBtn">
                            Find Jobs
                        </button>
                        <button class="border-2 border-white text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-white transition-all duration-300" 
                                style="hover:color: var(--primary-color);" id="secondaryBtn">
                            Upload Resume
                        </button>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-4">
                        <div class="text-center">
                            <div class="text-xl lg:text-2xl font-bold text-white" id="stat1Number">500</div>
                            <div class="text-xs opacity-80" style="color: var(--bg-light);" id="stat1Label">Companies</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl lg:text-2xl font-bold text-white" id="stat2Number">98%</div>
                            <div class="text-xs opacity-80" style="color: var(--bg-light);" id="stat2Label">Success Rate</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl lg:text-2xl font-bold text-white" id="stat3Number">24/7</div>
                            <div class="text-xs opacity-80" style="color: var(--bg-light);" id="stat3Label">Support</div>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Image -->
                <div class="hero-image">
                    <img src="{{asset('assets/images/corporategirl.jpg')}}" alt="Hero Image" class="w-full h-full object-cover object-center rounded-lg">
                </div>
            </div>


              
            <!-- Carousel Navigation -->
            <div class="absolute top-1/2 left-4 transform -translate-y-1/2">
                <button id="prevBtn" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm rounded-full p-2 transition-all duration-300">
                    <!-- <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg> -->
                </button>
            </div>
            <div class="absolute top-1/2 right-4 transform -translate-y-1/2">
                <button id="nextBtn" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm rounded-full p-2 transition-all duration-300">
                    <!-- <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg> -->
                </button>
            </div>

            <!-- Carousel Indicators -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <button class="carousel-indicator active w-2.5 h-2.5 rounded-full transition-all duration-300" style="background-color: var(--accent-color);" data-slide="0"></button>
                <button class="carousel-indicator w-2.5 h-2.5 rounded-full bg-white bg-opacity-50 hover:bg-opacity-75 transition-all duration-300" data-slide="1"></button>
                <button class="carousel-indicator w-2.5 h-2.5 rounded-full bg-white bg-opacity-50 hover:bg-opacity-75 transition-all duration-300" data-slide="2"></button>
            </div>
        </div>
    </section>

    <!-- Job Search Bar -->
    <section class="py-8" style="background-color: var(--white); box-shadow: var(--shadow);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl p-6" style="background-color: var(--bg-light); border-radius: var(--border-radius);">
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input type="text" placeholder="Job title, keywords..." 
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 transition-all duration-300" 
                               style="border-color: #ddd; border-radius: var(--border-radius); focus:ring-color: var(--primary-color);">
                    </div>
                    <div>
                        <select class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 transition-all duration-300" 
                                style="border-color: #ddd; border-radius: var(--border-radius); focus:ring-color: var(--primary-color);">
                            <option>All Locations</option>
                            <option>New York</option>
                            <option>San Francisco</option>
                            <option>London</option>
                            <option>Remote</option>
                        </select>
                    </div>
                    <div>
                        <select class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 transition-all duration-300" 
                                style="border-color: #ddd; border-radius: var(--border-radius); focus:ring-color: var(--primary-color);">
                            <option>All Categories</option>
                            <option>Technology</option>
                            <option>Marketing</option>
                            <option>Design</option>
                            <option>Sales</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn-primary w-full px-6 py-3 rounded-lg font-semibold text-white transition-all duration-300">
                            Search Jobs
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Create Profile CTA -->
    <section class="py-16" style="background-color: var(--primary-color);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Create your profile in few seconds</h2>
            <p class="text-xl mb-8" style="color: var(--bg-light);">Get discovered by top employers and land your dream job</p>
            <button class="bg-white px-8 py-4 rounded-lg font-semibold transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105" 
                    style="color: var(--primary-color); border-radius: var(--border-radius);">
                Create Profile
            </button>
        </div>
    </section>

    <!-- Browse by Categories -->
    <section class="py-16" style="background-color: var(--bg-light);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4" style="color: var(--text-dark);">Browse by Categories</h2>
                <p style="color: var(--text-light);" class="max-w-2xl mx-auto">Find the career you deserve in your preferred industry</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $category)
                <div class="relative bg-white rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300 group cursor-pointer" 
                     style="border-radius: var(--border-radius); box-shadow: var(--shadow);">
                    <div class="relative h-48 bg-cover bg-center" 
                         style="background-image: url('{{ $category->image ? asset($category->image) : 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=400&h=300&fit=crop' }}');">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $category->jobs->count() }}
                            </div>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="font-semibold text-lg mb-1">{{ $category->name }}</h3>
                            <p class="text-sm opacity-90">{{ $category->description ?? 'Jobs in this category' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Recent Jobs Section -->
    <section class="py-16" style="background-color: var(--white);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="inline-block px-4 py-2 rounded-full text-sm font-semibold text-white mb-4" 
                     style="background-color: var(--secondary-color);">
                    HOT JOBS
                </div>
                <h2 class="text-3xl font-bold mb-4" style="color: var(--text-dark);">Browse Recent Jobs</h2>
                <p style="color: var(--text-light);" class="max-w-2xl mx-auto">Discover the latest job opportunities from top companies</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                @forelse($recentJobs as $job)
                <div class="bg-white rounded-xl p-6 border transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105 group" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius); border-color: #e5e7eb;">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center mr-4" 
                                 style="background-color: rgba(44, 62, 80, 0.1);">
                                @if($job->company && $job->company->logo)
                                    <img src="{{ asset($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-8 h-8 object-contain">
                                @else
                                    <span class="text-xl font-bold" style="color: var(--primary-color);">{{ substr($job->company->name ?? 'C', 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg" style="color: var(--text-dark);">{{ $job->job_title }}</h3>
                                <p class="text-sm" style="color: var(--text-light);">{{ $job->company->name ?? 'Company Name' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2 flex-wrap">
                            <!-- Job Type Button -->
                            <button class="border border-gray-300 px-3 py-2 rounded-lg text-xs font-medium transition-all duration-300" 
                                    style="color: var(--text-dark); border-radius: var(--border-radius);">
                                {{ ucfirst(str_replace('-', ' ', $job->job_type)) }}
                            </button>
                            
                            <!-- View Button -->
                            <a href="{{ route('employer.jobs.show', $job) }}" class="border border-blue-300 bg-blue-50 hover:bg-blue-100 px-3 py-2 rounded-lg text-xs font-medium text-blue-700 transition-all duration-300 inline-flex items-center justify-center">
                                View
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            
                            <!-- Apply Now Button - Always Show -->
                            @if(auth()->check())
                                @if(auth()->user()->isJobSeeker())
                                    @if(auth()->user()->jobSeeker)
                                        <!-- Job Seeker with Profile - Direct Apply -->
                                        <a href="{{ route('job_seeker.jobs.apply', $job) }}" class="px-3 py-2 rounded-lg text-xs font-medium text-white transition-all duration-300 inline-flex items-center justify-center" style="background-color: var(--primary-color); border-radius: var(--border-radius);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                            Apply Now
                                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <!-- Job Seeker without Profile - Complete Profile First -->
                                        <a href="{{ route('job_seeker.profile.edit') }}" class="px-3 py-2 rounded-lg text-xs font-medium text-white transition-all duration-300 inline-flex items-center justify-center" style="background-color: var(--primary-color); border-radius: var(--border-radius);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                            Apply Now
                                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                @elseif(auth()->user()->isEmployer())
                                    <!-- Employer - Show Apply Button but Disabled -->
                                    <span class="bg-gray-400 px-3 py-2 rounded-lg text-xs font-medium text-white cursor-not-allowed inline-flex items-center justify-center">
                                        Apply Now
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                        </svg>
                                    </span>
                                @else
                                    <!-- Other User Types - Direct Apply -->
                                    <a href="{{ route('job_seeker.jobs.apply', $job) }}" class="px-3 py-2 rounded-lg text-xs font-medium text-white transition-all duration-300 inline-flex items-center justify-center" style="background-color: var(--primary-color); border-radius: var(--border-radius);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                        Apply Now
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                @endif
                            @else
                                <!-- Guest User - Login to Apply -->
                                <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg text-xs font-medium text-white transition-all duration-300 inline-flex items-center justify-center" style="background-color: var(--primary-color); border-radius: var(--border-radius);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                    Apply Now
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                    <p class="text-sm mb-4" style="color: var(--text-light);">
                        {{ Str::limit($job->description, 150) }}
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t" style="border-color: #e5e7eb;">
                        <span class="text-sm" style="color: var(--text-light);">{{ $job->company->website ?? 'company.com' }}</span>
                        <div class="flex items-center gap-4">
                            <span class="font-semibold" style="color: var(--secondary-color);">
                                {{ $job->salary ?? 'Negotiable' }}
                            </span>
                            <span class="text-sm" style="color: var(--text-light);">
                                📍 {{ $job->location ?? 'Location' }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-2 text-center py-12">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No jobs available yet</h3>
                    <p class="text-gray-600 mb-4">Be the first to post a job!</p>
                    <a href="{{ route('employer.jobs.create') }}" class="btn-primary px-6 py-3 rounded-lg font-semibold text-white transition-all duration-300">
                        Post New Job
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-center space-x-2">
                <button class="w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center transition-all duration-300 hover:bg-gray-50" 
                        style="border-radius: var(--border-radius);">
                    <svg class="w-5 h-5" style="color: var(--text-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="w-10 h-10 rounded-lg flex items-center justify-center font-semibold text-white transition-all duration-300" 
                        style="background-color: var(--primary-color); border-radius: var(--border-radius);">
                    1
                </button>
                <button class="w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center transition-all duration-300 hover:bg-gray-50" 
                        style="color: var(--text-dark); border-radius: var(--border-radius);">
                    2
                </button>
                <button class="w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center transition-all duration-300 hover:bg-gray-50" 
                        style="color: var(--text-dark); border-radius: var(--border-radius);">
                    3
                </button>
                <span class="px-2" style="color: var(--text-light);">...</span>
                <button class="w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center transition-all duration-300 hover:bg-gray-50" 
                        style="color: var(--text-dark); border-radius: var(--border-radius);">
                    10
                </button>
                <button class="w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center transition-all duration-300 hover:bg-gray-50" 
                        style="border-radius: var(--border-radius);">
                    <svg class="w-5 h-5" style="color: var(--text-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Jobs -->
    <section class="py-16" style="background-color: var(--bg-light);" id="jobs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4" style="color: var(--text-dark);">Featured Jobs</h2>
                <p style="color: var(--text-light);">Discover amazing opportunities from top companies</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Featured Job Card 1 - Graphics Design -->
                <div class="bg-white rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105 group" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="relative h-48 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1561736778-92e52a7769ef?w=400&h=300&fit=crop');">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-semibold">FEATURED</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-4" style="color: var(--text-dark);">Graphics Design</h3>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                New York
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Full-time
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                80K-90K
                            </div>
                        </div>
                        <p class="text-sm mb-6" style="color: var(--text-light);">We are looking for Enrollment Advisors who are looking to take 30-35 appointments per week. All leads are pre-scheduled.</p>
                        <div class="flex items-center gap-3">
                            <button class="flex-1 bg-blue-600 text-white px-4 py-3 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700">Apply Now</button>
                            <button class="flex items-center justify-center w-12 h-12 border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50" style="border-radius: var(--border-radius);">
                                <svg class="w-5 h-5" style="color: var(--text-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Featured Job Card 2 - Restaurant Services -->
                <div class="bg-white rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105 group" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="relative h-48 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400&h=300&fit=crop');">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-semibold">FEATURED</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-4" style="color: var(--text-dark);">Restaurant Services</h3>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                New York
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Full-time
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                80K-90K
                            </div>
                        </div>
                        <p class="text-sm mb-6" style="color: var(--text-light);">We are looking for Enrollment Advisors who are looking to take 30-35 appointments per week. All leads are pre-scheduled.</p>
                        <div class="flex items-center gap-3">
                            <button class="flex-1 bg-blue-600 text-white px-4 py-3 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700">Apply Now</button>
                            <button class="flex items-center justify-center w-12 h-12 border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50" style="border-radius: var(--border-radius);">
                                <svg class="w-5 h-5" style="color: var(--text-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Featured Job Card 3 - Share Market Analysis -->
                <div class="bg-white rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105 group" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="relative h-48 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop');">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-semibold">FEATURED</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-4" style="color: var(--text-dark);">Share Market Analysis</h3>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                New York
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Full-time
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                80K-90K
                            </div>
                        </div>
                        <p class="text-sm mb-6" style="color: var(--text-light);">We are looking for Enrollment Advisors who are looking to take 30-35 appointments per week. All leads are pre-scheduled.</p>
                        <div class="flex items-center gap-3">
                            <button class="flex-1 bg-blue-600 text-white px-4 py-3 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700">Apply Now</button>
                            <button class="flex items-center justify-center w-12 h-12 border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50" style="border-radius: var(--border-radius);">
                                <svg class="w-5 h-5" style="color: var(--text-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="btn-primary px-8 py-3 rounded-lg font-semibold text-white transition-all duration-300">
                    View All Jobs
                </button>
            </div>
        </div>
    </section>

    <!-- Pricing Plans Section -->
    <section class="py-16" style="background-color: var(--bg-light);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4" style="color: var(--text-dark);">Our Pricing Plans</h2>
                <p style="color: var(--text-light);" class="max-w-2xl mx-auto">Choose the perfect plan that fits your needs and budget</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Basic Pack -->
                <div class="bg-white rounded-xl p-8 transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold mb-4" style="color: var(--text-dark);">BASIC PACK</h3>
                        <div class="mb-2">
                            <span class="text-4xl font-bold" style="color: var(--text-dark);">tk30</span>
                            <span class="text-lg" style="color: var(--text-light);">per month</span>
                        </div>
                    </div>
                    
                    <!-- Features List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">5+ Listings</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">Contact With Agent</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">Contact With Agent</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">7×24 Fully Support</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">50GB Space</span>
                        </div>
                    </div>
                    
                    <!-- Register Button -->
                    <button class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700" 
                            style="border-radius: var(--border-radius);">
                        Register Now
                    </button>
                </div>

                <!-- Standard Pack -->
                <div class="bg-white rounded-xl p-8 transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold mb-4" style="color: var(--text-dark);">STANDARD PACK</h3>
                        <div class="mb-2">
                            <span class="text-4xl font-bold" style="color: var(--text-dark);">tk40</span>
                            <span class="text-lg" style="color: var(--text-light);">per month</span>
                        </div>
                    </div>
                    
                    <!-- Features List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">5+ Listings</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">Contact With Agent</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">Contact With Agent</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">7×24 Fully Support</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">50GB Space</span>
                        </div>
                    </div>
                    
                    <!-- Register Button -->
                    <button class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700" 
                            style="border-radius: var(--border-radius);">
                        Register Now
                    </button>
                </div>

                <!-- Premium Pack -->
                <div class="bg-white rounded-xl p-8 transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold mb-4" style="color: var(--text-dark);">PREMIUM PACK</h3>
                        <div class="mb-2">
                            <span class="text-4xl font-bold" style="color: var(--text-dark);">tk60</span>
                            <span class="text-lg" style="color: var(--text-light);">per month</span>
                        </div>
                    </div>
                    
                    <!-- Features List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">5+ Listings</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">Contact With Agent</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">Contact With Agent</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">7×24 Fully Support</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded-sm flex items-center justify-center mr-3" style="background-color: #4f46e5;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: var(--text-dark);">50GB Space</span>
                        </div>
                    </div>
                    
                    <!-- Register Button -->
                    <button class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700" 
                            style="border-radius: var(--border-radius);">
                        Register Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News/Blog/Job Tips Section -->
    <section class="py-16" style="background-color: var(--white);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4" style="color: var(--text-dark);">Latest News & Job Tips</h2>
                <p style="color: var(--text-light);" class="max-w-2xl mx-auto">Stay updated with career advice, CV tips, and industry insights to boost your job search</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Blog Card 1 - Job Skills -->
                <div class="bg-white rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="relative h-48 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=300&fit=crop');">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-4" style="color: var(--text-dark);">The Internet Is A Job Seeker Most Crucial Success</h3>
                        
                        <!-- Meta Information -->
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center text-sm">
                                <div class="w-4 h-4 rounded-sm flex items-center justify-center mr-2" style="background-color: #4f46e5;">
                                    <svg class="w-2 h-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span style="color: var(--primary-color);">Job Skills</span>
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                12-09-2023
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                55
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-sm mb-6" style="color: var(--text-light);">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard.</p>
                        
                        <!-- Read More Button -->
                        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700" 
                                style="border-radius: var(--border-radius);">
                            Read More
                        </button>
                    </div>
                </div>

                <!-- Blog Card 2 - Career Advice -->
                <div class="bg-white rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="relative h-48 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=400&h=300&fit=crop');">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-4" style="color: var(--text-dark);">Today From Connecting With Potential Employers</h3>
                        
                        <!-- Meta Information -->
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center text-sm">
                                <div class="w-4 h-4 rounded-sm flex items-center justify-center mr-2" style="background-color: #4f46e5;">
                                    <svg class="w-2 h-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span style="color: var(--primary-color);">Career Advice</span>
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                10-10-2023
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                55
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-sm mb-6" style="color: var(--text-light);">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard.</p>
                        
                        <!-- Read More Button -->
                        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700" 
                                style="border-radius: var(--border-radius);">
                            Read More
                        </button>
                    </div>
                </div>

                <!-- Blog Card 3 - Future Plan -->
                <div class="bg-white rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:transform hover:scale-105" 
                     style="box-shadow: var(--shadow); border-radius: var(--border-radius);">
                    <div class="relative h-48 bg-cover bg-center" 
                         style="background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=400&h=300&fit=crop');">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-4" style="color: var(--text-dark);">We've Weeded Through Hundreds Of Job Hunting</h3>
                        
                        <!-- Meta Information -->
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center text-sm">
                                <div class="w-4 h-4 rounded-sm flex items-center justify-center mr-2" style="background-color: #4f46e5;">
                                    <svg class="w-2 h-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span style="color: var(--primary-color);">Future Plan</span>
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                09-05-2023
                            </div>
                            <div class="flex items-center text-sm" style="color: var(--text-light);">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                55
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-sm mb-6" style="color: var(--text-light);">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard.</p>
                        
                        <!-- Read More Button -->
                        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700" 
                                style="border-radius: var(--border-radius);">
                            Read More
                        </button>
                    </div>
                </div>
            </div>

            <!-- View All Posts Button -->
            <div class="text-center mt-12">
                <button class="btn-primary px-8 py-3 rounded-lg font-semibold text-white transition-all duration-300">
                    View All Posts
                </button>
            </div>
        </div>
    </section>
     <!-- Mobile App Download -->
        <div class="border-t border-gray-700 mt-8 pt-8">
            <div class="text-center">
                <h3 class="font-semibold text-xl mb-4 text-black">Download Our Mobile App</h3>
                <p class="mb-6" style="color: var(--text-light);">
                    Take your job search on the go with our mobile app
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="inline-flex items-center px-6 py-3 rounded-lg transition-all duration-300 hover:transform hover:scale-105" 
                       style="background-color: var(--white); color: var(--text-dark);">
                        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                        </svg>
                        <div class="text-left">
                            <div class="text-xs">Download on the</div>
                            <div class="font-semibold">App Store</div>
                        </div>
                    </a>
                    <a href="#" class="inline-flex items-center px-6 py-3 rounded-lg transition-all duration-300 hover:transform hover:scale-105" 
                       style="background-color: var(--white); color: var(--text-dark);">
                        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 0 1-.61-.92V2.734a1 1 0 0 1 .609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 0 1 0 1.73l-2.808 1.626L15.699 12l1.999-2.491zM5.864 2.658L16.802 8.99 14.5 11.293 5.864 2.658z"/>
                        </svg>
                        <div class="text-left">
                            <div class="text-xs">Get it on</div>
                            <div class="font-semibold">Google Play</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
@endsection