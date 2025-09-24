<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->integer('application_id')->primary();

            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('seeker_id');

            $table->text('cover_letter')->nullable();
            $table->string('resume_file', 255)->nullable();

            $table->enum('application_status', ['pending', 'reviewed', 'shortlisted', 'interview_scheduled', 'rejected', 'hired'])->default('pending');
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamp('status_updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->text('notes')->nullable();

            // If you want foreign key constraints (optional)
            // $table->foreign('job_id')->references('id')->on('jobs_post')->onDelete('cascade');
            // $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
};
