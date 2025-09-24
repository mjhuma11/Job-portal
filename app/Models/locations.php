<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'location_id';
    public $timestamps = false;
    
    protected $fillable = [
        'city',
        'state',
        'country',
        'is_popular',
    ];
    
    protected $casts = [
        'is_popular' => 'boolean',
    ];
    
    // Scope for popular locations
    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }
    
    // Scope by country
    public function scopeByCountry($query, $country)
    {
        return $query->where('country', $country);
    }
}
