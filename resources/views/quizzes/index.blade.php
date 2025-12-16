@extends('layouts.app') 

@section('title', 'Lista Dostępnych Quizów')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #f6f8fa, #dbe6f2);
        font-family: 'Arial', sans-serif;
    }

    .quiz-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        font-size: 2.2em;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .quiz-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 0;
        list-style: none;
    }

    .quiz-card {
        background: #3498db;
        color: white;
        padding: 25px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .quiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    }

    .quiz-card a.title {
        color: white;
        font-size: 1.4em;
        font-weight: bold;
        text-decoration: none;
        margin-bottom: 10px;
    }

    .quiz-card p.description {
        font-size: 1em;
        color: #ecf0f1;
        flex-grow: 1;
        margin-bottom: 20px;
    }

    .start-button {
        padding: 12px 20px;
        background-color: #2ecc71;
        color: white;
        font-size: 1.1em;
        font-weight: bold;
        border-radius: 12px;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .start-button:hover {
        background-color: #27ae60;
    }
</style>

<div class="quiz-container">
    <h1>Lista Dostępnych Quizów</h1>

    @if ($quizzes->count() > 0)
        <ul class="quiz-list">
            @foreach ($quizzes as $quiz)
                <li class="quiz-card">
                    <a href="{{ route('quizzes.show', ['id' => $quiz->id]) }}" class="title">
                        {{ $quiz->title }}
                    </a>
                    <p class="description">{{ $quiz->description }}</p>
                    <a href="{{ route('quizzes.question', [
                        'quizId' => $quiz->id, 
                        'questionId' => $quiz->questions->first()?->id ?? 0,
                        'questionNumber' => 1
                    ]) }}" class="start-button">
                        Rozpocznij Quiz
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p style="text-align: center;">Brak dostępnych quizów. Spróbuj dodać nowe!</p>
    @endif
</div>
@endsection
