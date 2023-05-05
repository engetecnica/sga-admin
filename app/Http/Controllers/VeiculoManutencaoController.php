<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\CadastroFornecedor;
use App\Models\Servico;
use App\Models\VeiculoManutencao;
use RealRashid\SweetAlert\Facades\Alert;

class VeiculoManutencaoController extends Controller
{

    public function index($id)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();
        $servicos = Servico::select('id', 'name')->get();

        $store = Veiculo::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.manutencao.index', compact('store', 'fornecedores', 'servicos'));
    }

    public function edit($id)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();
        $servicos = Servico::select('id', 'name')->get();

        $store = VeiculoManutencao::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.manutencao.form', compact('store', 'fornecedores', 'servicos'));
    }

    public function store(Request $request, $id)
    {
        // dd($request);

        $veiculo = Veiculo::findOrFail($id);

        try {
            VeiculoManutencao::create(
                [
                    'veiculo_id' => $veiculo->id,
                    'tipo' => $request->input('tipo'),
                    'fornecedor_id' => $request->input('fornecedor'),
                    'servico_id' => $request->input('servico'),
                    'quilometragem_atual' => $request->input('quilometragem_atual'),
                    'quilometragem_proxima' => $request->input('quilometragem_proxima'),
                    'horimetro_atual' => $request->input('horimetro_atual'),
                    'horimetro_proximo' => $request->input('horimetro_proximo'),
                    'data_de_execucao' => $request->input('data_de_execucao'),
                    'data_de_vencimento' => $request->input('data_de_vencimento'),
                    'descricao' => $request->input('descricao'),
                    'valor_do_servico' => str_replace('R$ ', '', $request->input('valor_do_servico')),
                ]
            );
            return redirect()->back()->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $veiculo = VeiculoManutencao::findOrFail($id);
        $veiculo->update([
            'tipo' => $request->tipo,
            'fornecedor_id' => $request->fornecedor,
            'servico_id' => $request->servico,
            'quilometragem_atual' => $request->quilometragem_atual,
            'quilometragem_proxima' => $request->quilometragem_proxima,
            'horimetro_atual' => $request->horimetro_atual,
            'horimetro_proximo' => $request->horimetro_proximo,
            'data_de_execucao' => $request->data_de_execucao,
            'data_de_vencimento' => $request->data_de_vencimento,
            'valor_do_servico' => str_replace('R$ ', '', $request->valor_do_servico),
        ]);
        return redirect()->back();
        // try {
        //     $veiculo->manutencao->update([
        //         'tipo' => $request->tipo,
        //         'fornecedor_id' => $request->fornecedor,
        //         'servico_id' => $request->servico,
        //         'quilometragem_atual' => $request->quilometragem_atual,
        //         'quilometragem_proxima' => $request->quilometragem_proxima,
        //         'horimetro_atual' => $request->horimetro_atual,
        //         'horimetro_proximo' => $request->horimetro_proximo,
        //         'data_de_execucao' => $request->data_de_execucao,
        //         'data_de_vencimento' => $request->data_de_vencimento,
        //         'descricao' => $request->descricao,
        //         'valor_do_servico' => $request->valor_do_servico
        //     ]);

        //     return redirect()->back()->with('success', 'Sucesso');
        // } catch (\Exception $e) {

        //     return redirect()->back()->withInput();
        // }
    }
}
