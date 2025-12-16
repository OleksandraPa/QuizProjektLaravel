@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #f0f4f8, #dbe6f2);
        font-family: 'Arial', sans-serif;
    }

    .dashboard-container {
        max-width: 900px;
        margin: 60px auto;
        text-align: center;
        padding: 40px 20px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .dashboard-container h1 {
        font-size: 2.5em;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .dashboard-container h2 {
        font-size: 1.5em;
        color: #34495e;
        margin-bottom: 30px;
    }

    .dashboard-container p {
        font-size: 1.1em;
        color: #555;
        margin-bottom: 40px;
    }

    .quiz-list-button {
        padding: 15px 30px;
        background-color: #3498db;
        color: white;
        font-size: 1.2em;
        font-weight: bold;
        border-radius: 12px;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .quiz-list-button:hover {
        background-color: #2980b9;
    }
</style>

<div class="dashboard-container">
    <h1>Witamy na stronie!</h1>
    <h2>{{ Auth::user()->name }}</h2>
    <p>
        Tutaj możesz sprawdzić swoją wiedzę, rozwiązując quizy dostępne na platformie. 
        Kliknij poniżej, aby zobaczyć listę wszystkich quizów i rozpocząć naukę w interaktywny sposób.
    </p>
    <a href="{{ route('quizzes.index') }}" class="quiz-list-button">Przejdź do listy quizów</a>
</div>
@endsection
