<?php

namespace App\Http\Controllers;

use App\Models\CadastroFornecedor;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\VeiculoAbastecimento;

class VeiculoAbastecimentoController extends Controller
{
    public function edit($id)
    {
        // $fornecedores = CadastroFornecedor::all();

        $store = Veiculo::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.abastecimento.form', compact('store'));
    }

    public function store(Request $request, $id)
    {
        // dd($request);

        $veiculo = Veiculo::findOrFail($id);

        try {
            VeiculoAbastecimento::create(
                [
                    'veiculo_id' => $veiculo->id,
                    'combustivel' => $request->input('combustivel'),
                    'quilometragem' => $request->input('quilometragem'),
                    'valor_do_litro' => $request->input('valor_do_litro'),
                    'quantidade' => $request->input('quantidade'),
                    'valor_total' => $request->input('valor_total'),
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
                'combustivel' => $request->combustivel,
                'quilometragem' => $request->quilometragem,
                'valor_do_litro' => $request->valor_do_litro,
                'quantidade' => $request->quantidade,
                'valor_total' => $request->valor_total,
            ]);

            return redirect()->back()->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
}
