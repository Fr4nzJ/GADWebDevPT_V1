<?php

namespace App\Http\Controllers;

use Database\Seeders\ComprehensiveDataSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseManagementController extends Controller
{
    /**
     * Show the database management page
     */
    public function index()
    {
        return view('admin.database-management');
    }

    /**
     * Run the comprehensive data seeder
     */
    public function runSeeder(Request $request)
    {
        try {
            // Check if user wants to clear data first
            $clearData = $request->boolean('clear_data', false);

            // Create a mock command to pass to the seeder
            $seeder = new ComprehensiveDataSeeder();

            // Manually clear data if requested
            if ($clearData) {
                $this->clearAllData();
            }

            // Run seeding methods
            $seeder->seedStatistics();
            $seeder->seedPrograms();
            $seeder->seedEvents();
            $seeder->seedNews();
            $seeder->seedReports();
            $seeder->seedMilestones();
            $seeder->seedProcessSteps();
            $seeder->seedPageValues();
            $seeder->seedPageSections();
            $seeder->seedAchievements();
            $seeder->seedProgramStatistics();
            $seeder->seedEventStatistics();
            $seeder->seedReportStatistics();
            $seeder->seedPolicyBriefs();
            $seeder->seedResources();
            $seeder->seedStatisticalYearbooks();
            $seeder->seedChartData();
            $seeder->seedMonthlyEventCharts();
            $seeder->seedProgramDistributionCharts();
            $seeder->seedContacts();
            $seeder->seedDashboardStatistics();
            $seeder->seedDashboardActivities();

            Log::info('Comprehensive database seeding completed', [
                'clear_data' => $clearData,
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Database seeding completed successfully!' . ($clearData ? ' All data was cleared before seeding.' : ''),
            ]);
        } catch (\Exception $e) {
            Log::error('Database seeding failed', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error during seeding: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Clear all data from database (except users and protected tables)
     */
    public function deleteAllData(Request $request)
    {
        try {
            $confirmed = $request->boolean('confirmed', false);

            if (!$confirmed) {
                return response()->json([
                    'success' => false,
                    'message' => 'Deletion not confirmed',
                ], 400);
            }

            $this->clearAllData();

            Log::info('Database data cleared', [
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'All data has been deleted successfully (users table preserved).',
            ]);
        } catch (\Exception $e) {
            Log::error('Database deletion failed', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error during deletion: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Clear all data from database tables except protected ones
     */
    protected function clearAllData(): void
    {
        $protectedTables = [
            'users',
            'migrations',
            'personal_access_tokens',
        ];

        $driver = DB::getDriverName();

        try {
            if ($driver === 'pgsql') {
                // PostgreSQL - disable triggers and truncate
                DB::statement('SET session_replication_role = replica');

                // Get all tables
                $tables = DB::select("
                    SELECT table_name 
                    FROM information_schema.tables 
                    WHERE table_schema = 'public' 
                    AND table_type = 'BASE TABLE'
                ");

                foreach ($tables as $table) {
                    $tableName = $table->table_name;

                    // Skip protected tables
                    if (in_array($tableName, $protectedTables)) {
                        continue;
                    }

                    try {
                        DB::statement("TRUNCATE TABLE \"{$tableName}\" CASCADE");
                    } catch (\Exception $e) {
                        Log::warning("Could not clear {$tableName}: " . $e->getMessage());
                    }
                }

                // Re-enable triggers
                DB::statement('SET session_replication_role = default');
            } else {
                // MySQL
                DB::statement('SET FOREIGN_KEY_CHECKS=0');

                $tables = DB::select('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?', [
                    DB::getDatabaseName()
                ]);

                foreach ($tables as $table) {
                    $tableName = $table->TABLE_NAME;

                    // Skip protected tables
                    if (in_array($tableName, $protectedTables)) {
                        continue;
                    }

                    // Skip cache and jobs tables
                    if (in_array($tableName, ['cache', 'cache_locks', 'jobs', 'failed_jobs'])) {
                        continue;
                    }

                    try {
                        DB::table($tableName)->truncate();
                    } catch (\Exception $e) {
                        Log::warning("Could not clear {$tableName}: " . $e->getMessage());
                    }
                }

                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            }
        } catch (\Exception $e) {
            Log::error('Error clearing database: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get database statistics
     */
    public function getStats()
    {
        try {
            $tableStats = [];
            $totalRows = 0;
            $driver = DB::getDriverName();

            if ($driver === 'pgsql') {
                // PostgreSQL - get tables and count rows
                $tables = DB::select("
                    SELECT table_name 
                    FROM information_schema.tables 
                    WHERE table_schema = 'public' 
                    AND table_type = 'BASE TABLE'
                ");

                foreach ($tables as $table) {
                    $tableName = $table->table_name;
                    
                    // Skip certain system tables
                    if (in_array($tableName, ['migrations', 'personal_access_tokens'])) {
                        continue;
                    }

                    try {
                        $count = DB::table($tableName)->count();
                        if ($count > 0) {
                            $tableStats[$tableName] = $count;
                            $totalRows += $count;
                        }
                    } catch (\Exception $e) {
                        Log::warning("Could not count rows in {$tableName}: " . $e->getMessage());
                    }
                }
            } else {
                // MySQL - use TABLE_ROWS for faster statistics
                $tables = DB::select('SELECT TABLE_NAME, TABLE_ROWS FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?', [
                    DB::getDatabaseName()
                ]);

                foreach ($tables as $table) {
                    $tableName = $table->TABLE_NAME;

                    // Skip protected tables
                    if (in_array($tableName, ['users', 'migrations', 'personal_access_tokens'])) {
                        continue;
                    }

                    // Use TABLE_ROWS if available, otherwise count
                    $rows = $table->TABLE_ROWS > 0 ? $table->TABLE_ROWS : DB::table($tableName)->count();
                    
                    if ($rows > 0) {
                        $tableStats[$tableName] = $rows;
                        $totalRows += $rows;
                    }
                }
            }

            // Sort tables by row count descending
            arsort($tableStats);

            return response()->json([
                'success' => true,
                'total_rows' => $totalRows,
                'tables' => $tableStats,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve database statistics: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving statistics: ' . $e->getMessage(),
            ], 500);
        }
    }
}
