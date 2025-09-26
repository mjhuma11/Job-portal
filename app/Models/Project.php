<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'seeker_id',
        'name',
        'role',
        'category',
        'url',
        'start_date',
        'end_date',
        'ongoing',
        'description',
        'technologies',
        'outcomes',
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'ongoing' => 'boolean',
    ];
    
    // Relationships
    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(job_seekers::class, 'seeker_id', 'seeker_id');
    }
    
    // Scopes
    public function scopeOngoing($query)
    {
        return $query->where('ongoing', true);
    }
    
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
    
    public function scopeRecent($query)
    {
        return $query->orderBy('start_date', 'desc');
    }
}
