@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Zarządzanie Quizami</h1>
                
                {{-- Dodaj nowy quiz --}}
                <a href="{{ route('admin.quizzes.create') }}"
                   style="
                       display: inline-block;
                       background-color: #3B82F6;
                       color: white;
                       padding: 8px 16px;
                       border-radius: 5px;
                       font-weight: bold;
                       text-decoration: none;
                   ">
                    + Dodaj Nowy Quiz
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($quizzes->isEmpty())
                <div class="text-center py-10 text-gray-500">
                    Brak quizów w bazie. Kliknij przycisk powyżej, aby dodać pierwszy!
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-5 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-5 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tytuł</th>
                                <th class="px-5 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                                <tr class="bg-white">
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $quiz->id }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $quiz->title }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="flex gap-2 flex-wrap">
                                            {{-- Edytuj quiz --}}
                                            <a href="{{ route('admin.quizzes.edit', $quiz) }}"
                                               style="
                                                   display: inline-block;
                                                   background-color: #3B82F6;
                                                   color: white;
                                                   padding: 6px 12px;
                                                   border-radius: 5px;
                                                   font-weight: bold;
                                                   text-decoration: none;
                                               ">
                                                Edytuj
                                            </a>

                                            {{-- Pytania quizu --}}
                                            <a href="{{ route('admin.quizzes.questions.index', $quiz) }}"
                                               style="
                                                   display: inline-block;
                                                   background-color: #10B981;
                                                   color: white;
                                                   padding: 6px 12px;
                                                   border-radius: 5px;
                                                   font-weight: bold;
                                                   text-decoration: none;
                                               ">
                                                Pytania
                                            </a>

                                            {{-- Usuń quiz --}}
                                            <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten quiz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        style="
                                                            display: inline-block;
                                                            background-color: #EF4444;
                                                            color: white;
                                                            padding: 6px 12px;
                                                            border-radius: 5px;
                                                            font-weight: bold;
                                                            border: none;
                                                            cursor: pointer;
                                                        ">
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
