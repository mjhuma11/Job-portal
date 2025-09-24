<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class companies extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'description',
        'industry',
        'email',
        'website',
        'phone',
        'founded_year',
        'featured',
        'verified',
    ];
    
    protected $casts = [
        'featured' => 'boolean',
        'verified' => 'boolean',
    ];
    
    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function jobs(): HasMany
    {
        return $this->hasMany(jobs::class, 'company_id');
    }
}


