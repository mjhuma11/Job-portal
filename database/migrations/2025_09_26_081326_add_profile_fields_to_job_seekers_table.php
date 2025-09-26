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
        Schema::table('job_seekers', function (Blueprint $table) {
            $table->string('name')->nullable()->after('user_id');
            $table->string('email')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('phone');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->text('address')->nullable()->after('date_of_birth');
            $table->string('profile_image')->nullable()->after('address');
            $table->string('twitter_url')->nullable()->after('github_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_seekers', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'email', 
                'phone',
                'gender',
                'date_of_birth',
                'address',
                'profile_image',
                'twitter_url'
            ]);
        });
    }
};
