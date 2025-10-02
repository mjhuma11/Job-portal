@extends('layouts.app')

@section('title', 'Edit Location - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="flex">
        @include('admin.admin-dashboard.partials.sidebar')
        
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.locations') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Locations
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Edit Location</h1>
                <p class="text-gray-600 mt-1">Update location information</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <form action="{{ route('admin.locations.update', $location) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                            <input type="text" name="city" id="city" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Enter city name" value="{{ old('city', $location->city) }}" required>
                            @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                            <input type="text" name="state" id="state" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Enter state name" value="{{ old('state', $location->state) }}">
                            @error('state')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                            <input type="text" name="country" id="country" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Enter country name" value="{{ old('country', $location->country) }}" required>
                            @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="is_popular" id="is_popular" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   {{ old('is_popular', $location->is_popular) ? 'checked' : '' }}>
                            <label for="is_popular" class="ml-2 block text-sm text-gray-700">
                                Popular Location
                            </label>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.locations') }}" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                            Update Location
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection