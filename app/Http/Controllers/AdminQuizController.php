<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    // 1. Pokaż listę wszystkich quizów
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    // 2. Pokaż formularz dodawania
    public function create()
    {
        return view('admin.quizzes.create');
    }

    // 3. Zapisz nowy quiz w bazie (TUTAJ BYŁ BŁĄD - TERAZ JEST POPRAWNIE)
    public function store(Request $request)
    {
        // Walidujemy tytuł i opis, a nie pytania!
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Quiz::create($validated);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz został dodany!');
    }

    // 4. Usuń quiz
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz usunięty.');
    }

    // 5. Pokaż formularz edycji
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', compact('quiz'));
    }

    // 6. Zaktualizuj quiz w bazie
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $quiz->update($validated);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz został zaktualizowany!');
    }
}