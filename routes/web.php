<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController; 

// trasa dla strony głównej
Route::get('/', function () {
    return view('home'); 
})->name('home');

// grupa tras dla quizów
Route::prefix('quizzes')->group(function () {
    // Lista quizów
    Route::get('/', [QuizController::class, 'index'])->name('quizzes.index');

    // Szczegóły pojedynczego quizu
    Route::get('/{id}', [QuizController::class, 'show'])->name('quizzes.show');

    // Pojedyncze pytanie (GET: wyświetlenie)
    Route::get('/{quizId}/question/{questionId}', [QuizController::class, 'question'])->name('quizzes.question');

    // Przesłanie odpowiedzi (POST: sprawdzenie)
    Route::post('/{quizId}/question/{questionId}', [QuizController::class, 'submitAnswer'])->name('quizzes.submit');
    
});