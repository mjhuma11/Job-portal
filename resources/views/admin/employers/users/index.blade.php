@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        <!-- Include Sidebar -->
        @include('admin.employers.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
                        <p class="text-gray-600 mt-1">Manage users, roles, and permissions</p>
                    </div>
                    <a href="{{ route('employer.users.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New User
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Total Users -->
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg mb-4 mx-auto">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $stats['total_users'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Total Users</div>
                        </div>
                    </div>

                    <!-- Active Users -->
                    <div class="bg-green-50 rounded-xl p-6 border border-green-100">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg mb-4 mx-auto">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $stats['active_users'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Active Users</div>
                        </div>
                    </div>

                    <!-- Admins -->
                    <div class="bg-yellow-50 rounded-xl p-6 border border-yellow-100">
                        <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-lg mb-4 mx-auto">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-yellow-600">{{ $stats['admins'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Admins</div>
                        </div>
                    </div>

                    <!-- Customers -->
                    <div class="bg-teal-50 rounded-xl p-6 border border-teal-100">
                        <div class="flex items-center justify-center w-12 h-12 bg-teal-100 rounded-lg mb-4 mx-auto">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-teal-600">{{ $stats['customers'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Customers</div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <form method="GET" action="{{ route('employer.users.index') }}" class="flex flex-wrap gap-4 items-end">
                        <!-- Search -->
                        <div class="flex-1 min-w-64">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search users...</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search users..."
                                       class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            </div>
                        </div>

                        <!-- Role Filter -->
                        <div class="min-w-48">
                            <label class="block text-sm font-medium text-gray-700 mb-2">All Roles</label>
                            <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="">All Roles</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ request('role') === $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="min-w-48">
                            <label class="block text-sm font-medium text-gray-700 mb-2">All Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-2">
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                Filter
                            </button>
                            <a href="{{ route('employer.users.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                Reset Filters
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Users Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Join Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-teal-500 flex items-center justify-center">
                                                    <span class="text-white font-medium text-sm">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->role)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                @if($user->role->name === 'admin') bg-red-100 text-red-800
                                                @elseif($user->role->name === 'employer') bg-blue-100 text-blue-800
                                                @else bg-green-100 text-green-800 @endif">
                                                {{ ucfirst($user->role->name) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">No role</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->email_verified_at)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('n/j/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->updated_at->format('n/j/Y') }}<br>
                                        <span class="text-xs">{{ $user->updated_at->format('g:i A') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Views: {{ rand(10, 200) }}<br>
                                        <span class="text-xs">Inquiries: {{ rand(1, 50) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="relative inline-block text-left">
                                            <button type="button" 
                                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
                                                    onclick="toggleDropdown('dropdown-{{ $user->id }}')">
                                                Actions
                                                <svg class="-mr-1 ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <div id="dropdown-{{ $user->id }}" class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                                <div class="py-1">
                                                    <a href="{{ route('employer.users.show', $user) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Details</a>
                                                    <a href="{{ route('employer.users.edit', $user) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit User</a>
                                                    
                                                    <form method="POST" action="{{ route('employer.users.toggle-status', $user) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            {{ $user->email_verified_at ? 'Deactivate' : 'Activate' }}
                                                        </button>
                                                    </form>
                                                    
                                                    @if($user->id !== auth()->id())
                                                    <form method="POST" action="{{ route('employer.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50">Delete User</button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
                                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new user.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
<div id="success-message" class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div id="error-message" class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded z-50">
    {{ session('error') }}
</div>
@endif

<script>
function toggleDropdown(dropdownId) {
    // Close all other dropdowns
    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
        if (dropdown.id !== dropdownId) {
            dropdown.classList.add('hidden');
        }
    });
    
    // Toggle the clicked dropdown
    const dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle('hidden');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick^="toggleDropdown"]')) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }
});

// Auto-hide messages after 5 seconds
setTimeout(() => {
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');
    if (successMessage) successMessage.style.display = 'none';
    if (errorMessage) errorMessage.style.display = 'none';
}, 5000);
</script>
@endsection