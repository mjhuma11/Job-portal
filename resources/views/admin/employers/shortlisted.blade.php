@extends('layouts.app')

@section('title', 'Shortlisted Candidates - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Shortlisted Candidates</h1>
        
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-xl font-semibold mb-4">Manage Shortlisted Candidates</h2>
            <p class="text-gray-600">View and manage your shortlisted candidates here.</p>
            
            <div class="mt-6">
                <a href="{{ route('employer.dashboard') }}" class="text-blue-600 hover:text-blue-800">← Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection