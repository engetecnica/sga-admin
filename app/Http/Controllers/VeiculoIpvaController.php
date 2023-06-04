<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\VeiculoIpva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VeiculoIpvaController extends Controller
{

    public function index(Veiculo $veiculo)
    {
        $ipvas = VeiculoIpva::where('veiculo_id', $veiculo->id)->orderByDesc('id')->get();

        return view('pages.ativos.veiculos.ipva.index', compact('veiculo', 'ipvas'));
    }

    public function create(Veiculo $veiculo)
    {
        return view('pages.ativos.veiculos.ipva.create', compact('veiculo'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['valor'] = str_replace('R$ ', '', $request->valor);
        $save = VeiculoIpva::create($data);

        if($save){
            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | STORE IPVA: ' . $request->veiculo_id);

            return redirect()->route('ativo.veiculo.ipva.index', $request->veiculo_id)->with('success', 'Registro salvo com sucesso');
        } else {
            return redirect()->route('ativo.veiculo.ipva.index', $request->veiculo_id)->with('fail', 'Erro ao salvar registro');
        }
    }

    public function edit($id)
    {
        $ipva = VeiculoIpva::with('veiculo')->where('id', $id)->first();

        return view('pages.ativos.veiculos.ipva.edit', compact('ipva'));
    }

    public function update(Request $request, $id)
    {
        if (! $ipva = VeiculoIpva::find($id)) {
            return redirect()->route('ativo.veiculo.ipva.editar', $id)->with('fail', 'Problemas para localizar o registro.');
        }

        $data = $request->all();
        $data['valor'] = str_replace('R$ ', '', $request->valor);
        $ipva->update($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT IPVA: ' . $id);

        return redirect()->route('ativo.veiculo.ipva.editar', $id)->with('success', 'O registro foi alterado com sucesso');

    }

    public function delete($id)
    {
        $ipva = VeiculoIpva::findOrFail($id);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DELETE IPVA: ' . $ipva->id);

        $ipva->delete();

        return redirect()->back()->with('success', 'Sucesso');
    }
}
