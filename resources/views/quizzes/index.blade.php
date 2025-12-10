@extends('layouts.app') 

@section('title', 'Lista Dostępnych Quizów')

@section('content')
    <h1>Lista Dostępnych Quizów</h1>
    
    @if ($quizzes->count() > 0)
        <ul style="list-style: none; padding: 0;">
            @foreach ($quizzes as $quiz)
                <li style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; text-align: left;">
                    <a href="{{ route('quizzes.show', ['id' => $quiz->id]) }}" style="font-size: 1.4em; text-decoration: none; color: #3498db; font-weight: bold;">
                        {{ $quiz->title }}
                    </a>
                    <p style="margin-top: 5px; color: #666;">{{ $quiz->description }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>Brak dostępnych quizów. Spróbuj dodać nowe!</p>
    @endif
@endsection