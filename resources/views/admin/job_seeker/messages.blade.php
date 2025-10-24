@extends('layouts.app')

@section('title', 'Messages - CareerBridge')

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
                    
                    <a href="{{ route('job_seeker.messages') }}" class="flex items-center space-x-3 p-3 bg-blue-50 text-blue-600 border-l-4 border-blue-600 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <span>Messages</span>
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
                        <h1 class="text-2xl font-bold text-gray-900">Messages</h1>
                        <p class="text-gray-600">Communication with employers and recruiters</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @if($messages->count() > 0)
                    <div class="space-y-4">
                        @foreach($messages as $message)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ substr($message->sender, 0, 2) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $message->subject }}</h3>
                                            @if($message->status === 'unread')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">New</span>
                                            @endif
                                        </div>
                                        <p class="text-gray-600 text-sm">From: {{ $message->sender }}</p>
                                        <p class="text-gray-700 mt-2">{{ Str::limit($message->content, 150) }}</p>
                                        <p class="text-gray-500 text-xs mt-2">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('job_seeker.messages.show', $message->id) }}" class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors text-sm">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mt-4">No messages yet</h3>
                        <p class="text-gray-500 mt-2">When employers contact you, their messages will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection