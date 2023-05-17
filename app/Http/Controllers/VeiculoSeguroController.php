<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\VeiculoSeguro;
use RealRashid\SweetAlert\Facades\Alert;

class VeiculoSeguroController extends Controller
{

    public function index($id)
    {
        // $fornecedores = CadastroFornecedor::all();

        $store = Veiculo::find($id);

        $last = VeiculoSeguro::where('veiculo_id', $id)->orderBy('id', 'desc')->first();

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.seguro.index', compact('store', 'last'));
    }

    public function edit($id, $btn)
    {
        // $fornecedores = CadastroFornecedor::all();

        $store = VeiculoSeguro::find($id);

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse veículo não foi encontrado.');
            return redirect(route('ativo.veiculo'));
        endif;

        return view('pages.ativos.veiculos.seguro.form', compact('store', 'btn'));
    }

    public function store(Request $request, $id)
    {
        // dd($request);

        $veiculo = Veiculo::findOrFail($id);

        try {
            VeiculoSeguro::create(
                [
                    'veiculo_id' => $veiculo->id,
                    'carencia_inicial' => $request->input('carencia_inicial'),
                    'carencia_final' => $request->input('carencia_final'),
                    'valor' => str_replace('R$ ', '', $request->input('valor'))
                ]
            );
            return redirect()->route('ativo.veiculo.seguro.index', $id)->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $veiculo = VeiculoSeguro::findOrFail($id);
        try {
            $veiculo->update([
                'carencia_inicial' => $request->carencia_inicial,
                'carencia_final' => $request->carencia_final,
                'valor' => str_replace('R$ ', '', $request->valor)
            ]);

            return redirect()->route('ativo.veiculo.seguro.index', $veiculo->veiculo_id)->with('success', 'Sucesso');
        } catch (\Exception $e) {

            return redirect()->back()->withInput();
        }
    }
    public function delete($id)
    {
        $veiculo = VeiculoSeguro::findOrFail($id);

        $veiculo->delete();

        return redirect()->back();
    }
}
