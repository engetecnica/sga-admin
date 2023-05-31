<?php

namespace App\Http\Controllers;

use App\Models\{
    AtivoExterno,
    AtivoExternoEstoque,
    AtivoExternoEstoqueItem,
    FerramentalRequisicao,
    CadastroObra,
    CadastroFuncionario,
    FerramentalRequisicaoItem
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FerramentalRequisicaoController extends Controller
{
    public function index()
    {
        $requisicoes = FerramentalRequisicao::with('solicitante', 'obraOrigem', 'obraDestino', 'situacao')->get();


        return view('pages.ferramental.requisicao.index', compact('requisicoes'));
    }

    public function create()
    {
        $itens = AtivoExterno::with('estoque')->get();

        $obras = CadastroObra::all();

        return view('pages.ferramental.requisicao.create', compact('itens', 'obras'));
    }

    public function store(Request $request)
    {



        // $request->validate([
        //     'id_ativo_externo.*' => 'required',
        //     'quantidade.*' => 'required',
        // ]);

        $request->validate(
            [
                'id_obra_destino' => 'required'
            ],
            [
                'id_obra_destino.required' => 'É necessário selecionar uma Obra de Destino',
            ]
        );

        $data = $request->all();
        $requisicao = new FerramentalRequisicao();
        $requisicao->id_solicitante = Auth::user()->id;
        $requisicao->id_obra_origem = null;
        $requisicao->id_obra_destino = $data['id_obra_destino'];
        $requisicao->observacoes = $data['observacoes'];
        $requisicao->status = 1;
        $requisicao->save();
        $status = true;

        foreach ($request->id_ativo_externo as $index => $value) {

            $limit = $request->quantidade[$index];
            $id_ativo = $request->id_ativo_externo[$index];

            $estoques = AtivoExternoEstoque::where('id_ativo_externo', $id_ativo)
            ->where('status', 4)
            ->orderByDesc('id')
            ->limit($limit)
            ->get();

            foreach ($estoques as $estoque) {
                AtivoExternoEstoque::where('id', $estoque->id)->update(['status' => 11]);

                $item = new FerramentalRequisicaoItem();
                $item->id_ativo_externo = $estoque->id;
                $item->id_requisicao = $requisicao->id;
                $item->quantidade_solicitada = 1;
                $item->status = 1;
                $item->save();
            }
        }

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD REQUISICAO | ID: ' . $requisicao->id . ' | STATUS: ' . $status . ' | DATA: ' . date('Y-m-d H:i:s'));

        if ($status) {
            return redirect()->route('ferramental.requisicao.index')->with('success', 'Registro cadastrado com sucesso.');
        } else {
            return redirect()->route('ferramental.requisicao.index')->with('fail', 'Um erro impediu o cadastro.');
        }
    }

    public function show($id)
    {
        $ferramentalRequisicao = FerramentalRequisicao::with('solicitante', 'obraOrigem', 'obraDestino', 'situacao')
            ->where('id', $id)
            ->first();

        $itens = FerramentalRequisicaoItem::with('ativo_externo_estoque', 'situacao')->where('id_requisicao', $id)->get();

        return view('pages.ferramental.requisicao.show', compact('ferramentalRequisicao', 'itens'));
    }

    public function update(Request $request, $id)
    {

        if (! $save = FerramentalRequisicao::find($id)) {
            return redirect()->route('ferramental.requisicao.show', $id)->with('fail', 'Registro não encontrado.');
        }

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT REQUISICAO | ID: ' . $save->id);

        $data = $request->all();
        $data['data_liberacao'] = date('Y-m-d H:i:s');

        // $liberado = 0;
        // foreach ($request->quantidade_liberada as $quantidade) {
        //     if ($quantidade == 0) {
        //         $liberado = 0;
        //     } elseif ($quantidade > 0) {
        //         $liberado = $quantidade;
        //     }
        // }
        $total_liberado = array_sum($request->quantidade_liberada);
        $total_solicitado = array_sum($request->quantidade_solicitada);

        if ($total_liberado == $total_solicitado) {
            // Status 2: Liberado igual ao solicitado
            $data['status'] = 2;
        } elseif ($total_liberado == 0) {
            // Status 4: Não liberado (Recusado)
            $data['status'] = 4;
        } elseif ($total_liberado < $total_solicitado) {
            // Status 3: Total liberado menor que o solicitado (Liberado parcialmente)
            $data['status'] = 3;
        } else {
            // Outro status não previsto
            $data['status'] = 1;
        }
        $save->update($data);

        foreach ($request->id_item as $key => $id) {
            $total_liberado = $request->quantidade_liberada[$key];
            $total_solicitado = $request->quantidade_solicitada[$key];



            if ($total_liberado == $total_solicitado) {
                // Status 2: Liberado igual ao solicitado
                $item = FerramentalRequisicaoItem::find($id);
                $item->update(['status' => 2, 'quantidade_liberada' => $request->quantidade_liberada[$key]]);
            } elseif ($total_liberado == 0) {
                // Status 4: Não liberado (Recusado)
                $item = FerramentalRequisicaoItem::find($id);
                $item->update(['status' => 4, 'quantidade_liberada' => $request->quantidade_liberada[$key]]);
            } elseif ($total_liberado < $total_solicitado) {
                // Status 3: Total liberado menor que o solicitado (Liberado parcialmente)
                $item = FerramentalRequisicaoItem::find($id);
                $item->update(['status' => 3, 'quantidade_liberada' => $request->quantidade_liberada[$key]]);
            } else {
                // Outro status não previsto
                $item = FerramentalRequisicaoItem::find($id);
                $item->update(['status' => 1]);
            }
        }

        foreach ($request->id_ativo as $key => $id) {
            $total_liberado = $request->quantidade_liberada[$key];
            $total_solicitado = $request->quantidade_solicitada[$key];

            if ($total_liberado == $total_solicitado) {
                // Status 2: Liberado igual ao solicitado
                $item = AtivoExternoEstoque::find($id);
                $item->update(['status' => 3, 'id_obra' => $request->id_obra]);
            } elseif ($total_liberado == 0) {
                // Status 4: Não liberado (Recusado)
                $item = AtivoExternoEstoque::find($id);
                $item->update(['status' => 4]);
            } else {
                // Outro status não previsto
                $item = AtivoExternoEstoque::find($id);
                $item->update(['status' => 1]);
            }
        }

        foreach ($request->id_ativo_estoque as $key => $id) {
            $total_liberado = $request->quantidade_liberada[$key];
            $total_solicitado = $request->quantidade_solicitada[$key];

            if ($total_liberado == $total_solicitado) {
                // Status 2: Liberado igual ao solicitado
                $item = AtivoExternoEstoqueItem::where('id_ativo_externo', $id)->first();
                $item->update(['quantidade_em_transito' => $total_liberado]);

            } elseif ($total_liberado == 0) {
                // Status 4: Não liberado (Recusado)
            } else {
                // Outro status não previsto
            }
        }

        return redirect()->route('ferramental.requisicao.index')->with('success', 'Registro atualizado com sucesso.');


    }

}
