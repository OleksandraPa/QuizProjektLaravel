@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">
                Pytania – quiz: {{ $quiz->title }}
            </h1>

            {{-- Przycisk Dodaj pytanie zawsze widoczny --}}
            <a href="{{ route('admin.quizzes.questions.create', $quiz) }}"
               style="
                   display: inline-block;
                   background-color: #10B981;
                   color: white;
                   padding: 10px 20px;
                   border-radius: 5px;
                   font-weight: bold;
                   text-decoration: none;
                   margin-bottom: 1rem;
               ">
                + Dodaj pytanie
            </a>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($questions->isEmpty())
                <p class="text-gray-500 mt-4">
                    Ten quiz nie ma jeszcze żadnych pytań.
                </p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2 text-left">Treść pytania</th>
                                <th class="border p-2 text-center">Poprawna odpowiedź</th>
                                <th class="border p-2 text-left">Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr class="bg-white">
                                    <td class="border p-2">{{ $question->text }}</td>
                                    <td class="border p-2 text-center font-bold">{{ $question->correct_answer }}</td>
                                    <td class="border p-2">
                                        <div class="flex gap-4">
                                            <a href="{{ route('admin.questions.edit', $question) }}"
                                               class="text-blue-600 hover:text-blue-900 font-bold">
                                                Edytuj
                                            </a>
                                            <form method="POST" action="{{ route('admin.questions.destroy', $question) }}"
                                                  onsubmit="return confirm('Czy na pewno chcesz usunąć to pytanie?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold">
                                                    Usuń
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
