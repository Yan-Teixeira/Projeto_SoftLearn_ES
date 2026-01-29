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
        Schema::create('_questoes', function (Blueprint $table) {
            $table->id();
            $table->foreign('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text('enunciado');
            $table->text('dica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_questoes');
    }
};
