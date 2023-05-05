<?php

namespace App\Http\Controllers;

use App\Models\VeiculoDepreciacao;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use RealRashid\SweetAlert\Facades\Alert;

class VeiculoDepreciacaoController extends Controller
{
    public function index($id)
    {
        $store = Veiculo::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.depreciacao.index', compact('store'));
    }

    public function edit($id)
    {
        $store = VeiculoDepreciacao::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.depreciacao.form', compact('store'));
    }

    public function store(Request $request, $id)
    {
        // dd($request);

        $veiculo = Veiculo::findOrFail($id);

        try {
            VeiculoDepreciacao::create(
                [
                    'veiculo_id' => $veiculo->id,
                    'valor_atual' => str_replace('R$ ', '', $request->input('valor_atual')),
                    'referencia_mes' => $request->input('referencia_mes'),
                    'referencia_ano' => $request->input('referencia_ano'),
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
        $veiculo = VeiculoDepreciacao::findOrFail($id);
        try {
            $veiculo->update([
                'valor_atual' => str_replace('R$ ', '', $request->valor_atual),
                'referencia_mes' => $request->referencia_mes,
                'referencia_ano' => $request->referencia_ano
            ]);

            return redirect()->back()->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
}
