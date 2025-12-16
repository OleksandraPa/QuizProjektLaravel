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
        $questions = $quiz->questions()->orderBy('id')->get();

        return view('quizzes.show', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    /**
     * Pojedyncze pytanie z quizu.
     */
    public function question($quizId, $questionId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $allQuestions = $quiz->questions()->orderBy('id')->get();

        $question = $allQuestions->firstWhere('id', $questionId);
        if (!$question) {
            abort(404, "Nie znaleziono pytania.");
        }

        // Numer aktualnego pytania
        $currentIndex = $allQuestions->search(fn($q) => $q->id == $questionId);
        $questionNumber = $currentIndex + 1;

        $nextQuestion = $allQuestions->get($currentIndex + 1);

        $options = [
            'A' => $question->answer_a,
            'B' => $question->answer_b,
            'C' => $question->answer_c,
            'D' => $question->answer_d,
        ];

        return view('quizzes.question', [
            'quizTitle' => $quiz->title,
            'quizId' => $quiz->id,
            'questionId' => $question->id,
            'questionText' => $question->text,
            'options' => $options,
            'totalQuestions' => $allQuestions->count(),
            'questionNumber' => $questionNumber,
            'nextQuestionId' => $nextQuestion ? $nextQuestion->id : null,
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
            'answer.required' => 'Proszę zaznaczyć odpowiedź!',
        ]);

        $question = Question::findOrFail($questionId);

        $correctAnswer = $question->correct_answer;
        $userAnswer = $request->input('answer');
        $isCorrect = ($userAnswer === $correctAnswer);

        if (Auth::check()) {
            UserAnswer::create([
                'user_id' => Auth::id(),
                'quiz_id' => $quizId,
                'question_id' => $questionId,
                'answer' => $userAnswer,
                'is_correct' => $isCorrect,
            ]);
        }

        $message = $isCorrect 
            ? 'Brawo! Twoja odpowiedź jest poprawna.' 
            : "Niestety, odpowiedź jest niepoprawna. Poprawna opcja to: {$correctAnswer}.";

        // Przekierowanie na to samo pytanie, by pokazać komunikat i przycisk następnego
        return redirect()->route('quizzes.question', [
            'quizId' => $quizId, 
            'questionId' => $questionId
        ])->with('status', $message);
    }
}
