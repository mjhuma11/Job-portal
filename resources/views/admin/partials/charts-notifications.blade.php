<!-- Charts and Notifications Row -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Chart Section -->
    <div class="lg:col-span-2 bg-white rounded-lg p-6 shadow-sm border">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Extra Area Chart</h3>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                    <span class="text-sm text-gray-600">Product A</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                    <span class="text-sm text-gray-600">Product B</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                    <span class="text-sm text-gray-600">Product C</span>
                </div>
            </div>
        </div>
        
        <!-- Chart with Custom SVG -->
        <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
            <svg viewBox="0 0 500 250" class="w-full h-full">
                <!-- Y-axis labels -->
                <text x="20" y="40" class="text-xs fill-gray-500">100</text>
                <text x="20" y="80" class="text-xs fill-gray-500">80</text>
                <text x="20" y="120" class="text-xs fill-gray-500">60</text>
                <text x="20" y="160" class="text-xs fill-gray-500">40</text>
                <text x="20" y="200" class="text-xs fill-gray-500">20</text>
                <text x="20" y="240" class="text-xs fill-gray-500">0</text>
                
                <!-- X-axis labels -->
                <text x="60" y="245" class="text-xs fill-gray-500">Jan</text>
                <text x="120" y="245" class="text-xs fill-gray-500">Feb</text>
                <text x="180" y="245" class="text-xs fill-gray-500">Mar</text>
                <text x="240" y="245" class="text-xs fill-gray-500">Apr</text>
                <text x="300" y="245" class="text-xs fill-gray-500">May</text>
                <text x="360" y="245" class="text-xs fill-gray-500">Jun</text>
                <text x="420" y="245" class="text-xs fill-gray-500">Jul</text>
                
                <!-- Chart lines -->
                <polyline points="50,180 110,160 170,140 230,120 290,100 350,80 410,60" 
                          fill="none" stroke="#fbbf24" stroke-width="3"/>
                <polyline points="50,200 110,180 170,160 230,140 290,120 350,100 410,80" 
                          fill="none" stroke="#ef4444" stroke-width="3"/>
                <polyline points="50,220 110,200 170,180 230,160 290,140 350,120 410,100" 
                          fill="none" stroke="#22c55e" stroke-width="3"/>
            </svg>
        </div>
    </div>

    <!-- Notifications -->
    <div class="bg-white rounded-lg p-6 shadow-sm border">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Notifications</h3>
        <div class="space-y-4">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-yellow-600">KS</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">Kr. Shaury Preet Replied your message</p>
                    <p class="text-xs text-gray-500">Just Now</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-red-600">MD</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">Mortin Demain accepted your resume on JobStock</p>
                    <p class="text-xs text-gray-500">30 minutes ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-blue-600">YJ</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">Your job #456256 expired yesterday</p>
                    <p class="text-xs text-gray-500 cursor-pointer hover:text-blue-600">View More</p>
                    <p class="text-xs text-gray-500">1 day ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-green-600">DK</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">Daniel Kurva has been approved your resume!</p>
                    <p class="text-xs text-gray-500">14 days ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-semibold text-green-600">MV</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900">Musab Verma left a review on Your Message</p>
                    <p class="text-xs text-gray-500">Just Now</p>
                </div>
            </div>
        </div>
    </div>
</div>