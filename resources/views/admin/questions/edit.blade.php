@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">

            <h1 class="text-2xl font-bold mb-6">
                Edytuj pytanie
            </h1>

            <form method="POST"
                  action="{{ route('admin.questions.update', $question) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-bold mb-2">Treść pytania</label>
                    <textarea name="text"
                              class="border rounded w-full p-2"
                              rows="3"
                              required>{{ old('text', $question->text) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Odpowiedź A</label>
                        <input type="text" name="answer_a"
                               value="{{ old('answer_a', $question->answer_a) }}"
                               class="border rounded w-full p-2" required>
                    </div>

                    <div>
                        <label>Odpowiedź B</label>
                        <input type="text" name="answer_b"
                               value="{{ old('answer_b', $question->answer_b) }}"
                               class="border rounded w-full p-2" required>
                    </div>

                    <div>
                        <label>Odpowiedź C</label>
                        <input type="text" name="answer_c"
                               value="{{ old('answer_c', $question->answer_c) }}"
                               class="border rounded w-full p-2" required>
                    </div>

                    <div>
                        <label>Odpowiedź D</label>
                        <input type="text" name="answer_d"
                               value="{{ old('answer_d', $question->answer_d) }}"
                               class="border rounded w-full p-2" required>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="font-bold">Poprawna odpowiedź</label>
                    <select name="correct_answer"
                            class="border rounded w-full p-2">
                        @foreach(['A','B','C','D'] as $opt)
                            <option value="{{ $opt }}"
                                @selected($question->correct_answer === $opt)>
                                {{ $opt }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.quizzes.questions.index', $question->quiz_id) }}"
                       class="text-gray-600 font-bold">
                        Anuluj
                    </a>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded font-bold">
                        Zapisz zmiany
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
