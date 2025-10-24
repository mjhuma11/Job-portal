@if($followingCompanies->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($followingCompanies as $company)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-lg">{{ substr($company->name, 0, 2) }}</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">{{ $company->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $company->industry ?? 'Technology' }}</p>
                
                <div class="mt-4 space-y-2">
                    <button class="w-full px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors text-sm">
                        View Jobs
                    </button>
                    <button class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors text-sm">
                        Unfollow
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="text-center py-12">
        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mt-4">Not following any companies yet</h3>
        <p class="text-gray-500 mt-2">Start following companies to get updates about their job openings!</p>
        <button class="mt-4 inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors">
            Browse Companies
        </button>
    </div>
@endif