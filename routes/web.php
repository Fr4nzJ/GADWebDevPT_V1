<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC PAGES =====
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/programs', [ProgramController::class, 'publicIndex'])->name('programs');

Route::get('/news', [NewsController::class, 'newsPage'])->name('news-page');

Route::get('/news/{news:slug}', [NewsController::class, 'publicShow'])->name('news.show');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/events/{event}', [EventController::class, 'publicShow'])->name('events.show');

Route::get('/reports', [ReportController::class, 'publicIndex'])->name('reports');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

<<<<<<< HEAD
<<<<<<< HEAD
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
=======
// ===== CONTACT FORM SUBMISSION =====
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
>>>>>>> parent of cd5ea8f (Contact Page Resolidify)
=======
// ===== CONTACT FORM SUBMISSION =====
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
>>>>>>> parent of cd5ea8f (Contact Page Resolidify)

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

    
});

require __DIR__.'/auth.php';
