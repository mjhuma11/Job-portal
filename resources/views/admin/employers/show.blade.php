@extends('layouts.app')

@section('title', 'Employer Details - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.employers') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Employers
                </a>
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Employer Details</h1>
                        <p class="text-gray-600 mt-1">View detailed information about this employer</p>
                    </div>
                    <div class="flex space-x-2">
                        @if($company->verified)
                        <form action="{{ route('admin.employers.suspend', $company) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors"
                                    onclick="return confirm('Are you sure you want to suspend this employer?')">
                                Suspend
                            </button>
                        </form>
                        @else
                        <form action="{{ route('admin.employers.approve', $company) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors"
                                    onclick="return confirm('Are you sure you want to approve this employer?')">
                                Approve
                            </button>
                        </form>
                        @endif
                        
                        <a href="{{ route('admin.employers.edit', $company) }}" 
                           class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.employers.destroy', $company) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this employer? This action cannot be undone.')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Employer Information -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- User Details -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">User Information</h3>
                        
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 h-16 w-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-xl">{{ substr($company->user->name, 0, 2) }}</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">{{ $company->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $company->user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">User ID:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $company->user->id }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Joined:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $company->user->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Last Updated:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $company->user->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Company Status -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Account Status</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Verification Status:</span>
                                @if($company->verified)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Verified
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                                @endif
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Featured Status:</span>
                                @if($company->featured)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Featured
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Not Featured
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Company Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Company Name</label>
                                <p class="text-sm font-medium text-gray-900">{{ $company->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Company Email</label>
                                <p class="text-sm font-medium text-gray-900">{{ $company->email ?? 'Not provided' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Industry</label>
                                <p class="text-sm font-medium text-gray-900">{{ $company->industry ?? 'Not specified' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Founded Year</label>
                                <p class="text-sm font-medium text-gray-900">{{ $company->founded_year ?? 'Not specified' }}</p>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-1">Description</label>
                                <p class="text-sm font-medium text-gray-900">{{ $company->description ?? 'No description provided' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Website</label>
                                <p class="text-sm font-medium text-gray-900">
                                    @if($company->website)
                                    <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        {{ $company->website }}
                                    </a>
                                    @else
                                    Not provided
                                    @endif
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Phone</label>
                                <p class="text-sm font-medium text-gray-900">{{ $company->phone ?? 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Jobs Posted -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Jobs Posted</h3>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $company->jobs()->count() }} jobs
                            </span>
                        </div>
                        
                        @if($company->jobs()->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applications</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($company->jobs as $job)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $job->job_title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($job->status === 'open') bg-green-100 text-green-800
                                                @elseif($job->status === 'closed') bg-red-100 text-red-800
                                                @elseif($job->status === 'draft') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $job->applications()->count() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $job->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                            <p class="mt-2">No jobs posted yet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection