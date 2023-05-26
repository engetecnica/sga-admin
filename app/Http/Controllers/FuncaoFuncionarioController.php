<?php

namespace App\Http\Controllers;

use App\Models\FuncaoFuncionario;
use Illuminate\Http\Request;

class FuncaoFuncionarioController extends Controller
{
    public function index()
    {
        $funcoes = FuncaoFuncionario::with('funcionarios')->get();
        return view('pages.cadastros.funcionario.funcoes.index', compact('funcoes'));
    }

    public function create()
    {
        return view('pages.cadastros.funcionario.funcoes.create');
    }
}
