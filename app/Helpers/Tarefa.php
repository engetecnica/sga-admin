<?php

namespace App\Helpers;

use App\Models\CadastroFornecedor;
use App\Models\CadastroObra;
use App\Models\FerramentalRetirada;

use Carbon\Carbon;
class Tarefa
{
    public static function countObras()
    {
        return CadastroObra::where('nome_fantasia', null)->orderByDesc('id')->count();
    }

    public static function obras()
    {
        return CadastroObra::where('nome_fantasia', null)->orderByDesc('id')->limit(10)->get();
    }

    public static function funcionariosBloqueados()
    {
        $bloqueio = FerramentalRetirada::with('funcionario')
        ->where('status', 2)
        ->where('data_devolucao', '<', Carbon::now())
        ->orderByDesc('id')
        ->limit(10)
        ->get();

        return $bloqueio;
    }
}
