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
Schema::create('jobs_post', function (Blueprint $table) {
            $table->id();

            // company_id should reference companies.id, so use unsignedBigInteger or foreignId
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade')->onUpdate('cascade');

            $table->string('job_title')->unique();
            $table->string('category')->nullable();
            $table->string('salary')->nullable();

            // requirements, responsibilities, benefits are often longer, might be text
            $table->text('requirements')->nullable();
            $table->string('experience')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('benefits')->nullable();

            // deadlines, featured flags, status etc.
            $table->date('application_deadline')->nullable();  // better as date rather than string
            $table->boolean('is_featured')->default(false);
            
            // job_type enum
            $table->enum('job_type', ['full-time', 'part-time', 'contractor', 'remote'])->nullable();

            // status: define possible values or use a boolean if simple
            $table->enum('status', ['open','closed','draft'])->default('draft');

            $table->text('description')->nullable();
            $table->string('location')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_post');
    }
};
