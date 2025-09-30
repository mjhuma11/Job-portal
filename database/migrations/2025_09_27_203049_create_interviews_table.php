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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->unsignedBigInteger('seeker_id');
            $table->unsignedBigInteger('employer_id');
            $table->date('interview_date');
            $table->time('interview_time');
            $table->enum('interview_type', ['in_person', 'video_call', 'phone_call']);
            $table->string('location_or_link', 500);
            $table->text('notes')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'rescheduled'])->default('scheduled');
            $table->text('feedback')->nullable();
            $table->enum('result', ['passed', 'failed', 'pending'])->nullable();
            $table->timestamps();
            
            $table->foreign('employer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('seeker_id')->references('seeker_id')->on('job_seekers')->onDelete('cascade');
            $table->foreign('application_id')->references('application_id')->on('job_applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};