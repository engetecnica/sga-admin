<?php

namespace App\Http\Controllers;

use App\Models\CadastroFornecedor;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\VeiculoAbastecimento;
use RealRashid\SweetAlert\Facades\Alert;

class VeiculoAbastecimentoController extends Controller
{
    public function edit($id)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();

        $store = Veiculo::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.abastecimento.form', compact('store', 'fornecedores'));
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
            return redirect()->back()->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $veiculo = Veiculo::findOrFail($id);
        try {
            $veiculo->abastecimento->update([
                'fornecedor_id' => $request->fornecedor,
                'combustivel' => $request->combustivel,
                'quilometragem' => $request->quilometragem,
                'valor_do_litro' => str_replace('R$ ', '', $request->valor_do_litro),
                'quantidade' => $request->quantidade,
                'valor_total' => str_replace('R$ ', '', $request->valor_total),
            ]);

            return redirect()->back()->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
}
