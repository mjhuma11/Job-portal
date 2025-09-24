@extends('layouts.app')

@section('title', 'Edit Resume - CareerBridge')

@section('content')


<div class="min-h-screen bg-gray-50">
    <div class="flex">
        @include('admin.job_seeker.partials.sidebar')
        
        <div class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <form action="{{ route('job_seeker.resume.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-8 py-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Basic Information</h2>
                            <p class="text-gray-600 text-sm mt-1">Update your personal and professional information</p>
                        </div>
                        <div class="px-8 py-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                    <input type="text" id="name" name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           placeholder="Name"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           placeholder="Your@domain.com"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Professional Title -->
                                <div>
                                    <label for="current_position" class="block text-sm font-medium text-gray-700 mb-2">Professional Title</label>
                                    <input type="text" id="current_position" name="current_position" 
                                           value="{{ old('current_position', $jobSeeker->current_position) }}"
                                           placeholder="Something (e.g. Front-end developer)"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Location -->
                                <div>
                                    <label for="location_preference" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                    <input type="text" id="location_preference" name="location_preference" 
                                           value="{{ old('location_preference', $jobSeeker->location_preference) }}"
                                           placeholder="Location, e.g"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Website -->
                                <div>
                                    <label for="portfolio_url" class="block text-sm font-medium text-gray-700 mb-2">Web</label>
                                    <input type="url" id="portfolio_url" name="portfolio_url" 
                                           value="{{ old('portfolio_url', $jobSeeker->portfolio_url) }}"
                                           placeholder="Website address"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Per Hour Rate -->
                                <div>
                                    <label for="expected_salary_min" class="block text-sm font-medium text-gray-700 mb-2">Per Hour</label>
                                    <input type="number" id="expected_salary_min" name="expected_salary_min" 
                                           value="{{ old('expected_salary_min', $jobSeeker->expected_salary_min) }}"
                                           placeholder="Salary, e.g. $5"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <!-- Age -->
                            <div class="mt-6">
                                <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                                <input type="number" id="experience_years" name="experience_years" 
                                       value="{{ old('experience_years', $jobSeeker->experience_years) }}"
                                       placeholder="Years old"
                                       class="w-full md:w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Bio/Description -->
                            <div class="mt-6">
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Professional Summary</label>
                                <textarea id="bio" name="bio" rows="4" 
                                          placeholder="Write a brief description about yourself..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('bio', $jobSeeker->bio) }}</textarea>
                            </div>

                            <!-- Choose Cover Image Button -->
                            <!-- Education Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-8 py-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Education</h2>
                        </div>
                        <div class="px-8 py-8" id="educationContainer">
                            @forelse($educations as $index => $education)
                            <div class="education-entry {{ $index > 0 ? 'border-t pt-8 mt-8' : '' }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Degree -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                                        <input type="text" name="educations[{{ $index }}][degree_name]" 
                                               value="{{ old('educations.'.$index.'.degree_name', $education->degree_name) }}"
                                               placeholder="Degree, e.g Bachelor"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Field of Study -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Field of Study</label>
                                        <input type="text" name="educations[{{ $index }}][field_of_study]" 
                                               value="{{ old('educations.'.$index.'.field_of_study', $education->field_of_study) }}"
                                               placeholder="Major, e.g Computer Science"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- From -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">From</label>
                                        <input type="text" name="educations[{{ $index }}][start_year]" 
                                               value="{{ old('educations.'.$index.'.start_year', $education->start_date ? $education->start_date->year : '') }}"
                                               placeholder="e.g 2014"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- To -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">To</label>
                                        <input type="text" name="educations[{{ $index }}][passing_year]" 
                                               value="{{ old('educations.'.$index.'.passing_year', $education->passing_year) }}"
                                               placeholder="e.g 2020"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <!-- School -->
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">School</label>
                                    <input type="text" name="educations[{{ $index }}][institute_name]" 
                                           value="{{ old('educations.'.$index.'.institute_name', $education->institute_name) }}"
                                           placeholder="School name, e.g. Massachusetts Institute of Technology"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Description -->
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea name="educations[{{ $index }}][description]" rows="4" 
                                              placeholder="Write about your education experience..."
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('educations.'.$index.'.description', $education->description) }}</textarea>
                                </div>
                                
                                @if($index > 0)
                                <div class="mt-4">
                                    <button type="button" class="remove-education text-red-600 hover:text-red-800">
                                        Remove This Education
                                    </button>
                                </div>
                                @endif
                            </div>
                            @empty
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
                                        <input type="text" name="educations[0][start_year]" 
                                               placeholder="e.g 2014"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- To -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">To</label>
                                        <input type="text" name="educations[0][passing_year]" 
                                               placeholder="e.g 2020"
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
                            @endforelse
                        </div>
                        <div class="px-8 pb-6 flex justify-between">
                            <div class="space-x-4">
                                <button type="button" id="addEducation" class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add New Education
                                </button>
                               
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>

                    <!-- Work Experience Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-8 py-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Work Experience</h2>
                        </div>
                        <div class="px-8 py-8" id="workContainer">
                            @forelse($workExperiences as $index => $experience)
                            <div class="work-entry {{ $index > 0 ? 'border-t pt-8 mt-8' : '' }}">
                                <!-- Company Name -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                                    <input type="text" name="work_experiences[{{ $index }}][company_name]" 
                                           value="{{ old('work_experiences.'.$index.'.company_name', $experience->company_name) }}"
                                           placeholder="Company name"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Title -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <input type="text" name="work_experiences[{{ $index }}][job_title]" 
                                           value="{{ old('work_experiences.'.$index.'.job_title', $experience->job_title) }}"
                                           placeholder="e.g UIUX Researcher"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <!-- Date From -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                                        <input type="date" name="work_experiences[{{ $index }}][start_date]" 
                                               value="{{ old('work_experiences.'.$index.'.start_date', $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Date To -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                                        <input type="date" name="work_experiences[{{ $index }}][end_date]" 
                                               value="{{ old('work_experiences.'.$index.'.end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea name="work_experiences[{{ $index }}][description]" rows="4" 
                                              placeholder="Describe your work experience..."  
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('work_experiences.'.$index.'.description', $experience->description) }}</textarea>
                                </div>
                                
                                @if($index > 0)
                                <div class="mt-4">
                                    <button type="button" class="remove-experience text-red-600 hover:text-red-800">
                                        Remove This Experience
                                    </button>
                                </div>
                                @endif
                            </div>
                            @empty
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
                                              placeholder="Describe your work experience..."  
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        <div class="px-8 pb-6 flex justify-end">
                            <button type="button" id="addExperience" class="text-blue-600 hover:text-blue-800 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add New Experience
                            </button>
                        </div>
                        
                    </div>

                    <!-- Skills Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-8 py-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Skills</h2>
                        </div>
                        <div class="px-8 py-8" id="skillsContainer">
                            @forelse($skills as $index => $skill)
                            <div class="skills-entry {{ $index > 0 ? 'border-t pt-6 mt-6' : '' }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Skill Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Skill Name</label>
                                        <input type="text" name="skills[{{ $index }}][name]" 
                                               value="{{ old('skills.'.$index.'.name', $skill->skill_name) }}"
                                               placeholder="Skill name, e.g. HTML"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Proficiency -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">% (1-100)</label>
                                        <input type="number" name="skills[{{ $index }}][proficiency]" 
                                               value="{{ old('skills.'.$index.'.proficiency', $skill->proficiency) }}"
                                               placeholder="Skill proficiency, e.g. 90"
                                               min="1" max="100"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                
                                @if($index > 0)
                                <div class="mt-4">
                                    <button type="button" class="remove-skill text-red-600 hover:text-red-800">
                                        Remove This Skill
                                    </button>
                                </div>
                                @endif
                            </div>
                            @empty
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
                            @endforelse
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
                            Update Resume
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
    let educationIndex = {{ $educations->count() }};
    let experienceIndex = {{ $workExperiences->count() }};
    let skillIndex = {{ isset($skills) ? $skills->count() : 0 }};

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
    
    // Add event listeners to existing remove buttons
    document.querySelectorAll('.remove-education').forEach(function(button) {
        button.addEventListener('click', function() {
            this.closest('.education-entry').remove();
        });
    });
    
    document.querySelectorAll('.remove-experience').forEach(function(button) {
        button.addEventListener('click', function() {
            this.closest('.work-entry').remove();
        });
    });
    
    document.querySelectorAll('.remove-skill').forEach(function(button) {
        button.addEventListener('click', function() {
            this.closest('.skills-entry').remove();
        });
    });
});
</script>
@endpush

                    