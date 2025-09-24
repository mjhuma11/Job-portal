<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->id('saved_id'); // Auto-incrementing primary key
            $table->integer('seeker_id');
            $table->integer('job_id');
            $table->timestamp('saved_at')->useCurrent();
            
            // Add unique constraint to prevent duplicate saves
            $table->unique(['seeker_id', 'job_id']);
            
            // Add indexes for better performance
            $table->index('seeker_id');
            $table->index('job_id');
            $table->index('saved_at');
            
            // Add foreign key constraints if you have users and jobs tables
            // $table->foreign('seeker_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('job_id')->references('id')->on('jobs_post')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};