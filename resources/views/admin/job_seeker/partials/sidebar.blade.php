<!-- Sidebar -->
<div class="w-64 bg-white shadow-lg h-screen border-r border-gray-200">
    <!-- Navigation Menu -->
    <div class="py-6">
        <p class="px-6 text-xs uppercase text-gray-500 font-semibold mb-6">Main Navigation</p>
        <nav class="space-y-2">
            <!-- User Dashboard -->
            <a href="{{ route('job_seeker.dashboard') }}" class="bg-teal-50 border-r-4 border-teal-500 text-teal-700 flex items-center px-6 py-3 text-sm font-medium">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                </div>
                User Dashboard
            </a>
            
            <!-- My Profile -->
            <a href="{{ route('job_seeker.profile') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                My Profile
            </a>
            
            <!-- My Resumes -->
            <a href="{{ route('job_seeker.resume') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                My Resume
                @php
                    $jobSeeker = auth()->user()->jobSeeker ?? null;
                    $hasResume = $jobSeeker && $jobSeeker->resume_file;
                @endphp
                @if($hasResume)
                    <span class="bg-green-500 text-white text-xs font-medium w-5 h-5 rounded-full ml-auto flex items-center justify-center">✓</span>
                @else
                    <span class="bg-orange-500 text-white text-xs font-medium px-2 py-1 rounded-full ml-auto">Add</span>
                @endif
            </a>
            
            <!-- Resume Management -->
            <a href="{{ route('job_seeker.resume.manage') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                Resume CRUD
            </a>
            
            <!-- Applied Jobs -->
            <a href="{{ route('job_seeker.applications') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                Applied jobs
            </a>
            
            <!-- Alert Jobs -->
            <a href="{{ route('job_seeker.job_alerts') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2L3 7v11c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V7l-7-5zM8 18v-6h4v6H8z"></path>
                    </svg>
                </div>
                Alert Jobs
                <span class="bg-yellow-400 text-white text-xs font-medium w-5 h-5 rounded-full ml-auto flex items-center justify-center">4</span>
            </a>
            
            <!-- Shortlist Jobs -->
            <a href="{{ route('job_seeker.saved_jobs') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                    </svg>
                </div>
                Shortlist Jobs
            </a>
            
            <!-- Following Employers -->
            <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                    </svg>
                </div>
                Following Employers
            </a>
            
            <!-- Messages -->
            <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                </div>
                Messages
                <span class="bg-green-500 text-white text-xs font-medium w-5 h-5 rounded-full ml-auto flex items-center justify-center">
                    @if(isset($stats))
                        {{ $stats['unread_messages'] ?? 0 }}
                    @else
                        0
                    @endif
                </span>
            </a>
            
            <!-- Change Password -->
            <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                Change Password
            </a>
            
            <!-- Delete Account -->
            <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M10 5a2 2 0 00-2 2v6a2 2 0 004 0V7a2 2 0 00-2-2z" clip-rule="evenodd"></path>
                        <path d="M3 5a2 2 0 012-2h1a1 1 0 000 2H5v11a2 2 0 002 2h6a2 2 0 002-2V5h-1a1 1 0 100-2h1a2 2 0 012 2v11a4 4 0 01-4 4H7a4 4 0 01-4-4V5z"></path>
                    </svg>
                </div>
                Delete Account
            </a>
            
            <!-- Log Out -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-6 py-3 text-sm font-medium transition-colors duration-200">
                    <div class="w-5 h-5 mr-3 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    Log Out
                </button>
            </form>
        </nav>
    </div>
</div>