<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\{
    FerramentalRetirada,
    FerramentalRetiradaItem,
    AtivoExternoEstoque
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnexoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function upload(Request $request, $input = "arquivo")
    {
        $request->validate([
            'file' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
        ], [
            'file.mimes' => 'O tipo de arquivo que você está tentando enviar não é válido.'
        ]);

        if ($request->file($input)) {
            $diretorio = $request->diretorio ?? 'uploads';
            $nome_arquivo = time() . '_' . $request->file($input)->getClientOriginalName();
            $request->file($input)->storeAs('uploads/' . $diretorio, $nome_arquivo, 'public');
        }

        if ($request->file($input)) {
            $anexo = new Anexo;
            $anexo->id_usuario = Auth::user()->id ?? 1;
            $anexo->id_anexo = 0;
            $anexo->id_modulo = $request->id_modulo ?? 0;
            $anexo->id_item = $request->id_item ?? 0;
            $anexo->titulo = $request->titulo ?? null;
            $anexo->tipo = $request->file($input)->extension();
            $anexo->arquivo = $nome_arquivo;
            $anexo->descricao = $request->detalhes ?? null;

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | UPDATE ANEXO: ' . $nome_arquivo);

            if ($anexo->save()) {

                $detalhes = FerramentalRetirada::getRetiradaItems($request->id_item);
                if ($detalhes->itens) {

                    // Atualiza Retirada
                    $retirada = FerramentalRetirada::find($request->id_item);
                    $retirada->status = 2;
                    $retirada->save();

                    // Atualiza Item da Retirada
                    foreach ($detalhes->itens as $ret) {
                        $retirada_item = FerramentalRetiradaItem::find($ret->id_retirada);
                        $retirada_item->status = 2; // Entregue
                        $retirada_item->save();
                    }

                    // Atualiza Estoque
                    foreach ($detalhes->itens as $ent) {
                        $estoque = AtivoExternoEstoque::find($ent->id_ativo_externo);
                        $estoque->status = 6; // Em Operação
                        $estoque->save();
                    }
                }

                return redirect()->route('ferramental.retirada.detalhes', $request->id_item)->with('success', 'Arquivo enviado com sucesso.');

            } else {

                return redirect()->route('ferramental.retirada.detalhes', $request->id_item)->with('fail',  'Não foi possível processar sua solicitação de envio. Fale com seu supervisor.');
            }
        }

        return redirect()->route('ferramental.retirada.detalhes', $request->id_item)->with('fail',  'Não foi possível processar sua solicitação de envio. Fale com seu supervisor.');

    }
}
