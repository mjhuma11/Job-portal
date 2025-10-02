@extends('layouts.app')

@section('title', 'Analytics Dashboard - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Analytics Dashboard</h1>
                        <p class="text-gray-600 mt-1">Comprehensive overview of platform statistics</p>
                    </div>
                    <div class="flex space-x-2">
                        <select id="timeRange" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="7">Last 7 Days</option>
                            <option value="30" selected>Last 30 Days</option>
                            <option value="90">Last 90 Days</option>
                            <option value="365">Last Year</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($userStats['total']) }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        <span class="text-green-500">↑ 12%</span> from last month
                    </p>
                </div>

                <!-- Employers -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Employers</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($userStats['employers']) }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        <span class="text-green-500">↑ 8%</span> from last month
                    </p>
                </div>

                <!-- Job Seekers -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Job Seekers</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($userStats['job_seekers']) }}</p>
                        </div>
                        <div class="p-3 bg-amber-100 rounded-lg">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        <span class="text-green-500">↑ 5%</span> from last month
                    </p>
                </div>

                <!-- Active Jobs -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Jobs</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($jobStats['open']) }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        <span class="text-red-500">↓ 2%</span> from last month
                    </p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- User Growth Chart -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">User Growth</h3>
                    <canvas id="userGrowthChart" height="300"></canvas>
                </div>

                <!-- Job Statistics Chart -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Job Statistics</h3>
                    <canvas id="jobStatsChart" height="300"></canvas>
                </div>
            </div>

            <!-- Detailed Statistics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- User Distribution -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">User Distribution</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Admins</span>
                                <span class="text-sm font-medium text-gray-700">{{ $userStats['admins'] }} ({{ round(($userStats['admins'] / max($userStats['total'], 1)) * 100, 1) }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($userStats['admins'] / max($userStats['total'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Employers</span>
                                <span class="text-sm font-medium text-gray-700">{{ $userStats['employers'] }} ({{ round(($userStats['employers'] / max($userStats['total'], 1)) * 100, 1) }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($userStats['employers'] / max($userStats['total'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Job Seekers</span>
                                <span class="text-sm font-medium text-gray-700">{{ $userStats['job_seekers'] }} ({{ round(($userStats['job_seekers'] / max($userStats['total'], 1)) * 100, 1) }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-amber-600 h-2 rounded-full" style="width: {{ ($userStats['job_seekers'] / max($userStats['total'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Status Distribution -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Job Status Distribution</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Open</span>
                                <span class="text-sm font-medium text-gray-700">{{ $jobStats['open'] }} ({{ round(($jobStats['open'] / max($jobStats['total'], 1)) * 100, 1) }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($jobStats['open'] / max($jobStats['total'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Closed</span>
                                <span class="text-sm font-medium text-gray-700">{{ $jobStats['closed'] }} ({{ round(($jobStats['closed'] / max($jobStats['total'], 1)) * 100, 1) }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-600 h-2 rounded-full" style="width: {{ ($jobStats['closed'] / max($jobStats['total'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Draft</span>
                                <span class="text-sm font-medium text-gray-700">{{ $jobStats['draft'] }} ({{ round(($jobStats['draft'] / max($jobStats['total'], 1)) * 100, 1) }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-600 h-2 rounded-full" style="width: {{ ($jobStats['draft'] / max($jobStats['total'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Featured</span>
                                <span class="text-sm font-medium text-gray-700">{{ $jobStats['featured'] }} ({{ round(($jobStats['featured'] / max($jobStats['total'], 1)) * 100, 1) }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: {{ ($jobStats['featured'] / max($jobStats['total'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category and Location Stats -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Top Categories -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Top Job Categories</h3>
                    <div class="space-y-3">
                        @forelse($categoryStats as $category)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @if($category->icon)
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    {!! $category->icon !!}
                                </div>
                                @endif
                                <span class="ml-3 text-sm font-medium text-gray-900">{{ $category->name }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $category->jobs_count }}</span>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4">No category data available</p>
                        @endforelse
                    </div>
                </div>

                <!-- Top Locations -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Top Job Locations</h3>
                    <div class="space-y-3">
                        @forelse($locationStats as $location)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-900">{{ $location->city }}, {{ $location->country }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $location->jobs_count }}</span>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4">No location data available</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // User Growth Chart
    const userCtx = document.getElementById('userGrowthChart').getContext('2d');
    const userGrowthChart = new Chart(userCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Users',
                data: [120, 190, 130, 190, 220, 250, 210, 280, 240, 300, 320, 350],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'New Employers',
                data: [30, 45, 35, 50, 60, 70, 65, 80, 75, 90, 95, 100],
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'New Job Seekers',
                data: [90, 145, 95, 140, 160, 180, 145, 200, 165, 210, 225, 250],
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Job Statistics Chart
    const jobCtx = document.getElementById('jobStatsChart').getContext('2d');
    const jobStatsChart = new Chart(jobCtx, {
        type: 'bar',
        data: {
            labels: ['Open', 'Closed', 'Draft', 'Featured'],
            datasets: [{
                label: 'Job Count',
                data: [{{ $jobStats['open'] }}, {{ $jobStats['closed'] }}, {{ $jobStats['draft'] }}, {{ $jobStats['featured'] }}],
                backgroundColor: [
                    '#10b981',
                    '#ef4444',
                    '#f59e0b',
                    '#8b5cf6'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush
@endsection