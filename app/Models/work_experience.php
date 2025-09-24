<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class work_experience extends Model
{
    use HasFactory;
    
    protected $table = 'work_experience';
    protected $primaryKey = 'experience_id';
    
    // Disable timestamps since the table doesn't have created_at/updated_at columns
    public $timestamps = false;
    
    protected $fillable = [
        'seeker_id',
        'company_name',
        'job_title',
        'employment_type',
        'start_date',
        'end_date',
        'is_current',
        'location',
        'description',
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];
    
    // Relationships
    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(job_seekers::class, 'seeker_id', 'seeker_id');
    }
    
    // Scopes
    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }
    
    public function scopeByEmploymentType($query, $type)
    {
        return $query->where('employment_type', $type);
    }
    
    public function scopeRecent($query)
    {
        return $query->orderBy('start_date', 'desc');
    }
}
