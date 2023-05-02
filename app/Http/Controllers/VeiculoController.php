<?php

namespace App\Http\Controllers;

use App\Models\CadastroObra;
use App\Models\Veiculo;
use App\Models\VeiculoQuilometragem;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

        $request->validate([
            'periodo_inicial' => 'required|date|before_or_equal:periodo_final',
            'periodo_final' => 'required|date',
            'quilometragem_inicial' => 'required|numeric|min:1',
        ]);

        $veiculo = Veiculo::create(
            [
                'obra_id' => $request->input('obra'),
                'periodo_inicial' => $request->input('periodo_inicial'),
                'periodo_final' => $request->input('periodo_final'),
                'tipo' => $request->input('tipo'),
                'marca' => $request->input('marca_nome'),
                'modelo' => $request->input('modelo_nome'),
                'ano' => $request->input('ano'),
                'veiculo' => $request->input('veiculo'),
                'valor_fipe' => str_replace('R$ ', '', $request->input('valor_fipe')),
                'codigo_fipe' => $request->input('codigo_fipe'),
                'fipe_mes_referencia' => $request->input('fipe_mes_referencia'),
                'placa' => $request->input('placa'),
                'renavam' => $request->input('renavam'),
                'horimetro_inicial' => $request->input('horimetro_inicial'),
                'observacao' => $request->input('observacao'),
                'situacao' => $request->input('situacao'),
            ]
        );

        VeiculoQuilometragem::create([
            'veiculo_id' => $veiculo->id,
            'quilometragem_atual' => $request->input('quilometragem_atual')
        ]);

        return redirect()->back();

        // try {
        //     $veiculo = Veiculo::create(
        //         [
        //             'obra' => $request->input('obra'),
        //             'periodo_inicial' => $request->input('periodo_inicial'),
        //             'periodo_final' => $request->input('periodo_final'),
        //             'tipo' => $request->input('tipo'),
        //             'marca' => $request->input('marca_nome'),
        //             'modelo' => $request->input('modelo_nome'),
        //             'ano' => $request->input('ano'),
        //             'veiculo' => $request->input('veiculo'),
        //             'valor_fipe' => $request->input('valor_fipe'),
        //             'codigo_fipe' => $request->input('codigo_fipe'),
        //             'fipe_mes_referencia' => $request->input('fipe_mes_referencia'),
        //             'placa' => $request->input('placa'),
        //             'renavam' => $request->input('renavam'),
        //             'horimetro_inicial' => $request->input('horimetro_inicial'),
        //             'observacao' => $request->input('observacao'),
        //             'situacao' => $request->input('situacao'),
        //         ]
        //     );

        //     VeiculoQuilometragem::create([
        //         'veiculo_id' => $veiculo->id,
        //         'quilometragem_atual' => $request->input('quilometragem_atual')
        //     ]);
        //     return redirect()->back()->with('success', 'Sucesso');
        // } catch (\Exception $e) {

        //     return redirect()->back()->withInput();
        // }
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

        $veiculo->update([
            'obra' => $request->obra,
            'periodo_inicial' => $request->periodo_inicial,
            'periodo_final' => $request->periodo_final,
            'tipo' => $request->tipo,
            'marca' => $request->marca_nome,
            'modelo' => $request->modelo_nome,
            'veiculo' => $request->veiculo,
            'valor_fipe' => str_replace('R$ ', '', $request->valor_fipe),
            'codigo_fipe' => $request->codigo_fipe,
            'fipe_mes_referencia' => $request->fipe_mes_referencia,
            'placa' => $request->placa,
            'renavam' => $request->renavam,
            'horimetro_inicial' => $request->horimetro_inicial,
            'observacao' => $request->observacao,
            'situacao' => $request->situacao,
        ]);

        return redirect()->back()->with('success', 'Sucesso');
    }
}
