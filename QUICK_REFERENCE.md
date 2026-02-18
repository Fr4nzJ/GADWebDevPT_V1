
# GAD Website Project Structure & Quick Reference

## 📂 Directory Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php              (Authenticated layout - Tailwind)
│   ├── bulma.blade.php            (Public layout - Bulma) ← NEW ✓
│   ├── guest.blade.php            (Guest layout)
│   └── navigation.blade.php       (Auth navigation)
│
├── welcome.blade.php              (Home page) ← UPDATED ✓
├── about.blade.php                (About page) ← NEW ✓
├── programs.blade.php             (Programs page) ← NEW ✓
├── news.blade.php                 (News page) ← NEW ✓
├── events.blade.php               (Events page) ← NEW ✓
├── reports.blade.php              (Reports page) ← NEW ✓
├── contact.blade.php              (Contact page) ← NEW ✓
│
├── dashboard.blade.php
├── auth/
│   ├── confirm-password.blade.php
│   ├── forgot-password.blade.php
│   ├── login.blade.php
│   ├── register.blade.php
│   ├── reset-password.blade.php
│   └── verify-email.blade.php
│
├── components/
├── profile/
└── ... (other views)
```

---

## 🔄 Route to View Mapping

```
Route                    Method    Name             View File
─────────────────────────────────────────────────────────────
/                        GET       welcome          welcome.blade.php
/about                   GET       about            about.blade.php
/programs                GET       programs         programs.blade.php
/news                    GET       news             news.blade.php
/events                  GET       events           events.blade.php
/reports                 GET       reports          reports.blade.php
/contact                 GET       contact          contact.blade.php
/contact                 POST      contact.store    ContactController@store
```

---

## 🎨 Layout Inheritance

### **Public Pages** (Using Bulma Layout)
```
resources/views/layouts/bulma.blade.php
├── welcome.blade.php
├── about.blade.php
├── programs.blade.php
├── news.blade.php
├── events.blade.php
├── reports.blade.php
└── contact.blade.php
```

All public pages extend `@extends('layouts.bulma')` and define content with `@section('content')`

### **Layout Features**
- ✓ Responsive navigation bar
- ✓ Auto-active menu item detection using `request()->routeIs()`
- ✓ Persistent footer with contact info
- ✓ Consistent styling across all pages
- ✓ CDN-loaded dependencies (no build step required)

---

## 📋 Page Content Inventory

### **HOME** (welcome.blade.php)
- Quick stats (250K beneficiaries, 6 programs, 45+ reports, 17 regions)
- 3 featured programs
- 4 latest news items
- 3 upcoming events
- About section
- Latest research highlights
- Contact CTA

### **ABOUT** (about.blade.php)
- Vision & Mission (cards)
- Mandate & Legal Framework (4 legislative bases)
- Core Functions (6 items)
- Organizational Structure (5 staff roles with names & emails)
- Focal Person Structure (3-level hierarchy)
- Core Values & Principles (6 values with icons)
- Key Achievements (statistics)
- CTA buttons

### **PROGRAMS** (programs.blade.php)
- 6 GAD Programs with:
  - Title and status badge
  - Detailed description
  - Objectives (3-5 per program)
  - Target beneficiaries
  - Program period
  - Budget allocation
  - Featured image
- Program filter (All, Ongoing, Completed, Upcoming)
- Impact statistics
- Contact CTA

### **NEWS** (news.blade.php)
- 5 news articles with:
  - Featured image
  - Category badge (Announcements, Policy, Research, Activities)
  - Publication date
  - Author/department
  - Summary text
  - Read more link
- Category filter
- Newsletter subscription form

### **EVENTS** (events.blade.php)
- 3 upcoming events with:
  - Title and icon
  - Date and venue
  - Detailed description
  - Event organizer
  - Contact info
  - Registration info
- 2 past events (completed)
- Event filter (Upcoming, Past)
- Registration contact CTA

### **REPORTS** (reports.blade.php)
- 10 research publications (table format)
- 3 policy briefs
- Statistical yearbook
- Resources for researchers (4 categories)
- Research impact statistics

### **CONTACT** (contact.blade.php)
- Contact form (Name, Email, Subject, Message)
- Form validation and error handling
- Contact information:
  - Office address
  - Phone numbers (with extensions)
  - Email addresses (department-specific)
  - Office hours
- Department contacts (3 divisions)
- Google Maps embed
- FAQ section (5 FAQs with accordion)
- Social media links

---

## 🔌 Key Laravel Features Used

### **Route Helper**
```blade
{{ route('welcome') }}      <!-- Generates: / -->
{{ route('about') }}        <!-- Generates: /about -->
{{ route('contact.store') }} <!-- Generates: /contact (POST) -->
```

### **Active Route Detection**
```blade
request()->routeIs('about')     <!-- Returns true if current page is about -->
request()->routeIs('programs')  <!-- For navbar active styling -->
```

### **Session Data**
```blade
@if (session('success'))
    {{ session('success') }}
@endif
```

### **Old Form Data**
```blade
value="{{ old('name') }}"       <!-- Repopulate on validation error -->
```

### **Error Display**
```blade
@error('name')
    <p class="help is-danger">{{ $message }}</p>
