@extends('layouts.app')

@section('title', 'Post New Job - CareerBridge')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Post New Job</h1>
        
        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <h3 class="text-red-800 font-medium mb-2">Please correct the following errors:</h3>
                <ul class="list-disc list-inside text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Display success message -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800">{{ session('success') }}</p>
            </div>
        @endif
        
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-xl font-semibold mb-4">Create Job Posting</h2>
            <p class="text-gray-600 mb-6">Create a new job posting to attract qualified candidates.</p>
            
            <form action="{{ route('employer.jobs.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Job Title -->
                <div>
                    <label for="job_title" class="block text-sm font-medium text-gray-700 mb-1">Job Title *</label>
                    <input type="text" name="job_title" id="job_title" value="{{ old('job_title') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('job_title') border-red-500 @enderror">
                    @error('job_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Company Name -->
                <div>
                    <label for="company_id" class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                    <select name="company_id" id="company_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_id') border-red-500 @enderror">
                        <option value="">Select a company</option>
                        @forelse($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @empty
                            <option value="" disabled>No companies found. Please create a company first.</option>
                        @endforelse
                    </select>
                    @error('company_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    @if($companies->isEmpty())
                        <p class="mt-1 text-sm text-blue-600">
                            <a href="#" onclick="openCreateCompanyModal()" class="underline">Create a new company</a> to post jobs.
                        </p>
                    @else
                        <p class="mt-1 text-sm text-gray-500">
                            Don't see your company? <a href="#" onclick="openCreateCompanyModal()" class="text-blue-600 underline">Add a new company</a>
                        </p>
                    @endif
                </div>
                
                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" id="category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select a category</option>
                        @foreach(App\Models\Category::all() as $category)
                            <option value="{{ $category->name }}" {{ old('category') == $category->name ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Job Type -->
                <div>
                    <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                    <select name="job_type" id="job_type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select job type</option>
                        <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                        <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                        <option value="contractor" {{ old('job_type') == 'contractor' ? 'selected' : '' }}>Contractor</option>
                        <option value="remote" {{ old('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                    </select>
                </div>
                
                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="e.g. New York, NY">
                </div>
                
                <!-- Salary -->
                <div>
                    <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                    <input type="text" name="salary" id="salary" value="{{ old('salary') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="e.g. $50,000 - $70,000">
                </div>
                
                <!-- Application Deadline -->
                <div>
                    <label for="application_deadline" class="block text-sm font-medium text-gray-700 mb-1">Application Deadline</label>
                    <input type="date" name="application_deadline" id="application_deadline" value="{{ old('application_deadline') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <!-- Experience -->
                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Experience Required</label>
                    <input type="text" name="experience" id="experience" value="{{ old('experience') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="e.g. 2-3 years">
                </div>
                
                <!-- Job Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Description *</label>
                    <textarea name="description" id="description" rows="5" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        placeholder="Describe the role, responsibilities, and requirements...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Requirements -->
                <div>
                    <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Requirements</label>
                    <textarea name="requirements" id="requirements" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="List the qualifications and skills required...">{{ old('requirements') }}</textarea>
                </div>
                
                <!-- Responsibilities -->
                <div>
                    <label for="responsibilities" class="block text-sm font-medium text-gray-700 mb-1">Responsibilities</label>
                    <textarea name="responsibilities" id="responsibilities" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="List the key responsibilities for this role...">{{ old('responsibilities') }}</textarea>
                </div>
                
                <!-- Benefits -->
                <div>
                    <label for="benefits" class="block text-sm font-medium text-gray-700 mb-1">Benefits</label>
                    <textarea name="benefits" id="benefits" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="List the benefits offered...">{{ old('benefits') }}</textarea>
                </div>
                
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="open" {{ old('status', 'open') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                
                <!-- Featured Job -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                        Featured Job
                    </label>
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('employer.jobs.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Post Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Company Creation Modal -->
<div id="createCompanyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Create New Company</h3>
                <button onclick="closeCreateCompanyModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="createCompanyForm" action="{{ route('employer.companies.store') }}" method="POST">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ route('employer.jobs.create') }}">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Company Name -->
                    <div class="mb-4">
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                        <input type="text" name="name" id="company_name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <!-- Company Email -->
                    <div class="mb-4">
                        <label for="company_email" class="block text-sm font-medium text-gray-700 mb-1">Company Email *</label>
                        <input type="email" name="email" id="company_email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <!-- Industry -->
                    <div class="mb-4">
                        <label for="company_industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                        <select name="industry" id="company_industry"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Industry</option>
                            <option value="Technology">Technology</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Finance">Finance</option>
                            <option value="Education">Education</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Retail">Retail</option>
                            <option value="Construction">Construction</option>
                            <option value="Transportation">Transportation</option>
                            <option value="Hospitality">Hospitality</option>
                            <option value="Real Estate">Real Estate</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Consulting">Consulting</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="tel" name="phone" id="company_phone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="+1 (555) 123-4567">
                    </div>
                    
                    <!-- Website -->
                    <div class="mb-4">
                        <label for="company_website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <input type="url" name="website" id="company_website"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="https://example.com">
                    </div>
                    
                    <!-- Logo -->
                    <div class="mb-4">
                        <label for="company_logo" class="block text-sm font-medium text-gray-700 mb-1">Logo URL</label>
                        <input type="url" name="logo" id="company_logo"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="https://example.com/logo.png">
                    </div>
                    
                    <!-- Founded Year -->
                    <div class="mb-4">
                        <label for="company_founded_year" class="block text-sm font-medium text-gray-700 mb-1">Founded Year</label>
                        <input type="number" name="founded_year" id="company_founded_year" min="1800" max="{{ date('Y') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="{{ date('Y') }}">
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-4">
                    <label for="company_description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="company_description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Brief description of your company..."></textarea>
                </div>
                
                <!-- Checkboxes -->
                <div class="mb-4 flex space-x-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" id="company_featured" value="1"
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="company_featured" class="ml-2 block text-sm text-gray-700">
                            Featured Company
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="verified" id="company_verified" value="1"
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="company_verified" class="ml-2 block text-sm text-gray-700">
                            Verified Company
                        </label>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" onclick="closeCreateCompanyModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700">
                        Create Company
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateCompanyModal() {
    document.getElementById('createCompanyModal').classList.remove('hidden');
}

function closeCreateCompanyModal() {
    document.getElementById('createCompanyModal').classList.add('hidden');
    document.getElementById('createCompanyForm').reset();
}

// Handle form submission via AJAX
document.getElementById('createCompanyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    
    // Debug: Log form data
    console.log('Form submission started');
    console.log('Form action:', this.action);
    console.log('Form data:');
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }
    
    // Show loading state
    submitButton.disabled = true;
    submitButton.textContent = 'Creating...';
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        } else {
            // If not JSON, it's probably an HTML error page
            throw new Error('Server returned an unexpected response. Please refresh the page and try again.');
        }
    })
    .then(data => {
        console.log('Response data:', data);
        
        if (data.success) {
            // Close modal
            closeCreateCompanyModal();
            
            // Show SweetAlert success message
            Swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3B82F6'
            }).then(() => {
                // Add the new company to the dropdown
                const companySelect = document.getElementById('company_id');
                const newOption = document.createElement('option');
                newOption.value = data.company.id;
                newOption.textContent = data.company.name;
                newOption.selected = true;
                companySelect.appendChild(newOption);
                
                // Remove the "no companies" message if it exists
                const noCompaniesOption = companySelect.querySelector('option[disabled]');
                if (noCompaniesOption) {
                    noCompaniesOption.remove();
                }
            });
        } else {
            let errorMessage = data.message || 'Error creating company. Please try again.';
            
            // Handle validation errors
            if (data.errors) {
                const errorList = Object.values(data.errors).flat();
                errorMessage = errorList.join('\n');
            }
            
            Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#EF4444'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: error.message || 'Something went wrong. Please try again.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#EF4444'
        });
    })
    .finally(() => {
        // Reset button state
        submitButton.disabled = false;
        submitButton.textContent = originalText;
    });
});

// Close modal when clicking outside
document.getElementById('createCompanyModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateCompanyModal();
    }
});
</script>

@endsection