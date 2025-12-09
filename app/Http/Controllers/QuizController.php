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

    
    
}