<?php

namespace App\Http\Controllers;

use App\Models\VeiculoDepreciacao;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VeiculoDepreciacaoController extends Controller
{
    public function index($id)
    {
        $store = Veiculo::find($id);

        $last = VeiculoDepreciacao::where('veiculo_id', $id)->orderByDesc('id')->first();

        if (!$id or !$store) {
            return redirect()->route('ativo.veiculo')->with('fail', 'Esse veículo não foi encontrado.');
        }

        return view('pages.ativos.veiculos.depreciacao.index', compact('store', 'last'));
    }

    public function edit($id, $btn)
    {
        $store = VeiculoDepreciacao::find($id);

        if (!$id or !$store) {
            return redirect()->route('ativo.veiculo')->with('fail', 'Esse veículo não foi encontrado.');
        }

        return view('pages.ativos.veiculos.depreciacao.form', compact('store', 'btn'));
    }

    public function store(Request $request, $id)
    {
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

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | STORE DEPRECIACAO: ' . $veiculo->id);

            return redirect()->route('ativo.veiculo.depreciacao.index', $id)->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $veiculo = VeiculoDepreciacao::findOrFail($id);

        try {
            $veiculo->update([
                'valor_atual' => str_replace('R$ ', '', $request->valor_atual),
                'referencia_mes' => $request->referencia_mes,
                'referencia_ano' => $request->referencia_ano
            ]);

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | UPDATE DEPRECIACAO: ' . $veiculo->id);

            return redirect()->route('ativo.veiculo.depreciacao.editar', $veiculo->veiculo_id)->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
    public function delete($id)
    {
        $veiculo = VeiculoDepreciacao::findOrFail($id);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DELETE DEPRECIACAO: ' . $veiculo->id);

        $veiculo->delete();

        return redirect()->back()->with('success', 'Sucesso');
    }
}
