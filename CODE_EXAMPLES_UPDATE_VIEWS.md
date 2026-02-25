# Code Examples - How to Update Public Views

This guide shows you how to update the public pages to use the dynamic data that's now available in the controllers.

## Available Data in Your Views

### From PageController@home()

The `welcome.blade.php` now receives:
- `$statistics` - Collection of Statistic models (ordered by 'order' field)
- `$milestones` - Collection of Milestone models (ordered by year)
- `$processSteps` - Collection of ProcessStep models (ordered by 'order' field)
- `$sections` - Collection of PageSection models (keyed by 'section_key')

### From PageController@about()

The `about.blade.php` now receives:
- `$visions` - Vision statements
- `$missions` - Mission statements
- `$objectives` - Objective statements
- `$mandates` - Mandate text
- `$goals` - Goal text
- `$achievements` - Achievement statistics
- `$sections` - Generic page sections

## Example Code Replacements

### Replace Hardcoded Statistics Block

**BEFORE** (in welcome.blade.php - lines ~370):
```blade
<div class="kpi-grid">
    <div class="kpi-card blue">
        <div class="kpi-icon"><i class="fas fa-users"></i></div>
        <div class="kpi-number">250K+</div>
        <div class="kpi-label">Direct Beneficiaries</div>
    </div>
    <div class="kpi-card green">
        <div class="kpi-icon"><i class="fas fa-project-diagram"></i></div>
        <div class="kpi-number">6</div>
        <div class="kpi-label">Active Programs</div>
    </div>
    <!-- ... more cards ... -->
</div>
```

**AFTER**:
```blade
<div class="kpi-grid">
    @forelse($statistics as $stat)
        <div class="kpi-card {{ $stat->color }}">
            @if($stat->icon)
                <div class="kpi-icon"><i class="{{ $stat->icon }}"></i></div>
            @endif
            <div class="kpi-number">{{ $stat->value }}</div>
            <div class="kpi-label">{{ $stat->label }}</div>
        </div>
    @empty
        <p class="text-gray-500">No statistics available</p>
    @endforelse
</div>
```

### Replace Hardcoded Milestones Timeline

**BEFORE** (in welcome.blade.php - lines ~405):
```blade
<div class="timeline-items">
    <div class="timeline-item">
        <div class="timeline-year">2019</div>
        <div class="timeline-text">CatSu GAD established...</div>
    </div>
    <div class="timeline-item">
        <div class="timeline-year">2020</div>
        <div class="timeline-text">Adapted programs...</div>
    </div>
    <!-- ... more items ... -->
</div>
```

**AFTER**:
```blade
<div class="timeline-items">
    @forelse($milestones as $milestone)
        <div class="timeline-item">
            <div class="timeline-year">{{ $milestone->year }}</div>
            <div class="timeline-text">{{ $milestone->description }}</div>
        </div>
    @empty
        <p class="text-gray-500">No milestones available</p>
    @endforelse
</div>
```

### Replace Hardcoded Process Steps

**BEFORE** (in welcome.blade.php - lines ~455):
```blade
<div class="process-flow">
    <div class="process-step">
        <div class="step-icon"><i class="fas fa-search"></i></div>
        <div class="step-title">Research & Assessment</div>
        <div class="step-desc">Identify community needs...</div>
    </div>
    <!-- ... more steps ... -->
</div>
```

**AFTER**:
```blade
<div class="process-flow">
    @forelse($processSteps as $step)
        <div class="process-step">
            @if($step->icon)
                <div class="step-icon"><i class="{{ $step->icon }}"></i></div>
            @endif
            <div class="step-title">{{ $step->title }}</div>
            <div class="step-desc">{{ $step->description }}</div>
        </div>
    @empty
        <p class="text-gray-500">No process steps available</p>
    @endforelse
</div>
```

### Update About Page Vision/Mission

**BEFORE** (in about.blade.php - lines ~110):
```blade
<div class="mission-vision-hero">
    <div class="vision-card">
        <div class="card-icon"><i class="fas fa-eye"></i></div>
        <h3 class="card-title">Our Vision</h3>
        <p class="card-description">
           A gender sensitive and responsive university...
        </p>
    </div>
    <div class="mission-card">
        <div class="card-icon" style="..."><i class="fas fa-bullseye"></i></div>
        <h3 class="card-title" style="color: #2c3e50;">Our Mission</h3>
        <p class="card-description" style="color: #666;">
            Faster gender and development advocacy...
        </p>
    </div>
</div>
```

**AFTER**:
```blade
<div class="mission-vision-hero">
    @if($visions->count())
        <div class="vision-card">
            <div class="card-icon">
                <i class="{{ $visions->first()->icon ?? 'fas fa-eye' }}"></i>
            </div>
            <h3 class="card-title">Our Vision</h3>
            <p class="card-description">{{ $visions->first()->content }}</p>
        </div>
    @endif
    
    @if($missions->count())
        <div class="mission-card">
            <div class="card-icon" style="background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                <i class="{{ $missions->first()->icon ?? 'fas fa-bullseye' }}"></i>
            </div>
            <h3 class="card-title" style="color: #2c3e50;">Our Mission</h3>
            <p class="card-description" style="color: #666;">{{ $missions->first()->content }}</p>
        </div>
    @endif
</div>
```

