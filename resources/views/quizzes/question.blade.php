@extends('layouts.app')

@section('title', "Pytanie $questionId - $quizTitle") 

@section('content')
    <style>
        .question-text {
            font-size: 1.8em;
            margin: 30px 0;
            padding: 15px;
            color: #2c3e50;
            font-weight: bold;
            border-bottom: 3px solid #f8f9fa;
        }
        
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

        .submit-button {
            padding: 15px 30px;
            background-color: #3498db; 
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            transition: background-color 0.2s;
        }
        
        .submit-button:hover {
            background-color: #2980b9;
        }
    </style>

    <h2 style="color: #3498db;">{{ $quizTitle }}</h2>
    <h3 style="margin-bottom: 30px;">Pytanie {{ $questionNumber }} z {{ $totalQuestions }}</h3>

    @if (session('status'))
        <div class="alert {{ str_contains(session('status'), 'Brawo') ? 'alert-success' : 'alert-danger' }}">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            Błąd: {{ $errors->first('answer') }}
        </div>
    @endif
    
    <p class="question-text">{{ $questionText }}</p>

    <form action="{{ route('quizzes.submit', ['quizId' => $quizId, 'questionId' => $questionId]) }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 30px; text-align: center;">
            @foreach ($options as $key => $value)
                <label class="option-label">
                    <input type="radio" name="answer" value="{{ $key }}" required>
                    {{ $key }}) {{ $value }}
                </label>
            @endforeach
        </div>
        
        <button type="submit" class="submit-button">
            Sprawdź Odpowiedź
        </button>
    </form>

    <hr style="margin: 40px 0;">
    <p><a href="{{ route('quizzes.show', ['id' => $quizId]) }}" style="color: #2c3e50;">← Powrót do szczegółów Quizu</a></p>
@endsection