<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\VeiculoQuilometragem;
use Database\Seeders\VeiculoSeguroSeeder;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VeiculoQuilometragemController extends Controller
{

    public function index($id)
    {
        $veiculo = Veiculo::find($id);
        $store = VeiculoQuilometragem::with('veiculo')->where('veiculo_id', $id)->get();
        $last = VeiculoQuilometragem::where('veiculo_id', $id)->orderByDesc('id')->first();

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.quilometragem.index', compact('veiculo', 'store', 'last'));
    }

    public function edit($id, $btn)
    {
        $store = VeiculoQuilometragem::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.quilometragem.form', compact('store', 'btn'));
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
            return redirect()->route('ativo.veiculo.quilometragem.index', $id)->with('success', 'Sucesso');
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

            return redirect()->route('ativo.veiculo.quilometragem.index', $veiculo->veiculo_id)->with('success', 'Sucesso');
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
