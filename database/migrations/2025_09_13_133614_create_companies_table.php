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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // id as primary key (unsigned big integer)
            
            // Foreign key to users table
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            
            $table->string('name')->unique();
            
            // Logo, might want nullable if not always present
            $table->string('logo')->nullable();
            
            // Description can be longer text if you expect long descriptions
            $table->text('description')->nullable();
            
            $table->string('industry')->nullable(); // maybe nullable
            
            $table->string('email')->unique(); // unique if needed
            
            $table->string('website')->nullable();
            
            $table->string('phone')->nullable();
            
            // Founded year could be year type or integer; string works but has less structure
            $table->year('founded_year')->nullable();
            
            // Featured and verified: likely flags, so boolean is better
            $table->boolean('featured')->default(false);
            $table->boolean('verified')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
