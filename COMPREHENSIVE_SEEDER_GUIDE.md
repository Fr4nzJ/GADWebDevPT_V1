# Comprehensive Data Seeder Guide

## Overview

The `ComprehensiveDataSeeder` is designed to seed all database tables except the `users` table with sample data. It also provides an option to clear all data from the database before seeding.

## Tables Seeded

The seeder populates the following tables:

- **statistics** - Homepage statistics and metrics
- **milestones** - Organization milestones
- **process_steps** - Process workflow steps
- **page_values** - Core values
- **page_sections** - Page section configurations
- **achievements** - Organizational achievements
- **programs** - Programs and initiatives
- **program_statistics** - Program-specific statistics
- **program_distribution_charts** - Program distribution visualization data
- **events** - Events and activities
- **event_statistics** - Event attendance and performance data
- **monthly_event_charts** - Monthly event tracking data
- **news** - News and announcements
- **reports** - Research and annual reports
- **report_statistics** - Report download/view statistics
- **policy_briefs** - Policy briefs and recommendations
- **resources** - Educational and operational resources
- **statistical_yearbooks** - Statistical yearbooks
- **chart_data** - Chart data for visualizations
- **contacts** - Contact form submissions
- **dashboard_statistics** - Dashboard metric cards
- **dashboard_activities** - Activity log entries

## Protected Tables

The seeder will **NOT** delete or truncate:

- `users` - All user accounts remain intact
- `migrations` - Database migration history
- `personal_access_tokens` - API tokens

## Usage

### Method 1: Run via Main Seeder (Recommended)

Run the main `DatabaseSeeder` which will automatically call the comprehensive seeder:

```bash
php artisan db:seed
```

You will be prompted to confirm whether you want to delete all existing data before seeding.

### Method 2: Run Specific Seeder Only

To run only the comprehensive data seeder:

```bash
php artisan db:seed --class=ComprehensiveDataSeeder
```

You will be prompted to confirm whether you want to delete all existing data before seeding.

### Method 3: Fresh Migration and Seeding

To reset the entire database schema and seed with fresh data:

```bash
php artisan migrate:fresh --seed
```

This will:
1. Drop all tables
2. Re-run all migrations
3. Execute seeders (including ComprehensiveDataSeeder)

## Interactive Prompts

When running the seeder, you will see the following prompt:

```
Do you want to delete all existing data (except users) before seeding? (yes/no) [no]:
```

- **Type `yes`** to clear all data from tables (except users) before seeding new data
- **Type `no`** (or press Enter) to skip clearing and just seed/update data

## Data Clearing Option

The seeder includes a `clearAllData()` method that:

1. Disables foreign key constraints temporarily
2. Truncates all tables except protected ones
3. Re-enables foreign key constraints
4. Provides feedback on each table cleared

### Manually Clear Data

If you want to clear all data without seeding, you can use this command:

```bash
php artisan tinker
```

Then in the Tinker console:

```php
$seeder = new \Database\Seeders\ComprehensiveDataSeeder();
$seeder->setCommand(\Illuminate\Support\Facades\Artisan::command());
$seeder->clearAllData();
```

## Features

✅ **Complete Data Population** - Seeds all relevant tables with realistic sample data

✅ **User-Friendly** - Interactive prompts for clearing data

✅ **Safe** - Protects users table from deletion

✅ **Organized** - Separate methods for seeding each table

✅ **Foreign Key Support** - Handles foreign key relationships properly

✅ **Progress Feedback** - Shows what's being seeded

## Sample Data Includes

- **4 Organizations/Programs** with varying details
- **3 Events** (upcoming and completed)
- **3 News Articles** with different categories
- **2 Reports** (annual and quarterly)
- **4 Milestones** spanning 2015-2020
- **5 Process Steps** with icons
- **4 Core Values** with descriptions
- **4 Key Achievements**
- **12 Monthly Event Charts** (one per month)
- **Sample Chart Data** for visualizations
- **Dashboard Statistics** with 4 key metrics
- **Activity Log Entries** showing recent actions

## Notes

- All sample data is created using realistic, organization-appropriate content
- Relationships between tables are properly maintained (e.g., program IDs in program_statistics)
- The seeder is **idempotent** when data clearing is skipped - safe to run multiple times
- File paths in reports, resources, and briefs are placeholder paths - adjust as needed
- Event dates use relative dates (e.g., `now()->addMonths(1)`) for future relevance

## Troubleshooting

### Error: "Table doesn't exist"

This typically means migrations haven't been run. Run:

```bash
php artisan migrate
```

### Error: "Foreign key constraint fails"

The seeder disables foreign key checks during clearing. If you still get this error:

1. Ensure models have proper relationships defined
2. Check that no orphaned records exist
3. Try running migrations fresh first

### Data Not Appearing

- Check that the seeder ran successfully and showed "completed successfully!" message
- Verify the database connection is correct in `.env`
- Confirm you're checking the correct database

## Customization

To customize the seed data, edit the seeder file:

[database/seeders/ComprehensiveDataSeeder.php](database/seeders/ComprehensiveDataSeeder.php)

Each seeding method (`seedPrograms()`, `seedEvents()`, etc.) can be modified to add, remove, or change sample data.

## Reverting Changes

If you need to revert to the state before seeding:

```bash
# Delete data only
php artisan db:seed --class=ComprehensiveDataSeeder
# Choose 'yes' to clear data

# Or rollback migrations and re-run fresh
php artisan migrate:refresh
```

## Related Seeders

This project also includes:

- [SetAdminUserSeeder.php](database/seeders/SetAdminUserSeeder.php) - Sets admin role
- [PageContentSeeder.php](database/seeders/PageContentSeeder.php) - Seeds specific page content
- [ReportSeeder.php](database/seeders/ReportSeeder.php) - Seeds report data

---

**Last Updated:** February 27, 2026
