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
        Schema::create('seeker_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seeker_id');
            $table->string('skill_name', 100);
            $table->integer('proficiency')->default(50); // 1-100
            $table->timestamps();
            
            // Add indexes
            $table->index('seeker_id');
            $table->index('skill_name');
            
            // Unique constraint to prevent duplicate skills for same seeker
            $table->unique(['seeker_id', 'skill_name']);
            
            // Foreign key constraint
            // $table->foreign('seeker_id')->references('seeker_id')->on('job_seekers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seeker_skills');
    }
};
