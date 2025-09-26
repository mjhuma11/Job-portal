<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeekerSkill extends Model
{
    use HasFactory;
    
    protected $table = 'seeker_skills';
    
    protected $fillable = [
        'seeker_id',
        'skill_name',
        'proficiency',
        'years_experience',
        'category',
        'certification',
    ];
    
    protected $casts = [
        'proficiency' => 'integer',
    ];
    
    // Relationships
    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(job_seekers::class, 'seeker_id', 'seeker_id');
    }
    
    // Scopes
    public function scopeByProficiency($query, $level)
    {
        return $query->where('proficiency', '>=', $level);
    }
    
    public function scopeOrderByProficiency($query)
    {
        return $query->orderBy('proficiency', 'desc');
    }
}
