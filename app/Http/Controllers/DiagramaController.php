<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level; // Certifique-se de importar o Model Level

class DiagramaController extends Controller
{
    // A função que você selecionou vai aqui dentro da classe
    public function index() {
        // Pega todos os níveis ordenados do banco de dados
        $levels = Level::orderBy('order')->get();
        
        // Retorna a view 'diagramas.blade.php' passando a variável $levels
        return view('diagramas', compact('levels'));
    }
}