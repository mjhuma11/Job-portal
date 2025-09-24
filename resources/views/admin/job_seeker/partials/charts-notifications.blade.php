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
    </div>

    <!-- Notifications -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Recent Activity</h3>
            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full">4 new</span>
        </div>
        <div class="space-y-4">
            <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors duration-200">
                <div class="w-3 h-3 bg-teal-500 rounded-full mt-2 flex-shrink-0"></div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">
                        <span class="font-bold">TechCorp</span> viewed your profile
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Just Now</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors duration-200">
                <div class="w-3 h-3 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">
                        <span class="font-bold">Morin Denver</span> accepted your resume on 
                        <span class="font-medium">JobStock</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">25 min ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-red-50 rounded-xl hover:bg-red-100 transition-colors duration-200">
                <div class="w-3 h-3 bg-red-500 rounded-full mt-2 flex-shrink-0"></div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">
                        Your job <span class="font-bold">#456256</span> expired yesterday
                        <span class="font-medium">Your Partner..</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">10 days ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-xl hover:bg-green-100 transition-colors duration-200">
                <div class="w-3 h-3 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">
                        <span class="font-bold">Musth Verma</span> left a review on 
                        <span class="font-medium">Your Message</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Just Now</p>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <button class="w-full py-2 text-center text-teal-600 font-medium hover:bg-teal-50 rounded-lg transition-colors duration-200">
                View all notifications
            </button>
        </div>
    </div>
</div>