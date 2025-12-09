<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController; 

// trasa dla strony głównej
Route::get('/', function () {
    return view('home'); 
})->name('home');
