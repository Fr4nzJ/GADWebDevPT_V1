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
            Statistic::firstOrCreate(
                ['title' => $stat['title'], 'page' => $stat['page']],
                $stat
            );
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
            Program::firstOrCreate(
                ['title' => $program['title']],
                $program
            );
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
            Event::firstOrCreate(
                ['title' => $event['title']],
                $event
            );
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
                'status' => 'published',
            ],
            [
                'title' => 'Community Leaders Gather for Training Session',
                'slug' => 'community-leaders-training',
                'content' => 'Community leaders from 10 provinces participated in our leadership training program.',
                'excerpt' => 'Leadership training brings together community leaders',
                'category' => 'events',
                'author' => 'Admin',
                'status' => 'published',
            ],
            [
                'title' => 'Research Study Shows Impact of Programs',
                'slug' => 'research-study-impact',
                'content' => 'A comprehensive study reveals the positive impact of our programs on beneficiary communities.',
                'excerpt' => 'Study shows positive program impact',
                'category' => 'research',
                'author' => 'Admin',
                'status' => 'published',
            ],
        ];

        foreach ($news as $item) {
            News::firstOrCreate(
                ['slug' => $item['slug']],
                $item
            );
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
                'status' => 'published',
            ],
            [
                'title' => 'Q1 Progress Report 2026',
                'description' => 'First quarter progress and achievements',
                'file_path' => 'reports/q1-2026.pdf',
                'year' => 2026,
                'type' => 'quarterly',
                'status' => 'published',
            ],
        ];

        foreach ($reports as $report) {
            Report::firstOrCreate(
                ['title' => $report['title']],
                $report
            );
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
                'description' => 'GAD organization established',
                'year' => 2015,
                'page' => 'about',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'description' => 'Launch of women empowerment program',
                'year' => 2016,
                'page' => 'about',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'description' => 'Expanded operations to 10 regions',
                'year' => 2018,
                'page' => 'about',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'description' => 'Reached 100k beneficiaries',
                'year' => 2020,
                'page' => 'about',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($milestones as $milestone) {
            Milestone::firstOrCreate(
                ['year' => $milestone['year']],
                $milestone
            );
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
                'page' => 'about',
                'icon' => 'fas fa-check',
                'is_active' => true,
            ],
            [
                'title' => 'Planning',
                'description' => 'Develop strategic plans based on assessment',
                'order' => 2,
                'page' => 'about',
                'icon' => 'fas fa-clipboard',
                'is_active' => true,
            ],
            [
                'title' => 'Implementation',
                'description' => 'Execute programs and initiatives',
                'order' => 3,
                'page' => 'about',
                'icon' => 'fas fa-rocket',
                'is_active' => true,
            ],
            [
                'title' => 'Monitoring',
                'description' => 'Track progress and outcomes',
                'order' => 4,
                'page' => 'about',
                'icon' => 'fas fa-eye',
                'is_active' => true,
            ],
            [
                'title' => 'Evaluation',
                'description' => 'Assess effectiveness and impact',
                'order' => 5,
                'page' => 'about',
                'icon' => 'fas fa-chart-bar',
                'is_active' => true,
            ],
        ];

        foreach ($steps as $step) {
            ProcessStep::firstOrCreate(
                ['title' => $step['title']],
                $step
            );
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
                'type' => 'value',
                'content' => 'Fair and inclusive access to opportunities for all',
                'page' => 'about',
                'order' => 1,
                'icon' => 'fas fa-balance-scale',
                'is_active' => true,
            ],
            [
                'type' => 'value',
                'content' => 'Ensuring all voices are heard and valued',
                'page' => 'about',
                'order' => 2,
                'icon' => 'fas fa-handshake',
                'is_active' => true,
            ],
            [
                'type' => 'value',
                'content' => 'Building capacity and agency in communities',
                'page' => 'about',
                'order' => 3,
                'icon' => 'fas fa-bolt',
                'is_active' => true,
            ],
            [
                'type' => 'value',
                'content' => 'Transparent and responsible operations',
                'page' => 'about',
                'order' => 4,
                'icon' => 'fas fa-shield-alt',
                'is_active' => true,
            ],
            [
                'type' => 'mission',
                'content' => 'To promote gender equality and empower all individuals to achieve their full potential',
                'page' => 'about',
                'order' => 1,
                'icon' => 'fas fa-target',
                'is_active' => true,
            ],
            [
                'type' => 'vision',
                'content' => 'A society where gender equality is realized and all individuals are valued and respected',
                'page' => 'about',
                'order' => 1,
                'icon' => 'fas fa-lightbulb',
                'is_active' => true,
            ],
        ];

        foreach ($values as $value) {
            PageValue::firstOrCreate(
                ['type' => $value['type'], 'content' => $value['content']],
                $value
            );
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
                'page' => 'home',
                'section_key' => 'hero',
                'title' => 'Hero Section',
                'content' => 'Main hero section with call to action',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'about',
                'title' => 'About Us',
                'content' => 'Organization overview and mission',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'programs',
                'title' => 'Our Programs',
                'content' => 'Featured programs section',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'impact',
                'title' => 'Our Impact',
                'content' => 'Statistics and impact section',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            PageSection::firstOrCreate(
                ['section_key' => $section['section_key'], 'page' => $section['page']],
                $section
            );
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
                'number' => '250K+',
                'label' => 'Direct Beneficiaries',
                'icon' => 'fas fa-award',
                'page' => 'home',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'number' => 'ISO',
                'label' => 'Certification (9001)',
                'icon' => 'fas fa-certificate',
                'page' => 'home',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'number' => '17',
                'label' => 'Regions Covered',
                'icon' => 'fas fa-map',
                'page' => 'home',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::firstOrCreate(
                ['number' => $achievement['number'], 'label' => $achievement['label']],
                $achievement
            );
        }

        $this->line('Achievements seeded.');
    }

    /**
     * Seed Program Statistics table.
     */
    public function seedProgramStatistics(): void
    {
        $stats = [
            [
                'label' => 'Program Reach',
                'value' => '125,000+',
                'icon' => 'fas fa-users',
                'color' => 'blue',
                'page' => 'programs',
                'order' => 1,
                'description' => 'Total beneficiaries across all programs',
                'is_active' => true,
            ],
            [
                'label' => 'Success Rate',
                'value' => '92%',
                'icon' => 'fas fa-check-circle',
                'color' => 'green',
                'page' => 'programs',
                'order' => 2,
                'description' => 'Program completion and impact success',
                'is_active' => true,
            ],
            [
                'label' => 'Active Programs',
                'value' => '6',
                'icon' => 'fas fa-project-diagram',
                'color' => 'purple',
                'page' => 'programs',
                'order' => 3,
                'description' => 'Number of active programs',
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            ProgramStatistic::firstOrCreate(
                ['label' => $stat['label']],
                $stat
            );
        }

        $this->line('Program statistics seeded.');
    }

    /**
     * Seed Event Statistics table.
     */
    public function seedEventStatistics(): void
    {
        $stats = [
            [
                'label' => 'Events Conducted',
                'value' => '45',
                'icon' => 'fas fa-calendar-alt',
                'color' => 'blue',
                'page' => 'events',
                'order' => 1,
                'description' => 'Total events organized',
                'is_active' => true,
            ],
            [
                'label' => 'Total Attendees',
                'value' => '8,500+',
                'icon' => 'fas fa-users',
                'color' => 'green',
                'page' => 'events',
                'order' => 2,
                'description' => 'People participated in events',
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            EventStatistic::firstOrCreate(
                ['label' => $stat['label']],
                $stat
            );
        }

        $this->line('Event statistics seeded.');
    }

    /**
     * Seed Report Statistics table.
     */
    public function seedReportStatistics(): void
    {
        $stats = [
            [
                'label' => 'Reports Published',
                'number' => '28',
                'subtitle' => 'Research and analysis reports',
                'icon' => 'fas fa-file-alt',
                'gradient_start' => '#667eea',
                'gradient_end' => '#764ba2',
                'page' => 'reports',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Total Downloads',
                'number' => '12,500',
                'subtitle' => 'Report downloads',
                'icon' => 'fas fa-download',
                'gradient_start' => '#f093fb',
                'gradient_end' => '#f5576c',
                'page' => 'reports',
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            ReportStatistic::firstOrCreate(
                ['label' => $stat['label']],
                $stat
            );
        }

        $this->line('Report statistics seeded.');
    }

    public function seedPolicyBriefs(): void
    {
        $briefs = [
            [
                'title' => 'Women Empowerment Policy',
                'description' => 'Key policy recommendations for advancing women empowerment initiatives and gender equality programs',
                'pages' => 12,
                'year' => 2025,
                'icon' => 'fas fa-book',
                'color' => 'info',
                'page' => 'reports',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Community Development Strategy',
                'description' => 'Strategic recommendations for sustainable community development and social impact',
                'pages' => 18,
                'year' => 2025,
                'icon' => 'fas fa-building',
                'color' => 'success',
                'page' => 'reports',
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($briefs as $brief) {
            PolicyBrief::firstOrCreate(
                ['title' => $brief['title']],
                $brief
            );
        }

        $this->line('Policy briefs seeded.');
    }

    public function seedResources(): void
    {
        $resources = [
            [
                'title' => 'Training Materials',
                'description' => 'Comprehensive training materials for program implementation and staff development',
                'icon' => 'fas fa-book-open',
                'color' => 'primary',
                'button_text' => 'Download Training',
                'button_url' => '#',
                'button_action' => 'download',
                'page' => 'reports',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Operational Guidelines',
                'description' => 'Operational guidelines and best practices for effective program delivery',
                'icon' => 'fas fa-clipboard-list',
                'color' => 'success',
                'button_text' => 'View Guidelines',
                'button_url' => '#',
                'button_action' => 'view',
                'page' => 'reports',
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($resources as $resource) {
            Resource::firstOrCreate(
                ['title' => $resource['title']],
                $resource
            );
        }

        $this->line('Resources seeded.');
    }

    public function seedStatisticalYearbooks(): void
    {
        $yearbooks = [
            [
                'title' => 'Statistical Yearbook 2024',
                'description' => 'Comprehensive statistical data and analysis for the year 2024',
                'publication_date' => now()->subYear()->format('Y-01-15'),
                'pages' => 150,
                'format' => 'PDF',
                'languages' => 'English, Filipino',
                'file_path' => 'yearbooks/statistical-2024.pdf',
                'download_size' => '12 MB',
                'is_active' => true,
            ],
            [
                'title' => 'Statistical Yearbook 2025',
                'description' => 'Comprehensive statistical data and analysis for the year 2025',
                'publication_date' => now()->format('Y-01-15'),
                'pages' => 160,
                'format' => 'PDF + Excel',
                'languages' => 'English, Filipino',
                'file_path' => 'yearbooks/statistical-2025.pdf',
                'download_size' => '18 MB',
                'is_active' => true,
            ],
        ];

        foreach ($yearbooks as $yearbook) {
            StatisticalYearbook::firstOrCreate(
                ['title' => $yearbook['title']],
                $yearbook
            );
        }

        $this->line('Statistical yearbooks seeded.');
    }

    public function seedChartData(): void
    {
        $chartData = [
            [
                'chart_type' => 'growth',
                'label' => '2023',
                'value' => 45000,
                'page' => 'home',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'chart_type' => 'growth',
                'label' => '2024',
                'value' => 52000,
                'page' => 'home',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'chart_type' => 'distribution',
                'label' => 'Program A',
                'value' => 85,
                'page' => 'home',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'chart_type' => 'distribution',
                'label' => 'Program B',
                'value' => 92,
                'page' => 'home',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($chartData as $data) {
            ChartData::firstOrCreate(
                ['label' => $data['label'], 'chart_type' => $data['chart_type']],
                $data
            );
        }

        $this->line('Chart data seeded.');
    }

    public function seedMonthlyEventCharts(): void
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach ($months as $index => $month) {
            MonthlyEventChart::firstOrCreate(
                ['month' => $month],
                [
                    'month' => $month,
                    'value' => rand(5, 20),
                    'order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $this->line('Monthly event charts seeded.');
    }

    public function seedProgramDistributionCharts(): void
    {
        $programs = [
            'VAWG Prevention' => '#667eea',
            'Women Entrepreneurship' => '#764ba2',
            'Health and Wellness' => '#f093fb',
            'Education & Skills' => '#4ecdc4',
            'Community Development' => '#44af69',
            'Economic Empowerment' => '#f38181',
        ];

        $order = 1;
        foreach ($programs as $label => $color) {
            ProgramDistributionChart::firstOrCreate(
                ['label' => $label],
                [
                    'label' => $label,
                    'value' => rand(10, 40),
                    'color_hex' => $color,
                    'order' => $order++,
                    'is_active' => true,
                ]
            );
        }

        $this->line('Program distribution charts seeded.');
    }

    public function seedContacts(): void
    {
        $contacts = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'subject' => 'Inquiry about programs',
                'message' => 'I am interested in learning more about your programs.',
                'verification_code' => 'VERIFY' . bin2hex(random_bytes(8)),
                'is_verified' => false,
                'ip_address' => '192.168.1.1',
                'user_agent' => 'Mozilla/5.0',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'subject' => 'Partnership proposal',
                'message' => 'We would like to explore partnership opportunities.',
                'verification_code' => 'VERIFY' . bin2hex(random_bytes(8)),
                'is_verified' => true,
                'ip_address' => '192.168.1.2',
                'user_agent' => 'Mozilla/5.0',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::firstOrCreate(
                ['email' => $contact['email']],
                $contact
            );
        }

        $this->line('Contacts seeded.');
    }

    public function seedDashboardStatistics(): void
    {
        $stats = [
            [
                'label' => 'Total Beneficiaries',
                'value' => 250000,
                'icon_class' => 'fas fa-users',
                'color_class' => 'blue',
                'trend_value' => 8,
                'trend_direction' => 'up',
                'trend_text' => '8% increase',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Active Programs',
                'value' => 6,
                'icon_class' => 'fas fa-project-diagram',
                'color_class' => 'green',
                'trend_value' => 2,
                'trend_direction' => 'up',
                'trend_text' => '2 new programs',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'Completed Events',
                'value' => 45,
                'icon_class' => 'fas fa-calendar-check',
                'color_class' => 'purple',
                'trend_value' => 12,
                'trend_direction' => 'up',
                'trend_text' => '12 this month',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'label' => 'Published Reports',
                'value' => 28,
                'icon_class' => 'fas fa-file-alt',
                'color_class' => 'orange',
                'trend_value' => 3,
                'trend_direction' => 'up',
                'trend_text' => '3 new reports',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            DashboardStatistic::firstOrCreate(
                ['label' => $stat['label']],
                $stat
            );
        }

        $this->line('Dashboard statistics seeded.');
    }

    public function seedDashboardActivities(): void
    {
        $activities = [
            [
                'user_name' => 'Admin User',
                'action' => 'created',
                'module' => 'Program',
                'description' => 'Created new Women Empowerment Program',
                'status' => 'active',
                'action_time' => now()->subDays(5),
                'order' => 1,
                'is_active' => true,
            ],
            [
                'user_name' => 'Admin User',
                'action' => 'updated',
                'module' => 'Event',
                'description' => 'Updated event "Community Workshop" details',
                'status' => 'active',
                'action_time' => now()->subDays(3),
                'order' => 2,
                'is_active' => true,
            ],
            [
                'user_name' => 'Admin User',
                'action' => 'published',
                'module' => 'Report',
                'description' => 'Published annual impact report',
                'status' => 'published',
                'action_time' => now()->subDays(1),
                'order' => 3,
                'is_active' => true,
            ],
            [
                'user_name' => 'Admin User',
                'action' => 'responded',
                'module' => 'Contact',
                'description' => 'Replied to contact inquiry from John Doe',
                'status' => 'active',
                'action_time' => now(),
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($activities as $activity) {
            DashboardActivity::firstOrCreate(
                ['user_name' => $activity['user_name'], 'description' => $activity['description']],
                $activity
            );
        }

        $this->line('Dashboard activities seeded.');
    }
}
