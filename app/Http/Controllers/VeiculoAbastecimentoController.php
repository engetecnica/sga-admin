<?php

namespace App\Http\Controllers;

use App\Models\CadastroFornecedor;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\VeiculoAbastecimento;
use App\Models\VeiculoDepreciacao;
use RealRashid\SweetAlert\Facades\Alert;

class VeiculoAbastecimentoController extends Controller
{
    public function index($id)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();

        $store = Veiculo::find($id);

        $last = VeiculoAbastecimento::where('veiculo_id', $id)->orderBy('id', 'desc')->first();

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.abastecimento.index', compact('store', 'last', 'fornecedores'));
    }

    public function edit($id, $btn)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();

        $store = VeiculoAbastecimento::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.abastecimento.form', compact('store', 'fornecedores', 'btn'));
    }

    public function store(Request $request, $id)
    {
        // dd($request);

        $veiculo = Veiculo::findOrFail($id);

        try {
            VeiculoAbastecimento::create(
                [
                    'veiculo_id' => $veiculo->id,
                    'fornecedor_id' => $request->input('fornecedor'),
                    'combustivel' => $request->input('combustivel'),
                    'quilometragem' => $request->input('quilometragem'),
                    'valor_do_litro' => str_replace('R$ ', '', $request->input('valor_do_litro')),
                    'quantidade' => $request->input('quantidade'),

                    'valor_total' => str_replace('R$ ', '', $request->input('valor_total')),

                ]
            );
            return redirect()->route('ativo.veiculo.abastecimento.index', $id)->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $veiculo = VeiculoAbastecimento::findOrFail($id);
        try {
            $veiculo->update([
                'fornecedor_id' => $request->fornecedor,
                'combustivel' => $request->combustivel,
                'quilometragem' => $request->quilometragem,
                'valor_do_litro' => str_replace('R$ ', '', $request->valor_do_litro),
                'quantidade' => $request->quantidade,
                'valor_total' => str_replace('R$ ', '', $request->valor_total),
            ]);

            return redirect()->route('ativo.veiculo.abastecimento.index', $veiculo->veiculo_id)->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
    public function delete($id)
    {
        $veiculo = VeiculoAbastecimento::findOrFail($id);

        $veiculo->delete();

        return redirect()->back();
    }
}
