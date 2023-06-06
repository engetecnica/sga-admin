<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\VeiculoQuilometragem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VeiculoQuilometragemController extends Controller
{

    public function index(Veiculo $veiculo)
    {

        $quilometragens = VeiculoQuilometragem::with('veiculo')->where('veiculo_id', $veiculo->id)->orderByDesc('id')->get();

        return view('pages.ativos.veiculos.quilometragem.index', compact('veiculo', 'quilometragens'));
    }

    public function create(Veiculo $veiculo)
    {
        return view('pages.ativos.veiculos.quilometragem.create', compact('veiculo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quilometragem_atual' => 'required',
            'quilometragem_nova' => 'required|gte:quilometragem_atual',
        ]);

        $data = $request->all();
        $save = VeiculoQuilometragem::create($data);

        if($save){

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | STORE QUILOMETRAGEM: ' . $request->veiculo_id);

            return redirect()->route('ativo.veiculo.quilometragem.index', $request->veiculo_id)->with('success', 'Registro salvo com sucesso');
        } else {
            return redirect()->route('ativo.veiculo.quilometragem.index', $request->veiculo_id)->with('fail', 'Erro ao salvar registro');
        }

    }

    public function edit($id)
    {
        $quilometragem = VeiculoQuilometragem::with('veiculo')->where('id', $id)->first();

        return view('pages.ativos.veiculos.quilometragem.edit', compact('quilometragem'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        if (! $save = VeiculoQuilometragem::find($id)) {
            return redirect()->route('ativo.veiculo.quilometragem.editar', $id)->with('fail', 'Problemas para localizar o registro.');
        }

        $request->validate([
            'veiculo_id' => 'required',
            'quilometragem_atual' => 'required',
            'quilometragem_nova' => 'required|gte:quilometragem_atual',
        ]);

        $data = $request->all();
        $save->update($data);

        if($save) {
            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | EDIT QUILOMETRAGEM/HORIMETRO: ' . $save->id);

            return redirect()->route('ativo.veiculo.quilometragem.editar', $id)->with('success', 'Registro salvo com sucesso.');
        } else {
            return redirect()->route('ativo.veiculo.quilometragem.editar', $id)->with('fail', 'Erro ao salvar registro.');
        }

    }

    public function delete($id)
    {
        $quilometragem = VeiculoQuilometragem::findOrFail($id);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DELETE QUILOMETRAGEM/HORIMETRO: ' . $quilometragem->id);

        if($quilometragem->delete()) {
            return redirect()->back()->with('success', 'Registro excluído com sucesso.');
        } else {
            return redirect()->back()->with('fail', 'Erro ao excluir registro.');
        }
    }
}
