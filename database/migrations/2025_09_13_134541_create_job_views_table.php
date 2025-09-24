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
        Schema::create('job_views', function (Blueprint $table) {
            $table->id('view_id'); // Auto-incrementing primary key
            $table->integer('job_id');
            $table->integer('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('viewed_at')->useCurrent();
            
            // Add indexes for better performance
            $table->index('job_id');
            $table->index('user_id');
            $table->index('viewed_at');
            
            // Add foreign key constraint if you have a jobs table
            // $table->foreign('job_id')->references('id')->on('jobs_post')->onDelete('cascade');
            
            // Add foreign key constraint if you have a users table
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_views');
    }
};