<!-- Enhanced Statistics Cards with Solid Colors -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Applied Jobs -->
    <div class="bg-white rounded-2xl shadow-lg p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-xl border border-gray-100">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-3xl font-bold text-green-600">
                    @if(isset($stats))
                        {{ $stats['total_applications'] ?? 0 }}
                    @else
                        0
                    @endif
                </p>
                <p class="text-gray-700 font-semibold text-lg">Applied Jobs</p>
                <p class="text-gray-500 text-sm">Total applications sent</p>
            </div>
            <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center space-x-2 text-green-600">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-semibold">+15% this month</span>
            </div>
            <div class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                Active
            </div>
        </div>
    </div>

    <!-- Saved Jobs -->
    <div class="bg-white rounded-2xl shadow-lg p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-xl border border-gray-100">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-3xl font-bold text-orange-600">
                    @if(isset($stats))
                        {{ $stats['shortlisted'] ?? 0 }}
                    @else
                        0
                    @endif
                </p>
                <p class="text-gray-700 font-semibold text-lg">Saved Jobs</p>
                <p class="text-gray-500 text-sm">Bookmarked positions</p>
            </div>
            <div class="w-16 h-16 bg-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center space-x-2 text-orange-600">
                <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-semibold">+8% this month</span>
            </div>
            <div class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-bold">
                Trending
            </div>
        </div>
    </div>

    <!-- Profile Views -->
    <div class="bg-white rounded-2xl shadow-lg p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-xl border border-gray-100">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-3xl font-bold text-purple-600">
                    @if(isset($stats))
                        {{ ($stats['total_applications'] ?? 0) * 3 }}
                    @else
                        0
                    @endif
                </p>
                <p class="text-gray-700 font-semibold text-lg">Profile Views</p>
                <p class="text-gray-500 text-sm">Employer interest</p>
            </div>
            <div class="w-16 h-16 bg-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center space-x-2 text-purple-600">
                <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-semibold">+12% this month</span>
            </div>
            <div class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">
                Growing
            </div>
        </div>
    </div>

    <!-- Interview Invites -->
    <div class="bg-white rounded-2xl shadow-lg p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-xl border border-gray-100">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-3xl font-bold text-blue-600">
                    @if(isset($stats))
                        {{ $stats['unread_notifications'] ?? 0 }}
                    @else
                        0
                    @endif
                </p>
                <p class="text-gray-700 font-semibold text-lg">Interviews</p>
                <p class="text-gray-500 text-sm">Scheduled meetings</p>
            </div>
            <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center space-x-2 text-blue-600">
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-semibold">+5% this month</span>
            </div>
            <div class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">
                Upcoming
            </div>
        </div>
    </div>
</div>