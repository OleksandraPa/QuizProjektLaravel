<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;      
use App\Models\Question;  
use Illuminate\Support\Facades\Auth;
use App\Models\UserAnswer;

class QuizController extends Controller
{
    /**
     * Wyświetla listę wszystkich quizów.
     */
    public function index()
    {
        $quizzes = Quiz::all(); 

        return view('quizzes.index', ['quizzes' => $quizzes]);
    }

    /**
     * Wyświetla szczegóły pojedynczego quizu.
     */
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id); 

        $questions = $quiz->questions;

        return view('quizzes.show', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    /**
     * pojedyncze pytanie z quizu
     */
    public function question($quizId, $questionId, $questionNumber = 1)    {
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
            'totalQuestions' => $totalQuestions,
            'questionNumber' => (int)$questionNumber 
        ]);
    }
    
    /**
     * Obsługuje przesłaną odpowiedź na pytanie i sprawdza jej poprawność.
     */
    public function submitAnswer(Request $request, $quizId, $questionId, $questionNumber = 1)
    {
        // 1. WALIDACJA (To spełnia pierwszą część zadania)
        $request->validate([
            'answer' => 'required|in:A,B,C,D',
        ], [
            'answer.required' => 'Proszę zaznaczyć odpowiedź!',
        ]);

        $question = Question::findOrFail($questionId);

        // Sprawdzamy czy odpowiedź jest poprawna
        $correctAnswer = $question->answer;
        $userAnswer = $request->input('answer');
        $isCorrect = ($userAnswer === $correctAnswer);

        // 2. ZAPIS DO BAZY (To spełnia drugą część zadania: "przed zapisaniem")
        // Zapisujemy tylko jeśli użytkownik jest zalogowany
        if (Auth::check()) {
            UserAnswer::create([
                'user_id' => Auth::id(),
                'quiz_id' => $quizId,
                'question_id' => $questionId,
                'answer' => $userAnswer,
                'is_correct' => $isCorrect,
            ]);
        }

        // 3. Informacja zwrotna
        $message = $isCorrect 
            ? 'Brawo! Twoja odpowiedź jest poprawna.' 
            : "Niestety, odpowiedź jest niepoprawna. Poprawna opcja to: {$correctAnswer}.";

        return redirect()->route('quizzes.question', [
            'quizId' => $quizId, 
            'questionId' => $questionId,
            'questionNumber' => $questionNumber
        ])->with('status', $message);
    }
}