@extends('layouts.app')

@section('title', 'Manage Roles - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Manage Roles</h1>
                        <p class="text-gray-600 mt-1">View and manage user roles and permissions</p>
                    </div>
                    <a href="{{ route('admin.roles.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Role
                    </a>
                </div>
            </div>

            <!-- Roles Table -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Users</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($roles as $role)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $role->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $role->description ?? 'No description' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $role->users()->count() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($role->name !== 'admin' && $role->name !== 'employer' && $role->name !== 'jobseeker')
                                    <a href="{{ route('admin.roles.edit', $role) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure you want to delete this role? This action cannot be undone.')">
                                            Delete
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-gray-400">System Role</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <div class="py-8">
                                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        <p class="mt-4">No roles found</p>
                                        <a href="{{ route('admin.roles.create') }}" 
                                           class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                            Add New Role
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Permissions Information -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Role-Based Access Control</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900">Admin</h4>
                        <p class="text-sm text-gray-500 mt-1">Full access to all system features and settings</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900">Employer</h4>
                        <p class="text-sm text-gray-500 mt-1">Can post jobs, manage applications, and company profile</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900">Job Seeker</h4>
                        <p class="text-sm text-gray-500 mt-1">Can search jobs, apply, and manage profile</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection