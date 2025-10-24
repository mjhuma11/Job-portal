@extends('layouts.app')

@section('title', 'Job Alerts - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-teal-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">CB</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800">CareerBridge</span>
                </div>
            </div>
            
            <div class="p-4">
                <div class="mb-6">
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name, 0, 2) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-500">Job Seeker</p>
                        </div>
                    </div>
                </div>

                <nav class="space-y-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">DASHBOARD</div>
                    
                    <a href="{{ route('job_seeker.dashboard') }}" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('job_seeker.job_alerts') }}" class="flex items-center space-x-3 p-3 bg-blue-50 text-blue-600 border-l-4 border-blue-600 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM4 15h8v-2H4v2zM4 11h8V9H4v2z"></path>
                        </svg>
                        <span>Job Alerts</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-white border-b border-gray-200 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Job Alerts</h1>
                        <p class="text-gray-600">Get notified when new jobs match your criteria</p>
                    </div>
                    <button class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors" onclick="openCreateModal()">
                        Create Alert
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @if($jobAlerts->count() > 0)
                    <div class="space-y-4">
                        @foreach($jobAlerts as $alert)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $alert->keywords }}</h3>
                                    <p class="text-gray-600">{{ $alert->location ?? 'Any location' }} • {{ $alert->job_type ?? 'Any type' }}</p>
                                    <p class="text-sm text-gray-500">Created: {{ $alert->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">Active</span>
                                    <button class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                        Edit
                                    </button>
                                    <form action="{{ route('job_seeker.job_alerts.destroy', $alert->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM4 15h8v-2H4v2zM4 11h8V9H4v2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mt-4">No job alerts yet</h3>
                        <p class="text-gray-500 mt-2">Create your first job alert to get notified about relevant opportunities!</p>
                        <button class="mt-4 inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors" onclick="openCreateModal()">
                            Create Job Alert
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Create Alert Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Create Job Alert</h3>
            <form action="{{ route('job_seeker.job_alerts.create') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="keywords" class="block text-sm font-medium text-gray-700">Keywords</label>
                        <input type="text" name="keywords" id="keywords" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="e.g. PHP Developer" required>
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="e.g. New York">
                    </div>
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-700">Job Type</label>
                        <select name="job_type" id="job_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Any Type</option>
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                            <option value="contract">Contract</option>
                            <option value="freelance">Freelance</option>
                        </select>
                    </div>
                    <div>
                        <label for="salary_min" class="block text-sm font-medium text-gray-700">Minimum Salary</label>
                        <input type="number" name="salary_min" id="salary_min" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="50000">
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600">
                        Create Alert
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.getElementById('createModal').classList.add('flex');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.getElementById('createModal').classList.remove('flex');
}
</script>
@endsection