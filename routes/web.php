<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC PAGES =====
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/programs', function () {
    return view('programs');
})->name('programs');

Route::get('/news', [NewsController::class, 'newsPage'])->name('news-page');

Route::get('/news/{news:slug}', [NewsController::class, 'publicShow'])->name('news.show');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/events/{event}', [EventController::class, 'publicShow'])->name('events.show');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ===== CONTACT FORM SUBMISSION =====
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

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
    
    Route::get('/programs', function () {
        return view('admin.programs.index');
    })->name('admin.programs.index');
    
    Route::get('/reports', function () {
        return view('admin.reports.index');
    })->name('admin.reports.index');
    
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('admin.users.index');

    
});

require __DIR__.'/auth.php';
