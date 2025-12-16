<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    // Lista pytań dla quizu
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('admin.questions.index', compact('quiz', 'questions'));
    }

    // Formularz dodawania pytania
    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    // Zapis pytania
    public function store(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'answer_a' => 'required|string',
            'answer_b' => 'required|string',
            'answer_c' => 'required|string',
            'answer_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $validated['quiz_id'] = $quiz->id;

        Question::create($validated);

        return redirect()
            ->route('admin.quizzes.questions.index', $quiz)
            ->with('success', 'Pytanie dodane!');
    }

    // ✏️ EDYCJA – formularz
    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    // 💾 EDYCJA – zapis
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'answer_a' => 'required|string',
            'answer_b' => 'required|string',
            'answer_c' => 'required|string',
            'answer_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $question->update($validated);

        return redirect()
            ->route('admin.quizzes.questions.index', $question->quiz_id)
            ->with('success', 'Pytanie zaktualizowane!');
    }

    // Usuwanie
    public function destroy(Question $question)
    {
        $quizId = $question->quiz_id;
        $question->delete();

        return redirect()
            ->route('admin.quizzes.questions.index', $quizId)
            ->with('success', 'Pytanie usunięte.');
    }
}
