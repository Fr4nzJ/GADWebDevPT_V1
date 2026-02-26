<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ProcessStepController;
use App\Http\Controllers\PageValueController;
use App\Http\Controllers\PageSectionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChartDataController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ProgramStatisticController;
use App\Http\Controllers\EventStatisticController;
use App\Http\Controllers\PolicyBriefController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ReportStatisticController;
use App\Models\EventStatistic;
use App\Models\PolicyBrief;
use App\Models\Resource;
use App\Models\ReportStatistic;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// ===== PUBLIC PAGES =====
Route::get('/', [PageController::class, 'home'])->name('welcome');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/programs', [ProgramController::class, 'publicIndex'])->name('programs');

Route::get('/news', [NewsController::class, 'newsPage'])->name('news-page');

Route::get('/news/{news:slug}', [NewsController::class, 'publicShow'])->name('news.show');

Route::get('/events', function () {
    $statistics = EventStatistic::where('page', 'events')->where('is_active', true)->orderBy('order')->get();
    return view('events', compact('statistics'));
})->name('events');

Route::get('/events/{event}', [EventController::class, 'publicShow'])->name('events.show');

Route::get('/reports', function () {
    $policyBriefs = PolicyBrief::where('page', 'reports')->where('is_active', true)->orderBy('order')->get();
    $resources = Resource::where('page', 'reports')->where('is_active', true)->orderBy('order')->get();
    $statistics = ReportStatistic::where('page', 'reports')->where('is_active', true)->orderBy('order')->get();
    return view('reports', compact('policyBriefs', 'resources', 'statistics'));
})->name('reports');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// ===== CONTACT FORM SUBMISSION WITH OTP VERIFICATION =====
// Throttle contact form submission to 3 attempts per 10 minutes per IP
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store')
    ->middleware('throttle:3,10');

// OTP Verification routes
Route::get('/contact/verify', [ContactController::class, 'showVerify'])
    ->name('contact.verify');

Route::post('/contact/verify', [ContactController::class, 'verify'])
    ->name('contact.verify.submit')
    ->middleware('throttle:5,10'); // Slightly higher limit for OTP attempts

Route::post('/contact/resend-otp', [ContactController::class, 'resendOtp'])
    ->name('contact.resend-otp')
    ->middleware('throttle:3,10'); // Limit resend attempts

// ===== AUTHENTICATED ROUTES =====
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== ADMIN ROUTES =====
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');

    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{news}/show', [NewsController::class, 'show'])->name('admin.news.show');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
    
    Route::get('/events', [EventController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('admin.events.show');
    
    Route::get('/programs', [ProgramController::class, 'index'])->name('admin.programs.index');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('admin.programs.create');
    Route::post('/programs', [ProgramController::class, 'store'])->name('admin.programs.store');
    Route::get('/programs/{program}/show', [ProgramController::class, 'show'])->name('admin.programs.show');
    Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])->name('admin.programs.edit');
    Route::put('/programs/{program}', [ProgramController::class, 'update'])->name('admin.programs.update');
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('admin.programs.destroy');
    
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('admin.reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('admin.reports.store');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('admin.reports.show');
    Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('admin.reports.edit');
    Route::put('/reports/{report}', [ReportController::class, 'update'])->name('admin.reports.update');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('admin.reports.destroy');
    
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/create', [AdminContactController::class, 'create'])->name('admin.contacts.create');
    Route::post('/contacts', [AdminContactController::class, 'store'])->name('admin.contacts.store');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::get('/contacts/{contact}/edit', [AdminContactController::class, 'edit'])->name('admin.contacts.edit');
    Route::put('/contacts/{contact}', [AdminContactController::class, 'update'])->name('admin.contacts.update');
    Route::post('/contacts/{contact}/reply', [AdminContactController::class, 'reply'])->name('admin.contacts.reply');
    Route::post('/contacts/{contact}/archive', [AdminContactController::class, 'archive'])->name('admin.contacts.archive');
    Route::post('/contacts/{contact}/restore', [AdminContactController::class, 'restore'])->name('admin.contacts.restore');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');

    // Page Content Management Routes
    Route::resource('statistics', StatisticController::class)->except(['show'])->names('admin.statistics');
    Route::resource('milestones', MilestoneController::class)->except(['show'])->names('admin.milestones');
    Route::resource('process-steps', ProcessStepController::class)->except(['show'])->names('admin.process-steps');
    Route::resource('page-values', PageValueController::class)->except(['show'])->names('admin.page-values');
    Route::resource('page-sections', PageSectionController::class)->except(['show'])->names('admin.page-sections');
    Route::resource('chart-data', ChartDataController::class)->except(['show'])->names('admin.chart-data');
    Route::resource('achievements', AchievementController::class)->except(['show'])->names('admin.achievements');
    Route::resource('program-statistics', ProgramStatisticController::class)->except(['show'])->names('admin.program-statistics');
    Route::resource('event-statistics', EventStatisticController::class)->except(['show'])->names('admin.event-statistics');
    Route::resource('policy-briefs', PolicyBriefController::class)->except(['show'])->names('admin.policy-briefs');
    Route::resource('resources', ResourceController::class)->except(['show'])->names('admin.resources');
    Route::resource('report-statistics', ReportStatisticController::class)->except(['show'])->names('admin.report-statistics');

});

require __DIR__.'/auth.php';
