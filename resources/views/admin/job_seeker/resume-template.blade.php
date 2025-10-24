<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $jobSeeker->name ?? $user->name ?? 'Job Seeker' }} - Resume</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: white;
            font-size: 14px;
        }
        
        .resume-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background: white;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .name {
            font-size: 32px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        
        .contact-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            color: #6b7280;
            font-size: 14px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 5px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .experience-item, .education-item, .project-item {
            margin-bottom: 20px;
            padding-left: 20px;
            border-left: 3px solid #e5e7eb;
        }
        
        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 5px;
        }
        
        .item-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .item-company {
            font-size: 14px;
            color: #2563eb;
            font-weight: 600;
        }
        
        .item-date {
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }
        
        .item-location {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        
        .item-description {
            color: #4b5563;
            margin-bottom: 8px;
        }
        
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .skill-category {
            margin-bottom: 15px;
        }
        
        .skill-category-title {
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .skill-tag {
            display: inline-block;
            background: #f3f4f6;
            color: #374151;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            margin: 2px;
            border: 1px solid #d1d5db;
        }
        
        .skill-tag.expert { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
        .skill-tag.advanced { background: #dbeafe; color: #1e40af; border-color: #bfdbfe; }
        .skill-tag.intermediate { background: #fef3c7; color: #92400e; border-color: #fde68a; }
        .skill-tag.beginner { background: #fee2e2; color: #991b1b; border-color: #fecaca; }
        
        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }
        
        .social-link {
            color: #2563eb;
            text-decoration: none;
            font-size: 12px;
        }
        
        .tech-tags {
            margin-top: 8px;
        }
        
        .tech-tag {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
            margin: 2px;
        }
        
        @media print {
            body {
                font-size: 12px;
            }
            
            .resume-container {
                padding: 20px;
            }
            
            .name {
                font-size: 28px;
            }
            
            .section-title {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="resume-container">
        <!-- Header -->
        <div class="header">
            <h1 class="name">{{ $jobSeeker->name ?? $user->name ?? 'Job Seeker' }}</h1>
            <div class="contact-info">
                @if($jobSeeker && $jobSeeker->email)
                    <div class="contact-item">{{ $jobSeeker->email }}</div>
                @endif
                @if($jobSeeker && $jobSeeker->phone)
                    <div class="contact-item">{{ $jobSeeker->phone }}</div>
                @endif
                @if($jobSeeker && $jobSeeker->address)
                    <div class="contact-item">{{ $jobSeeker->address }}</div>
                @endif
            </div>
            
            @if($jobSeeker && ($jobSeeker->linkedin_url || $jobSeeker->github_url || $jobSeeker->portfolio_url))
                <div class="social-links">
                    @if($jobSeeker->linkedin_url)
                        <a href="{{ $jobSeeker->linkedin_url }}" class="social-link">LinkedIn: {{ $jobSeeker->linkedin_url }}</a>
                    @endif
                    @if($jobSeeker->github_url)
                        <a href="{{ $jobSeeker->github_url }}" class="social-link">GitHub: {{ $jobSeeker->github_url }}</a>
                    @endif
                    @if($jobSeeker->portfolio_url)
                        <a href="{{ $jobSeeker->portfolio_url }}" class="social-link">Portfolio: {{ $jobSeeker->portfolio_url }}</a>
                    @endif
                </div>
            @endif
        </div>

        <!-- Professional Summary -->
        @if($jobSeeker && $jobSeeker->professional_summary)
        <div class="section">
            <h2 class="section-title">Professional Summary</h2>
            <p class="item-description">{{ $jobSeeker->professional_summary }}</p>
        </div>
        @endif

        <!-- Work Experience -->
        @if($workExperiences && $workExperiences->count() > 0)
        <div class="section">
            <h2 class="section-title">Work Experience</h2>
            @foreach($workExperiences as $experience)
                <div class="experience-item">
                    <div class="item-header">
                        <div>
                            <div class="item-title">{{ $experience->job_title }}</div>
                            <div class="item-company">{{ $experience->company_name }}</div>
                            @if($experience->location)
                                <div class="item-location">{{ $experience->location }}</div>
                            @endif
                        </div>
                        <div class="item-date">
                            {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - 
                            {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                        </div>
                    </div>
                    @if($experience->description)
                        <div class="item-description">{{ $experience->description }}</div>
                    @endif
                    @if($experience->achievements)
                        <div class="item-description">
                            <strong>Key Achievements:</strong><br>
                            {{ $experience->achievements }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @endif

        <!-- Education -->
        @if($educations && $educations->count() > 0)
        <div class="section">
            <h2 class="section-title">Education</h2>
            @foreach($educations as $education)
                <div class="education-item">
                    <div class="item-header">
                        <div>
                            <div class="item-title">{{ $education->degree_name }}</div>
                            <div class="item-company">{{ $education->institute_name }}</div>
                        </div>
                        <div class="item-date">{{ $education->passing_year }}</div>
                    </div>
                    @if($education->result_value)
                        <div class="item-description">Grade: {{ $education->result_value }}</div>
                    @endif
                    @if($education->major_subject)
                        <div class="item-description">Major: {{ $education->major_subject }}</div>
                    @endif
                </div>
            @endforeach
        </div>
        @endif

        <!-- Skills -->
        @if($skills && $skills->count() > 0)
        <div class="section">
            <h2 class="section-title">Skills</h2>
            @foreach($skills->groupBy('category') as $category => $categorySkills)
                <div class="skill-category">
                    <div class="skill-category-title">{{ ucfirst($category) }} Skills</div>
                    <div class="skills-container">
                        @foreach($categorySkills as $skill)
                            <span class="skill-tag {{ $skill->proficiency }}">
                                {{ $skill->name }}
                                @if($skill->years)
                                    ({{ $skill->years }}y)
                                @endif
                            </span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        <!-- Projects -->
        @if($projects && $projects->count() > 0)
        <div class="section">
            <h2 class="section-title">Projects</h2>
            @foreach($projects as $project)
                <div class="project-item">
                    <div class="item-header">
                        <div>
                            <div class="item-title">{{ $project->name }}</div>
                            @if($project->role)
                                <div class="item-company">{{ $project->role }}</div>
                            @endif
                        </div>
                        <div class="item-date">
                            @if($project->start_date)
                                {{ \Carbon\Carbon::parse($project->start_date)->format('M Y') }}
                                @if($project->end_date)
                                    - {{ \Carbon\Carbon::parse($project->end_date)->format('M Y') }}
                                @elseif($project->ongoing)
                                    - Present
                                @endif
                            @endif
                        </div>
                    </div>
                    @if($project->description)
                        <div class="item-description">{{ $project->description }}</div>
                    @endif
                    @if($project->technologies)
                        <div class="tech-tags">
                            <strong>Technologies:</strong>
                            @foreach(explode(',', $project->technologies) as $tech)
                                <span class="tech-tag">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    @endif
                    @if($project->outcomes)
                        <div class="item-description">
                            <strong>Outcomes:</strong><br>
                            {{ $project->outcomes }}
                        </div>
                    @endif
                    @if($project->url)
                        <div class="item-description">
                            <strong>Project URL:</strong> <a href="{{ $project->url }}" class="social-link">{{ $project->url }}</a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @endif

        <!-- Additional Information -->
        @if($jobSeeker && ($jobSeeker->date_of_birth || $jobSeeker->gender))
        <div class="section">
            <h2 class="section-title">Personal Information</h2>
            @if($jobSeeker->date_of_birth)
                <div class="item-description">
                    <strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($jobSeeker->date_of_birth)->format('F j, Y') }}
                </div>
            @endif
            @if($jobSeeker->gender)
                <div class="item-description">
                    <strong>Gender:</strong> {{ ucfirst($jobSeeker->gender) }}
                </div>
            @endif
        </div>
        @endif
    </div>
</body>
</html>