<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AulaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CompeticaoController;
use App\Http\Controllers\LevelController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/levels', [LevelController::class, 'index'])->name('levels.index');
    Route::get('/levels/{level}', [LevelController::class, 'show'])->name('levels.show');
    Route::post('/levels/{level}/complete', [LevelController::class, 'complete'])->name('levels.complete');

    Route::resource('modules', ModuleController::class);
    Route::get('/aulas', [ModuleController::class, 'index'])->name('aulas');
    Route::get('/aulas/{id}', [ModuleController::class, 'show'])->name('aulas.show');

    // Rotas da competição
    Route::get('/competicao', [CompeticaoController::class, 'index'])->name('competicao');
    Route::get('/competicao/{id}', [CompeticaoController::class, 'show'])->name('competicao.perfil');

    $pages = [
        'dashboard' => 'dashboard',
        'flashcards' => 'flashcards',
        'diagramas' => 'diagramas',
        'calendario' => 'calendario',
        'revisoes' => 'revisoes',
        'informacoes' => 'informacoes',
        'configuracoes' => 'configuracoes',
        'meu-plano' => 'meu-plano',
        // 'competicao' saiu daqui porque agora usa controller
    ];

    foreach ($pages as $uri => $view) {
        Route::view("/{$uri}", $view)->name($uri);
    }
});

use App\Http\Controllers\DiagramaController;

Route::get('/diagramas', [DiagramaController::class, 'index'])->name('diagramas');




require __DIR__ . '/auth.php';
