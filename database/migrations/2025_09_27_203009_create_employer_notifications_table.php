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
        Schema::create('employer_notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->unsignedBigInteger('seeker_id');
            $table->unsignedBigInteger('employer_id');
            $table->enum('type', ['interview_invitation', 'status_update', 'general_message']);
            $table->string('subject');
            $table->text('message');
            $table->datetime('scheduled_date')->nullable();
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->datetime('sent_at')->nullable();
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
        Schema::dropIfExists('employer_notifications');
    }
};