<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Routes accessible to all authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    // User dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Job postings routes for users and admins
    Route::get('job-postings', [JobPostingController::class, 'index'])->name('job-postings.index');
    Route::get('job-postings/{jobPosting}', [JobPostingController::class, 'show'])->name('job-postings.show');

    // Route for users to apply for a job posting
    Route::get('job-postings/{jobPosting}/apply', [JobApplicationController::class, 'applyForm'])->name('job-postings.apply-form');
    Route::post('job-postings/{jobPosting}/apply', [JobApplicationController::class, 'apply'])->name('job-postings.apply');

    // Job applications routes for users and admins
    Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');
    Route::get('/job-applications/{jobApplication}', [JobApplicationController::class, 'show'])->name('job-applications.show');
});

// Admin-specific routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Job posting management routes
    Route::get('job-postings', [JobPostingController::class, 'index'])->name('job-postings.index');
    Route::get('job-postings/create', [JobPostingController::class, 'create'])->name('job-postings.create');
    Route::post('job-postings', [JobPostingController::class, 'store'])->name('job-postings.store');
    Route::get('job-postings/{jobPosting}/edit', [JobPostingController::class, 'edit'])->name('job-postings.edit');
    Route::put('job-postings/{jobPosting}', [JobPostingController::class, 'update'])->name('job-postings.update');
    Route::delete('job-postings/{jobPosting}', [JobPostingController::class, 'destroy'])->name('job-postings.destroy');

    // Viewing job applications for a specific job posting
    Route::get('job-postings/{id}/applications', [JobPostingController::class, 'applications'])->name('job-postings.applications');

    // Job applications routes for admins
    Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');
    Route::get('/job-applications/{jobApplication}', [JobApplicationController::class, 'show'])->name('job-applications.show');
});

require __DIR__.'/auth.php';