### Update About Page Objectives

**BEFORE** (in about.blade.php - lines ~150):
```blade
<div class="values-grid">
    <div class="value-box">
        <div class="value-icon"><i class="fas fa-hands-helping"></i></div>
        <p style="color: #666; font-size: 0.9rem;">Integrate GAD concepts in the circular agenda</p>
    </div>
    <!-- ... more objectives ... -->
</div>
```

**AFTER**:
```blade
<div class="values-grid">
    @forelse($objectives as $objective)
        <div class="value-box">
            @if($objective->icon)
                <div class="value-icon"><i class="{{ $objective->icon }}"></i></div>
            @endif
            <p style="color: #666; font-size: 0.9rem;">{{ $objective->content }}</p>
        </div>
    @empty
        <p class="text-gray-500">No objectives available</p>
    @endforelse
</div>
```

### Update Mandate Section

**BEFORE** (in about.blade.php - lines ~170):
```blade
<div style="background: linear-gradient(135deg, #ff00b398, #06cff3a4); ...">
    <p style="color: #ffffff;">The Catanduanes State University...</p>
</div>
```

**AFTER**:
```blade
@if($mandates)
    <div style="background: linear-gradient(135deg, #ff00b398, #06cff3a4); border-left: 4px solid #667eea; border-radius: 8px; padding: 1.5rem;">
        <p style="color: #ffffff; margin: 0;">{{ $mandates->content }}</p>
    </div>
@endif
```

### Update Goal Section

**BEFORE** (in about.blade.php - lines ~185):
```blade
<div style="background: linear-gradient(135deg, #ff00b398, #06cff3a4); ...">
    <p style="color: #ffffff;">Mainstream gender and development...</p>
</div>
```

**AFTER**:
```blade
@if($goals)
    <div style="background: linear-gradient(135deg, #ff00b398, #06cff3a4); border-left: 4px solid #667eea; border-radius: 8px; padding: 1.5rem;">
        <p style="color: #ffffff; margin: 0;">{{ $goals->content }}</p>
    </div>
@endif
```

### Update Achievements Section

**BEFORE** (in about.blade.php - lines ~205):
```blade
<div class="columns is-multiline">
    <div class="column is-3-desktop is-6-tablet">
        <div class="achievement-stat">
            <div class="achievement-number">250+</div>
            <p class="achievement-label">Agencies with Gender Focal Persons</p>
        </div>
    </div>
    <!-- ... more achievements ... -->
</div>
```

**AFTER**:
```blade
<div class="columns is-multiline">
    @forelse($achievements as $achievement)
        <div class="column is-3-desktop is-6-tablet">
            <div class="achievement-stat">
                <div class="achievement-number">{{ $achievement->content }}</div>
                <p class="achievement-label">{{ $achievement->title ?? 'Achievement' }}</p>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No achievements available</p>
    @endforelse
</div>
```

## Testing After Updates

After updating the blade templates:

1. **Clear cache:**
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```

2. **Visit the public pages:**
   - http://127.0.0.1:8000/ (Home)
   - http://127.0.0.1:8000/about (About)

3. **Make changes in admin:**
   - Edit a statistic
   - Edit a milestone
   - Verify changes appear on public pages

4. **Check for errors:**
   - Open browser developer console (F12)
   - Check for JavaScript errors
   - Check Network tab for failed requests

## Tips for Smooth Implementation

✓ **Test one section at a time** - Update one blade block, test it, then move to the next
✓ **Use soft deletes if possible** - You can soft-delete records instead of truncating
✓ **Add fallback content** - Use `{{ $variable ?? 'Default text' }}` for safety
✓ **Use @forelse/@empty** - Better handles empty collections gracefully
✓ **Maintain styling** - Keep the same CSS classes as the original

## Common Patterns

### Displaying with Default Icon
```blade
@if($stat->icon)
    <i class="{{ $stat->icon }}"></i>
@else
    <i class="fas fa-circle"></i> {{-- Default icon --}}
@endif
```

### Conditional Styling
```blade
<div class="card {{ $item->is_active ? 'active' : 'inactive' }}">
    {{ $item->title }}
</div>
```

### Limiting Items Displayed
```blade
@foreach($statistics->take(4) as $stat)
    {{-- Only display first 4 --}}
@endforeach
```

### Ordering Dynamically
```blade
@foreach($milestones->sortByDesc('year') as $milestone)
    {{-- Custom ordering --}}
@endforeach
```

---

**Remember:** Any changes you make in the admin interface will automatically appear on the public pages!
