@if($applications->count() > 0)
    <div class="space-y-4">
        @foreach($applications as $application)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">{{ substr($application->job->job_title, 0, 2) }}</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $application->job->job_title }}</h3>
                        <p class="text-gray-600">{{ $application->job->company->name }}</p>
                        <p class="text-sm text-gray-500">Applied: {{ $application->applied_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm rounded-full">
                        {{ ucfirst($application->application_status) }}
                    </span>
                    <div class="mt-2">
                        <button class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors text-sm">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="text-center py-12">
        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mt-4">No applications yet</h3>
        <p class="text-gray-500 mt-2">Start applying to jobs to track your applications here.</p>
        <button class="mt-4 inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors">
            Browse Jobs
        </button>
    </div>
@endif