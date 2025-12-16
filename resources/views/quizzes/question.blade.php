@extends('layouts.app')

@section('title', "Pytanie $questionNumber - $quizTitle")

@section('content')
<style>
    .question-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        text-align: center;
    }

    .question-text {
        font-size: 1.8em;
        margin: 30px 0;
        color: #2c3e50;
        font-weight: bold;
    }

    .option-label {
        display: block;
        margin: 15px 0;
        font-size: 1.2em;
        cursor: pointer;
        padding: 15px 20px;
        background-color: #f1f1f1; 
        border: 2px solid #ddd;
        border-radius: 12px;
        transition: background-color 0.2s, border-color 0.2s;
        text-align: left;
    }

    .option-label:hover {
        background-color: #e9ecef;
        border-color: #3498db;
    }

    .option-label input[type="radio"] {
        margin-right: 15px;
        transform: scale(1.5);
        vertical-align: middle;
    }

    .submit-button, .back-button {
        padding: 15px 30px;
        font-size: 1.1em;
        font-weight: bold;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        margin-top: 20px;
        text-decoration: none;
        display: inline-block;
    }

    .submit-button {
        background-color: #3498db;
        color: white;
        transition: background-color 0.2s;
    }

    .submit-button:hover {
        background-color: #2980b9;
    }

    .back-button {
        background-color: #2ecc71;
        color: white;
        transition: background-color 0.2s;
    }

    .back-button:hover {
        background-color: #27ae60;
    }
</style>

<div class="question-container">
    <h2>{{ $quizTitle }}</h2>
    <h3>Pytanie {{ $questionNumber }} z {{ $totalQuestions }}</h3>

    @if (session('status'))
        <div class="alert {{ str_contains(session('status'), 'Brawo') ? 'alert-success' : 'alert-danger' }}">
            {{ session('status') }}
        </div>
    @endif

    <p class="question-text">{{ $questionText }}</p>

    <form action="{{ route('quizzes.submit', ['quizId' => $quizId, 'questionId' => $questionId]) }}" method="POST">
        @csrf
        @foreach ($options as $key => $value)
            <label class="option-label">
                <input type="radio" name="answer" value="{{ $key }}" required>
                {{ $key }}) {{ $value }}
            </label>
        @endforeach

        <button type="submit" class="submit-button">Sprawdź Odpowiedź</button>
    </form>

    {{-- 🔹 Nowy przycisk w dół --}}
    <a href="{{ route('quizzes.index') }}" class="back-button">← Wróć do listy quizów</a>
</div>
@endsection
