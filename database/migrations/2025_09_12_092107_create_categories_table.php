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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // auto-incrementing primary key (bigint)
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('icon')->nullable();         // maybe nullable if not always provided
            $table->text('description')->nullable();    // description often better as text
            $table->string('image')->nullable();        // image path may be nullable

            // For status, using set() works, but often enum or tinyint is better.
            // But if you want set: you need to pass values and default
            $table->set('status', ['0', '1'])->default('1');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
