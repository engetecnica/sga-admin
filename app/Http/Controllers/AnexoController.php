<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


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
            $anexo->descricao = $request->detalhes ?? null;
            if ($anexo->save()) {
                Alert::success('Muito bem ;)', 'Arquivo enviado com sucesso!');
                return redirect(route('ferramental.retirada.detalhes', $request->id_item));
            } else {
                Alert::error('Atenção', 'Não foi possível processar sua solicitação de envio. Fale com seu supervisor.');
                return redirect(route('ferramental.retirada.detalhes', $request->id_item));
            }
        }

        Alert::error('Atenção', 'Input form upload está vazio.');
        return redirect(route('ferramental.retirada.detalhes', $request->id_item));


    }
}