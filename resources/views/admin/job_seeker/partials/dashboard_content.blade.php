<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Applied Jobs</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_applications'] ?? 1 }}</p>
                <p class="text-sm text-gray-500 mt-1">Total applications</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center">
            <span class="text-green-600 text-sm font-medium">Active</span>
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Saved Jobs</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['saved_jobs'] ?? 0 }}</p>
                <p class="text-sm text-gray-500 mt-1">Saved for later</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center">
            <span class="text-yellow-600 text-sm font-medium">Bookmarked</span>
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Profile Views</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['profile_views'] ?? 0 }}</p>
                <p class="text-sm text-gray-500 mt-1">Employer views</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center">
            <span class="text-green-600 text-sm font-medium">Trending</span>
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Interviews</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['upcoming_interviews'] ?? 0 }}</p>
                <p class="text-sm text-gray-500 mt-1">Scheduled meetings</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center">
            <span class="text-purple-600 text-sm font-medium">Upcoming</span>
        </div>
    </div>
</div>

<!-- Career Analytics and Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Career Analytics Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Career Analytics</h3>
            <div class="flex items-center space-x-4">
                <button class="px-3 py-1 bg-purple-100 text-purple-700 rounded-lg text-sm font-medium">Monthly</button>
                <button class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-lg text-sm">Yearly</button>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-6">Track your job search journey and progress over time</p>
        
        <!-- Chart Container -->
        <div class="h-64 relative">
            <canvas id="careerChart"></canvas>
        </div>
        
        <!-- Chart Legend -->
        <div class="flex items-center justify-center space-x-6 mt-4">
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-teal-500 rounded-full"></div>
                <span class="text-sm text-gray-600">Applications</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                <span class="text-sm text-gray-600">Interviews</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                <span class="text-sm text-gray-600">Offers</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
            <button class="text-sm text-teal-600 hover:text-teal-700">See all</button>
        </div>
        
        <div class="space-y-4">
            @forelse($recentActivities ?? [] as $activity)
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-{{ $activity['color'] }}-100 rounded-full flex items-center justify-center flex-shrink-0">
                    @if($activity['icon'] === 'briefcase')
                    <svg class="w-4 h-4 text-{{ $activity['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                    @elseif($activity['icon'] === 'eye')
                    <svg class="w-4 h-4 text-{{ $activity['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    @else
                    <svg class="w-4 h-4 text-{{ $activity['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    @endif
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">{{ $activity['title'] }}</p>
                    <p class="text-xs text-gray-500">{{ $activity['description'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $activity['time'] }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-gray-500 mt-2">No recent activity</p>
            </div>
            @endforelse
        </div>

        <button class="w-full mt-6 px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors text-sm">
            View All Notifications
        </button>
    </div>
</div>

<!-- Shortlisted Jobs -->
<div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Shortlisted Jobs</h3>
        <div class="flex items-center space-x-2">
            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">{{ $recommendedJobs->count() }} applications</span>
        </div>
    </div>
    <p class="text-sm text-gray-600 mb-6">Jobs that match your skills and preferences</p>

    <div class="space-y-4">
        @forelse($recommendedJobs ?? [] as $job)
        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition-colors">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">{{ substr($job->job_title, 0, 2) }}</span>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900">{{ $job->job_title }}</h4>
                    <p class="text-sm text-gray-600">
                        {{ $job->company->name ?? 'Company' }} • 
                        {{ $job->remote_work ? 'Remote' : 'On-site' }} • 
                        {{ ucfirst(str_replace('-', ' ', $job->job_type ?? 'Full-time')) }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Posted: {{ $job->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-semibold text-gray-900">
                    @if($job->salary_min && $job->salary_max)
                        ${{ number_format($job->salary_min/1000, 0) }}K - ${{ number_format($job->salary_max/1000, 0) }}K
                    @else
                        $5K - $8K
                    @endif
                </p>
                <div class="flex items-center space-x-2 mt-2">
                    <span class="px-2 py-1 {{ $job->remote_work ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }} text-xs rounded">
                        {{ $job->remote_work ? 'Remote' : 'On-site' }}
                    </span>
                    <button class="px-3 py-1 bg-teal-500 text-white text-xs rounded hover:bg-teal-600 transition-colors">
                        View Detail
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8">
            <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
            </svg>
            <p class="text-sm text-gray-500 mt-2">No recommended jobs available</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6 text-center">
        <button class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
            View All Jobs
        </button>
    </div>
</div>