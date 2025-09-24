<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class job_alerts extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'seeker_id',
        'alert_name',
        'alert_email',
        'category_id',
        'location_id',
        'job_type_id',
        'salary_range_id',
        'experience_id',
        'negotiable',
    ];
    
    protected $casts = [
        'negotiable' => 'boolean',
    ];
    
    // Relationships (assuming these tables exist)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function location(): BelongsTo
    {
        return $this->belongsTo(locations::class, 'location_id', 'location_id');
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
