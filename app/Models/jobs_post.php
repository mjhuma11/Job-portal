<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobs_post extends Model
{
    /** @use HasFactory<\Database\Factories\JobsFactory> */
    use HasFactory;
    
    protected $table = 'jobs_post';
}
