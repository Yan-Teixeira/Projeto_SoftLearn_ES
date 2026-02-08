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
        Schema::create('questoes', function (Blueprint $table) {
            $table->id();

            // FK para quizzes
            $table->foreignId('quiz_id')
                  ->constrained('quizzes')
                  ->onDelete('cascade');

            $table->text('enunciado');

            // DICA da questão
            $table->string('dica')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questoes');
    }
};
