<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    private $quizzes = [
        1 => [
            'title' => 'Quiz Matematyczny: Podstawowe Działania',
            'description' => 'Test z dodawania, odejmowania i mnożenia.',
            'questions' => [
                1 => ['text' => 'Ile to jest $7 + 15$?', 'answer' => '22'],
                2 => ['text' => 'Jaki jest wynik działania $8 \times 6$?', 'answer' => '48'],
                3 => ['text' => 'Ile wynosi $\sqrt{49}$?', 'answer' => '7'],
            ]
        ],
        2 => [
            'title' => 'Angielski/Polski: Zwierzęta (Animals)',
            'description' => 'Sprawdź, czy znasz polskie odpowiedniki popularnych zwierząt.',
            'questions' => [
                1 => ['text' => 'Jakie polskie słowo oznacza **Dog**?', 'answer' => 'Pies'],
                2 => ['text' => 'Jakie polskie słowo oznacza **Cat**?', 'answer' => 'Kot'],
                3 => ['text' => 'Jakie polskie słowo oznacza **Elephant**?', 'answer' => 'Słoń'],
            ]
        ]
    ];

    public function index()
    {
        return view('quizzes.index', ['quizzes' => $this->quizzes]);
    }

    public function show($id)
    {
        if (!isset($this->quizzes[$id])) {
            abort(404);
        }
        $quiz = $this->quizzes[$id];
        $quiz['id'] = $id;

        return view('quizzes.show', ['quiz' => $quiz]);
    }

    public function question($quizId, $questionId)
    {
        if (!isset($this->quizzes[$quizId]) || !isset($this->quizzes[$quizId]['questions'][$questionId])) {
            abort(404);
        }

        $quiz = $this->quizzes[$quizId];
        $question = $quiz['questions'][$questionId];

        return view('quizzes.question', [
            'quizTitle' => $quiz['title'],
            'quizId' => $quizId,
            'questionId' => $questionId,
            'questionText' => $question['text']
        ]);
    }
}