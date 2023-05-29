<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\VeiculoIpva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VeiculoIpvaController extends Controller
{

    public function index($id)
    {
        // $fornecedores = CadastroFornecedor::all();

        $store = Veiculo::find($id);

        $last = VeiculoIpva::where('veiculo_id', $store->id)->orderBy('id', 'desc')->first();

        if (!$id or !$store) {
            return redirect()->route('ativo.veiculo')->with('fail', 'Esse veículo não foi encontrado.');
        }

        return view('pages.ativos.veiculos.ipva.index', compact('store', 'last'));
    }

    public function edit($id, $btn)
    {
        // $fornecedores = CadastroFornecedor::all();

        $store = VeiculoIpva::find($id);

        if (!$id or !$store) {
            return redirect()->route('ativo.veiculo')->with('fail', 'Esse veículo não foi encontrado.');
        }

        return view('pages.ativos.veiculos.ipva.form', compact('store', 'btn'));
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

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | STORE IPVA: ' . $veiculo->id);

            return redirect()->route('ativo.veiculo.ipva.index', $id)->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {

        $veiculo = VeiculoIpva::findOrFail($id);

        try {
            $veiculo->update([
                'referencia_ano' => $request->referencia_ano,
                'valor' => str_replace('R$ ', '', $request->valor),
                'data_de_vencimento' => $request->data_de_vencimento,
                'data_de_pagamento' => $request->data_de_pagamento,
            ]);

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | UPDATE IPVA: ' . $veiculo->id);

            return redirect()->route('ativo.veiculo.ipva.editar', $veiculo->veiculo_id)->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
    public function delete($id)
    {
        $veiculo = VeiculoIpva::findOrFail($id);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DELETE IPVA: ' . $veiculo->id);

        $veiculo->delete();

        return redirect()->back()->with('success', 'Sucesso');
    }
}
