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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seeker_id');
            $table->string('name');
            $table->string('role')->nullable();
            $table->enum('category', ['professional', 'academic', 'personal', 'open-source'])->default('personal');
            $table->string('url')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('ongoing')->default(false);
            $table->text('description')->nullable();
            $table->text('technologies')->nullable();
            $table->text('outcomes')->nullable();
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('seeker_id')->references('seeker_id')->on('job_seekers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
