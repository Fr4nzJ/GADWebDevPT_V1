<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
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

Route::get('/news', function () {
    return view('news');
})->name('news');

Route::get('/events', function () {
    return view('events');
})->name('events');

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

require __DIR__.'/auth.php';
