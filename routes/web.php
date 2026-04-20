<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/job_application', [JobApplicationController::class, 'index'])->name('job_application.index');
    Route::get('/job_vacancy/{id}', [JobVacancyController::class, 'show'])->name('job_vacancy.show');
    Route::get('/job_vacancy/{id}/apply', [JobVacancyController::class, 'apply'])->name('job_vacancy.apply');
    Route::post('/job_vacancy/{id}/processing', [JobVacancyController::class, 'processing'])->name('job_vacancy.processing');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route To Test OpenAI
    // Route::get('test-openai', [JobVacancyController::class, 'testOpenAi'])->name('testOpenAi');
});

require __DIR__.'/auth.php';
