<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class email_notifications extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'type',
        'subject',
        'message',
        'is_read',
        'status',
        'sent_at',
    ];
    
    protected $casts = [
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
    ];
    
    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
    
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }
}
