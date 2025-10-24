<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update the status enum to include pending and rejected
        DB::statement("ALTER TABLE jobs_post MODIFY COLUMN status ENUM('open', 'closed', 'draft', 'pending', 'rejected') DEFAULT 'pending'");
        
        Schema::table('jobs_post', function (Blueprint $table) {
            // Add new fields for enhanced job management
            if (!Schema::hasColumn('jobs_post', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('company_id');
            }
            if (!Schema::hasColumn('jobs_post', 'location_id')) {
                $table->unsignedBigInteger('location_id')->nullable()->after('category_id');
            }
            if (!Schema::hasColumn('jobs_post', 'salary_min')) {
                $table->decimal('salary_min', 10, 2)->nullable()->after('salary');
            }
            if (!Schema::hasColumn('jobs_post', 'salary_max')) {
                $table->decimal('salary_max', 10, 2)->nullable()->after('salary_min');
            }
            if (!Schema::hasColumn('jobs_post', 'salary_type')) {
                $table->enum('salary_type', ['hourly', 'monthly', 'yearly'])->nullable()->after('salary_max');
            }
            if (!Schema::hasColumn('jobs_post', 'experience_level')) {
                $table->enum('experience_level', ['entry', 'mid', 'senior', 'executive'])->nullable()->after('experience');
            }
            if (!Schema::hasColumn('jobs_post', 'remote_work')) {
                $table->boolean('remote_work')->default(false)->after('location');
            }
            if (!Schema::hasColumn('jobs_post', 'posted_by')) {
                $table->unsignedBigInteger('posted_by')->nullable()->after('remote_work');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs_post', function (Blueprint $table) {
            // Drop columns if they exist
            $columns = ['category_id', 'location_id', 'salary_min', 'salary_max', 'salary_type', 'experience_level', 'remote_work', 'posted_by'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('jobs_post', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
        
        // Revert status enum to original values
        DB::statement("ALTER TABLE jobs_post MODIFY COLUMN status ENUM('open', 'closed', 'draft') DEFAULT 'draft'");
    }
};
