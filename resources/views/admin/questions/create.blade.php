@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <h1 class="text-2xl font-bold mb-6 text-gray-800">
                Dodaj pytanie do: <span class="text-blue-600">{{ $quiz->title }}</span>
            </h1>

            <form action="{{ route('admin.quizzes.questions.store', $quiz) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Treść Pytania</label>
                    <textarea name="text" rows="3" class="border-2 border-gray-300 rounded w-full p-3" required placeholder="Wpisz pytanie..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Odpowiedź A</label>
                        <input type="text" name="answer_a" class="border rounded w-full p-2" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Odpowiedź B</label>
                        <input type="text" name="answer_b" class="border rounded w-full p-2" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Odpowiedź C</label>
                        <input type="text" name="answer_c" class="border rounded w-full p-2" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Odpowiedź D</label>
                        <input type="text" name="answer_d" class="border rounded w-full p-2" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-bold mb-2">Poprawna odpowiedź</label>
                    <select name="correct_answer" class="border-2 border-blue-200 rounded w-full p-2 bg-blue-50">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>

                <div class="flex items-center justify-between border-t pt-6">
                    <a href="{{ route('admin.quizzes.questions.index', $quiz) }}" class="text-gray-500 font-bold">
                        Anuluj
                    </a>
                    
                    <button type="submit" style="background-color: #10B981; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; border: none; cursor: pointer;">
                        ZAPISZ PYTANIE
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection