<?php

namespace App\Http\Controllers;

use App\Models\{
    AtivoExterno,
    AtivoExternoEstoque,
    FerramentalRequisicao,
    CadastroObra,
    CadastroFuncionario,
    FerramentalRequisicaoItem
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FerramentalRequisicaoController extends Controller
{
    public function index()
    {
        $requisicoes = FerramentalRequisicao::with('solicitante', 'obraOrigem', 'obraDestino', 'situacao')->get();
        return view('pages.ferramental.requisicao.index', compact('requisicoes'));
    }

    public function create()
    {
        $obras = CadastroObra::all();
        $itens = AtivoExterno::with('estoque')->get();
        return view('pages.ferramental.requisicao.create', compact('obras', 'itens'));
    }

    public function store(Request $request)
    {

        // $request->validate([
        //     'id_ativo_externo.*' => 'required',
        //     'quantidade.*' => 'required',
        // ]);

        $data = $request->all();
        $requisicao = new FerramentalRequisicao();
        $requisicao->id_solicitante = Auth::user()->id;
        $requisicao->id_obra_origem = $data['id_obra_origem'];
        $requisicao->id_obra_destino = $data['id_obra_destino'];
        $requisicao->observacoes = $data['observacoes'];
        $requisicao->status = 1;
        $requisicao->save();

        $status = true;

        foreach ($request->id_ativo_externo as $index => $idAtivoExterno) {
            $item = new FerramentalRequisicaoItem();
            $item->id_ativo_externo = $idAtivoExterno;
            $item->id_requisicao = $requisicao->id;
            $item->quantidade_solicitada = $request->quantidade[$index];
            $item->status = 1;
            $item->save();

            if (!$item->save()) {
                $status = false;
            }
        }

        if ($status) {
            return redirect()->route('ferramental.requisicao.index')->with('success', 'Registro cadastrado com sucesso.');
        } else {
            return redirect()->route('ferramental.requisicao.index')->with('fail', 'Um erro impediu o cadastro.');
        }
    }

    public function show($id)
    {
        $ferramentalRequisicao = FerramentalRequisicao::with('solicitante', 'obraOrigem', 'obraDestino', 'situacao')->where('id', $id)->first();
        $itens = FerramentalRequisicaoItem::with('ativo', 'requisicao')->where('id_requisicao', $id)->get();
        return view('pages.ferramental.requisicao.show', compact('ferramentalRequisicao', 'itens'));
    }

}