@enderror
```

---

## 🎨 Bulma Components Used

### **Cards**
- `.card` - Container
- `.card-header` - Header with title
- `.card-image` - Image section
- `.card-content` - Main content area
- `.card-footer` - Footer with links

### **Buttons**
- `.button` - Basic button
- `.button.is-primary` - Primary action
- `.button.is-light` - Light variant
- `.button.is-success`, `.is-info`, `.is-warning` - Color variants

### **Forms**
- `.field` - Form group container
- `.control` - Input wrapper
- `.input`, `.textarea`, `.select` - Form elements
- `.label` - Form labels
- `.help.is-danger` - Error messages

### **Layout**
- `.hero` - Hero section
- `.section` - Content section
- `.container` - Responsive container
- `.columns` - Grid system
- `.column` - Grid column
- `.navbar` - Navigation bar
- `.footer` - Footer

### **Content**
- `.box` - Simple box container
- `.notification` - Alert/notification
- `.breadcrumb` - Breadcrumb navigation
- `.table` - Data table
- `.tag`, `.tags` - Tag/label elements

---

## ⚙️ Custom CSS Classes

### **Gradients & Colors**
```css
.hero-gradient          /* Purple gradient (main theme) */
.has-background-light   /* Light gray background */
```

### **Animations**
```css
.box:hover, .card:hover /* Lift + shadow effect */
.button.is-primary:hover /* Transform + shadow */
```

### **Status Badges**
```css
.status-ongoing         /* Green - Active programs */
.status-completed       /* Blue - Finished programs */
.status-upcoming        /* Yellow - Future programs */
```

### **News Items**
```css
.news-item              /* Left border + padding */
.news-date              /* Gray text for dates */
.news-category          /* Colored badge */
```

---

## 📱 Responsive Design

### **Breakpoints**
- Mobile: < 768px
- Tablet: 768px - 1023px
- Desktop: 1024px+

### **Mobile-Specific Classes**
- `.is-hidden-mobile` - Hide on mobile
- `.is-full-mobile` - Full width on mobile
- `.is-half-tablet` - Half width on tablet
- `.is-one-third-desktop` - One-third on desktop

---

## 🔧 Alpine.js Features

### **Navigation Toggle**
```javascript
x-data="{ navOpen: false }"
@click="navOpen = !navOpen"
:class="{ 'is-active': navOpen }"
```

### **Program Filter**
```javascript
x-data="{ activeFilter: 'all' }"
@click="activeFilter = 'ongoing'"
x-show="activeFilter === 'all' || activeFilter === 'ongoing'"
```

### **FAQ Accordion**
```javascript
x-data="{ openFaq: null }"
@click="openFaq = openFaq === 1 ? null : 1"
x-show="openFaq === 1"
```

---

## 🔐 Security Features

✓ **CSRF Protection** - `@csrf` in all forms  
✓ **Input Validation** - Server-side validation in ContactController  
✓ **Error Handling** - Graceful error display with `@error()` blocks  
✓ **Blade Escaping** - Default XSS protection with `{{ }}` syntax  

---

## 📦 External Dependencies (CDN)

```html
<!-- Bulma CSS -->
https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css

<!-- Font Awesome Icons -->
https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css

<!-- Alpine.js -->
https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js
```

No build tools required - everything loads from CDN!

---

## 🚀 Quick Start Commands

```bash
# Start development server
php artisan serve

# View all routes
php artisan route:list

# Clear cache (if styles don't update)
php artisan cache:clear

# Clear view cache
php artisan view:clear
```

---

## 📝 Customization Guide

### **Change Colors**
Edit in `resources/views/layouts/bulma.blade.php`:
```css
.hero-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Change these hex values */
}
```

### **Update Staff Names**
Edit in relevant page files:
```blade
<p><strong>Dr. Maria Santos</strong></p>
<!-- Update name as needed -->
```

### **Add New Program**
Copy a program block in `programs.blade.php`:
```blade
<div class="program-card" x-show="activeFilter === 'all' || activeFilter === 'ongoing'">
    <!-- Duplicate and modify -->
</div>
```

### **Add New Page**
1. Create new file in `resources/views/` (e.g., `newpage.blade.php`)
2. Start with: `@extends('layouts.bulma')`
3. Add route in `routes/web.php`
4. Link in navigation

---

## ✨ Features Summary

| Feature | Status | Details |
|---------|--------|---------|
| Responsive Design | ✓ | Mobile, tablet, desktop |
| Bulma CSS | ✓ | v0.9.4 via CDN |
| Alpine.js | ✓ | Filtering, accordions, toggles |
| Contact Form | ✓ | Full validation + CSRF protection |
| SEO Ready | ✓ | Breadcrumbs, proper titles |
| Accessibility | ✓ | ARIA labels, semantic HTML |
| No Build Step | ✓ | Everything works out-of-box |
| Realistic Content | ✓ | No placeholder text |
| Comments | ✓ | Well-documented code |

---

**Last Updated:** February 18, 2026  
**Status:** ✅ Production Ready
