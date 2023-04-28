<?php

namespace App\Http\Controllers;

use App\Models\CadastroObra;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::all();
        return view('pages.ativos.veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        $obras = CadastroObra::select('id', 'razao_social')->get();

        return view('pages.ativos.veiculos.form', compact('obras'));
    }

    public function store(Request $request)
    {
        // dd($request);

        try {
            Veiculo::create(
                [
                    'periodo_inicial' => $request->input('periodo_inicial'),
                    'periodo_final' => $request->input('periodo_final'),
                    'tipo' => $request->input('tipo'),
                    'marca' => $request->input('marca'),
                    'modelo' => $request->input('modelo'),
                    'ano' => $request->input('ano'),
                    'veiculo' => $request->input('veiculo'),
                    'valor_fipe' => $request->input('valor_fipe'),
                    'codigo_fipe' => $request->input('codigo_fipe'),
                    'fipe_mes_referencia' => $request->input('fipe_mes_referencia'),
                    'placa' => $request->input('placa'),
                    'renavam' => $request->input('renavam'),
                    'valor_funcionario' => $request->input('valor_funcionario'),
                    'valor_adicional' => $request->input('valor_adicional'),
                    'observacao' => $request->input('observacao'),
                    'situacao' => $request->input('situacao'),
                ]
            );
            return redirect()->back()->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $obras = CadastroObra::select('id', 'razao_social')->get();

        $store = Veiculo::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.form', compact('store', 'obras'));
    }

    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $veiculo->obra = $request->input('obra');
    }
}
