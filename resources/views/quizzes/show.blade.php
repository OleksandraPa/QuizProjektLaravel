@extends('layouts.app')

@section('title', $quiz->title)

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

    .questions-list li {
        font-size: 1.2em;
        margin-bottom: 15px;
    }

    .questions-list a {
        padding: 12px 25px;
        background-color: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-weight: bold;
        display: inline-block;
        transition: background 0.2s;
    }

    .questions-list a:hover {
        background-color: #2980b9;
    }
</style>

<div class="quiz-container">
    <div class="quiz-title">{{ $quiz->title }}</div>
    <h3>Pytania w quizie:</h3>

    @if ($questions->count() > 0)
        <ul class="questions-list">
            @foreach ($questions as $question)
                <li>
                    <a href="{{ route('quizzes.question', [
                        'quizId' => $quiz->id,
                        'questionId' => $question->id,
                        'questionNumber' => $loop->iteration
                    ]) }}">Pytanie {{ $loop->iteration }}</a>
                </li>
            @endforeach
        </ul>

        <p style="margin-top: 30px;">
            <a href="{{ route('quizzes.question', [
                'quizId' => $quiz->id,
                'questionId' => $questions->first()->id,
                'questionNumber' => 1
            ]) }}">Rozpocznij Quiz od Pytania 1</a>
        </p>
    @else
        <p>Ten quiz nie ma jeszcze zdefiniowanych pytań.</p>
    @endif
</div>
@endsection
