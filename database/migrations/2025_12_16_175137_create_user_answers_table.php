<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kto odpowiadał
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade'); // Jaki quiz
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Jakie pytanie
            $table->string('answer'); // Co zaznaczył (A, B, C...)
            $table->boolean('is_correct'); // Czy dobrze (0 lub 1)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
