<?php

namespace App\Http\Controllers;

use App\Models\CadastroFornecedor;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\VeiculoAbastecimento;
use App\Models\VeiculoDepreciacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VeiculoAbastecimentoController extends Controller
{
    public function index(Veiculo $veiculo)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();

        $abastecimentos = VeiculoAbastecimento::with('veiculo')->where('veiculo_id', $veiculo->id)->orderByDesc('id')->get();

        $last = VeiculoAbastecimento::where('veiculo_id', $veiculo->id)->orderByDesc('id')->first();

        return view('pages.ativos.veiculos.abastecimento.index', compact('veiculo', 'abastecimentos', 'last', 'fornecedores'));
    }

    public function create(Veiculo $veiculo)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();
        return view('pages.ativos.veiculos.abastecimento.create', compact('veiculo', 'fornecedores'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->all();
        $data['valor_total'] = str_replace('R$ ', '', $request->valor_total);
        $data['valor_do_litro'] = str_replace('R$ ', '', $request->valor_do_litro);
        $save = VeiculoAbastecimento::create($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | STORE ABASTECIMENTO | ' . $save->id . ' | COMBUSTÍVEL: ' . $request->input('combustivel') . ' | QUILOMETRAGEM: ' . $request->input('quilometragem') . ' | VALOR DO LITRO: ' . $request->input('valor_do_litro') );

        if ($save) {
            return redirect()->route('ativo.veiculo.abastecimento.index', $save->veiculo_id)->with('success', 'O registro foi adicionado com sucesso.');
        } else {
            return redirect()->route('ativo.veiculo.abastecimento.index', $save->veiculo_id)->with('fail', 'Problemas para adicionar o registro.');
        }

    }

    public function edit($id)
    {
        $abastecimento = VeiculoAbastecimento::with('veiculo', 'fornecedor')->findOrFail($id);

        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();

        return view('pages.ativos.veiculos.abastecimento.edit', compact('abastecimento', 'fornecedores'));
    }

    public function update(Request $request, $id)
    {
        if (! $abastecimento = VeiculoAbastecimento::find($id)) {
            return redirect()->route('ativo.veiculo.abastecimento.editar', $id)->with('fail', 'Problemas para localizar o registro.');
        }

        $data = $request->all();
        $data['valor_total'] = str_replace('R$ ', '', $request->valor_total);
        $data['valor_do_litro'] = str_replace('R$ ', '', $request->valor_do_litro);
        $abastecimento->update($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT ABASTECIMENTO: ' . $abastecimento->id);

        return redirect()->route('ativo.veiculo.abastecimento.editar', $abastecimento->id)->with('success', 'O registro foi alterado com sucesso');
    }

    public function delete($id)
    {
        $veiculo = VeiculoAbastecimento::findOrFail($id);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DELETE ABASTECIMENTO: ' . $veiculo->id);

        if($veiculo->delete()) {
            return redirect()->back()->with('success', 'O registro foi deletado com sucesso');
        } else {
            return redirect()->back()->with('fail', 'Problemas para deletar o registro.');
        }
    }
}
