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
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('user_id'); // Foreign Key
            $table->string('type')->nullable(); // job_alert, interview_schedule
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->enum('status', ['pending','sent','failed'])->default('pending');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            // Foreign key relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_notifications');
    }
};
