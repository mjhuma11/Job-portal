<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faqs extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'question',
        'answer',
        'category',
        'status',
        'sort_order',
    ];
    
    protected $casts = [
        'sort_order' => 'integer',
    ];
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
