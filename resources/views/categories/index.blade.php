@extends('layouts.app')

@section('title', 'Browse Job Categories - CareerBridge')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
    <!-- Categories Header -->
    <section class="py-16" style="background-color: var(--primary-color);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Browse Job Categories</h1>
            <p class="text-xl text-white opacity-90 max-w-2xl mx-auto">
                Explore career opportunities across different industries and find the perfect job that matches your skills and interests.
            </p>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="py-16" style="background-color: var(--bg-light);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="categories-grid grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                @forelse($categories as $category)
                <a href="{{ route('categories.show', $category->slug ?? Str::slug($category->name)) }}" 
                   class="category-card relative bg-white rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300 group cursor-pointer block" 
                   style="border-radius: var(--border-radius); box-shadow: var(--shadow);">
                    <div class="relative h-48 bg-cover bg-center" 
                         style="background-image: url('{{ $category->image ? (str_starts_with($category->image, 'http') ? $category->image : asset($category->image)) : 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=400&h=300&fit=crop' }}');">
                        <div class="category-overlay absolute inset-0 bg-black bg-opacity-40 transition-all duration-300"></div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $category->jobs->count() }} jobs
                            </div>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="font-semibold text-lg mb-1">{{ $category->name }}</h3>
                            <p class="text-sm opacity-90">{{ $category->description ?? 'Explore jobs in this category' }}</p>
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-4 text-center py-12">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No categories available</h3>
                    <p class="text-gray-600">Categories will appear here once they are added.</p>
                </div>
                @endforelse
            </div>

            <!-- Categories Pagination -->
            @if($categories->hasPages())
            <div class="categories-pagination">
                {{-- Previous Page Link --}}
                @if ($categories->onFirstPage())
                    <span class="disabled">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </span>
                @else
                    <a href="{{ $categories->previousPageUrl() }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                    @if ($page == $categories->currentPage())
                        <span class="current-page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($categories->hasMorePages())
                    <a href="{{ $categories->nextPageUrl() }}">
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

            <!-- Categories Info -->
            <div class="text-center mt-4">
                <p class="text-sm" style="color: var(--text-light);">
                    Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} categories
                </p>
            </div>
            @endif
        </div>
    </section>
@endsection