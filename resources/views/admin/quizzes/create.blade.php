@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Tworzenie Nowego Quizu</h1>

            <form action="{{ route('admin.quizzes.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tytuł Quizu</label>
                    <input type="text" name="title" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required placeholder="Np. Quiz z Historii">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Opis (opcjonalnie)</label>
                    <textarea name="description" rows="4" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" placeholder="Opisz czego dotyczy ten quiz..."></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.quizzes.index') }}" class="text-gray-500 hover:text-gray-700 font-bold">
                        Anuluj
                    </a>
                    
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-lg transition duration-150 ease-in-out">
                        Zapisz Quiz
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection