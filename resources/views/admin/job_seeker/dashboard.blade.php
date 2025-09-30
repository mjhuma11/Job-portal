@extends('layouts.app')

@section('title', 'Job Seeker Dashboard - CareerBridge')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        <!-- Include Left Sidebar -->
        @include('admin.job_seeker.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-white shadow-lg border-b border-gray-100 px-6 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Job Seeker Dashboard</h1>
                        <nav class="text-sm text-gray-500 mt-2">
                            <span>Job Seeker</span>
                            <span class="mx-2">/</span>
                            <span>Dashboard</span>
                            <span class="mx-2">/</span>
                            <span class="text-teal-600 font-medium">Your Career Stats</span>
                        </nav>
                        <p class="text-gray-600 mt-2">Track your job search progress and discover new opportunities</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex items-center space-x-2 bg-gradient-to-r from-teal-500 to-teal-600 text-white px-4 py-2 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Updated just now</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="p-6">
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