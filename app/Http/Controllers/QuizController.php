<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    //dane z opcjami wyboru
    private $quizzes = [
        1 => [
            'title' => 'Quiz Matematyczny: Podstawowe Działania',
            'description' => 'Test wiedzy z dodawania, odejmowania i mnożenia w formie testu.',
            'questions' => [
                1 => [
                    'text' => 'Ile to jest 7 + 15?', 
                    'options' => [
                        'A' => '21',
                        'B' => '22',
                        'C' => '23',
                        'D' => '24',
                    ],
                    'answer' => 'B' 
                ],
                2 => [
                    'text' => 'Jaki jest wynik działania 8 × 6?', 
                    'options' => [
                        'A' => '42',
                        'B' => '48',
                        'C' => '54',
                        'D' => '60',
                    ],
                    'answer' => 'B' 
                ],
                3 => [
                    'text' => 'Ile wynosi pierwiastek kwadratowy z 49?', 
                    'options' => [
                        'A' => '6',
                        'B' => '7',
                        'C' => '8',
                        'D' => '9',
                    ],
                    'answer' => 'B' 
                ],
            ]
        ],
        2 => [
            'title' => 'Tłumaczenie z angielskiego na polski: Zwierzęta',
            'description' => 'Wybierz polski odpowiednik popularnych zwierząt.',
            'questions' => [
                1 => [
                    'text' => 'Jakie polskie słowo oznacza "Dog"?', 
                    'options' => [
                        'A' => 'Koń',
                        'B' => 'Pies',
                        'C' => 'Krowa',
                        'D' => 'Królik',
                    ],
                    'answer' => 'B'
                ],
                2 => [
                    'text' => 'Jakie polskie słowo oznacza "Elephant"?', 
                    'options' => [
                        'A' => 'Żyrafa',
                        'B' => 'Lew',
                        'C' => 'Słoń',
                        'D' => 'Nosorożec',
                    ],
                    'answer' => 'C'
                ],
            ]
        ]
    ];

    //lista quizow
    public function index()
    {
        return view('quizzes.index', ['quizzes' => $this->quizzes]);
    }

    //szczegóły pojedynczego quizu
    public function show($id)
    {
        if (!isset($this->quizzes[$id])) {
            abort(404);
        }
        $quiz = $this->quizzes[$id];
        $quiz['id'] = $id; 

        return view('quizzes.show', ['quiz' => $quiz]);
    }

    
    //pojedyncze pytanie
    public function question($quizId, $questionId)
    {
        if (!isset($this->quizzes[$quizId]) || !isset($this->quizzes[$quizId]['questions'][$questionId])) {
            abort(404);
        }

        $quiz = $this->quizzes[$quizId];
        $question = $quiz['questions'][$questionId];

        // całkowita liczbę pytań dla postępu
        $totalQuestions = count($quiz['questions']);

        return view('quizzes.question', [
            'quizTitle' => $quiz['title'],
            'quizId' => $quizId,
            'questionId' => $questionId,
            'questionText' => $question['text'],
            'options' => $question['options'],
            'totalQuestions' => $totalQuestions 
        ]);
    }
    
    //sprawdzanie poprawnej odpowiedzi
    public function submitAnswer(Request $request, $quizId, $questionId)
    {
        // walidacja danych (A, B, C lub D)
        $request->validate([
            'answer' => 'required|in:A,B,C,D',
        ], [
            'answer.required' => 'Proszę wybrać jedną opcję, aby sprawdzić odpowiedź.',
            'answer.in' => 'Wybrana opcja jest nieprawidłowa.'
        ]);

        // poprawną odpowiedź (A, B, C lub D)
        if (!isset($this->quizzes[$quizId]) || !isset($this->quizzes[$quizId]['questions'][$questionId])) {
            return redirect()->route('quizzes.index')->with('error', 'Quiz lub pytanie nie istnieje.');
        }

        $correctAnswer = $this->quizzes[$quizId]['questions'][$questionId]['answer'];
        $userAnswer = $request->input('answer');
        
        // sprawdzanie poprawności
        $isCorrect = ($userAnswer === $correctAnswer);

        // wiadomość flash
        $message = $isCorrect 
            ? 'Brawo! Twoja odpowiedź jest poprawna.' 
            : "Niestety, odpowiedź jest niepoprawna. Poprawna opcja to: **{$correctAnswer}**.";

        // przekierowanie na to samo pytanie
        return redirect()->route('quizzes.question', [
            'quizId' => $quizId, 
            'questionId' => $questionId
        ])->with('status', $message);
    }
}