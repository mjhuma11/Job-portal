<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class jobs extends Model
{
    use HasFactory;
    
    protected $table = 'jobs_post';
    
    protected $fillable = [
        'company_id',
        'job_title',
        'category',
        'salary',
        'requirements',
        'experience',
        'responsibilities',
        'benefits',
        'application_deadline',
        'is_featured',
        'job_type',
        'status',
        'description',
        'location',
    ];
    
    protected $casts = [
        'application_deadline' => 'date',
        'is_featured' => 'boolean',
    ];
    
    // Relationships
    public function company(): BelongsTo
    {
        return $this->belongsTo(companies::class, 'company_id');
    }
    
    public function jobApplications(): HasMany
    {
        return $this->hasMany(job_applications::class, 'job_id');
    }
    
    public function jobViews(): HasMany
    {
        return $this->hasMany(job_views::class, 'job_id');
    }
    
    public function savedJobs(): HasMany
    {
        return $this->hasMany(saved_jobs::class, 'job_id');
    }
    
    public function jobSkills(): HasMany
    {
        return $this->hasMany(job_skills::class, 'job_id');
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'open');
    }
    
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    
    public function scopeByType($query, $type)
    {
        return $query->where('job_type', $type);
    }
    
    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'LIKE', "%{$location}%");
    }
    
    public function scopeNotExpired($query)
    {
        return $query->where('application_deadline', '>=', now()->toDateString())
                    ->orWhereNull('application_deadline');
    }
}
