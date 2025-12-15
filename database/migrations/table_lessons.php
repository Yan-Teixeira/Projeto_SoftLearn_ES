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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            // Relaciona cada lição ao seu módulo de aula
            $table->foreignId('module_id')->constrained('aula_modulos')->onDelete('cascade');
            $table->string('titulo');
            $table->longText('conteudo'); // Conteúdo principal (HTML, texto, link de vídeo)
            $table->integer('ordem')->default(0); // Para ordenar as aulas no Syllabus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};