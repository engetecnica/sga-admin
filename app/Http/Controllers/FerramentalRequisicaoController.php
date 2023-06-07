<?php

namespace App\Http\Controllers;

use App\Models\{
    AtivoExterno,
    AtivoExternoEstoque,
    AtivoExternoEstoqueItem,
    FerramentalRequisicao,
    CadastroObra,
    CadastroFuncionario,
    FerramentalRequisicaoItem,
    FerramentalRequisicaoTransito
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FerramentalRequisicaoController extends Controller
{
    public function index()
    {
        $requisicoes = FerramentalRequisicao::with('solicitante', 'obraOrigem', 'obraDestino', 'situacao')->orderByDesc('id')->get();


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


            $item = new FerramentalRequisicaoItem();
            $item->id_ativo_externo = $id_ativo;
            $item->id_requisicao = $requisicao->id;
            $item->quantidade_solicitada = $limit;
            $item->status = 1;
            $item->save();

            // $estoques = AtivoExternoEstoque::where('id_ativo_externo', $id_ativo)
            // ->where('status', 4)
            // ->orderByDesc('id')
            // ->limit($limit)
            // ->get();

            // foreach ($estoques as $estoque) {
            //     AtivoExternoEstoque::where('id', $estoque->id)->update(['status' => 11]);

            //     $item = new FerramentalRequisicaoItem();
            //     $item->id_ativo_externo = $estoque->id;
            //     $item->id_requisicao = $requisicao->id;
            //     $item->quantidade_solicitada = 1;
            //     $item->status = 1;
            //     $item->save();
            // }
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
        $ferramentalRequisicao = FerramentalRequisicao::with('solicitante', 'despachante', 'recebedor', 'obraOrigem', 'obraDestino', 'situacao')
            ->where('id', $id)
            ->first();

        $itens = FerramentalRequisicaoItem::with('ativo_externo', 'situacao', 'situacao_recebido')->where('id_requisicao', $id)->get();

        $transferencias = FerramentalRequisicaoTransito::with('requisicao', 'ativo', 'obraOrigem', 'obraDestino')->where('id_requisicao', $id)->get();

        return view('pages.ferramental.requisicao.show', compact('ferramentalRequisicao', 'itens', 'transferencias'));
    }

    public function update(Request $request, $id)
    {


        if (! $save = FerramentalRequisicao::find($id)) {
            return redirect()->route('ferramental.requisicao.show', $id)->with('fail', 'Registro não encontrado.');
        }

        // dd($request->all());

        $total_liberado = count($request->id_item);
        $total_solicitado = array_sum($request->quantidade_solicitada);

        //SALVANDO AS MUDANÇAS NA REQUISIÇÃO
        $data = $request->all();
        $data['id_despachante'] = Auth::user()->id;
        $data['data_liberacao'] = date('Y-m-d H:i:s');

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

        //ATUALIZANDO OS ITENS DA REQUICAO
        foreach($request->id_item_requisicao as $id_item_da_requisicao) {

            $itens_requisicao = FerramentalRequisicaoItem::find($id_item_da_requisicao);

            $contagem_item_requisicao = 0;

            foreach ($request->id_item as $item) {
                $arrayItem = explode(',', str_replace(['[', ']'], '', $item));
                $x = trim($arrayItem[0]);

                if ($x == $id_item_da_requisicao) {
                    $contagem_item_requisicao++;
                }
            }

            if ($contagem_item_requisicao == $itens_requisicao->quantidade_solicitada) {
                // Status 2: Liberado igual ao solicitado
                $status = 2;
            } elseif ($contagem_item_requisicao == 0) {
                // Status 4: Não liberado (Recusado)
                $status = 4;
            } elseif ($contagem_item_requisicao < $itens_requisicao->quantidade_solicitada) {
                // Status 3: Total liberado menor que o solicitado (Liberado parcialmente)
                $status = 3;
            } else {
                // Outro status não previsto
                $status = 1;
            }

            $itens_requisicao->update(['status' => $status, 'quantidade_liberada' => $contagem_item_requisicao]);
            AtivoExternoEstoqueItem::where('id_ativo_externo', $id_item_da_requisicao)->increment('quantidade_em_transito', $contagem_item_requisicao);
        }

        //MUDANDO O STATUS DA UNIDADE ATIVO EXTERNO
        $ativos = [];
        foreach ($request->id_item as $item) {
            $arrayItem = explode(',', str_replace(['[', ']'], '', $item));
            $y = trim($arrayItem[1]);
            $ativos[] = $y;
        }

        foreach($ativos as $ativo) {
            $item = AtivoExternoEstoque::find($ativo);
            $item->update(['status' => 3]);

            //GERANDO TRANSFERÊNCIAS ENTRE OBRAS
            $transfer = new FerramentalRequisicaoTransito();
            $transfer->id_requisicao = $request->id_requisicao;
            $transfer->id_ativo = $ativo;
            $transfer->id_obra_origem = $item->id_obra;
            $transfer->id_obra_destino = $save->id_obra_destino;
            $transfer->save();

        }

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT REQUISICAO | ID: ' . $save->id);

        return redirect()->route('ferramental.requisicao.index')->with('success', 'Registro atualizado com sucesso.');


    }

    public function recept(Request $request, $id)
    {
        // dd($request->all());

        if (! $save = FerramentalRequisicao::find($id)) {
            return redirect()->route('ferramental.requisicao.show', $id)->with('fail', 'Registro não encontrado.');
        }

        $data = $request->all();
        $data['id_recebedor'] = Auth::user()->id;
        $data['data_recebimento'] = date('Y-m-d H:i:s');
        $data['status'] = 6; //Recebido
        $save->update($data);

        foreach ($request->id_item_transferencia as $key => $id) {
            $status_recebido = $request->status_recebimento[$key];
            $observacao_recebido = $request->observacao_recebimento[$key];

            $item = FerramentalRequisicaoTransito::find($id);
            $item->update(['status' => $status_recebido, 'observacao_recebimento' => $observacao_recebido]);

        }

        foreach ($request->id_ativo as $key => $id) {
            $status_recebido = $request->status_recebimento[$key];

            if ($status_recebido == 6) {
            $item = AtivoExternoEstoque::find($id);
            $item->update(['status' => 4, 'id_obra' => $request->id_obra_destino]);

            } elseif ($status_recebido == 7) {
                // Status 7: Recebido com defeito
                $item = AtivoExternoEstoque::find($id);
                $item->update(['status' => 12, 'id_obra' => $request->id_obra_destino]);

            } else {
                // Outro status não previsto
            }
        }

        foreach ($request->id_estoque as $key => $id) {
            $status_recebido = $request->status_recebimento[$key];

            if ($status_recebido == 6) {
                // Status 6: Recebido
                $item = AtivoExternoEstoqueItem::where('id_ativo_externo', $id)->increment('quantidade_em_operacao');
                $item = AtivoExternoEstoqueItem::where('id_ativo_externo', $id)->decrement('quantidade_em_transito');

            } elseif ($status_recebido == 7) {
                // Status 7: Recebido com defeito
                $item = AtivoExternoEstoqueItem::where('id_ativo_externo', $id)->increment('quantidade_com_defeito');
                $item = AtivoExternoEstoqueItem::where('id_ativo_externo', $id)->decrement('quantidade_em_transito');
            } else {
                // Outro status não previsto
            }
        }

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | RECEBENDO REQUISICAO | ID: ' . $save->id);

        return redirect()->route('ferramental.requisicao.index')->with('success', 'Registro atualizado com sucesso.');
    }

}
