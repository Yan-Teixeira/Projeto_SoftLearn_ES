<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order')->default(1);
            $table->string('route_name')->nullable();
            
            // O campo mágico que guarda suas regras de conexão
            $table->json('validation_rules')->nullable(); 
            
            $table->timestamps();
        });

        Schema::create('level_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('level_id')->constrained()->onDelete('cascade');
            $table->timestamp('completed_at')->useCurrent();
            $table->integer('score')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'level_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('level_user');
        Schema::dropIfExists('levels');
    }
};