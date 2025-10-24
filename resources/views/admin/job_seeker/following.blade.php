@extends('layouts.app')

@section('title', 'Following Companies - CareerBridge')

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
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">COMMUNICATION</div>
                    
                    <a href="{{ route('job_seeker.following') }}" class="flex items-center space-x-3 p-3 bg-blue-50 text-blue-600 border-l-4 border-blue-600 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Following</span>
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
                        <h1 class="text-2xl font-bold text-gray-900">Following Companies</h1>
                        <p class="text-gray-600">Companies you're following for job updates</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
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
                                <p class="text-gray-500 text-xs mt-2">Following since {{ $company->followed_at->format('M Y') }}</p>
                                
                                <div class="mt-4 space-y-2">
                                    <button class="w-full px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors text-sm">
                                        View Jobs
                                    </button>
                                    <form action="{{ route('job_seeker.companies.unfollow', $company->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors text-sm">
                                            Unfollow
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mt-4">Not following any companies yet</h3>
                        <p class="text-gray-500 mt-2">Start following companies to get updates about their job openings!</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors">
                            Browse Companies
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection