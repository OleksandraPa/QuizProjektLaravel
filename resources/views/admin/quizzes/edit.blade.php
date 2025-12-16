@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Edytuj Quiz: {{ $quiz->title }}</h1>

            <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tytuł Quizu</label>
                    <input type="text" name="title" value="{{ old('title', $quiz->title) }}"
                           class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Opis (opcjonalnie)</label>
                    <textarea name="description"
                              class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500"
                              rows="4">{{ old('description', $quiz->description) }}</textarea>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                            style="
                                background-color: #3B82F6;
                                color: white;
                                padding: 10px 20px;
                                border-radius: 5px;
                                font-weight: bold;
                                border: none;
                                cursor: pointer;
                            ">
                        Zaktualizuj
                    </button>

                    <a href="{{ route('admin.quizzes.index') }}"
                       style="
                           display: inline-block;
                           background-color: #6B7280;
                           color: white;
                           padding: 10px 20px;
                           border-radius: 5px;
                           font-weight: bold;
                           text-decoration: none;
                       ">
                        Anuluj
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
