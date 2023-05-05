<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\VeiculoQuilometragem;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VeiculoQuilometragemController extends Controller
{

    public function index($id)
    {
        $store = Veiculo::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.quilometragem.index', compact('store'));
    }

    public function edit($id)
    {
        $store = VeiculoQuilometragem::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.quilometragem.form', compact('store'));
    }

    public function store(Request $request, $id)
    {
        // dd($request);

        $veiculo = Veiculo::findOrFail($id);

        try {
            VeiculoQuilometragem::create(
                [
                    'veiculo_id' => $veiculo->id,
                    'quilometragem_atual' => $request->input('quilometragem_atual'),
                    'quilometragem_nova' => $request->input('quilometragem_nova')
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
        $veiculo = VeiculoQuilometragem::findOrFail($id);
        try {
            $veiculo->update([
                'quilometragem_atual' => $request->quilometragem_atual,
                'quilometragem_nova' => $request->quilometragem_nova
            ]);

            return redirect()->back()->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
    public function delete($id)
    {
        $veiculo = VeiculoQuilometragem::findOrFail($id);

        $veiculo->delete();

        return redirect()->back();
    }
}
