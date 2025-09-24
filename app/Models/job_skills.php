<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class job_skills extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'job_id',
        'skill_id',
        'is_required',
    ];
    
    protected $casts = [
        'is_required' => 'boolean',
    ];
    
    // Relationships
    public function job(): BelongsTo
    {
        return $this->belongsTo(jobs::class, 'job_id');
    }
    
    // Note: Assuming you have a skills table and model
    // public function skill(): BelongsTo
    // {
    //     return $this->belongsTo(Skill::class, 'skill_id');
    // }
    
    // Scopes
    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }
    
    public function scopeOptional($query)
    {
        return $query->where('is_required', false);
    }
}
