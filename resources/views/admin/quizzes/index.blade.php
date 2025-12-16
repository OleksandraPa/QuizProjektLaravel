@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">Lista Quizów</h1>

            @if($quizzes->isEmpty())
                <p class="text-gray-500 mb-4">Nie ma jeszcze żadnych quizów.</p>
            @else
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2 text-left">Tytuł</th>
                            <th class="border p-2 text-left">Opis</th>
                            <th class="border p-2 text-center">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quizzes as $quiz)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2">{{ $quiz->title }}</td>
                                <td class="border p-2">{{ $quiz->description }}</td>
                                <td class="border p-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        {{-- Przycisk Pytania --}}
                                        <a href="{{ route('admin.quizzes.questions.index', $quiz) }}"
                                        class="px-4 py-2 font-bold rounded text-white bg-blue-600 hover:bg-blue-700">
                                        Pytania
                                        </a>

                                        {{-- Przycisk Edytuj --}}
                                        <a href="{{ route('admin.quizzes.edit', $quiz) }}"
                                        class="px-4 py-2 font-bold rounded text-white bg-blue-600 hover:bg-blue-700">
                                        Edytuj
                                        </a>

                                        {{-- Przycisk Usuń --}}
                                        <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 font-bold rounded text-white bg-red-600 hover:bg-red-700">
                                                Usuń
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- Dodaj nowy quiz --}}
            <div class="mt-6">
                <a href="{{ route('admin.quizzes.create') }}"
                   class="px-4 py-2 font-bold rounded text-white bg-green-600 hover:bg-green-700">
                   + Dodaj nowy quiz
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
