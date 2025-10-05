<!-- Enhanced Sidebar with Solid Colors -->
<div class="w-72 bg-white shadow-xl h-screen border-r border-gray-200">
    <!-- User Profile Section -->
    <div class="p-6 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                <span class="text-white font-bold text-xl">{{ substr(auth()->user()->name, 0, 2) }}</span>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 text-lg">{{ auth()->user()->name }}</h3>
                <p class="text-gray-600 text-sm">Job Seeker</p>
                <div class="flex items-center mt-1">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-xs text-green-600 font-medium">Active</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="py-6">
        <p class="px-6 text-xs uppercase text-gray-500 font-bold mb-6 tracking-wider">Navigation</p>
        <nav class="space-y-1 px-3">
            <!-- User Dashboard -->
            <a href="{{ route('job_seeker.dashboard') }}" class="group bg-blue-600 text-white mx-3 rounded-lg shadow-lg hover:bg-blue-700 transition-colors duration-300">
                <div class="flex items-center px-6 py-4">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="font-semibold text-base">Dashboard</span>
                        <p class="text-blue-100 text-xs">Overview & Stats</p>
                    </div>
                </div>
            </a>
            
            <!-- My Profile -->
            <a href="{{ route('job_seeker.profile') }}" class="group text-gray-700 hover:bg-purple-50 hover:text-purple-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-purple-100 group-hover:bg-purple-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <span class="font-semibold">My Profile</span>
                    <p class="text-gray-500 text-xs group-hover:text-purple-600">Personal Info</p>
                </div>
            </a>
            
            <!-- My Resumes -->
            <a href="{{ route('job_seeker.resume') }}" class="group text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-indigo-100 group-hover:bg-indigo-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <span class="font-semibold">My Resume</span>
                    <p class="text-gray-500 text-xs group-hover:text-indigo-600">CV & Documents</p>
                </div>
                @php
                    $jobSeeker = auth()->user()->jobSeeker ?? null;
                    $hasResume = $jobSeeker && $jobSeeker->resume_file;
                @endphp
                @if($hasResume)
                    <div class="w-8 h-8 bg-green-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                @else
                    <div class="px-3 py-1 bg-orange-500 text-white text-xs font-bold rounded-full shadow-lg">
                        Add
                    </div>
                @endif
            </a>
            
            <!-- Resume Management -->
            <a href="{{ route('job_seeker.resume.manage') }}" class="group text-gray-700 hover:bg-teal-50 hover:text-teal-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-teal-100 group-hover:bg-teal-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <span class="font-semibold">Resume Builder</span>
                    <p class="text-gray-500 text-xs group-hover:text-teal-600">Manage & Edit</p>
                </div>
            </a>
            
            <!-- Applied Jobs -->
            <a href="{{ route('job_seeker.applications') }}" class="group text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-emerald-100 group-hover:bg-emerald-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="font-semibold">Applied Jobs</span>
                    <p class="text-gray-500 text-xs group-hover:text-emerald-600">Track Applications</p>
                </div>
            </a>
            
            <!-- Alert Jobs -->
            <a href="{{ route('job_seeker.job_alerts') }}" class="group text-gray-700 hover:bg-amber-50 hover:text-amber-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-amber-100 group-hover:bg-amber-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2L3 7v11c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V7l-7-5zM8 18v-6h4v6H8z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <span class="font-semibold">Job Alerts</span>
                    <p class="text-gray-500 text-xs group-hover:text-amber-600">Notifications</p>
                </div>
                <div class="w-8 h-8 bg-orange-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg animate-pulse">
                    4
                </div>
            </a>
            
            <!-- Shortlist Jobs -->
            <a href="{{ route('job_seeker.saved_jobs') }}" class="group text-gray-700 hover:bg-rose-50 hover:text-rose-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-rose-100 group-hover:bg-rose-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                    </svg>
                </div>
                <div>
                    <span class="font-semibold">Saved Jobs</span>
                    <p class="text-gray-500 text-xs group-hover:text-rose-600">Bookmarked</p>
                </div>
            </a>
            
            <!-- Section Divider -->
            <div class="px-6 py-4">
                <div class="border-t border-gray-200/50"></div>
                <p class="text-xs uppercase text-gray-500 font-bold mt-4 mb-2 tracking-wider">Communication</p>
            </div>
            
            <!-- Following Employers -->
            <a href="#" class="group text-gray-700 hover:bg-violet-50 hover:text-violet-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-violet-100 group-hover:bg-violet-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                    </svg>
                </div>
                <div>
                    <span class="font-semibold">Following</span>
                    <p class="text-gray-500 text-xs group-hover:text-violet-600">Companies</p>
                </div>
            </a>
            
            <!-- Messages -->
            <a href="#" class="group text-gray-700 hover:bg-blue-50 hover:text-blue-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-blue-100 group-hover:bg-blue-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <span class="font-semibold">Messages</span>
                    <p class="text-gray-500 text-xs group-hover:text-blue-600">Inbox</p>
                </div>
                <div class="w-8 h-8 bg-green-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg">
                    @if(isset($stats))
                        {{ $stats['unread_messages'] ?? 0 }}
                    @else
                        0
                    @endif
                </div>
            </a>

            <!-- Section Divider -->
            <div class="px-6 py-4">
                <div class="border-t border-gray-200"></div>
                <p class="text-xs uppercase text-gray-500 font-bold mt-4 mb-2 tracking-wider">Settings</p>
            </div>
            
            <!-- Change Password -->
            <a href="{{ route('profile.edit') }}" class="group text-gray-700 hover:bg-gray-50 hover:text-gray-900 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                <div class="w-10 h-10 bg-gray-100 group-hover:bg-gray-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <span class="font-semibold">Security</span>
                    <p class="text-gray-500 text-xs group-hover:text-gray-700">Password & Privacy</p>
                </div>
            </a>
            
            <!-- Log Out -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="group w-full text-left text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center mx-3 px-4 py-3 rounded-lg transition-all duration-300 hover:shadow-md">
                    <div class="w-10 h-10 bg-red-100 group-hover:bg-red-200 rounded-lg flex items-center justify-center mr-4 transition-all duration-300">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="font-semibold">Sign Out</span>
                        <p class="text-gray-500 text-xs group-hover:text-red-600">Logout Safely</p>
                    </div>
                </button>
            </form>
        </nav>
    </div>
</div>