<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class job_applications extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'application_id';
    public $incrementing = false;
    
    protected $fillable = [
        'application_id',
        'job_id',
        'seeker_id',
        'cover_letter',
        'resume_file',
        'application_status',
        'applied_at',
        'status_updated_at',
        'notes',
    ];
    
    protected $casts = [
        'applied_at' => 'datetime',
        'status_updated_at' => 'datetime',
    ];
    
    // Relationships
    public function job(): BelongsTo
    {
        return $this->belongsTo(jobs::class, 'job_id');
    }
    
    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(job_seekers::class, 'seeker_id', 'seeker_id');
    }
    
    // Scopes
    public function scopePending($query)
    {
        return $query->where('application_status', 'pending');
    }
    
    public function scopeShortlisted($query)
    {
        return $query->where('application_status', 'shortlisted');
    }
    
    public function scopeHired($query)
    {
        return $query->where('application_status', 'hired');
    }
}
