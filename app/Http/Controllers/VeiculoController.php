<?php

namespace App\Http\Controllers;

use App\Models\CadastroEmpresa;
use App\Models\CadastroObra;
use App\Models\MarcaMaquina;
use App\Models\ModeloMaquina;
use App\Models\Veiculo;
use App\Models\VeiculoAbastecimento;
use App\Models\VeiculoDepreciacao;
use App\Models\VeiculoIpva;
use App\Models\VeiculoManutencao;
use App\Models\VeiculoQuilometragem;
use App\Models\VeiculoSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::with('quilometragens')->get();

        $quilometragem = VeiculoQuilometragem::where('veiculo_id', 51)->first();

        return view('pages.ativos.veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        $obras = CadastroObra::select('id', 'codigo_obra', 'razao_social')->orderByDesc('id')->get();

        $marcas = MarcaMaquina::all();

        $modelos = ModeloMaquina::all();

        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        return view('pages.ativos.veiculos.form', compact('obras', 'marcas', 'modelos', 'empresas'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'periodo_inicial' => 'required|date',
            'periodo_final' => 'required|date|after_or_equal:periodo_inicial',
        ]);

        if ($request->tipo == 'maquinas') {
            $modelo = $request->input('modelo_da_maquina');
            $ano = $request->input('ano_da_maquina');
            $veiculo = $request->input('veiculo_maquina');
            $marca = $request->input('marca_da_maquina');
        } else {
            $modelo = $request->input('modelo_nome');
            $ano = $request->input('ano');
            $veiculo = $request->input('veiculo');
            $marca = $request->input('marca_nome');
        }

        $veiculo = Veiculo::create(
            [
                'obra_id' => $request->input('obra'),
                'periodo_inicial' => $request->input('periodo_inicial'),
                'periodo_final' => $request->input('periodo_final'),
                'tipo' => $request->input('tipo'),
                'marca' => $marca,
                'modelo' => $modelo,
                'ano' => $ano,
                'veiculo' => $veiculo,
                'valor_fipe' => str_replace('R$ ', '', $request->input('valor_fipe')),
                'codigo_fipe' => $request->input('codigo_fipe'),
                'fipe_mes_referencia' => $request->input('fipe_mes_referencia'),
                'codigo_da_maquina' => $request->input('codigo_da_maquina'),
                'placa' => $request->input('placa'),
                'renavam' => $request->input('renavam'),
                'horimetro_inicial' => $request->input('horimetro_inicial'),
                'quilometragem_inicial' => $request->input('quilometragem_atual'),
                'observacao' => $request->input('observacao'),
                'situacao' => $request->input('situacao'),
            ]
        );

        VeiculoQuilometragem::create([
            'veiculo_id' => $veiculo->id,
            'quilometragem_atual' => $request->input('quilometragem_atual'),
            'quilometragem_nova' => $request->input('quilometragem_atual'),
        ]);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog . ' | ADD VEICULO | Placa: ' . $veiculo->veiculo);

        return redirect()->route('ativo.veiculo')->with('success', 'Registro cadastrado com sucesso.');
    }

    public function edit($id)
    {

        $veiculo = Veiculo::find($id);

        $obras = CadastroObra::select('id', 'codigo_obra', 'razao_social')->orderByDesc('id')->get();

        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        $marcas = MarcaMaquina::all();

        $modelos = ModeloMaquina::all();

        if ($veiculo->tipo == 'maquinas') {
            return view('pages.ativos.veiculos.edit-maquina', compact('veiculo', 'obras', 'marcas', 'modelos', 'empresas'));
        } else {
            return view('pages.ativos.veiculos.edit-veiculo', compact('veiculo', 'obras', 'marcas', 'modelos', 'empresas'));
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        if (! $save = Veiculo::find($id)) {
            return redirect()->route('ativo.interno.index')->with('fail', 'Registro atualizado com sucesso.');
        }

        if ($request->tipo == 'maquinas') {
            $modelo = $request->input('modelo_da_maquina');
            $ano = $request->input('ano_da_maquina');
            $veiculo = $request->input('veiculo_maquina');
            $marca = $request->input('marca_da_maquina');
        } else {
            $modelo = $request->input('modelo_nome');
            $ano = $request->input('ano');
            $veiculo = $request->input('veiculo');
            $marca = $request->input('marca_nome');
        }

        if ($request->tipo == 'maquinas') {
            $data = $request->all();
            $data['marca'] = $request->input('marca_da_maquina');
            $data['modelo'] = $request->input('modelo_da_maquina');
            $data['ano'] = $request->input('ano_da_maquina');
            $data['veiculo'] = $request->input('veiculo_maquina');
            $date['valor_fipe'] = str_replace('R$ ', '', $request->valor_fipe);
            $save->update($data);

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog . ' | EDIT MAQUINA | ID: ' . $id);

            return redirect()->route('ativo.veiculo.editar', $id)->with('success', 'Máquina editada com sucesso.');
        } else {
            $data = $request->all();
            $data['marca'] = $request->marca_nome;
            $data['modelo'] = $request->modelo_nome;
            $data['ano'] = substr($request->ano, 0, 4);
            $data['valor_fipe'] = str_replace('R$ ', '', $request->valor_fipe);
            $save->update($data);

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog . ' | EDIT VEICULO | ID: ' . $id);

            return redirect()->route('ativo.veiculo.editar', $id)->with('success', 'Máquina editada com sucesso.');
        }
    }

    public function adicionarMarca(Request $request)
    {
        MarcaMaquina::create([
            'marca' => $request->input('add_marca_da_maquina')
        ]);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog . ' | ADD MARCA MÁQUINA: ' . $request->marca);

        return redirect()->back()->withInput();
    }

    public function delete($id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog . ' | DELETE VEÍCULO: ' . $veiculo->id);

        VeiculoQuilometragem::where('veiculo_id', $id)->delete();
        VeiculoAbastecimento::where('veiculo_id', $id)->delete();
        VeiculoDepreciacao::where('veiculo_id', $id)->delete();
        VeiculoIpva::where('veiculo_id', $id)->delete();
        VeiculoManutencao::where('veiculo_id', $id)->delete();
        VeiculoSeguro::where('veiculo_id', $id)->delete();

        if ($veiculo->delete()) {
            return redirect()->route('ativo.veiculo')->with('success', 'Registro excluído com sucesso.');
        } else {
            return redirect()->route('ativo.veiculo')->with('fail', 'Problemas ao excluir registro.');
        }

    }
}
