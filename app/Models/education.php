<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class education extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'degree_name',
        'field_of_study',
        'institute_name',
        'board_name',
        'passing_year',
        'start_date',
        'end_date',
        'result',
        'education_level',
        'status',
        'description',
        'certificate',
    ];
    
    protected $casts = [
        'passing_year' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
    
    public function scopeRunning($query)
    {
        return $query->where('status', 'running');
    }
    
    public function scopeByLevel($query, $level)
    {
        return $query->where('education_level', $level);
    }
    
    public function scopeRecent($query)
    {
        return $query->orderBy('passing_year', 'desc');
    }
}
