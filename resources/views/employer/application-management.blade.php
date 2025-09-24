@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Manage Job Applications</h2>
                    <div class="flex space-x-2">
                        <select id="statusFilter" class="border rounded-md px-3 py-1 text-sm">
                            <option value="">All Applications</option>
                            <option value="pending">Pending</option>
                            <option value="reviewed">Reviewed</option>
                            <option value="shortlisted">Shortlisted</option>
                            <option value="rejected">Rejected</option>
                            <option value="hired">Hired</option>
                        </select>
                    </div>
                </div>
                
                @if($applications->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">No job applications found.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied On</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($applications as $application)
                                <tr class="application-row" data-status="{{ $application->status }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-600 font-medium">{{ substr($application->jobSeeker->full_name ?? 'A', 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $application->jobSeeker->full_name ?? 'N/A' }}</div>
                                                <div class="text-sm text-gray-500">{{ $application->jobSeeker->email ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $application->job->job_title ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-500">{{ $application->job->company->name ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $application->applied_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $application->status === 'reviewed' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $application->status === 'shortlisted' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $application->status === 'hired' ? 'bg-green-100 text-green-800' : '' }}
                                            status-badge">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <select class="status-select border rounded px-2 py-1 text-sm" 
                                                    data-application-id="{{ $application->id }}">
                                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="reviewed" {{ $application->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                                <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlist</option>
                                                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Reject</option>
                                                <option value="hired" {{ $application->status === 'hired' ? 'selected' : '' }}>Hire</option>
                                            </select>
                                            <a href="{{ route('employer.applications.show', $application) }}" 
                                               class="text-indigo-600 hover:text-indigo-900">View</a>
                                            <a href="{{ asset('storage/' . $application->resume_path) }}" 
                                               target="_blank" 
                                               class="text-blue-600 hover:text-blue-900">Resume</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter applications by status
    const statusFilter = document.getElementById('statusFilter');
    const applicationRows = document.querySelectorAll('.application-row');
    
    statusFilter.addEventListener('change', function() {
        const status = this.value;
        
        applicationRows.forEach(row => {
            if (!status || row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Update application status
    const statusSelects = document.querySelectorAll('.status-select');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const applicationId = this.dataset.applicationId;
            const newStatus = this.value;
            
            // Show loading state
            const originalText = this.innerHTML;
            this.disabled = true;
            this.innerHTML = 'Updating...';
            
            // Send AJAX request
            fetch(`/employer/applications/${applicationId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update status badge
                    const row = this.closest('tr');
                    const statusBadge = row.querySelector('.status-badge');
                    
                    // Update status attribute for filtering
                    row.dataset.status = newStatus;
                    
                    // Update badge text and classes
                    statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    
                    // Remove all status classes
                    statusBadge.className = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full status-badge ';
                    
                    // Add appropriate class for the new status
                    if (newStatus === 'pending') statusBadge.classList.add('bg-yellow-100', 'text-yellow-800');
                    else if (newStatus === 'reviewed') statusBadge.classList.add('bg-blue-100', 'text-blue-800');
                    else if (newStatus === 'shortlisted' || newStatus === 'hired') statusBadge.classList.add('bg-green-100', 'text-green-800');
                    else if (newStatus === 'rejected') statusBadge.classList.add('bg-red-100', 'text-red-800');
                    
                    // Show success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'Application status updated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    throw new Error(data.message || 'Failed to update status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert the select value
                this.value = this.dataset.originalValue;
                
                // Show error message
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Failed to update application status',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            })
            .finally(() => {
                // Reset button state
                this.disabled = false;
                this.innerHTML = originalText;
            });
            
            // Store original value for potential revert
            this.dataset.originalValue = newStatus;
        });
    });
});
</script>
@endpush
@endsection
