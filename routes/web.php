<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController; // <--- Pamiętaj o tym!
use Illuminate\Support\Facades\Route;

// Strona główna (dostępna dla wszystkich)
Route::get('/', function () {
    return view('welcome'); // Domyślny widok Laravela
});

// Dashboard (tylko dla zalogowanych)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// GRUPA TRAS ZALOGOWANEGO UŻYTKOWNIKA
Route::middleware('auth')->group(function () {
    
    // --- TWOJE QUIZY ---
    Route::prefix('quizzes')->group(function () {
        Route::get('/', [QuizController::class, 'index'])->name('quizzes.index');
        Route::get('/{id}', [QuizController::class, 'show'])->name('quizzes.show');
        Route::get('/{quizId}/question/{questionId}/{questionNumber?}', [QuizController::class, 'question'])->name('quizzes.question');
        Route::post('/{quizId}/question/{questionId}/{questionNumber?}', [QuizController::class, 'submitAnswer'])->name('quizzes.submit');    
    });

    // --- Profile (od Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';