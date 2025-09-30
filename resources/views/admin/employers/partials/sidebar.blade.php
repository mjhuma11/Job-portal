<!-- Sidebar -->
<div class="w-64 bg-white shadow-lg min-h-screen">
    <!-- Profile Section -->
    <div class="p-6 border-b">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">{{ auth()->user()->name ?? 'Tech Solutions Inc.' }}</h3>
                <p class="text-sm text-gray-500">Premium Employer</p>
                <p class="text-xs text-gray-400">Dhaka, Bangladesh</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-4">
        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Main Navigation</h4>
        
        <ul class="space-y-1">
            <li>
                <a href="{{ route('employer.dashboard') }}" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Employer Dashboard</span>
                </a>
            </li>
            
            <li>
                <!-- Categories Dropdown -->
                <div class="relative">
                    <button id="categoriesToggle" class="w-full flex items-center justify-between text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-4H3m16 8H9m10 4H7"></path>
                            </svg>
                            <span>Categories</span>
                        </div>
                        <svg id="categoriesChevron" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="categoriesDropdown" class="hidden mt-2 ml-8 space-y-1">
                        <button type="button" onclick="openCategoryModal()" class="w-full flex items-center space-x-3 text-sm text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Add Category</span>
                        </button>
                        <a href="{{ route('employer.categories.index') }}" class="flex items-center space-x-3 text-sm text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Management</span>
                        </a>
                    </div>
                </div>
            </li>
            
            <li>
                <a href="{{ route('employer.profile') }}" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>User Profile</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('employer.users.index') }}" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                    </svg>
                    <span>User Management</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('employer.companies.index') }}" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>Company Management</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('employer.applications.index') }}" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Application Management</span>
                </a>
            </li>
            
            <li>
                <!-- My Jobs Dropdown -->
                <div class="relative">
                    <button id="myJobsToggle" class="w-full flex items-center justify-between text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                            <span>My Jobs</span>
                        </div>
                        <svg id="myJobsChevron" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="myJobsDropdown" class="hidden mt-2 ml-8 space-y-1">
                        <a href="{{ route('employer.jobs.index') }}" class="flex items-center space-x-3 text-sm text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span>View All Jobs</span>
                        </a>
                        <a href="{{ route('employer.jobs.create') }}" class="flex items-center space-x-3 text-sm text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Post New Job</span>
                        </a>
                        <a href="{{ route('employer.jobs.drafts') }}" class="flex items-center space-x-3 text-sm text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Draft Jobs</span>
                        </a>
                        <a href="{{ route('employer.applications.index') }}" class="flex items-center space-x-3 text-sm text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Job Applications</span>
                        </a>
                    </div>
                </div>
            </li>
            
            <li>
                <a href="{{ route('employer.shortlisted') }}" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 616 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Shortlisted Candidates</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span>Package</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>Messages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('employer.password.edit') }}" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1921 9z"></path>
                    </svg>
                    <span>Change Password</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 text-red-600 hover:text-red-700 hover:bg-red-50 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <span>Delete Account</span>
                </a>
            </li>
            <li class="pt-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 text-gray-600 hover:text-teal-600 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors w-full text-left">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</div>

<script>
    // Categories dropdown toggle
    document.addEventListener('DOMContentLoaded', function() {
        // Categories dropdown
        const categoriesToggle = document.getElementById('categoriesToggle');
        const categoriesDropdown = document.getElementById('categoriesDropdown');
        const categoriesChevron = document.getElementById('categoriesChevron');
        
        if (categoriesToggle && categoriesDropdown && categoriesChevron) {
            categoriesToggle.addEventListener('click', function(e) {
                e.preventDefault();
                categoriesDropdown.classList.toggle('hidden');
                categoriesChevron.classList.toggle('rotate-90');
            });
        }
        
        // My Jobs dropdown
        const myJobsToggle = document.getElementById('myJobsToggle');
        const myJobsDropdown = document.getElementById('myJobsDropdown');
        const myJobsChevron = document.getElementById('myJobsChevron');
        
        if (myJobsToggle && myJobsDropdown && myJobsChevron) {
            myJobsToggle.addEventListener('click', function(e) {
                e.preventDefault();
                myJobsDropdown.classList.toggle('hidden');
                myJobsChevron.classList.toggle('rotate-90');
            });
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            // Close categories dropdown if clicked outside
            if (categoriesToggle && categoriesDropdown && categoriesChevron) {
                if (!categoriesToggle.contains(e.target) && !categoriesDropdown.contains(e.target)) {
                    categoriesDropdown.classList.add('hidden');
                    categoriesChevron.classList.remove('rotate-90');
                }
            }
            
            // Close my jobs dropdown if clicked outside
            if (myJobsToggle && myJobsDropdown && myJobsChevron) {
                if (!myJobsToggle.contains(e.target) && !myJobsDropdown.contains(e.target)) {
                    myJobsDropdown.classList.add('hidden');
                    myJobsChevron.classList.remove('rotate-90');
                }
            }
        });
        
        // Modal functions - moved here so they're accessible from sidebar
        window.openCategoryModal = function() {
            const modal = document.getElementById('categoryModal');
            if (modal) {
                modal.classList.remove('hidden');
                // Reset form if it exists
                const form = document.getElementById('addCategoryForm');
                if (form) {
                    form.reset();
                }
            }
        };
        
        window.closeCategoryModal = function() {
            const modal = document.getElementById('categoryModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        };
    });
</script>