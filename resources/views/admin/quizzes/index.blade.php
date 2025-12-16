@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">Lista Quizów</h1>

            @if($quizzes->isEmpty())
                <p class="text-gray-500 mb-4">Nie ma jeszcze żadnych quizów.</p>
            @else
                <table class="w-full border-collapse border border-gray-300" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr class="bg-gray-100" style="background-color: #f3f4f6;">
                            <th class="border p-2 text-left" style="border: 1px solid #e5e7eb; padding: 8px;">Tytuł</th>
                            <th class="border p-2 text-left" style="border: 1px solid #e5e7eb; padding: 8px;">Opis</th>
                            <th class="border p-2 text-center" style="border: 1px solid #e5e7eb; padding: 8px;">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quizzes as $quiz)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2" style="border: 1px solid #e5e7eb; padding: 8px;">{{ $quiz->title }}</td>
                                <td class="border p-2" style="border: 1px solid #e5e7eb; padding: 8px;">{{ $quiz->description }}</td>
                                <td class="border p-2 text-center" style="border: 1px solid #e5e7eb; padding: 8px;">
                                    <div class="flex justify-center gap-2" style="display: flex; gap: 10px; justify-content: center;">
                                        
                                        {{-- Przycisk Pytania (Pomarańczowy) --}}
                                        <a href="{{ route('admin.quizzes.questions.index', $quiz) }}"
                                           class="px-4 py-2 font-bold rounded text-white bg-yellow-600 hover:bg-yellow-700"
                                           style="background-color: #D97706; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; display: inline-block;">
                                           Pytania
                                        </a>

                                        {{-- Przycisk Edytuj (Niebieski) --}}
                                        <a href="{{ route('admin.quizzes.edit', $quiz) }}"
                                           class="px-4 py-2 font-bold rounded text-white bg-blue-600 hover:bg-blue-700"
                                           style="background-color: #2563EB; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; display: inline-block;">
                                           Edytuj
                                        </a>

                                        {{-- Przycisk Usuń (Czerwony) --}}
                                        <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten quiz?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 font-bold rounded text-white bg-red-600 hover:bg-red-700"
                                                    style="background-color: #DC2626; color: white; padding: 8px 16px; border-radius: 4px; border: none; cursor: pointer;">
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

            {{-- Dodaj nowy quiz (Zielony) --}}
            <div class="mt-6" style="margin-top: 24px;">
                <a href="{{ route('admin.quizzes.create') }}"
                   class="px-4 py-2 font-bold rounded text-white bg-green-600 hover:bg-green-700"
                   style="background-color: #16A34A; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block;">
                   + Dodaj nowy quiz
                </a>
            </div>

        </div>
    </div>
</div>
@endsection