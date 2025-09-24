<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            // Primary key
            $table->id('seeker_id');  // auto increment big integer primary

            // Foreign key to users table (if applicable)
            $table->unsignedBigInteger('user_id');
            // optionally, if you want referential integrity:
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Other columns
            $table->string('resume_file', 255)->nullable();
            $table->text('bio')->nullable();
            $table->string('current_position', 150)->nullable();
            $table->integer('experience_years')->default(0);
            $table->decimal('expected_salary_min', 10, 2)->nullable();
            $table->decimal('expected_salary_max', 10, 2)->nullable();
            $table->enum('availability_status', [
                'immediately',
                'within_month',
                'within_3_months',
                'not_looking'
            ])->default('immediately');

            $table->string('location_preference', 100)->nullable();
            $table->boolean('remote_preference')->default(false);

            $table->string('linkedin_url', 255)->nullable();
            $table->string('portfolio_url', 255)->nullable();
            $table->string('github_url', 255)->nullable();

            // Timestamps if needed (created_at, updated_at)
            $table->timestamps();

            // If you want, you can also add updated_at to be managed automatically
            // by default, `timestamps()` does both created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seekers');
    }
};
