<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\VeiculoIpva;
use RealRashid\SweetAlert\Facades\Alert;

class VeiculoIpvaController extends Controller
{

    public function index($id)
    {
        // $fornecedores = CadastroFornecedor::all();

        $store = Veiculo::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.ipva.index', compact('store'));
    }

    public function edit($id)
    {
        // $fornecedores = CadastroFornecedor::all();

        $store = VeiculoIpva::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.ipva.form', compact('store'));
    }

    public function store(Request $request, $id)
    {
        // dd($request);

        $veiculo = Veiculo::findOrFail($id);

        try {
            Veiculoipva::create(
                [
                    'veiculo_id' => $veiculo->id,
                    'referencia_ano' => $request->input('referencia_ano'),
                    'valor' => str_replace('R$ ', '', $request->input('valor')),
                    'data_de_vencimento' => $request->input('data_de_vencimento'),
                    'data_de_pagamento' => $request->input('data_de_pagamento')
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


        $veiculo = VeiculoIpva::findOrFail($id);

        try {
            $veiculo->update([
                'referencia_ano' => $request->referencia_ano,
                'valor' => str_replace('R$ ', '', $request->valor),
                'data_de_vencimento' => $request->data_de_vencimento,
                'data_de_pagamento' => $request->data_de_pagamento,
            ]);

            return redirect()->back()->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
}
