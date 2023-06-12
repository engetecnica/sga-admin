<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\CadastroFornecedor;
use App\Models\Preventiva;
use App\Models\Servico;
use App\Models\VeiculoManutencao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VeiculoManutencaoController extends Controller
{

    public function index(Veiculo $veiculo)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();

        $servicos = Servico::select('id', 'name')->get();

        $manutencoes = VeiculoManutencao::where('veiculo_id', $veiculo->id)->orderByDesc('id')->get();

        return view('pages.ativos.veiculos.manutencao.index', compact('veiculo', 'fornecedores', 'servicos', 'manutencoes'));
    }

    public function create(Veiculo $veiculo)
    {
        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();

        $servicos = Servico::select('id', 'name')->get();

        return view('pages.ativos.veiculos.manutencao.create', compact('veiculo', 'fornecedores', 'servicos'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->all();
        $data['valor_do_servico'] = str_replace('R$ ', '', $request->valor_do_servico);
        $save = VeiculoManutencao::create($data);

        $preventiva['veiculo_id'] = $request->veiculo_id;
        $preventiva['manutencao_id'] = $save->id;
        if($request->veiculo_tipo == 'maquinas') {
            $preventiva['preventiva'] = $request->horimetro_proximo;
        } else {
            $preventiva['preventiva'] = $request->quilometragem_proxima;
        }

        $servico = Servico::find($request->servico_id);
        $preventiva['descricao'] = 'Serviço realizado: ' . $servico->name . ' | Preventiva: ' . $request->tipo;
        $alerta = Preventiva::create($preventiva);


        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | STORE MANUTENCAO: ' . $save->id);

        if($save && $alerta) {
            return redirect()->route('ativo.veiculo.manutencao.index', $request->veiculo_id)->with('success', 'Registro salvo com sucesso.');
        } else {
            return redirect()->route('ativo.veiculo.manutencao.index', $request->veiculo_id)->with('fail', 'Erro ao salvar registro.');
        }
    }

    public function edit($id)
    {
        if (!$manutencao = VeiculoManutencao::with('veiculo', 'fornecedor', 'servico')->find($id)) {
            return redirect()->route('ativo.veiculo')->with('fail', 'Manutenção não encontrada');
        }

        $fornecedores = CadastroFornecedor::select('id', 'razao_social')->get();

        $servicos = Servico::select('id', 'name')->get();

        return view('pages.ativos.veiculos.manutencao.edit', compact('manutencao', 'fornecedores', 'servicos'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        if (! $save = VeiculoManutencao::find($id)) {
            return redirect()->route('ativo.veiculo.manutencao.editar', $id)->with('fail', 'Problemas para localizar o registro.');
        }
        $data = $request->all();
        $data['valor_do_servico'] = str_replace('R$ ', '', $request->valor_do_servico);
        $save->update($data);

        $servico = Servico::find($request->servico_id);

        $up_preventiva = Preventiva::where('manutencao_id', $save->id)->first();
        $preventiva['veiculo_id'] = $request->veiculo_id;
        $preventiva['manutencao_id'] = $save->id;
        if($request->veiculo_tipo == 'maquinas') {
            $preventiva['preventiva'] = $request->horimetro_proximo;
        } else {
            $preventiva['preventiva'] = $request->quilometragem_proxima;
        }
        $preventiva['descricao'] = 'Serviço realizado: ' . $servico->name . ' | Preventiva: ' . $request->tipo;
        $up_preventiva->update($preventiva);


        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT MANUTENCAO: ' . $save->id);

        if($save && $up_preventiva) {
            return redirect()->route('ativo.veiculo.manutencao.index', $request->veiculo_id)->with('success', 'Registro salvo com sucesso.');
        } else {
            return redirect()->route('ativo.veiculo.manutencao.index', $request->veiculo_id)->with('fail', 'Erro ao salvar registro.');
        }
    }

    public function delete($id)
    {
        $manutencao = VeiculoManutencao::findOrFail($id);

        Preventiva::where('manutencao_id', $manutencao->id)->delete();

        if($manutencao->delete()) {

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | DELETE MANUTENCAO: ' . $manutencao->id);

            return redirect()->route('ativo.veiculo.manutencao.index', $manutencao->veiculo_id)->with('success', 'Registro excluído com sucesso');
        } else {
            return redirect()->route('ativo.veiculo.manutencao.index', $manutencao->veiculo_id)->with('fail', 'Problema nas exclusão do registro');
        }
    }

    public function cancel($id)
    {

        if (! $save = VeiculoManutencao::find($id)) {
            return redirect()->route('ativo.veiculo.manutencao.index', $save->veiculo_id)->with('fail', 'Problemas para localizar o registro.');
        }
        $save->update(['situacao' => 4]);

        if($save) {
            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | CANCEL MANUTENCAO: ' . $save->id);
            return redirect()->route('ativo.veiculo.manutencao.index', $save->veiculo_id)->with('success', 'Registro salvo com sucesso.');
        } else {
            return redirect()->route('ativo.veiculo.manutencao.index', $save->veiculo_id)->with('fail', 'Erro ao salvar registro.');
        }
    }

    public function storeServico(Request $request)
    {
        $data = $request->all();
        $save = Servico::create($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD SERVICO MANUTENCAO: ' . $save->name);

        if ($save) {
            return response()->json(['success' => true, 'servico_id' => $save->id, 'servico' => $save->name]);
        } else {
            return response()->json(['fail' => true]);
        }
    }
}
