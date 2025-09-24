<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class saved_jobs extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'saved_id';
    
    protected $fillable = [
        'seeker_id',
        'job_id',
        'saved_at',
    ];
    
    protected $casts = [
        'saved_at' => 'datetime',
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
    public function scopeRecent($query)
    {
        return $query->orderBy('saved_at', 'desc');
    }
}
