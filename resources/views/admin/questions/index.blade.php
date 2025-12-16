@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">
                Pytania – quiz: {{ $quiz->title }}
            </h1>

            {{-- Powrót do listy quizów --}}
            <a href="{{ route('admin.quizzes.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded font-bold mb-4 inline-block hover:bg-gray-700"
               style="background-color: #4B5563; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-bottom: 15px; display: inline-block;">
                ← Powrót do listy quizów
            </a>

            {{-- Dodaj pytanie --}}
            <div class="mb-6">
                <a href="{{ route('admin.quizzes.questions.create', $quiz) }}"
                   class="bg-green-600 text-white px-4 py-2 rounded font-bold inline-block hover:bg-green-700"
                   style="background-color: #16A34A; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    + Dodaj pytanie
                </a>
            </div>

            @if($questions->isEmpty())
                <p class="text-gray-500 mt-4">
                    Ten quiz nie ma jeszcze żadnych pytań.
                </p>
            @else
                <table class="w-full border mt-4" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr class="bg-gray-100" style="background-color: #f3f4f6;">
                            <th class="border p-2 text-left" style="border: 1px solid #e5e7eb; padding: 8px;">Treść</th>
                            <th class="border p-2 text-center" style="border: 1px solid #e5e7eb; padding: 8px;">Poprawna</th>
                            <th class="border p-2 text-center" style="border: 1px solid #e5e7eb; padding: 8px;">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td class="border p-2" style="border: 1px solid #e5e7eb; padding: 8px;">{{ $question->text }}</td>
                                <td class="border p-2 text-center font-bold" style="border: 1px solid #e5e7eb; padding: 8px; text-align: center;">{{ $question->correct_answer }}</td>
                                <td class="border p-2" style="border: 1px solid #e5e7eb; padding: 8px;">
                                    <div class="flex gap-2 justify-center" style="display: flex; gap: 10px; justify-content: center;">
                                        
                                        {{-- Edytuj (Niebieski) --}}
                                        <a href="{{ route('admin.questions.edit', $question) }}"
                                           class="px-4 py-2 font-bold rounded text-white bg-blue-600 hover:bg-blue-700"
                                           style="background-color: #2563EB; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; display: inline-block;">
                                           Edytuj
                                        </a>

                                        {{-- Usuń (Czerwony) --}}
                                        <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" onsubmit="return confirm('Czy na pewno usunąć?');" style="display: inline;">
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

        </div>
    </div>
</div>
@endsection