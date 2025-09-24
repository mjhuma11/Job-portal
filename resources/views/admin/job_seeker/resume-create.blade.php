@extends('layouts.app')

@section('title', 'Add Resume - CareerBridge')

@section('content')
<!-- Blue Header Section -->
<div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative z-10 py-16 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Add Resume</h1>
            <p class="text-blue-100 text-lg mb-6">Business plan draws on a wide range of knowledge from different business disciplines. Business draws on a wide range of different business.</p>
            <nav class="text-blue-200">
                <a href="{{ route('job_seeker.dashboard') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">Add Resume</span>
            </nav>
        </div>
    </div>
</div>

<div class="min-h-screen bg-gray-50">
    <div class="flex">
        @include('admin.job_seeker.partials.sidebar')
        
        <div class="flex-1 p-8">

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="max-w-4xl mx-auto mb-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Display Success Message -->
            @if (session('success'))
                <div class="max-w-4xl mx-auto mb-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="max-w-4xl mx-auto">
                <form action="{{ route('job_seeker.resume.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Basic Information Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-8 py-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Basic Information</h2>
                            <p class="text-gray-600 text-sm mt-1">Already have an account? <a href="#" class="text-blue-600 hover:underline">Click here to login</a></p>
                        </div>
                        <div class="px-8 py-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                    <input type="text" id="name" name="name" 
                                           value="{{ auth()->user()->name }}" 
                                           placeholder="Name"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email" 
                                           value="{{ auth()->user()->email }}" 
                                           placeholder="Your@domain.com"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Professional Title -->
                                <div>
                                    <label for="current_position" class="block text-sm font-medium text-gray-700 mb-2">Professional Title</label>
                                    <input type="text" id="current_position" name="current_position" 
                                           value="{{ old('current_position') }}"
                                           placeholder="Something (e.g. Front-end developer)"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Location -->
                                <div>
                                    <label for="location_preference" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                    <input type="text" id="location_preference" name="location_preference" 
                                           value="{{ old('location_preference') }}"
                                           placeholder="Location, e.g"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Website -->
                                <div>
                                    <label for="portfolio_url" class="block text-sm font-medium text-gray-700 mb-2">Web</label>
                                    <input type="url" id="portfolio_url" name="portfolio_url" 
                                           value="{{ old('portfolio_url') }}"
                                           placeholder="Website address"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Per Hour Rate -->
                                <div>
                                    <label for="expected_salary_min" class="block text-sm font-medium text-gray-700 mb-2">Per Hour</label>
                                    <input type="number" id="expected_salary_min" name="expected_salary_min" 
                                           value="{{ old('expected_salary_min') }}"
                                           placeholder="Salary, e.g. $5"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <!-- Age -->
                            <div class="mt-6">
                                <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                                <input type="number" id="age" name="age" 
                                       value="{{ old('age') }}"
                                       placeholder="Years old"
                                       class="w-full md:w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Years of Experience -->
                            <div class="mt-6">
                                <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">Years of Experience</label>
                                <input type="number" id="experience_years" name="experience_years" 
                                       value="{{ old('experience_years', 0) }}"
                                       placeholder="Years of work experience"
                                       min="0" max="50"
                                       class="w-full md:w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Bio/Description -->
                            <div class="mt-6">
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Professional Summary</label>
                                <textarea id="bio" name="bio" rows="4" 
                                          placeholder="Write a brief description about yourself..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('bio') }}</textarea>
                            </div>

                            <!-- Availability Status -->
                            <div class="mt-6">
                                <label for="availability_status" class="block text-sm font-medium text-gray-700 mb-2">Availability Status</label>
                                <select id="availability_status" name="availability_status" 
                                        class="w-full md:w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="immediately" {{ old('availability_status') == 'immediately' ? 'selected' : '' }}>Available Immediately</option>
                                    <option value="within_month" {{ old('availability_status') == 'within_month' ? 'selected' : '' }}>Within a Month</option>
                                    <option value="within_3_months" {{ old('availability_status') == 'within_3_months' ? 'selected' : '' }}>Within 3 Months</option>
                                    <option value="not_looking" {{ old('availability_status') == 'not_looking' ? 'selected' : '' }}>Not Looking</option>
                                </select>
                            </div>

                            <!-- Remote Preference -->
                            <div class="mt-6">
                                <label class="flex items-center">
                                    <input type="checkbox" id="remote_preference" name="remote_preference" value="1" 
                                           {{ old('remote_preference') ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    <span class="ml-2 text-sm font-medium text-gray-700">Open to Remote Work</span>
                                </label>
                            </div>

                            
                        </div>
                    </div>

                    <!-- Education Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-8 py-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Education</h2>
                        </div>
                        <div class="px-8 py-8" id="educationContainer">
                            <div class="education-entry">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Degree -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                                        <input type="text" name="educations[0][degree_name]" 
                                               placeholder="Degree, e.g Bachelor"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Field of Study -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Field of Study</label>
                                        <input type="text" name="educations[0][field_of_study]" 
                                               placeholder="Major, e.g Computer Science"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- From -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">From</label>
                                        <input type="number" name="educations[0][start_year]" 
                                               placeholder="e.g 2014"
                                               min="1950" max="2040"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- To -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">To</label>
                                        <input type="number" name="educations[0][passing_year]" 
                                               placeholder="e.g 2020"
                                               min="1950" max="2040"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <!-- School -->
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">School</label>
                                    <input type="text" name="educations[0][institute_name]" 
                                           placeholder="School name, e.g. Massachusetts Institute of Technology"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Description -->
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea name="educations[0][description]" rows="4" 
                                              placeholder="Write about your education experience..."
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="px-8 pb-6 flex justify-between">
                            
                            <div class="space-x-4">
                                <button type="button" id="addEducation" class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add New Education
                                </button>
                                <button type="button" class="text-red-600 hover:text-red-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete This
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Work Experience Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-8 py-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Work Experience</h2>
                        </div>
                        <div class="px-8 py-8" id="workContainer">
                            <div class="work-entry">
                                <!-- Company Name -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                                    <input type="text" name="work_experiences[0][company_name]" 
                                           placeholder="Company name"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Title -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <input type="text" name="work_experiences[0][job_title]" 
                                           placeholder="e.g UIUX Researcher"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <!-- Date From -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                                        <input type="date" name="work_experiences[0][start_date]" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Date To -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                                        <input type="date" name="work_experiences[0][end_date]" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea name="work_experiences[0][description]" rows="4" 
                                              placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed duis ut enim nunc tellus, rutrum magna pretium facilisis eque quis tortor."  
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="px-8 pb-6 flex justify-between">
                            
                            <div class="space-x-4">
                                <button type="button" id="addExperience" class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add New Experience
                                </button>
                                
                            </div>
                        </div>
                    </div>

                    <!-- Skills Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-8 py-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Skills</h2>
                        </div>
                        <div class="px-8 py-8" id="skillsContainer">
                            <div class="skills-entry">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Skill Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Skill Name</label>
                                        <input type="text" name="skills[0][name]" 
                                               placeholder="Skill name, e.g. HTML"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Proficiency -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">% (1-100)</label>
                                        <input type="number" name="skills[0][proficiency]" 
                                               placeholder="Skill proficiency, e.g. 90"
                                               min="1" max="100"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-8 pb-6 flex justify-end">
                            <div class="space-x-4">
                                <button type="button" id="addSkill" class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add New Skills
                                </button>

                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center py-8">
                        <button type="submit" class="bg-blue-600 text-white px-12 py-4 rounded-lg text-lg font-semibold hover:bg-blue-700 transition-colors">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let educationIndex = 1;
    let experienceIndex = 1;
    let skillIndex = 1;

    // Add New Education
    document.getElementById('addEducation').addEventListener('click', function() {
        const container = document.getElementById('educationContainer');
        const newEducation = `
            <div class="education-entry border-t pt-8 mt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                        <input type="text" name="educations[${educationIndex}][degree_name]" 
                               placeholder="Degree, e.g Bachelor"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Field of Study</label>
                        <input type="text" name="educations[${educationIndex}][field_of_study]" 
                               placeholder="Major, e.g Computer Science"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From</label>
                        <input type="number" name="educations[${educationIndex}][start_year]" 
                               placeholder="e.g 2014" min="1950" max="2040"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To</label>
                        <input type="number" name="educations[${educationIndex}][passing_year]" 
                               placeholder="e.g 2020" min="1950" max="2040"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">School</label>
                    <input type="text" name="educations[${educationIndex}][institute_name]" 
                           placeholder="School name, e.g. Massachusetts Institute of Technology"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="educations[${educationIndex}][description]" rows="4" 
                              placeholder="Write about your education experience..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="mt-4">
                    <button type="button" class="remove-education text-red-600 hover:text-red-800">
                        Remove This Education
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newEducation);
        educationIndex++;
        
        // Add event listener to new remove button
        container.lastElementChild.querySelector('.remove-education').addEventListener('click', function() {
            this.closest('.education-entry').remove();
        });
    });

    // Add New Experience
    document.getElementById('addExperience').addEventListener('click', function() {
        const container = document.getElementById('workContainer');
        const newExperience = `
            <div class="work-entry border-t pt-8 mt-8">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                    <input type="text" name="work_experiences[${experienceIndex}][company_name]" 
                           placeholder="Company name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="work_experiences[${experienceIndex}][job_title]" 
                           placeholder="e.g UIUX Researcher"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                        <input type="date" name="work_experiences[${experienceIndex}][start_date]" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                        <input type="date" name="work_experiences[${experienceIndex}][end_date]" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="work_experiences[${experienceIndex}][description]" rows="4" 
                              placeholder="Describe your work experience..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="mt-4">
                    <button type="button" class="remove-experience text-red-600 hover:text-red-800">
                        Remove This Experience
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newExperience);
        experienceIndex++;
        
        // Add event listener to new remove button
        container.lastElementChild.querySelector('.remove-experience').addEventListener('click', function() {
            this.closest('.work-entry').remove();
        });
    });

    // Add New Skill
    document.getElementById('addSkill').addEventListener('click', function() {
        const container = document.getElementById('skillsContainer');
        const newSkill = `
            <div class="skills-entry border-t pt-6 mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skill Name</label>
                        <input type="text" name="skills[${skillIndex}][name]" 
                               placeholder="Skill name, e.g. HTML"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">% (1-100)</label>
                        <input type="number" name="skills[${skillIndex}][proficiency]" 
                               placeholder="Skill proficiency, e.g. 90" min="1" max="100"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="remove-skill text-red-600 hover:text-red-800">
                        Remove This Skill
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newSkill);
        skillIndex++;
        
        // Add event listener to new remove button
        container.lastElementChild.querySelector('.remove-skill').addEventListener('click', function() {
            this.closest('.skills-entry').remove();
        });
    });
});
</script>
@endpush