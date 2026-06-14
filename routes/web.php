<?php

use App\Http\Controllers\CreatorController;
use App\Http\Controllers\CreatorLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Public Routes
Route::get('/@{slug}', [CreatorController::class, 'show'])->name('creator.show');
Route::post('/api/supports', [SupportController::class, 'store'])->name('supports.store');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Creator Routes
    Route::get('/creator-dashboard', [CreatorController::class, 'dashboard'])->name('creator.dashboard');
    Route::put('/creator/update', [CreatorController::class, 'update'])->name('creator.update');

    // Creator Links Routes
    Route::get('/api/creator-links', [CreatorLinkController::class, 'index'])->name('creator-links.index');
    Route::post('/api/creator-links', [CreatorLinkController::class, 'store'])->name('creator-links.store');
    Route::put('/api/creator-links/{link}', [CreatorLinkController::class, 'update'])->name('creator-links.update');
    Route::delete('/api/creator-links/{link}', [CreatorLinkController::class, 'destroy'])->name('creator-links.destroy');

    // Supports Routes
    Route::get('/api/supports', [SupportController::class, 'index'])->name('supports.index');

    // Profile Routes (Usuario)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
