@extends('layouts.app')

@section('title', 'Security Settings - CareerBridge')

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
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">SETTINGS</div>
                    
                    <a href="{{ route('job_seeker.security') }}" class="flex items-center space-x-3 p-3 bg-blue-50 text-blue-600 border-l-4 border-blue-600 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Security</span>
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
                        <h1 class="text-2xl font-bold text-gray-900">Security Settings</h1>
                        <p class="text-gray-600">Manage your account security and privacy</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 space-y-8">
                <!-- Change Password -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Password</h3>
                    <form action="{{ route('job_seeker.security.password') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                        </div>
                        
                        <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors">
                            Update Password
                        </button>
                    </form>
                </div>

                <!-- Change Email -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Email Address</h3>
                    <form action="{{ route('job_seeker.security.email') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Current Email</label>
                            <p class="mt-1 text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">New Email Address</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors">
                            Update Email
                        </button>
                    </form>
                </div>

                <!-- Two-Factor Authentication -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Two-Factor Authentication</h3>
                    <p class="text-gray-600 mb-4">Add an extra layer of security to your account by enabling two-factor authentication.</p>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">Status: <span class="text-red-600">Disabled</span></p>
                            <p class="text-sm text-gray-500">Two-factor authentication is currently disabled</p>
                        </div>
                        <form action="{{ route('job_seeker.security.two_factor') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                Enable 2FA
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Account Created:</span>
                            <span class="font-medium">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Last Login:</span>
                            <span class="font-medium">{{ $user->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email Verified:</span>
                            <span class="font-medium">
                                @if($user->email_verified_at)
                                    <span class="text-green-600">Verified</span>
                                @else
                                    <span class="text-red-600">Not Verified</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-white rounded-lg shadow-sm border border-red-200 p-6">
                    <h3 class="text-lg font-semibold text-red-900 mb-4">Danger Zone</h3>
                    <p class="text-gray-600 mb-4">These actions are irreversible. Please be careful.</p>
                    
                    <div class="space-y-4">
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors" onclick="alert('This feature will be implemented soon.')">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection