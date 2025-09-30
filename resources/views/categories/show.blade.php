@extends('layouts.app')

@section('title', $category->name . ' Jobs - CareerBridge')

@section('content')
    <!-- Category Header -->
    <section class="py-16 relative overflow-hidden" style="background-color: var(--primary-color);">
        <div class="absolute inset-0 bg-cover bg-center opacity-20" 
             style="background-image: url('{{ $category->image ? (str_starts_with($category->image, 'http') ? $category->image : asset($category->image)) : 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=1920&h=600&fit=crop' }}');"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-4">{{ $category->name }} Jobs</h1>
                <p class="text-xl text-white opacity-90 max-w-2xl mx-auto mb-6">
                    {{ $category->description ?? 'Discover exciting career opportunities in ' . $category->name }}
                </p>
                <div class="inline-flex items-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3 text-white">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                    {{ $jobs->total() }} {{ Str::plural('job', $jobs->total()) }} available
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="py-4" style="background-color: var(--bg-light);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
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
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('categories.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Categories</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $category->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Jobs Listing -->
    <section class="py-16" style="background-color: var(--white);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($jobs->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    @foreach($jobs as $job)
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
                                <button class="border border-gray-300 px-3 py-2 rounded-lg text-xs font-medium transition-all duration-300" 
                                        style="color: var(--text-dark); border-radius: var(--border-radius);">
                                    {{ ucfirst(str_replace('-', ' ', $job->job_type)) }}
                                </button>
                                <a href="{{ route('employer.jobs.show', $job) }}" class="px-3 py-2 rounded-lg text-xs font-medium text-white transition-all duration-300 inline-flex items-center justify-center" style="background-color: var(--primary-color); border-radius: var(--border-radius);">
                                    Apply Now
                                </a>
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
                    @endforeach
                </div>

                <!-- Jobs Pagination -->
                @if($jobs->hasPages())
                <div class="categories-pagination">
                    {{-- Previous Page Link --}}
                    @if ($jobs->onFirstPage())
                        <span class="disabled">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $jobs->previousPageUrl() }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                        @if ($page == $jobs->currentPage())
                            <span class="current-page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($jobs->hasMorePages())
                        <a href="{{ $jobs->nextPageUrl() }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <span class="disabled">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    @endif
                </div>

                <!-- Jobs Info -->
                <div class="text-center mt-4">
                    <p class="text-sm" style="color: var(--text-light);">
                        Showing {{ $jobs->firstItem() ?? 0 }} to {{ $jobs->lastItem() ?? 0 }} of {{ $jobs->total() }} jobs
                    </p>
                </div>
                @endif
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full flex items-center justify-center" style="background-color: var(--bg-light);">
                        <svg class="w-12 h-12" style="color: var(--text-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No jobs available in {{ $category->name }}</h3>
                    <p class="text-gray-600 mb-6">Check back later for new opportunities in this category.</p>
                    <a href="{{ route('categories.index') }}" class="btn-primary px-6 py-3 rounded-lg font-semibold text-white transition-all duration-300">
                        Browse Other Categories
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection