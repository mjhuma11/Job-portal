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
        Schema::create('work_experience', function (Blueprint $table) {
            $table->id('experience_id'); // Auto-incrementing primary key
            $table->integer('seeker_id');
            $table->string('company_name', 200);
            $table->string('job_title', 150);
            $table->enum('employment_type', [
                'full_time', 
                'part_time', 
                'contract', 
                'internship', 
                'freelance'
            ])->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->string('location', 150)->nullable();
            $table->text('description')->nullable();
            
            // Add indexes for better performance
            $table->index('seeker_id');
            $table->index('company_name');
            $table->index('job_title');
            $table->index('start_date');
            $table->index('employment_type');
            
            // Add foreign key constraint if you have a users table
            // $table->foreign('seeker_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experience');
    }
};