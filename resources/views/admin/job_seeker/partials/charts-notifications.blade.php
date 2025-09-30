<!-- Charts and Notifications Row -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Chart Section -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Career Progress</h3>
                <p class="text-gray-600 text-sm mt-1">Track your job search journey over time</p>
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 bg-teal-100 text-teal-800 text-sm font-medium rounded-lg">Monthly</button>
                <button class="px-3 py-1 bg-gray-100 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-200">Yearly</button>
            </div>
        </div>
        <div class="mb-4">
            <h4 class="text-base font-medium text-gray-700 mb-4">Application Trends</h4>
            <div class="flex items-center space-x-4 mb-4">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-teal-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Applications</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-amber-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Interviews</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Offers</span>
                </div>
            </div>
        </div>
        <!-- Chart Container -->
        <div class="relative h-64">
            <canvas id="salesChart"></canvas>
        </div>
        <!-- Fallback content if chart fails to load -->
        <div id="chart-fallback" class="hidden text-center py-8 text-gray-500">
            <p>Chart data is not available at the moment.</p>
        </div>
    </div>

    <!-- Notifications -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Recent Activity</h3>
            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full">
                @if(isset($stats))
                    {{ $stats['unread_notifications'] ?? 0 }} new
                @else
                    0 new
                @endif
            </span>
        </div>
        <div class="space-y-4">
            @if(isset($notifications) && $notifications->count() > 0)
                @foreach($notifications->take(4) as $notification)
                <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors duration-200">
                    <div class="w-3 h-3 bg-teal-500 rounded-full mt-2 flex-shrink-0"></div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-900">
                            @if(isset($notification->message))
                                {{ $notification->message }}
                            @else
                                New notification
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            @if(isset($notification->created_at))
                                {{ $notification->created_at->diffForHumans() }}
                            @else
                                Just now
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>No recent notifications</p>
                </div>
            @endif
        </div>
        <div class="mt-6">
            <button class="w-full py-2 text-center text-teal-600 font-medium hover:bg-teal-50 rounded-lg transition-colors duration-200">
                View all notifications
            </button>
        </div>
    </div>
</div>