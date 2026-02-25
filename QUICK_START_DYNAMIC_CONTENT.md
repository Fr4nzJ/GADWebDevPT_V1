# Quick Start Guide - Dynamic Content Management

## Accessing Admin Panel

1. **Go to your admin dashboard**: http://127.0.0.1:8000/admin/dashboard
2. **Manage content from these links** (in the admin panel):

### ✨ Available Admin Sections

| Section | URL | Purpose |
|---------|-----|---------|
| **Statistics** | `/admin/statistics` | Manage KPI cards, statistics |
| **Milestones** | `/admin/milestones` | Manage timeline events |
| **Process Steps** | `/admin/process-steps` | Manage process workflow steps |
| **Page Values** | `/admin/page-values` | Manage objectives, values, mandates, visions, missions |
| **Page Sections** | `/admin/page-sections` | Manage generic page sections |

## How to Use Each Admin Section

### 📊 Statistics (KPI Cards)
**What it does:** Manages the statistics displayed on the home page (250K+ beneficiaries, etc.)

**To add a statistic:**
1. Click `/admin/statistics`
2. Click "+ Add New Statistic"
3. Fill in:
   - **Title**: "Direct Beneficiaries"
   - **Value**: "250K+"
   - **Label**: "Direct Beneficiaries"
   - **Color**: blue, green, orange, or purple
   - **Icon**: FontAwesome class (e.g., `fas fa-users`)
   - **Page**: "home" (which page to display on)
   - **Check "Active"** to display it

### 📅 Milestones (Timeline)
**What it does:** Manages timeline events (2019-2024 milestones on home page)

**To add a milestone:**
1. Click `/admin/milestones`
2. Click "+ Add Milestone"
3. Fill in:
   - **Year**: 2024
   - **Description**: The milestone description
   - **Page**: "home"
   - **Check "Active"**

### 🔄 Process Steps
**What it does:** Manages the process flow steps (Research → Design → Implementation → Evaluate)

**To add a process step:**
1. Click `/admin/process-steps`
2. Click "+ Add"
3. Fill in:
   - **Title**: "Research & Assessment"
   - **Description**: "Identify community needs and gender gaps"
   - **Icon**: `fas fa-search`
   - **Check "Active"**

### 📝 Page Values
**What it does:** Manages about page content (vision, mission, objectives, etc.)

**To add a page value:**
1. Click `/admin/page-values`
2. Click "+ Add"
3. Select **Type**:
   - objective
   - value
   - mandate
   - goal
   - vision
   - mission
   - achievement
4. Enter the **Content**
5. Set **Page** to "about"
6. **Check "Active"**

### 📄 Page Sections
**What it does:** Manages generic page sections (footer text, etc.)

**To add a page section:**
1. Click `/admin/page-sections`
2. Click "+ Add"
3. Fill in:
   - **Page**: "footer" or "home"
   - **Section Key**: "footer_about" (unique identifier)
   - **Title**: Optional section title
   - **Content**: The section content
   - **Check "Active"**

## Sample Data Already Added ✓

The system comes with sample data:
- 4 Statistics (250K+ beneficiaries, 6 programs, 45+ reports, 17 regions)
- 6 Milestones (2019-2024)
- 3 Objectives
- 1 Vision and 1 Mission
- 1 Mandate and 1 Goal

## Next: Update Public Views

The public pages (`/` and `/about`) are now pulling data from controllers but still show placeholder HTML. 

To fully implement, update the view files to use the dynamic data passed from controllers:

**welcome.blade.php** - Use `$statistics`, `$milestones`, `$processSteps`
**about.blade.php** - Use `$visions`, `$missions`, `$objectives`, `$mandates`, `$goals`, `$achievements`

## Tips & Tricks

✅ **Ordering:** Use the "order" field to control the display sequence (lower = first)
✅ **Activation:** Uncheck "Active" to hide content without deleting it
✅ **Icons:** Use FontAwesome 6 classes (e.g., `fas fa-heart`, `fas fa-star`)
✅ **Colors:** Blue (#667eea), Green (#48c774), Orange (#f0ad4e), Purple (#764ba2)
✅ **Pages:** Use "home" and "about" as page identifiers

## Troubleshooting

**Can't see content on public pages?**
- Check if "Active" is checked in admin
- Verify the "page" field matches the page name
- Clear browser cache

**Form validation errors?**
- All red-marked fields (*) are required
- Check field constraints (e.g., year must be past)

**Routes not working?**
- Make sure routes were updated: `php artisan route:clear`
- Verify you're logged in as an admin

## File Locations

- Admin Views: `/resources/views/admin/statistics/`, `/process-steps/`, etc.
- Models: `/app/Models/Statistic.php`, `Milestone.php`, etc.
- Controllers: `/app/Http/Controllers/StatisticController.php`, etc.
- Database: Check `statistics`, `milestones`, `process_steps`, `page_values`, `page_sections` tables
