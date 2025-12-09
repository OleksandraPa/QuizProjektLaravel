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

});