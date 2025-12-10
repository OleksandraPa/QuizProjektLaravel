<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;      // Importujemy model Quiz
use App\Models\Question;  // Importujemy model Question

class QuizController extends Controller
{
    // Usunęliśmy tablicę $this->quizzes, dane są teraz w bazie!

    /**
     * Wyświetla listę wszystkich quizów.
     */
    public function index()
    {
        // Pobieramy wszystkie quizy z bazy danych
        $quizzes = Quiz::all(); 

        return view('quizzes.index', ['quizzes' => $quizzes]);
    }

    /**
     * Wyświetla szczegóły pojedynczego quizu.
     */
    public function show($id)
    {
        // Znajdujemy quiz po ID lub zwracamy 404
        $quiz = Quiz::findOrFail($id); 
        
        // Ładujemy pytania powiązane z tym quizem (lazy loading)
        $questions = $quiz->questions;

        return view('quizzes.show', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    /**
     * Wyświetla pojedyncze pytanie z quizu.
     */
    public function question($quizId, $questionId)
    {
        $question = Question::where('quiz_id', $quizId)
                            ->where('id', $questionId)
                            ->firstOrFail(); 

        $quiz = Quiz::findOrFail($quizId);

        $totalQuestions = $quiz->questions()->count(); 

        return view('quizzes.question', [
            'quizTitle' => $quiz->title, 
            'quizId' => $quizId,
            'questionId' => $question->id, 
            'questionText' => $question->text,
            'options' => $question->options, 
            'totalQuestions' => $totalQuestions 
        ]);
    }
    
    /**
     * Obsługuje przesłaną odpowiedź na pytanie i sprawdza jej poprawność.
     */
    public function submitAnswer(Request $request, $quizId, $questionId)
    {
        $request->validate([
            'answer' => 'required|in:A,B,C,D',
        ], [
            'answer.required' => 'Proszę wybrać jedną opcję, aby sprawdzić odpowiedź.',
        ]);

        $question = Question::findOrFail($questionId);
        
        if ((int)$question->quiz_id !== (int)$quizId) {
            abort(403, 'Pytanie nie należy do tego quizu.');
        }

        $correctAnswer = $question->answer; 
        $userAnswer = $request->input('answer');
        
        $isCorrect = ($userAnswer === $correctAnswer);

        $message = $isCorrect 
            ? 'Brawo! Twoja odpowiedź jest poprawna.' 
            : "Niestety, odpowiedź jest niepoprawna. Poprawna opcja to: {$correctAnswer}.";

        return redirect()->route('quizzes.question', [
            'quizId' => $quizId, 
            'questionId' => $questionId
        ])->with('status', $message);
    }
}