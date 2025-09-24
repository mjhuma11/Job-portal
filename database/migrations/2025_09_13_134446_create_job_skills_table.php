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
        Schema::create('job_skills', function (Blueprint $table) {
            $table->integer('job_id');
            $table->integer('skill_id');
            $table->boolean('is_required')->default(true);
            
            // Add composite primary key if needed
            // $table->primary(['job_id', 'skill_id']);
            $table->timestamps();
            
            // Add foreign key constraints if you have jobs and skills tables
            // $table->foreign('job_id')->references('id')->on('jobs_post')->onDelete('cascade');
            // $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_skills');
    }
};