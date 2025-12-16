@extends('layouts.app')

@section('title', "Pytanie $questionNumber z $totalQuestions") 

@section('content')
<style>
.option-label {
    display: block;
    margin-bottom: 15px;
    font-size: 1.2em;
    cursor: pointer;
    padding: 15px 20px;
    background-color: #f1f1f1;
    border: 2px solid #ddd;
    border-radius: 8px;
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
.submit-button, .next-button {
    padding: 15px 30px;
    background-color: #3498db; 
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.1em;
    font-weight: bold;
    transition: background-color 0.2s;
    margin-right: 15px;
}
.submit-button:hover, .next-button:hover {
    background-color: #2980b9;
}
.status-message {
    padding: 10px 15px;
    background-color: #d1e7dd;
    color: #0f5132;
    border-radius: 8px;
    margin-bottom: 20px;
}
</style>

<h2>{{ $quizTitle }}</h2>
<h3>Pytanie {{ $questionNumber }} z {{ $totalQuestions }}</h3>

@if (session('status'))
    <div class="status-message">
        {{ session('status') }}
    </div>
@endif

<p style="font-weight:bold; font-size:1.5em; margin:20px 0;">{{ $questionText }}</p>

<form method="POST" action="{{ route('quizzes.submit', ['quizId' => $quizId, 'questionId' => $questionId]) }}">
    @csrf
    @foreach ($options as $key => $value)
        <label class="option-label">
            <input type="radio" name="answer" value="{{ $key }}" required>
            {{ $key }}) {{ $value }}
        </label>
    @endforeach

    <div style="margin-top: 20px;">
        <button type="submit" class="submit-button">Sprawdź odpowiedź</button>
        @if($nextQuestionId)
            <a href="{{ route('quizzes.question', ['quizId' => $quizId, 'questionId' => $nextQuestionId]) }}" class="next-button">Idź do następnego pytania</a>
        @endif
    </div>
</form>

<hr style="margin: 40px 0;">
<p><a href="{{ route('quizzes.show', ['id' => $quizId]) }}">← Powrót do szczegółów Quizu</a></p>
@endsection
