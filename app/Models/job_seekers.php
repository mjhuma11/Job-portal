<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class job_seekers extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'seeker_id';
    
    protected $fillable = [
        'user_id',
        'resume_file',
        'bio',
        'current_position',
        'experience_years',
        'expected_salary_min',
        'expected_salary_max',
        'availability_status',
        'location_preference',
        'remote_preference',
        'linkedin_url',
        'portfolio_url',
        'github_url',
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'date_of_birth',
        'profile_image',
        'twitter_url',
    ];
    
    protected $casts = [
        'expected_salary_min' => 'decimal:2',
        'expected_salary_max' => 'decimal:2',
        'remote_preference' => 'boolean',
        'experience_years' => 'integer',
        'date_of_birth' => 'date',
    ];
    
    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function jobApplications(): HasMany
    {
        return $this->hasMany(job_applications::class, 'seeker_id', 'seeker_id');
    }
    
    public function savedJobs(): HasMany
    {
        return $this->hasMany(saved_jobs::class, 'seeker_id', 'seeker_id');
    }
    
    public function workExperiences(): HasMany
    {
        return $this->hasMany(work_experience::class, 'seeker_id', 'seeker_id');
    }
    
    public function educations(): HasMany
    {
        return $this->hasMany(education::class, 'user_id', 'user_id');
    }
    
    public function skills(): HasMany
    {
        return $this->hasMany(SeekerSkill::class, 'seeker_id', 'seeker_id');
    }
    
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'seeker_id', 'seeker_id');
    }
    
    // Helper method to get age from date_of_birth
    public function getAgeAttribute()
    {
        if ($this->date_of_birth) {
            return $this->date_of_birth->age;
        }
        return null;
    }
}
