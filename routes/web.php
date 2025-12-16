<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\AdminQuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// STRONA GŁÓWNA
Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD (po zalogowaniu)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| STREFA ADMINISTRATORA
|--------------------------------------------------------------------------
| Dostęp tylko dla zalogowanego admina
*/
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | QUIZY (CRUD)
        |--------------------------------------------------------------------------
        */

        // Lista quizów
        Route::get('/quizzes', [AdminQuizController::class, 'index'])
            ->name('quizzes.index');

        // Dodawanie quizu
        Route::get('/quizzes/create', [AdminQuizController::class, 'create'])
            ->name('quizzes.create');

        Route::post('/quizzes', [AdminQuizController::class, 'store'])
            ->name('quizzes.store');

        // Edycja quizu
        Route::get('/quizzes/{quiz}/edit', [AdminQuizController::class, 'edit'])
            ->name('quizzes.edit');

        Route::put('/quizzes/{quiz}', [AdminQuizController::class, 'update'])
            ->name('quizzes.update');

        // Usuwanie quizu
        Route::delete('/quizzes/{quiz}', [AdminQuizController::class, 'destroy'])
            ->name('quizzes.destroy');

        /*
        |--------------------------------------------------------------------------
        | PYTANIA DO QUIZÓW (CRUD)
        |--------------------------------------------------------------------------
        */

        // Lista pytań konkretnego quizu
        Route::get('/quizzes/{quiz}/questions', [AdminQuestionController::class, 'index'])
            ->name('quizzes.questions.index');

        // Dodawanie pytania
        Route::get('/quizzes/{quiz}/questions/create', [AdminQuestionController::class, 'create'])
            ->name('quizzes.questions.create');

        Route::post('/quizzes/{quiz}/questions', [AdminQuestionController::class, 'store'])
            ->name('quizzes.questions.store');

        // ✏️ Edycja pytania
        Route::get('/questions/{question}/edit', [AdminQuestionController::class, 'edit'])
            ->name('questions.edit');

        Route::put('/questions/{question}', [AdminQuestionController::class, 'update'])
            ->name('questions.update');

        // 🗑 Usuwanie pytania
        Route::delete('/questions/{question}', [AdminQuestionController::class, 'destroy'])
            ->name('questions.destroy');
    });

/*
|--------------------------------------------------------------------------
| STREFA UŻYTKOWNIKA (GRACZA)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Quizy – rozwiązywanie
    Route::prefix('quizzes')->group(function () {

        // Lista dostępnych quizów
        Route::get('/', [QuizController::class, 'index'])
            ->name('quizzes.index');

        // Start quizu
        Route::get('/{id}', [QuizController::class, 'show'])
            ->name('quizzes.show');

        // Pytania
        Route::get('/{quizId}/question/{questionId}/{questionNumber?}', [QuizController::class, 'question'])
            ->name('quizzes.question');

        Route::post('/{quizId}/question/{questionId}/{questionNumber?}', [QuizController::class, 'submitAnswer'])
            ->name('quizzes.submit');
    });

    // Profil użytkownika (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
