<?php

namespace App\Helpers;

use App\Models\CadastroFornecedor;
use App\Models\CadastroObra;
use App\Models\FerramentalRequisicaoTransito;
use App\Models\FerramentalRetirada;
use App\Models\Preventiva;
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
        ->where('data_devolucao', '<', Carbon::now())
        ->orWhere('status', 5)
        ->orderByDesc('id')
        ->limit(10)
        ->get();

        return $bloqueio;
    }

    public static function preventivas()
    {
        $preventivas = Preventiva::with('veiculo', 'manutencao')->limit(10)->get();
        return $preventivas;
    }

    public static function transferencias($obra)
    {
        if(isset($obra)) {
            $transferencias = FerramentalRequisicaoTransito::with('requisicao', 'ativo', 'obraOrigem', 'obradestino', 'status')->where('status', 5)
            ->Where('id_obra_origem', $obra)
            ->orWhere('id_obra_destino', $obra)
            ->get();
        } else {
            $transferencias = FerramentalRequisicaoTransito::with('requisicao', 'ativo', 'obraOrigem', 'obradestino', 'status')->where('status', 5)
            ->get();
        }
        return $transferencias;
    }
}
