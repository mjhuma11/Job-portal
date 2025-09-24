<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact_messages extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'reply',
        'status',
    ];
    
    // Scope for unread messages
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }
    
    // Scope for replied messages
    public function scopeReplied($query)
    {
        return $query->whereNotNull('reply');
    }
}
