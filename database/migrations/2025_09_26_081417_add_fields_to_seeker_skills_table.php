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
        Schema::table('seeker_skills', function (Blueprint $table) {
            $table->integer('years_experience')->nullable()->after('proficiency');
            $table->enum('category', ['technical', 'soft', 'language', 'other'])->default('technical')->after('years_experience');
            $table->string('certification')->nullable()->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seeker_skills', function (Blueprint $table) {
            $table->dropColumn(['years_experience', 'category', 'certification']);
        });
    }
};
