<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CheckTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if required tables exist';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tables = [
            'employer_notifications',
            'employer_messages',
            'interviews',
            'job_seekers',
            'jobs',
            'companies'
        ];
        
        $this->info('Checking database tables...');
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                $this->line("✓ Table '{$table}' exists");
                
                // Get column count
                try {
                    $columns = DB::select("DESCRIBE {$table}");
                    $this->line("  Columns: " . count($columns));
                } catch (\Exception $e) {
                    $this->line("  Could not get column info: " . $e->getMessage());
                }
            } else {
                $this->line("✗ Table '{$table}' does not exist");
            }
        }
        
        $this->info('Table check completed.');
    }
}