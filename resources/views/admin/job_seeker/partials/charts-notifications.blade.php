<!-- Enhanced Charts and Notifications Row -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
    <!-- Chart Section -->
    <div class="lg:col-span-2 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-40 h-40 bg-gradient-to-br from-purple-400/10 to-pink-400/10 rounded-full -translate-x-20 -translate-y-20"></div>
        <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tl from-blue-400/10 to-indigo-400/10 rounded-full translate-x-16 translate-y-16"></div>
        <div class="relative flex items-center justify-between mb-8">
            <div class="space-y-2">
                <h3 class="text-2xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Career Analytics</h3>
                <p class="text-gray-600 text-base">Track your job search journey and progress over time</p>
            </div>
            <div class="flex space-x-3">
                <button class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">Monthly</button>
                <button class="px-4 py-2 bg-white/50 backdrop-blur-sm text-gray-700 text-sm font-semibold rounded-xl hover:bg-white/70 transition-all duration-300 border border-white/30">Yearly</button>
            </div>
        </div>
        <div class="relative mb-6">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-bold text-gray-800">Application Trends</h4>
                <div class="flex items-center space-x-1">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-500 font-medium">Live Data</span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="flex items-center space-x-3 p-3 bg-gradient-to-r from-teal-50 to-cyan-50 rounded-2xl">
                    <div class="w-4 h-4 bg-gradient-to-r from-teal-400 to-cyan-500 rounded-full shadow-lg"></div>
                    <span class="text-sm font-semibold text-teal-700">Applications</span>
                </div>
                <div class="flex items-center space-x-3 p-3 bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl">
                    <div class="w-4 h-4 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full shadow-lg"></div>
                    <span class="text-sm font-semibold text-amber-700">Interviews</span>
                </div>
                <div class="flex items-center space-x-3 p-3 bg-gradient-to-r from-emerald-50 to-green-50 rounded-2xl">
                    <div class="w-4 h-4 bg-gradient-to-r from-emerald-400 to-green-500 rounded-full shadow-lg"></div>
                    <span class="text-sm font-semibold text-emerald-700">Offers</span>
                </div>
            </div>
        </div>
        <!-- Chart Container -->
        <div class="relative h-80 bg-gradient-to-br from-gray-50/50 to-white/50 rounded-2xl p-4 border border-white/30">
            <canvas id="salesChart"></canvas>
        </div>
        <!-- Fallback content if chart fails to load -->
        <div id="chart-fallback" class="hidden text-center py-12 text-gray-500">
            <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <p class="font-semibold">Chart data is not available at the moment.</p>
        </div>
    </div>

    <!-- Enhanced Notifications -->
    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full -translate-y-12 translate-x-12"></div>
        <div class="absolute bottom-0 left-0 w-20 h-20 bg-gradient-to-tr from-pink-400/20 to-rose-400/20 rounded-full translate-y-10 -translate-x-10"></div>
        <div class="relative flex items-center justify-between mb-8">
            <div>
                <h3 class="text-2xl font-black bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Recent Activity</h3>
                <p class="text-gray-600 text-sm mt-1">Stay updated with your latest interactions</p>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-gradient-to-r from-red-400 to-pink-500 rounded-full animate-pulse"></div>
                <span class="px-3 py-1 bg-gradient-to-r from-red-100 to-pink-100 text-red-700 text-xs font-bold rounded-full shadow-lg">
                    @if(isset($stats))
                        {{ $stats['unread_notifications'] ?? 0 }} new
                    @else
                        0 new
                    @endif
                </span>
            </div>
        </div>
        <div class="relative space-y-4">
            @if(isset($notifications) && $notifications->count() > 0)
                @foreach($notifications->take(4) as $notification)
                <div class="group flex items-start space-x-4 p-4 bg-gradient-to-r from-blue-50/50 to-purple-50/50 backdrop-blur-sm rounded-2xl hover:from-blue-100/70 hover:to-purple-100/70 transition-all duration-300 hover:shadow-lg border border-white/30">
                    <div class="w-4 h-4 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full mt-1 flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="flex-1 space-y-1">
                        <p class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors duration-300">
                            @if(isset($notification->message))
                                {{ $notification->message }}
                            @else
                                New job opportunity matches your profile
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 group-hover:text-blue-600 transition-colors duration-300">
                            @if(isset($notification->created_at))
                                {{ $notification->created_at->diffForHumans() }}
                            @else
                                Just now
                            @endif
                        </p>
                    </div>
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Sample notifications for demo -->
                <div class="group flex items-start space-x-4 p-4 bg-gradient-to-r from-emerald-50/50 to-green-50/50 backdrop-blur-sm rounded-2xl hover:from-emerald-100/70 hover:to-green-100/70 transition-all duration-300 hover:shadow-lg border border-white/30">
                    <div class="w-4 h-4 bg-gradient-to-r from-emerald-400 to-green-500 rounded-full mt-1 flex-shrink-0 shadow-lg"></div>
                    <div class="flex-1 space-y-1">
                        <p class="text-sm font-semibold text-gray-900">New job match found!</p>
                        <p class="text-xs text-gray-500">Senior Developer position at TechCorp</p>
                    </div>
                </div>
                <div class="group flex items-start space-x-4 p-4 bg-gradient-to-r from-amber-50/50 to-orange-50/50 backdrop-blur-sm rounded-2xl hover:from-amber-100/70 hover:to-orange-100/70 transition-all duration-300 hover:shadow-lg border border-white/30">
                    <div class="w-4 h-4 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full mt-1 flex-shrink-0 shadow-lg"></div>
                    <div class="flex-1 space-y-1">
                        <p class="text-sm font-semibold text-gray-900">Profile viewed by employer</p>
                        <p class="text-xs text-gray-500">StartupXYZ checked your profile</p>
                    </div>
                </div>
                <div class="group flex items-start space-x-4 p-4 bg-gradient-to-r from-purple-50/50 to-pink-50/50 backdrop-blur-sm rounded-2xl hover:from-purple-100/70 hover:to-pink-100/70 transition-all duration-300 hover:shadow-lg border border-white/30">
                    <div class="w-4 h-4 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full mt-1 flex-shrink-0 shadow-lg"></div>
                    <div class="flex-1 space-y-1">
                        <p class="text-sm font-semibold text-gray-900">Application status updated</p>
                        <p class="text-xs text-gray-500">Interview scheduled for next week</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="relative mt-8">
            <button class="w-full py-3 text-center bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold rounded-2xl hover:from-blue-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                View All Notifications
            </button>
        </div>
    </div>
</div>