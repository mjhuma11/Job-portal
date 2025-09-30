<nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" 
                         style="background-color: var(--primary-color);">
                        <span class="text-white font-bold text-lg">CB</span>
                    </div>
                    <span class="text-2xl font-bold" style="color: var(--primary-color);">CareerBridge</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="/" class="font-medium transition-colors duration-300 hover:text-[var(--primary-color)]" 
                   style="color: var(--text-dark);">Home</a>
                
                <!-- Mega Menu Trigger -->
                <div class="relative group">
                    <button class="font-medium transition-colors duration-300 hover:text-[var(--primary-color)] flex items-center space-x-1" 
                            style="color: var(--text-dark);" id="pages-menu-trigger">
                        <span>Pages</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Mega Menu -->
                    <div class="mega-menu absolute top-full left-1/2 transform -translate-x-1/2 w-[600px] mt-2" 
                         id="mega-menu">
                        <div class="bg-white rounded-lg shadow-lg border border-gray-100 p-6">
                            <div class="grid grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-1">
                                    <h3 class="font-semibold text-sm uppercase tracking-wide mb-3" 
                                        style="color: var(--primary-color);">Company Info</h3>
                                    <a href="/about" class="mega-menu-item block px-3 py-2 rounded-md text-sm font-medium transition-all duration-200" 
                                       style="color: var(--text-dark);">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-md flex items-center justify-center" 
                                                 style="background-color: rgba(44, 62, 80, 0.1);">
                                                <svg class="w-4 h-4" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium">About Us</div>
                                                <div class="text-xs" style="color: var(--text-light);">Learn about our mission</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/privacy-policy" class="mega-menu-item block px-3 py-2 rounded-md text-sm font-medium transition-all duration-200" 
                                       style="color: var(--text-dark);">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-md flex items-center justify-center" 
                                                 style="background-color: rgba(44, 62, 80, 0.1);">
                                                <svg class="w-4 h-4" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium">Privacy Policy</div>
                                                <div class="text-xs" style="color: var(--text-light);">Your data protection</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/pricing" class="mega-menu-item block px-3 py-2 rounded-md text-sm font-medium transition-all duration-200" 
                                       style="color: var(--text-dark);">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-md flex items-center justify-center" 
                                                 style="background-color: rgba(243, 156, 18, 0.1);">
                                                <svg class="w-4 h-4" style="color: var(--accent-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium">Our Pricing</div>
                                                <div class="text-xs" style="color: var(--text-light);">View pricing plans</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                
                                <!-- Right Column -->
                                <div class="space-y-1">
                                    <h3 class="font-semibold text-sm uppercase tracking-wide mb-3" 
                                        style="color: var(--secondary-color);">Job Center</h3>
                                    <a href="/jobs" class="mega-menu-item block px-3 py-2 rounded-md text-sm font-medium transition-all duration-200" 
                                       style="color: var(--text-dark);">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-md flex items-center justify-center" 
                                                 style="background-color: rgba(231, 76, 60, 0.1);">
                                                <svg class="w-4 h-4" style="color: var(--secondary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium">Job List</div>
                                                <div class="text-xs" style="color: var(--text-light);">Browse all available jobs</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/job-details" class="mega-menu-item block px-3 py-2 rounded-md text-sm font-medium transition-all duration-200" 
                                       style="color: var(--text-dark);">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-md flex items-center justify-center" 
                                                 style="background-color: rgba(231, 76, 60, 0.1);">
                                                <svg class="w-4 h-4" style="color: var(--secondary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium">Job Details</div>
                                                <div class="text-xs" style="color: var(--text-light);">View detailed job info</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/resume" class="mega-menu-item block px-3 py-2 rounded-md text-sm font-medium transition-all duration-200" 
                                       style="color: var(--text-dark);">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-md flex items-center justify-center" 
                                                 style="background-color: rgba(231, 76, 60, 0.1);">
                                                <svg class="w-4 h-4" style="color: var(--secondary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium">Resume Page</div>
                                                <div class="text-xs" style="color: var(--text-light);">Create & manage resume</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="/companies" class="font-medium transition-colors duration-300 hover:text-[var(--primary-color)]" 
                   style="color: var(--text-dark);">Companies</a>
                <a href="/blog" class="font-medium transition-colors duration-300 hover:text-[var(--primary-color)]" 
                   style="color: var(--text-dark);">Blog</a>
                <a href="/contact" class="font-medium transition-colors duration-300 hover:text-[var(--primary-color)]" 
                   style="color: var(--text-dark);">Contact</a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    <!-- Job Seeker Profile Button (only visible to users with job seeker profile) -->
                    @if(Auth::user()->jobSeeker)
                        <a href="{{ route('job_seeker.profile') }}" class="inline-flex items-center px-3 py-1 bg-teal-600 border border-transparent rounded-md text-xs font-semibold text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            My Profile
                        </a>
                    @endif

                    <!-- Logged in user menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-sm font-medium transition-colors duration-300 hover:text-[var(--primary-color)]" style="color: var(--text-dark);">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color: var(--primary-color);">
                                <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-50 transition-colors duration-200" style="color: var(--text-dark);">Profile</a>
                            <a href="{{ route('employer.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50 transition-colors duration-200" style="color: var(--text-dark);">Employer Dashboard</a>
                            <a href="{{ route('job_seeker.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50 transition-colors duration-200" style="color: var(--text-dark);">Job Seeker Dashboard</a>
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-50 transition-colors duration-200" style="color: var(--text-dark);">Log Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest user buttons -->
                    <a href="{{ route('login') }}" class="font-medium transition-colors duration-300 hover:text-[var(--primary-color)]" 
                       style="color: var(--text-dark);">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-secondary px-6 py-2 rounded-lg font-medium text-white transition-all duration-300 hover:shadow-lg">
                        Sign Up
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button type="button" class="text-gray-700 hover:text-[var(--primary-color)] transition-colors duration-300" 
                        id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="lg:hidden hidden border-t border-gray-100" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="/" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                   style="color: var(--text-dark);">Home</a>
                
                <!-- Mobile Pages Submenu -->
                <div class="relative">
                    <button class="w-full text-left px-3 py-2 text-base font-medium rounded-md transition-colors duration-300 flex items-center justify-between" 
                            style="color: var(--text-dark);" id="mobile-pages-trigger">
                        <span>Pages</span>
                        <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="hidden pl-6 mt-1 space-y-1" id="mobile-pages-menu">
                        <a href="/about" class="block px-3 py-2 text-sm rounded-md transition-colors duration-300" 
                           style="color: var(--text-light);">About Us</a>
                        <a href="/jobs" class="block px-3 py-2 text-sm rounded-md transition-colors duration-300" 
                           style="color: var(--text-light);">Job List</a>
                        <a href="/job-details" class="block px-3 py-2 text-sm rounded-md transition-colors duration-300" 
                           style="color: var(--text-light);">Job Details</a>
                        <a href="/resume" class="block px-3 py-2 text-sm rounded-md transition-colors duration-300" 
                           style="color: var(--text-light);">Resume Page</a>
                        <a href="/privacy-policy" class="block px-3 py-2 text-sm rounded-md transition-colors duration-300" 
                           style="color: var(--text-light);">Privacy Policy</a>
                        <a href="/pricing" class="block px-3 py-2 text-sm rounded-md transition-colors duration-300" 
                           style="color: var(--text-light);">Our Pricing</a>
                    </div>
                </div>
                
                <a href="/companies" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                   style="color: var(--text-dark);">Companies</a>
                <a href="/blog" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                   style="color: var(--text-dark);">Blog</a>
                <a href="/contact" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                   style="color: var(--text-dark);">Contact</a>
                
                <div class="border-t border-gray-100 pt-3 mt-3">
                    @auth
                        <!-- Job Seeker Profile Button (only visible to users with job seeker profile) -->
                        @if(Auth::user()->jobSeeker)
                            <a href="{{ route('job_seeker.profile') }}" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300 bg-teal-600 text-white text-center mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                My Profile
                            </a>
                        @endif

                        <!-- Logged in user mobile menu -->
                        <div class="px-3 py-2 text-base font-medium" style="color: var(--text-dark);">
                            <div class="flex items-center space-x-2 mb-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color: var(--primary-color);">
                                    <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                           style="color: var(--text-dark);">Profile</a>
                        <a href="{{ route('employer.dashboard') }}" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                           style="color: var(--text-dark);">Employer Dashboard</a>
                        <a href="{{ route('job_seeker.dashboard') }}" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                           style="color: var(--text-dark);">Job Seeker Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                                    style="color: var(--text-dark);">Log Out</button>
                        </form>
                    @else
                        <!-- Guest user mobile menu -->
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium rounded-md transition-colors duration-300" 
                           style="color: var(--text-dark);">Sign In</a>
                        <a href="{{ route('register') }}" class="block mx-3 mt-2 px-4 py-2 text-center font-medium text-white rounded-lg transition-all duration-300" 
                           style="background-color: var(--secondary-color);">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>