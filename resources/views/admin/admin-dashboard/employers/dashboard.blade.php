@extends('layouts.app')

@section('title', 'Employer Dashboard - CareerBridge')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <!-- Dashboard Container -->
    <div class="flex">
        @include('admin.employers.partials.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <span>Employer</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span>Dashboard</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-teal-600">Employer Dashboard</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Employer Dashboard</h1>
                <p class="text-gray-600 mt-1">Welcome back! Here's what's happening with your job posts today.</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Posted Jobs -->
                <div class="bg-green rounded-xl p-6 shadow-lg transform transition-all duration-300 hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-gray">{{ $stats['posted_jobs'] }}</div>
                            <div class="text-sm text-blue-100">Posted Jobs</div>
                        </div>
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-blue-100 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            <span>12% increase from last month</span>
                        </div>
                    </div>
                </div>

                <!-- Total Applications -->
                <div class="bg-green-500 rounded-xl p-6 shadow-lg transform transition-all duration-300 hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-white">{{ $stats['total_applications'] }}</div>
                            <div class="text-sm text-green-100">Total Applications</div>
                        </div>
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-green-100 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            <span>8% increase from last month</span>
                        </div>
                    </div>
                </div>

                <!-- Shortlisted Candidates -->
                <div class="bg-amber-500 rounded-xl p-6 shadow-lg transform transition-all duration-300 hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-gray-900">{{ $stats['shortlisted_candidates'] }}</div>
                            <div class="text-sm text-amber-100">Shortlisted</div>
                        </div>
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-amber-100 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            <span>5% increase from last month</span>
                        </div>
                    </div>
                </div>

                <!-- Hired Candidates -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 shadow-lg transform transition-all duration-300 hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-white">{{ $stats['hired_candidates'] }}</div>
                            <div class="text-sm text-purple-100">Hired</div>
                        </div>
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-purple-100 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            <span>3% increase from last month</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Jobs and Applications -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Recent Jobs -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-teal-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">Recent Job Posts</h3>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Live</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">Your most recent job postings</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentJobs as $job)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-blue-50 transition-all duration-200">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $job['title'] }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $job['applications'] }} applications</p>
                                    <p class="text-xs text-gray-500 mt-1">Posted: {{ $job['posted_date'] }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full {{ $job['status'] === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $job['status'] }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">Deadline: {{ $job['deadline'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('employer.jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300">
                                View all jobs
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Applications -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">Recent Applications</h3>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">New</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">Latest candidate applications</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentApplications as $application)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-purple-50 transition-all duration-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ substr($application['candidate_name'], 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $application['candidate_name'] }}</h4>
                                        <p class="text-sm text-gray-600">{{ $application['job_title'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $application['experience'] }} • Applied: {{ $application['applied_date'] }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full 
                                        @if($application['status'] === 'Under Review') bg-yellow-100 text-yellow-800
                                        @elseif($application['status'] === 'Shortlisted') bg-blue-100 text-blue-800
                                        @elseif($application['status'] === 'Interview Scheduled') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $application['status'] }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('employer.applications.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-medium rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300">
                                View all applications
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div id="categoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-screen overflow-y-auto">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Add New Category</h3>
            <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form id="addCategoryForm" action="{{ route('employer.categories.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="space-y-4">
                <!-- Name -->
                <div>
                    <label for="modal_name" class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
                    <input type="text" id="modal_name" name="name" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" 
                           placeholder="Enter category name" required>
                </div>

                <!-- Description -->
                <div>
                    <label for="modal_description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="modal_description" name="description" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" 
                              placeholder="Enter category description"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Icon -->
                    <div>
                        <label for="modal_icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (HTML/Unicode)</label>
                        <input type="text" id="modal_icon" name="icon" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" 
                               placeholder="e.g. 🏢 or <i class='fas fa-building'></i>">
                        <p class="mt-1 text-xs text-gray-500">Enter HTML icon code or Unicode emoji</p>
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="modal_image" class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
                        <input type="file" id="modal_image" name="image" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <p class="mt-1 text-xs text-gray-500">Upload an image for the category (optional)</p>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="modal_status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                    <select id="modal_status" name="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeCategoryModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Handle form submission via AJAX
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('addCategoryForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                
                // Show loading state
                submitButton.innerHTML = 'Creating...';
                submitButton.disabled = true;
                
                // Get form data
                const formData = new FormData(form);
                
                // Submit via AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        // If not JSON, it's probably an HTML error page
                        throw new Error('Server returned an unexpected response. Please refresh the page and try again.');
                    }
                })
                .then(data => {
                    if (data.success) {
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Close modal
                            closeCategoryModal();
                            // Reset form
                            form.reset();
                            // Optionally reload the page or update UI
                            location.reload();
                        });
                    } else {
                        // Handle validation errors
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Error creating category. Please check the form.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'An error occurred while creating the category. Please refresh the page and try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                })
                .finally(() => {
                    // Reset button state
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                });
            });
        }
        
        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('categoryModal');
            const modalContent = document.querySelector('#categoryModal .bg-white');
            
            if (modal && !modal.classList.contains('hidden') && modalContent && !modalContent.contains(event.target)) {
                closeCategoryModal();
            }
        });
    });
</script>

@endsection