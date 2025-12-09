@extends('layouts.app')

@section('title', 'Strona Główna')

@section('content')
    <h1 style="margin-top: 30px;">Witamy na Stronie Głównej Quizzes!</h1>
    
    <p style="font-size: 1.1em;">
        Dziękujemy za odwiedzenie naszej platformy do testowania wiedzy.
    </p>
    
    <p>
        <a href="{{ route('quizzes.index') }}" style="padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 15px;">
            Przejdź do listy Quizów
        </a>
    </p>

    <hr style="margin-top: 40px;">
    <p>Aktualnie dostępne są quizy z matematyki i tłumaczenia słów (Animals).</p>
@endsection