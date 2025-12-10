<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizzesData = [
            [
                'title' => 'Quiz Matematyczny: Podstawowe Działania (Wybór)',
                'description' => 'Test wiedzy z dodawania, odejmowania i mnożenia w formie testu.',
                'questions' => [
                    [
                        'text' => 'Ile to jest 7 + 15?',
                        'options' => ['A' => '21', 'B' => '22', 'C' => '23', 'D' => '24'],
                        'answer' => 'B'
                    ],
                    [
                        'text' => 'Jaki jest wynik działania 8 × 6?',
                        'options' => ['A' => '42', 'B' => '48', 'C' => '54', 'D' => '60'],
                        'answer' => 'B'
                    ],
                    [
                        'text' => 'Ile wynosi pierwiastek kwadratowy z 49?',
                        'options' => ['A' => '6', 'B' => '7', 'C' => '8', 'D' => '9'],
                        'answer' => 'B'
                    ],
                ]
            ],
            [
                'title' => 'Angielski/Polski: Zwierzęta (Wybór)',
                'description' => 'Wybierz polski odpowiednik popularnych zwierząt.',
                'questions' => [
                    [
                        'text' => 'Jakie polskie słowo oznacza **Dog**?',
                        'options' => ['A' => 'Koń', 'B' => 'Pies', 'C' => 'Krowa', 'D' => 'Królik'],
                        'answer' => 'B'
                    ],
                    [
                        'text' => 'Jakie polskie słowo oznacza **Elephant**?',
                        'options' => ['A' => 'Żyrafa', 'B' => 'Lew', 'C' => 'Słoń', 'D' => 'Nosorożec'],
                        'answer' => 'C'
                    ],
                ]
            ],
        ];

        foreach ($quizzesData as $data) {
            $questions = $data['questions'];
            unset($data['questions']); 

            $quiz = Quiz::create($data);

            foreach ($questions as $questionData) {
                $quiz->questions()->create($questionData);
            }
        }
    }
}