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
        Schema::create('locations', function (Blueprint $table) {
            $table->id('location_id'); // Auto-incrementing primary key
            $table->string('city', 100);
            $table->string('state', 100)->nullable();
            $table->string('country', 100);
            $table->boolean('is_popular')->default(false);
            
            // Add indexes for better performance
            $table->index('city');
            $table->index('country');
            $table->index('is_popular');
            
            // Optional: Add unique constraint for city-state-country combination
            // $table->unique(['city', 'state', 'country']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};