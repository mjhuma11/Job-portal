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
                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        Delete
                    </button>
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

<!-- Create Alert Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Create Job Alert</h3>
            <form>
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