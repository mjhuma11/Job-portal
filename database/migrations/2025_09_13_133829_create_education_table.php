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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign Key
            $table->string('degree_name'); // যেমন: B.Sc, HSC
            $table->string('field_of_study')->nullable(); // Major subject
            $table->string('institute_name'); // University / College / School
            $table->string('board_name')->nullable(); // SSC/HSC এর জন্য
            $table->year('passing_year')->nullable(); // যেমন: 2023
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('result')->nullable(); // GPA / CGPA
            $table->string('education_level')->nullable(); // যেমন Graduate, Post Graduate
            $table->enum('status', ['running', 'completed', 'dropped'])->default('completed');
            $table->text('description')->nullable();
            $table->string('certificate')->nullable(); // file path
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
