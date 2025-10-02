<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    
    // Accessor to get jobs count for this location
    public function getJobsCountAttribute()
    {
        // Since location is stored as a string in jobs_post table, we need to count jobs by matching the location string
        return DB::table('jobs_post')
            ->where('location', 'LIKE', '%' . $this->city . '%')
            ->count();
    }
    
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