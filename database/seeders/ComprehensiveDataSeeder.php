<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\ChartData;
use App\Models\Contact;
use App\Models\DashboardActivity;
use App\Models\DashboardStatistic;
use App\Models\Event;
use App\Models\EventStatistic;
use App\Models\Milestone;
use App\Models\MonthlyEventChart;
use App\Models\News;
use App\Models\PageSection;
use App\Models\PageValue;
use App\Models\PolicyBrief;
use App\Models\ProcessStep;
use App\Models\Program;
use App\Models\ProgramDistributionChart;
use App\Models\ProgramStatistic;
use App\Models\Report;
use App\Models\ReportStatistic;
use App\Models\Resource;
use App\Models\Statistic;
use App\Models\StatisticalYearbook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComprehensiveDataSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * The tables that should not be deleted/truncated.
     */
    protected array $protectedTables = [
        'users',
        'migrations',
        'personal_access_tokens',
    ];

    /**
     * The tables to seed (in order to respect foreign keys).
     */
    protected array $seedableTables = [
        'statistics' => true,
        'milestones' => true,
        'process_steps' => true,
        'page_values' => true,
        'page_sections' => true,
        'achievements' => true,
        'programs' => true,
        'program_statistics' => true,
        'program_distribution_charts' => true,
        'events' => true,
        'event_statistics' => true,
        'monthly_event_charts' => true,
        'news' => true,
        'reports' => true,
        'report_statistics' => true,
        'policy_briefs' => true,
        'resources' => true,
        'statistical_yearbooks' => true,
        'contacts' => true,
        'dashboard_statistics' => true,
        'dashboard_activities' => true,
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->info('Starting comprehensive data seeding...');

        // Check if we should clear data first
        if ($this->shouldConfirm() && $this->confirm('Do you want to delete all existing data (except users) before seeding?', false)) {
            $this->clearAllData();
            $this->info('All data cleared successfully!');
        }

        // Seed the data
        $this->seedStatistics();
        $this->seedPrograms();
        $this->seedEvents();
        $this->seedNews();
        $this->seedReports();
        $this->seedMilestones();
        $this->seedProcessSteps();
        $this->seedPageValues();
        $this->seedPageSections();
        $this->seedAchievements();
        $this->seedProgramStatistics();
        $this->seedEventStatistics();
        $this->seedReportStatistics();
        $this->seedPolicyBriefs();
        $this->seedResources();
        $this->seedStatisticalYearbooks();
        $this->seedChartData();
        $this->seedMonthlyEventCharts();
        $this->seedProgramDistributionCharts();
        $this->seedContacts();
        $this->seedDashboardStatistics();
        $this->seedDashboardActivities();

        $this->info('Comprehensive data seeding completed successfully!');
    }

    /**
     * Check if command object exists (for Artisan execution)
     */
    protected function shouldConfirm(): bool
    {
        return isset($this->command);
    }

    /**
     * Output info message
     */
    protected function info(string $message): void
    {
        if (isset($this->command)) {
            $this->command->info($message);
        }
    }

    /**
     * Output warning message
     */
    protected function warn(string $message): void
    {
        if (isset($this->command)) {
            $this->command->warn($message);
        }
    }

    /**
     * Output line message
     */
    protected function line(string $message): void
    {
        if (isset($this->command)) {
            $this->command->line($message);
        }
    }

    /**
     * Ask for confirmation
     */
    protected function confirm(string $question, bool $default = false): bool
    {
        if (isset($this->command)) {
            return $this->command->confirm($question, $default);
        }
        return $default;
    }

    /**
     * Clear all data from database tables except protected tables.
     */
    public function clearAllData(): void
    {
        $this->warn('Clearing all data except protected tables...');

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Get all tables in the database
        $tables = DB::select('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?', [
            DB::getDatabaseName()
        ]);

        foreach ($tables as $table) {
            $tableName = $table->TABLE_NAME;

            // Skip protected tables
            if (in_array($tableName, $this->protectedTables)) {
                continue;
            }

            // Skip cache and jobs tables
            if (in_array($tableName, ['cache', 'cache_locks', 'jobs', 'failed_jobs'])) {
                continue;
            }

            try {
                DB::table($tableName)->truncate();
                $this->line("Cleared: {$tableName}");
            } catch (\Exception $e) {
                $this->warn("Could not clear {$tableName}: " . $e->getMessage());
            }
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Seed Statistics table.
     */
    public function seedStatistics(): void
    {
        $statistics = [
            [
                'title' => 'Direct Beneficiaries',
                'value' => '250K+',
                'label' => 'Direct Beneficiaries',
                'icon' => 'fas fa-users',
                'color' => 'blue',
                'page' => 'home',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Active Programs',
                'value' => '6',
                'label' => 'Active Programs',
                'icon' => 'fas fa-project-diagram',
                'color' => 'green',
                'page' => 'home',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Research Reports',
                'value' => '45+',
                'label' => 'Research Reports',
                'icon' => 'fas fa-file-pdf',
                'color' => 'orange',
                'page' => 'home',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Regions Covered',
                'value' => '17',
                'label' => 'Regions Covered',
                'icon' => 'fas fa-map-marker-alt',
                'color' => 'purple',
                'page' => 'home',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($statistics as $stat) {
            Statistic::create($stat);
        }

        $this->line('Statistics seeded.');
    }

    /**
     * Seed Programs table.
     */
    public function seedPrograms(): void
    {
        $programs = [
            [
                'title' => 'Women Empowerment Program',
                'description' => 'Empowering women through skills training and entrepreneurship',
                'category' => 'women_empowerment',
                'status' => 'active',
            ],
            [
                'title' => 'Rural Development Initiative',
                'description' => 'Community development in rural areas',
                'category' => 'mainstreaming',
                'status' => 'active',
            ],
            [
                'title' => 'Education Access Project',
                'description' => 'Providing educational opportunities to underserved communities',
                'category' => 'education',
                'status' => 'active',
            ],
            [
                'title' => 'Health and Wellness Campaign',
                'description' => 'Promoting health awareness and wellness programs',
                'category' => 'mainstreaming',
                'status' => 'active',
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }

        $this->line('Programs seeded.');
    }

    /**
     * Seed Events table.
     */
    public function seedEvents(): void
    {
        $events = [
            [
                'title' => 'Women Entrepreneurship Summit 2026',
                'description' => 'Annual summit bringing together women entrepreneurs for networking and skill development',
                'event_date' => now()->addMonths(1)->toDateString(),
                'location' => 'Manila Convention Center',
                'status' => 'upcoming',
                'images' => null,
            ],
            [
                'title' => 'Rural Community Workshop',
                'description' => 'Hands-on workshop for rural community development',
                'event_date' => now()->addMonths(2)->toDateString(),
                'location' => 'Provincial Hall, Various Locations',
                'status' => 'upcoming',
                'images' => null,
            ],
            [
                'title' => 'Education Access Forum',
                'description' => 'Forum discussing strategies for improving access to quality education',
                'event_date' => now()->subMonths(1)->toDateString(),
                'location' => 'DepEd Central Office',
                'status' => 'completed',
                'images' => null,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }

        $this->line('Events seeded.');
    }

    /**
     * Seed News table.
     */
    public function seedNews(): void
    {
        $news = [
            [
                'title' => 'New Initiative Launches Success in First Quarter',
                'slug' => 'new-initiative-launches-success',
                'content' => 'Our latest initiative has successfully reached over 5,000 beneficiaries in its first quarter of operation.',
                'excerpt' => 'Successful launch of new initiative',
                'category' => 'announcements',
                'author' => 'Admin',
                'published' => true,
            ],
            [
                'title' => 'Community Leaders Gather for Training Session',
                'slug' => 'community-leaders-training',
                'content' => 'Community leaders from 10 provinces participated in our leadership training program.',
                'excerpt' => 'Leadership training brings together community leaders',
                'category' => 'events',
                'author' => 'Admin',
                'published' => true,
            ],
            [
                'title' => 'Research Study Shows Impact of Programs',
                'slug' => 'research-study-impact',
                'content' => 'A comprehensive study reveals the positive impact of our programs on beneficiary communities.',
                'excerpt' => 'Study shows positive program impact',
                'category' => 'research',
                'author' => 'Admin',
                'published' => true,
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }

        $this->line('News seeded.');
    }

    /**
     * Seed Reports table.
     */
    public function seedReports(): void
    {
        $reports = [
            [
                'title' => 'Annual Report 2025',
                'description' => 'Comprehensive report of activities and outcomes for 2025',
                'file_path' => 'reports/annual-2025.pdf',
                'year' => 2025,
                'type' => 'annual',
            ],
            [
                'title' => 'Q1 Progress Report 2026',
                'description' => 'First quarter progress and achievements',
                'file_path' => 'reports/q1-2026.pdf',
                'year' => 2026,
                'type' => 'quarterly',
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }

        $this->line('Reports seeded.');
    }

    /**
     * Seed Milestones table.
     */
    public function seedMilestones(): void
    {
        $milestones = [
            [
                'title' => 'Organization Foundation',
                'description' => 'GAD organization established',
                'year' => 2015,
                'is_active' => true,
            ],
            [
                'title' => 'First Major Program Launch',
                'description' => 'Launch of women empowerment program',
                'year' => 2016,
                'is_active' => true,
            ],
            [
                'title' => 'Regional Expansion',
                'description' => 'Expanded operations to 10 regions',
                'year' => 2018,
                'is_active' => true,
            ],
            [
                'title' => 'Milestone Achievement',
                'description' => 'Reached 100k beneficiaries',
                'year' => 2020,
                'is_active' => true,
            ],
        ];

        foreach ($milestones as $milestone) {
            Milestone::create($milestone);
        }

        $this->line('Milestones seeded.');
    }

    /**
     * Seed Process Steps table.
     */
    public function seedProcessSteps(): void
    {
        $steps = [
            [
                'title' => 'Assessment',
                'description' => 'Initial assessment of community needs',
                'order' => 1,
                'icon' => 'fas fa-check',
                'is_active' => true,
            ],
            [
                'title' => 'Planning',
                'description' => 'Develop strategic plans based on assessment',
                'order' => 2,
                'icon' => 'fas fa-clipboard',
                'is_active' => true,
            ],
            [
                'title' => 'Implementation',
                'description' => 'Execute programs and initiatives',
                'order' => 3,
                'icon' => 'fas fa-rocket',
                'is_active' => true,
            ],
            [
                'title' => 'Monitoring',
                'description' => 'Track progress and outcomes',
                'order' => 4,
                'icon' => 'fas fa-eye',
                'is_active' => true,
            ],
            [
                'title' => 'Evaluation',
                'description' => 'Assess effectiveness and impact',
                'order' => 5,
                'icon' => 'fas fa-chart-bar',
                'is_active' => true,
            ],
        ];

        foreach ($steps as $step) {
            ProcessStep::create($step);
        }

        $this->line('Process steps seeded.');
    }

    /**
     * Seed Page Values table.
     */
    public function seedPageValues(): void
    {
        $values = [
            [
                'title' => 'Equity',
                'description' => 'Fair and inclusive access to opportunities for all',
                'icon' => 'fas fa-balance-scale',
                'is_active' => true,
            ],
            [
                'title' => 'Inclusion',
                'description' => 'Ensuring all voices are heard and valued',
                'icon' => 'fas fa-handshake',
                'is_active' => true,
            ],
            [
                'title' => 'Empowerment',
                'description' => 'Building capacity and agency in communities',
                'icon' => 'fas fa-bolt',
                'is_active' => true,
            ],
            [
                'title' => 'Accountability',
                'description' => 'Transparent and responsible operations',
                'icon' => 'fas fa-shield-alt',
                'is_active' => true,
            ],
        ];

        foreach ($values as $value) {
            PageValue::create($value);
        }

        $this->line('Page values seeded.');
    }

    /**
     * Seed Page Sections table.
     */
    public function seedPageSections(): void
    {
        $sections = [
            [
                'name' => 'hero',
                'title' => 'Hero Section',
                'description' => 'Main hero section with call to action',
                'page' => 'home',
                'is_active' => true,
            ],
            [
                'name' => 'about',
                'title' => 'About Us',
                'description' => 'Organization overview and mission',
                'page' => 'home',
                'is_active' => true,
            ],
            [
                'name' => 'programs',
                'title' => 'Our Programs',
                'description' => 'Featured programs section',
                'page' => 'home',
                'is_active' => true,
            ],
            [
                'name' => 'impact',
                'title' => 'Our Impact',
                'description' => 'Statistics and impact section',
                'page' => 'home',
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            PageSection::create($section);
        }

        $this->line('Page sections seeded.');
    }

    /**
     * Seed Achievements table.
     */
    public function seedAchievements(): void
    {
        $achievements = [
            [
                'title' => '250K+ Direct Beneficiaries',
                'description' => 'Successfully reached over 250,000 direct beneficiaries',
                'year' => 2025,
                'category' => 'reach',
                'icon' => 'fas fa-award',
                'is_active' => true,
            ],
            [
                'title' => 'ISO Certification',
                'description' => 'Achieved ISO 9001 certification for quality management',
                'year' => 2024,
                'category' => 'certification',
                'icon' => 'fas fa-certificate',
                'is_active' => true,
            ],
            [
                'title' => '17 Regions Covered',
                'description' => 'Expanded operations across 17 regions',
                'year' => 2025,
                'category' => 'expansion',
                'icon' => 'fas fa-map',
                'is_active' => true,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }

        $this->line('Achievements seeded.');
    }

    /**
     * Seed Program Statistics table.
     */
    public function seedProgramStatistics(): void
    {
        $programs = Program::all();

        foreach ($programs as $program) {
            ProgramStatistic::create([
                'program_id' => $program->id,
                'beneficiaries_reached' => rand(1000, 50000),
                'success_rate' => rand(70, 95),
                'activities_conducted' => rand(10, 100),
                'year' => now()->year,
            ]);
        }

        $this->line('Program statistics seeded.');
    }

    /**
     * Seed Event Statistics table.
     */
    public function seedEventStatistics(): void
    {
        $events = Event::all();

        foreach ($events as $event) {
            EventStatistic::create([
                'event_id' => $event->id,
                'attendees' => rand(50, 1000),
                'feedback_score' => rand(3, 5),
                'completion_rate' => rand(80, 100),
            ]);
        }

        $this->line('Event statistics seeded.');
    }

    /**
     * Seed Report Statistics table.
     */
    public function seedReportStatistics(): void
    {
        $reports = Report::all();

        foreach ($reports as $report) {
            ReportStatistic::create([
                'report_id' => $report->id,
                'downloads' => rand(50, 500),
                'views' => rand(100, 2000),
                'shares' => rand(10, 200),
            ]);
        }

        $this->line('Report statistics seeded.');
    }

    /**
     * Seed Policy Briefs table.
     */
    public function seedPolicyBriefs(): void
    {
        $briefs = [
            [
                'title' => 'Policy Brief: Women Empowerment',
                'slug' => 'policy-women-empowerment',
                'content' => 'Key policy recommendations for advancing women empowerment initiatives',
                'file_path' => 'briefs/women-empowerment.pdf',
                'published' => true,
            ],
            [
                'title' => 'Policy Brief: Community Development',
                'slug' => 'policy-community-dev',
                'content' => 'Strategic recommendations for sustainable community development',
                'file_path' => 'briefs/community-development.pdf',
                'published' => true,
            ],
        ];

        foreach ($briefs as $brief) {
            PolicyBrief::create($brief);
        }

        $this->line('Policy briefs seeded.');
    }

    /**
     * Seed Resources table.
     */
    public function seedResources(): void
    {
        $resources = [
            [
                'title' => 'Resource: Training Materials',
                'description' => 'Comprehensive training materials for program implementation',
                'file_path' => 'resources/training-materials.pdf',
                'type' => 'training',
                'is_active' => true,
            ],
            [
                'title' => 'Resource: Guidelines Handbook',
                'description' => 'Operational guidelines and best practices',
                'file_path' => 'resources/guidelines.pdf',
                'type' => 'guide',
                'is_active' => true,
            ],
        ];

        foreach ($resources as $resource) {
            Resource::create($resource);
        }

        $this->line('Resources seeded.');
    }

    /**
     * Seed Statistical Yearbooks table.
     */
    public function seedStatisticalYearbooks(): void
    {
        $yearbooks = [
            [
                'title' => 'Statistical Yearbook 2024',
                'year' => 2024,
                'file_path' => 'yearbooks/statistical-2024.pdf',
                'published' => true,
            ],
            [
                'title' => 'Statistical Yearbook 2025',
                'year' => 2025,
                'file_path' => 'yearbooks/statistical-2025.pdf',
                'published' => true,
            ],
        ];

        foreach ($yearbooks as $yearbook) {
            StatisticalYearbook::create($yearbook);
        }

        $this->line('Statistical yearbooks seeded.');
    }

    /**
     * Seed Chart Data table.
     */
    public function seedChartData(): void
    {
        $chartData = [
            [
                'label' => 'Q1 2026 Beneficiaries',
                'value' => 45000,
                'chart_type' => 'bar',
                'category' => 'beneficiaries',
            ],
            [
                'label' => 'Q2 2026 Beneficiaries',
                'value' => 52000,
                'chart_type' => 'bar',
                'category' => 'beneficiaries',
            ],
            [
                'label' => 'Program A Achievement',
                'value' => 85,
                'chart_type' => 'pie',
                'category' => 'performance',
            ],
            [
                'label' => 'Program B Achievement',
                'value' => 92,
                'chart_type' => 'pie',
                'category' => 'performance',
            ],
        ];

        foreach ($chartData as $data) {
            ChartData::create($data);
        }

        $this->line('Chart data seeded.');
    }

    /**
     * Seed Monthly Event Charts table.
     */
    public function seedMonthlyEventCharts(): void
    {
        for ($month = 1; $month <= 12; $month++) {
            MonthlyEventChart::create([
                'month' => $month,
                'year' => now()->year,
                'event_count' => rand(5, 20),
                'attendees' => rand(500, 5000),
            ]);
        }

        $this->line('Monthly event charts seeded.');
    }

    /**
     * Seed Program Distribution Charts table.
     */
    public function seedProgramDistributionCharts(): void
    {
        $programs = Program::all();

        foreach ($programs as $program) {
            ProgramDistributionChart::create([
                'program_id' => $program->id,
                'label' => $program->title,
                'value' => rand(10, 40),
                'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
            ]);
        }

        $this->line('Program distribution charts seeded.');
    }

    /**
     * Seed Contacts table.
     */
    public function seedContacts(): void
    {
        $contacts = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'subject' => 'Inquiry about programs',
                'message' => 'I am interested in learning more about your programs.',
                'status' => 'new',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'subject' => 'Partnership proposal',
                'message' => 'We would like to explore partnership opportunities.',
                'status' => 'responded',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }

        $this->line('Contacts seeded.');
    }

    /**
     * Seed Dashboard Statistics table.
     */
    public function seedDashboardStatistics(): void
    {
        $stats = [
            [
                'label' => 'Total Beneficiaries',
                'value' => 250000,
                'icon' => 'fas fa-users',
                'color' => 'blue',
                'type' => 'primary',
            ],
            [
                'label' => 'Active Programs',
                'value' => 6,
                'icon' => 'fas fa-project-diagram',
                'color' => 'green',
                'type' => 'primary',
            ],
            [
                'label' => 'Completed Events',
                'value' => 45,
                'icon' => 'fas fa-calendar-check',
                'color' => 'purple',
                'type' => 'secondary',
            ],
            [
                'label' => 'Published Reports',
                'value' => 28,
                'icon' => 'fas fa-file-alt',
                'color' => 'orange',
                'type' => 'secondary',
            ],
        ];

        foreach ($stats as $stat) {
            DashboardStatistic::create($stat);
        }

        $this->line('Dashboard statistics seeded.');
    }

    /**
     * Seed Dashboard Activities table.
     */
    public function seedDashboardActivities(): void
    {
        $activities = [
            [
                'user_id' => 1,
                'activity_type' => 'program_created',
                'description' => 'Created new program',
                'related_model' => 'Program',
                'related_id' => 1,
            ],
            [
                'user_id' => 1,
                'activity_type' => 'event_updated',
                'description' => 'Updated event details',
                'related_model' => 'Event',
                'related_id' => 1,
            ],
            [
                'user_id' => 1,
                'activity_type' => 'report_published',
                'description' => 'Published annual report',
                'related_model' => 'Report',
                'related_id' => 1,
            ],
            [
                'user_id' => 1,
                'activity_type' => 'contact_replied',
                'description' => 'Replied to contact inquiry',
                'related_model' => 'Contact',
                'related_id' => 1,
            ],
        ];

        foreach ($activities as $activity) {
            DashboardActivity::create($activity);
        }

        $this->line('Dashboard activities seeded.');
    }
}
