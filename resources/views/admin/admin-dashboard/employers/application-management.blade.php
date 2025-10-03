@extends('layouts.app')

@section('title', 'Application Management - CareerBridge')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50">
    <!-- Application Management Container -->
    <div class="flex">
        @include('admin.employers.partials.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <span>Employer</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span>Dashboard</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-teal-600">Application Management</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Application Management</h1>
                <p class="text-gray-600 mt-1">Review and manage job applications from candidates.</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-8">
                <!-- Total Applications -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 shadow-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['total'] }}</div>
                        <div class="text-xs text-blue-100">Total</div>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-4 shadow-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['pending'] }}</div>
                        <div class="text-xs text-yellow-100">Pending</div>
                    </div>
                </div>

                <!-- Reviewed -->
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl p-4 shadow-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['reviewed'] }}</div>
                        <div class="text-xs text-indigo-100">Reviewed</div>
                    </div>
                </div>

                <!-- Shortlisted -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 shadow-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['shortlisted'] }}</div>
                        <div class="text-xs text-green-100">Shortlisted</div>
                    </div>
                </div>

                <!-- Interview Scheduled -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-4 shadow-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['interview_scheduled'] }}</div>
                        <div class="text-xs text-purple-100">Interview</div>
                    </div>
                </div>

                <!-- Rejected -->
                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl p-4 shadow-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['rejected'] }}</div>
                        <div class="text-xs text-red-100">Rejected</div>
                    </div>
                </div>

                <!-- Hired -->
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl p-4 shadow-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['hired'] }}</div>
                        <div class="text-xs text-emerald-100">Hired</div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6">
                <form method="GET" action="{{ route('employer.applications.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Candidates</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" 
                               placeholder="Name or email..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewed" {{ request('status') === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="shortlisted" {{ request('status') === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="interview_scheduled" {{ request('status') === 'interview_scheduled' ? 'selected' : '' }}>Interview Scheduled</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="hired" {{ request('status') === 'hired' ? 'selected' : '' }}>Hired</option>
                        </select>
                    </div>

                    <!-- Job Filter -->
                    <div>
                        <label for="job_id" class="block text-sm font-medium text-gray-700 mb-1">Job Position</label>
                        <select id="job_id" name="job_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option value="">All Jobs</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}" {{ request('job_id') == $job->id ? 'selected' : '' }}>
                                    {{ $job->job_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-teal-500 to-teal-600 text-white px-4 py-2 rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                            </svg>
                            Filter
                        </button>
                        <button type="button" onclick="refreshApplications()" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Refresh
                        </button>
                        <a href="{{ route('employer.applications.index') }}" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-4 py-2 rounded-lg hover:from-gray-600 hover:to-gray-700 transition-all duration-300">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear
                        </a>
                    </div>
                </form>
            </div>

            <!-- Last Updated Info -->
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-600">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Last updated: {{ now()->format('M d, Y H:i:s') }}
                </div>
                <div class="text-sm text-gray-600">
                    <span id="dynamic-status" class="inline-flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        Dynamic Updates Active
                    </span>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                @if($applications->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-full flex items-center justify-center bg-gray-100">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No applications found</h3>
                        <p class="text-gray-600 mb-6">No job applications match your current filters.</p>
                        <a href="{{ route('employer.applications.index') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                            Clear Filters
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Candidate</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Position</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($applications as $application)
                                <tr class="application-row hover:bg-gray-50 transition-colors" data-status="{{ $application->application_status }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center">
                                                <span class="text-white font-bold text-sm">{{ substr($application->jobSeeker->full_name ?? 'A', 0, 2) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $application->jobSeeker->full_name ?? 'Unknown' }}</div>
                                                <div class="text-sm text-gray-500">{{ $application->jobSeeker->email ?? 'No email' }}</div>
                                                <div class="text-xs text-gray-400">{{ $application->jobSeeker->experience ?? 'Experience not specified' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $application->job->job_title ?? 'Unknown Job' }}</div>
                                        <div class="text-sm text-gray-500">{{ $application->job->company->name ?? 'Unknown Company' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $application->applied_at->format('M d, Y') }}
                                        <div class="text-xs text-gray-400">{{ $application->applied_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'reviewed' => 'bg-blue-100 text-blue-800',
                                                'shortlisted' => 'bg-green-100 text-green-800',
                                                'interview_scheduled' => 'bg-purple-100 text-purple-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                                'hired' => 'bg-emerald-100 text-emerald-800'
                                            ];
                                            $statusClass = $statusClasses[$application->application_status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }} status-badge">
                                            {{ ucfirst(str_replace('_', ' ', $application->application_status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <!-- Status Update Dropdown -->
                                            <select class="status-select border border-gray-300 rounded px-2 py-1 text-xs focus:ring-2 focus:ring-teal-500 focus:border-teal-500" 
                                                    data-application-id="{{ $application->application_id }}">
                                                <option value="pending" {{ $application->application_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="reviewed" {{ $application->application_status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                                <option value="shortlisted" {{ $application->application_status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                                <option value="interview_scheduled" {{ $application->application_status === 'interview_scheduled' ? 'selected' : '' }}>Interview</option>
                                                <option value="rejected" {{ $application->application_status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                <option value="hired" {{ $application->application_status === 'hired' ? 'selected' : '' }}>Hired</option>
                                            </select>
                                            
                                            <!-- Action Buttons -->
                                            <div class="flex items-center space-x-2">
                                                <!-- View Application -->
                                                <a href="{{ route('employer.applications.show', $application->application_id) }}" 
                                                   class="inline-flex items-center px-2 py-1 bg-indigo-100 text-indigo-700 text-xs rounded hover:bg-indigo-200 transition-colors"
                                                   title="View Details">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    View
                                                </a>
                                                
                                                <!-- Download CV -->
                                                @if($application->jobSeeker && $application->jobSeeker->resume_file)
                                                    <a href="{{ route('employer.applications.download.cv', $application->application_id) }}" 
                                                       class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs rounded hover:bg-green-200 transition-colors"
                                                       title="Download CV">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        CV
                                                    </a>
                                                @endif
                                                
                                                <!-- Send Alert -->
                                                <button onclick="openAlertModal('{{ $application->application_id }}')" 
                                                        class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded hover:bg-yellow-200 transition-colors"
                                                        title="Send Alert">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM4 15h8v-2H4v2zM4 11h8V9H4v2z"></path>
                                                    </svg>
                                                    Alert
                                                </button>
                                                
                                                <!-- Send Message -->
                                                <button onclick="openMessageModal('{{ $application->application_id }}')" 
                                                        class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded hover:bg-blue-200 transition-colors"
                                                        title="Send Message">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                    Message
                                                </button>
                                                
                                                <!-- Schedule Interview -->
                                                <button onclick="openInterviewModal('{{ $application->application_id }}')" 
                                                        class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded hover:bg-purple-200 transition-colors"
                                                        title="Schedule Interview">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    Interview
                                                </button>
                                                
                                                <!-- Add Notes -->
                                                <button onclick="openNotesModal('{{ $application->application_id }}')" 
                                                        class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded hover:bg-gray-200 transition-colors"
                                                        title="Add Notes">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Notes
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $applications->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Alert Modal -->
<div id="alertModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Send Alert</h3>
            </div>
            <form id="alertForm" method="POST">
                @csrf
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alert Type</label>
                        <select name="alert_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="interview_invitation">Interview Invitation</option>
                            <option value="status_update">Status Update</option>
                            <option value="general_message">General Message</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" name="subject" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Schedule Date (Optional)</label>
                        <input type="datetime-local" name="scheduled_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2">
                    <button type="button" onclick="closeAlertModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-md hover:bg-teal-700">Send Alert</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Message Modal -->
<div id="messageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Send Message</h3>
            </div>
            <form id="messageForm" method="POST">
                @csrf
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Priority</label>
                        <select name="priority" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required placeholder="Type your message here..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2">
                    <button type="button" onclick="closeMessageModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Interview Modal -->
<div id="interviewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Schedule Interview</h3>
            </div>
            <form id="interviewForm" method="POST">
                @csrf
                <div class="px-6 py-4 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Interview Date</label>
                            <input type="date" name="interview_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Interview Time</label>
                            <input type="time" name="interview_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Interview Type</label>
                        <select name="interview_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="in_person">In Person</option>
                            <option value="video_call">Video Call</option>
                            <option value="phone_call">Phone Call</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location/Link</label>
                        <input type="text" name="location_or_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required placeholder="Office address or meeting link">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                        <textarea name="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="Additional instructions or notes..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2">
                    <button type="button" onclick="closeInterviewModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md hover:bg-purple-700">Schedule Interview</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Notes Modal -->
<div id="notesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Add Notes</h3>
            </div>
            <form id="notesForm" method="POST">
                @csrf
                <div class="px-6 py-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required placeholder="Add your notes about this application..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2">
                    <button type="button" onclick="closeNotesModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md hover:bg-gray-700">Save Notes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Application Management: JavaScript loaded');
    
    // Update application status
    const statusSelects = document.querySelectorAll('.status-select');
    console.log('Found status selects:', statusSelects.length);
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const applicationId = this.dataset.applicationId;
            const newStatus = this.value;
            const originalValue = this.querySelector(`option[selected]`)?.value || this.value;
            
            console.log('Status change triggered:', { applicationId, newStatus, originalValue });
            
            // Simple test alert
            if (!applicationId) {
                alert('Error: Application ID not found!');
                console.error('Application ID is missing from data-application-id attribute');
                return;
            }
            
            // Show loading state
            this.disabled = true;
            this.style.backgroundColor = '#f3f4f6';
            this.style.cursor = 'wait';
            
            // Send AJAX request
            const url = `{{ url('/employer/applications') }}/${applicationId}/status`;
            console.log('Sending request to:', url);
            console.log('Request data:', { status: newStatus });
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error('Response error:', text);
                        throw new Error(`HTTP ${response.status}: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Update status badge
                    const row = this.closest('tr');
                    const statusBadge = row.querySelector('.status-badge');
                    
                    if (statusBadge) {
                        // Update status attribute for filtering
                        row.dataset.status = newStatus;
                        
                        // Update badge text and classes
                        statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1).replace('_', ' ');
                        
                        // Remove all status classes
                        statusBadge.className = 'px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full status-badge ';
                        
                        // Add appropriate class for the new status
                        const statusClasses = {
                            'pending': 'bg-yellow-100 text-yellow-800',
                            'reviewed': 'bg-blue-100 text-blue-800',
                            'shortlisted': 'bg-green-100 text-green-800',
                            'interview_scheduled': 'bg-purple-100 text-purple-800',
                            'rejected': 'bg-red-100 text-red-800',
                            'hired': 'bg-emerald-100 text-emerald-800'
                        };
                        
                        if (statusClasses[newStatus]) {
                            statusBadge.classList.add(...statusClasses[newStatus].split(' '));
                        }
                        
                        // Update statistics if they exist
                        updateStatistics(newStatus, originalValue);
                        
                        console.log('Status badge updated successfully');
                    } else {
                        console.error('Status badge not found in row');
                    }
                    
                    // Show success notification
                    showNotification('Application status updated successfully!', 'success');
                } else {
                    throw new Error(data.message || 'Failed to update status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert the select value
                this.value = originalValue;
                
                // Show error notification
                showNotification('Failed to update application status. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                this.disabled = false;
                this.style.backgroundColor = '';
                this.style.cursor = '';
            });
        });
    });
    
    // Update statistics when status changes
    function updateStatistics(newStatus, oldStatus) {
        // Find statistics cards and update counts
        const statsCards = document.querySelectorAll('.grid .rounded-xl');
        
        // Map status to card index (0=total, 1=pending, 2=reviewed, etc.)
        const statusMap = {
            'pending': 1,
            'reviewed': 2,
            'shortlisted': 3,
            'interview_scheduled': 4,
            'rejected': 5,
            'hired': 6
        };
        
        // Decrease old status count
        if (oldStatus && statusMap[oldStatus] && statsCards[statusMap[oldStatus]]) {
            const oldCard = statsCards[statusMap[oldStatus]];
            const countElement = oldCard.querySelector('.text-2xl');
            if (countElement) {
                const currentCount = parseInt(countElement.textContent) || 0;
                countElement.textContent = Math.max(0, currentCount - 1);
            }
        }
        
        // Increase new status count
        if (statusMap[newStatus] && statsCards[statusMap[newStatus]]) {
            const newCard = statsCards[statusMap[newStatus]];
            const countElement = newCard.querySelector('.text-2xl');
            if (countElement) {
                const currentCount = parseInt(countElement.textContent) || 0;
                countElement.textContent = currentCount + 1;
            }
        }
    }
    
    // Manual filtering functionality (no auto-submit)
    // Users need to click the Filter button to apply filters
    
    // Manual refresh function
    window.refreshApplications = function() {
        showNotification('Refreshing applications...', 'info');
        setTimeout(() => {
            window.location.reload();
        }, 500);
    };
    
    // Show initialization notification
    setTimeout(() => {
        showNotification('Application management loaded successfully!', 'success');
    }, 1000);
    
    // Modal functions
    window.openAlertModal = function(applicationId) {
        const modal = document.getElementById('alertModal');
        const form = document.getElementById('alertForm');
        form.action = `{{ url('/employer/applications') }}/${applicationId}/send-alert`;
        modal.classList.remove('hidden');
    };
    
    window.closeAlertModal = function() {
        document.getElementById('alertModal').classList.add('hidden');
        document.getElementById('alertForm').reset();
    };
    
    window.openMessageModal = function(applicationId) {
        const modal = document.getElementById('messageModal');
        const form = document.getElementById('messageForm');
        form.action = `{{ url('/employer/applications') }}/${applicationId}/send-message`;
        modal.classList.remove('hidden');
    };
    
    window.closeMessageModal = function() {
        document.getElementById('messageModal').classList.add('hidden');
        document.getElementById('messageForm').reset();
    };
    
    window.openInterviewModal = function(applicationId) {
        const modal = document.getElementById('interviewModal');
        const form = document.getElementById('interviewForm');
        form.action = `{{ url('/employer/applications') }}/${applicationId}/schedule-interview`;
        modal.classList.remove('hidden');
        
        // Set minimum date to today
        const dateInput = form.querySelector('input[name="interview_date"]');
        const today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
    };
    
    window.closeInterviewModal = function() {
        document.getElementById('interviewModal').classList.add('hidden');
        document.getElementById('interviewForm').reset();
    };
    
    window.openNotesModal = function(applicationId) {
        const modal = document.getElementById('notesModal');
        const form = document.getElementById('notesForm');
        form.action = `{{ url('/employer/applications') }}/${applicationId}/add-notes`;
        modal.classList.remove('hidden');
    };
    
    window.closeNotesModal = function() {
        document.getElementById('notesModal').classList.add('hidden');
        document.getElementById('notesForm').reset();
    };
    
    // Handle modal form submissions
    ['alertForm', 'messageForm', 'interviewForm', 'notesForm'].forEach(formId => {
        const form = document.getElementById(formId);
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.textContent = 'Processing...';
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        
                        // Close modal
                        const modal = this.closest('.fixed');
                        modal.classList.add('hidden');
                        this.reset();
                        
                        // Refresh page after a short delay
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Operation failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification(error.message || 'Operation failed. Please try again.', 'error');
                })
                .finally(() => {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
            });
        }
    });
    
    // Close modals when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('fixed') && e.target.classList.contains('bg-gray-600')) {
            e.target.classList.add('hidden');
        }
    });

    
    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
        
        const colors = {
            'success': 'bg-green-500 text-white',
            'error': 'bg-red-500 text-white',
            'info': 'bg-blue-500 text-white'
        };
        
        notification.className += ` ${colors[type]}`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translate-x-0';
        }, 100);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.transform = 'translate-x-full';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
});
</script>
@endpush
@endsection
