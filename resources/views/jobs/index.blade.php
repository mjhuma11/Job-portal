@extends('layouts.app')

@section('title', 'Browse Jobs - CareerBridge')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Find Your Dream Job</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Browse through thousands of job opportunities and take the next step in your career journey
            </p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">Keywords</label>
                    <input type="text" id="keyword" name="keyword" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Job title, skills, etc.">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" id="location" name="location" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="City, state, etc.">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select id="category" name="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">All Categories</option>
                        <option value="technology">Technology</option>
                        <option value="healthcare">Healthcare</option>
                        <option value="finance">Finance</option>
                        <option value="education">Education</option>
                        <option value="marketing">Marketing</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300">
                        Search Jobs
                    </button>
                </div>
            </form>
        </div>

        <!-- Job Listings -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Job Count -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Latest Jobs</h2>
                    <p class="text-gray-600">Showing 12 of 142 jobs</p>
                </div>

                <!-- Job Cards -->
                <div class="space-y-6">
                    <!-- Sample Job Card 1 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold text-lg">T</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900">Senior Frontend Developer</h3>
                                        <p class="text-gray-700 mt-1">Tech Innovations Inc.</p>
                                        <div class="flex flex-wrap items-center gap-2 mt-2">
                                            <span class="inline-flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                San Francisco, CA
                                            </span>
                                            <span class="inline-flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                $90,000 - $120,000
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-0 flex flex-col items-end">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        Full-time
                                    </span>
                                    <span class="text-sm text-gray-500 mt-2">2 days ago</span>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    JavaScript
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    React
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    CSS
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    HTML
                                </span>
                            </div>
                            <div class="mt-6 flex justify-between items-center">
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                                    View Details
                                </a>
                                <button class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sample Job Card 2 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold text-lg">H</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900">Healthcare Data Analyst</h3>
                                        <p class="text-gray-700 mt-1">HealthPlus Medical Group</p>
                                        <div class="flex flex-wrap items-center gap-2 mt-2">
                                            <span class="inline-flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                New York, NY
                                            </span>
                                            <span class="inline-flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                $75,000 - $95,000
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-0 flex flex-col items-end">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        Full-time
                                    </span>
                                    <span class="text-sm text-gray-500 mt-2">1 week ago</span>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    SQL
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Python
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Tableau
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Healthcare
                                </span>
                            </div>
                            <div class="mt-6 flex justify-between items-center">
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                                    View Details
                                </a>
                                <button class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sample Job Card 3 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="bg-gradient-to-r from-amber-500 to-orange-600 w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold text-lg">F</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900">Financial Advisor</h3>
                                        <p class="text-gray-700 mt-1">FinanceFirst Corporation</p>
                                        <div class="flex flex-wrap items-center gap-2 mt-2">
                                            <span class="inline-flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Chicago, IL
                                            </span>
                                            <span class="inline-flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                $60,000 - $100,000
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-0 flex flex-col items-end">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                                        Part-time
                                    </span>
                                    <span class="text-sm text-gray-500 mt-2">3 days ago</span>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Financial Planning
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Investment
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Client Relations
                                </span>
                            </div>
                            <div class="mt-6 flex justify-between items-center">
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                                    View Details
                                </a>
                                <button class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-10 flex justify-center">
                    <nav class="inline-flex rounded-md shadow">
                        <a href="#" class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-100">
                            1
                        </a>
                        <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            2
                        </a>
                        <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            3
                        </a>
                        <span class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500">
                            ...
                        </span>
                        <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            15
                        </a>
                        <a href="#" class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            Next
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Job Categories -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Job Categories</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-700 hover:text-blue-600">
                                <span>Technology</span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">24</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-700 hover:text-blue-600">
                                <span>Healthcare</span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">18</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-700 hover:text-blue-600">
                                <span>Finance</span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">15</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-700 hover:text-blue-600">
                                <span>Education</span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-700 hover:text-blue-600">
                                <span>Marketing</span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">9</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-gray-700 hover:text-blue-600">
                                <span>Design</span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">7</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Job Types -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Job Types</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-center text-gray-700 hover:text-blue-600">
                                <input type="checkbox" class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                                <span class="ml-3">Full-time</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-700 hover:text-blue-600">
                                <input type="checkbox" class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                                <span class="ml-3">Part-time</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-700 hover:text-blue-600">
                                <input type="checkbox" class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                                <span class="ml-3">Remote</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-700 hover:text-blue-600">
                                <input type="checkbox" class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                                <span class="ml-3">Contract</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-700 hover:text-blue-600">
                                <input type="checkbox" class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                                <span class="ml-3">Internship</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Salary Range -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Salary Range</h3>
                    <div class="mb-4">
                        <input type="range" min="0" max="200000" step="1000" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    </div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>$0</span>
                        <span>$200,000+</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection