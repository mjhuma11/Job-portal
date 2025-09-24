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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();

            $table->string('name');            // perhaps the name of the person or title
            $table->string('question');
            $table->text('answer');           // answers may be longer, so `text`

            $table->string('category')->nullable();  // if categories are limited, consider enum
            // e.g. $table->enum('category', ['general','billing','technical'])->nullable();

            // It’s better to define status values explicitly
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
