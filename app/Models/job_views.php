<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class job_views extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'view_id';
    
    protected $fillable = [
        'job_id',
        'user_id',
        'ip_address',
        'user_agent',
        'viewed_at',
    ];
    
    protected $casts = [
        'viewed_at' => 'datetime',
    ];
    
    // Relationships
    public function job(): BelongsTo
    {
        return $this->belongsTo(jobs::class, 'job_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // Scopes
    public function scopeToday($query)
    {
        return $query->whereDate('viewed_at', today());
    }
    
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('viewed_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }
    
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('viewed_at', now()->month)
                    ->whereYear('viewed_at', now()->year);
    }
}
