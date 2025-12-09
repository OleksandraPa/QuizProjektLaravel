<?php

use Illuminate\Support\Facades\Route;

// Trasa dla strony głównej (/)
Route::get('/', function () {
    return '<h1>Witamy na Stronie Głównej QuizProject!</h1><p>Przejdź do /quizzes, aby zobaczyć listę.</p>';
})->name('home');

// Trasa dla listy quizów (/quizzes)
Route::get('/quizzes', function () {
    $quizzes = [
        "Quiz z PHP",
        "Wprowadzenie do Laravela",
        "Podstawy baz danych MariaDB",
        "Test wiedzy ogólnej"
    ];

    $output = '<h1>Lista Dostępnych Quizów</h1><ul>';
    foreach ($quizzes as $quiz) {
        $output .= '<li>' . htmlspecialchars($quiz) . '</li>';
    }
    $output .= '</ul>';

    return $output;
})->name('quizzes.index');