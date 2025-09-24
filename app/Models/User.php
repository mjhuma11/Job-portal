<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // Relationships
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    
    public function company(): HasOne
    {
        return $this->hasOne(companies::class);
    }
    
    public function jobSeeker(): HasOne
    {
        return $this->hasOne(job_seekers::class);
    }
    
    public function educations(): HasMany
    {
        return $this->hasMany(education::class);
    }
    
    public function emailNotifications(): HasMany
    {
        return $this->hasMany(email_notifications::class);
    }
    
    public function jobAlerts(): HasMany
    {
        return $this->hasMany(job_alerts::class, 'seeker_id');
    }
    
    // Helper methods for role checking
    public function hasRole($roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }
    
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
    
    public function isEmployer(): bool
    {
        return $this->hasRole('employer');
    }
    
    public function isJobSeeker(): bool
    {
        return $this->hasRole('jobseeker');
    }
}