@extends('layouts.app')

@section('title', 'Message Details - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.messages') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Messages
                </a>
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Message Details</h1>
                        <p class="text-gray-600 mt-1">View message from {{ $message->name }}</p>
                    </div>
                    <div>
                        @if($message->status === 'unread')
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Unread</span>
                        @elseif($message->status === 'read')
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Read</span>
                        @else
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Replied</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Message Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Message Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ $message->subject }}</h3>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <span>From: {{ $message->name }} ({{ $message->email }})</span>
                                <span class="mx-2">•</span>
                                <span>Sent: {{ $message->created_at->format('M d, Y \a\t g:i A') }}</span>
                            </div>
                        </div>
                        
                        <div class="prose max-w-none">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
                        </div>
                    </div>
                    
                    <!-- Reply Section -->
                    @if(!$message->reply)
                    <div id="reply" class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Reply to Message</h3>
                        
                        <form action="{{ route('admin.messages.reply', $message) }}" method="POST">
                            @csrf
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="reply" class="block text-sm font-medium text-gray-700 mb-1">Your Reply *</label>
                                    <textarea name="reply" id="reply" rows="6" 
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                              placeholder="Enter your reply here..." required>{{ old('reply') }}</textarea>
                                    @error('reply')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                                        Send Reply
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Your Reply</h3>
                        
                        <div class="prose max-w-none">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $message->reply }}</p>
                        </div>
                        
                        <div class="mt-4 text-sm text-gray-500">
                            Replied on: {{ $message->updated_at->format('M d, Y \a\t g:i A') }}
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Sender Information -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Sender Information</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                                <p class="text-sm font-medium text-gray-900">{{ $message->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                <p class="text-sm font-medium text-gray-900">{{ $message->email }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Subject</label>
                                <p class="text-sm font-medium text-gray-900">{{ $message->subject }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Sent</label>
                                <p class="text-sm font-medium text-gray-900">{{ $message->created_at->format('M d, Y') }}</p>
                                <p class="text-sm text-gray-500">{{ $message->created_at->format('g:i A') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <p class="text-sm font-medium text-gray-900">
                                    @if($message->status === 'unread')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Unread
                                    </span>
                                    @elseif($message->status === 'read')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Read
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Replied
                                    </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                        
                        <div class="space-y-3">
                            @if(!$message->reply)
                            <a href="#reply" 
                               class="block w-full text-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                Reply to Message
                            </a>
                            @endif
                            
                            <button onclick="window.print()" 
                                    class="block w-full text-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                Print Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection