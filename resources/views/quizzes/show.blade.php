@extends('layouts.app')

@section('title', $quiz->title)

@section('content')
    <h1>{{ $quiz->title }}</h1>
    <h2 style="margin-top: 30px; color: #2c3e50;">Pytania w Quizie:</h2>
    
    @if ($questions->count() > 0) 
        <ol style="padding-left: 0; text-align: left; list-style-position: inside;">
            @foreach ($questions as $question)
                <li style="margin-bottom: 10px; font-size: 1.1em; padding: 5px;">
                    <a href="{{ route('quizzes.question', [
                        'quizId' => $quiz->id, 
                        'questionId' => $question->id,
                        'questionNumber' => $loop->iteration
                    ]) }}" style="color: #28a745; text-decoration: none;">
                        **Pytanie {{ $loop->iteration }}** </a>
                </li>
            @endforeach 
        </ol>
        
        <p style="margin-top: 30px;">
            <a href="{{ route('quizzes.question', [
                'quizId' => $quiz->id, 
                'questionId' => $questions->first()->id,
                'questionNumber' => 1
            ]) }}" style="padding: 12px 25px; background-color: #3498db; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block;">
                Rozpocznij Quiz od Pytania 1
            </a>
        </p>

    @else 
        <p>Ten quiz nie ma jeszcze zdefiniowanych pytań.</p>
    @endif 
    
    <hr style="margin-top: 40px;">
    <p><a href="{{ route('quizzes.index') }}" style="color: #2c3e50;">← Powrót do listy quizów</a></p>
@endsection