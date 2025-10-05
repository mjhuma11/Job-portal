@extends('layouts.app')

@section('title', 'Job Seeker Dashboard - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="flex">
        <!-- Include Left Sidebar -->
        @include('admin.job_seeker.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Enhanced Header with Solid Colors -->
            <div class="bg-white shadow-lg border-b border-gray-200 px-8 py-8 sticky top-0 z-10">
                <div class="flex items-center justify-between">
                    <div class="space-y-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-4xl font-bold text-gray-900">
                                    Welcome Back, {{ auth()->user()->name }}!
                                </h1>
                                <p class="text-gray-600 text-lg">Ready to find your dream job today?</p>
                            </div>
                        </div>
                        <nav class="flex items-center space-x-2 text-sm text-gray-500">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-medium">Job Seeker</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full font-medium">Dashboard</span>
                        </nav>
                    </div>
                    <div class="hidden lg:flex items-center space-x-4">
                        <div class="flex items-center space-x-3 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg">
                            <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
                            <span class="font-semibold">Live Updates</span>
                        </div>
                        <button class="p-3 bg-gray-200 rounded-lg hover:bg-gray-300 transition-all duration-300 shadow-lg">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM4 15h8v-2H4v2zM4 11h8V9H4v2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content with Enhanced Spacing -->
            <div class="p-8 space-y-8">
                <!-- Include Statistics -->
                @include('admin.job_seeker.partials.statistics')

                <!-- Include Charts and Notifications -->
                @include('admin.job_seeker.partials.charts-notifications')

                <!-- Include Shortlisted Jobs -->
                @include('admin.job_seeker.partials.shortlisted-jobs')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if Chart.js is loaded
    if (typeof Chart === 'undefined') {
        console.error('Chart.js not loaded');
        return;
    }
    
    // Sales Chart
    const ctx = document.getElementById('salesChart');
    if (ctx) {
        try {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Applications',
                        data: [20, 35, 25, 45, 35, 55, 45],
                        borderColor: '#06afaa',
                        backgroundColor: 'rgba(6, 175, 170, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Interviews',
                        data: [15, 25, 35, 30, 45, 35, 50],
                        borderColor: '#ffae00',
                        backgroundColor: 'rgba(255, 174, 0, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Offers',
                        data: [5, 10, 15, 20, 25, 20, 30],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: '#172029',
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                color: '#586566'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                color: '#586566'
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error initializing chart:', error);
        }
    } else {
        console.warn('Chart canvas not found');
    }
});
</script>
@endpush