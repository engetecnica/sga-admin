<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AtivoExternoEstoqueItem;
use Illuminate\Http\Request;

class ApiRequisicao extends Controller
{
    //

    public function lista_ativo(Request $request)
    {
        $termo = $request->term ?? null;
        $ativos = AtivoExternoEstoqueItem::getEstoqueItemLista($termo);
        return json_encode($ativos);
    }

    public function ativo_externo_id($id)
    {

        if (!$id) return "";
        $ativo = AtivoExternoEstoqueItem::find($id)->quantidade_estoque;
        return $ativo;
    }
}
