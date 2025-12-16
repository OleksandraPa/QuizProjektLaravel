@extends('layouts.app')

@section('title', "Pytanie $questionNumber z $totalQuestions")

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #f6f8fa, #dbe6f2);
        font-family: 'Arial', sans-serif;
    }

    .quiz-container {
        max-width: 800px;
        margin: 40px auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        padding: 40px;
        text-align: center;
    }

    .quiz-title {
        font-size: 2em;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .question-text {
        font-size: 1.6em;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .options {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 30px;
    }

    .option-label {
        background: #3498db;
        color: white;
        font-size: 1.3em;
        padding: 20px;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
    }

    .option-label input[type="radio"] {
        margin-right: 20px;
        transform: scale(1.5);
    }

    .option-label:hover {
        background: #2980b9;
        transform: scale(1.02);
    }

    .submit-button, .next-button {
        padding: 15px 30px;
        font-size: 1.2em;
        font-weight: bold;
        border-radius: 12px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .submit-button {
        background-color: #2ecc71;
        color: white;
        border: none;
        margin-bottom: 15px;
    }

    .submit-button:hover {
        background-color: #27ae60;
    }

    .next-button {
        background-color: #e67e22;
        color: white;
        border: none;
    }

    .next-button:hover {
        background-color: #d35400;
    }

    .status-message {
        font-size: 1.2em;
        font-weight: bold;
        margin-bottom: 20px;
        color: #e74c3c;
    }
</style>

<div class="quiz-container">
    <div class="quiz-title">{{ $quizTitle }}</div>
    <div class="question-text">{{ $questionText }}</div>

    @if (session('status'))
        <div class="status-message">{{ session('status') }}</div>
    @endif

    <form action="{{ route('quizzes.submit', ['quizId' => $quizId, 'questionId' => $questionId]) }}" method="POST">
        @csrf
        <div class="options">
            @foreach ($options as $key => $value)
                <label class="option-label">
                    <input type="radio" name="answer" value="{{ $key }}" required>
                    {{ $key }}) {{ $value }}
                </label>
            @endforeach
        </div>

        <button type="submit" class="submit-button">Sprawdź Odpowiedź</button>
    </form>

    @if($questionNumber < $totalQuestions)
        <a href="{{ route('quizzes.question', [
            'quizId' => $quizId,
            'questionId' => $nextQuestionId ?? $questionId + 1,
            'questionNumber' => $questionNumber + 1
        ]) }}" class="next-button">Idź do następnego pytania</a>
    @endif
</div>
@endsection
