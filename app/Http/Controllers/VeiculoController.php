<?php

namespace App\Http\Controllers;

use App\Models\CadastroEmpresa;
use App\Models\CadastroObra;
use App\Models\MarcaMaquina;
use App\Models\ModeloMaquina;
use App\Models\Veiculo;
use App\Models\VeiculoQuilometragem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::all();

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
            'periodo_inicial' => 'required|date|before_or_equal:periodo_final',
            'periodo_final' => 'required|date',
            // 'quilometragem_atual' => 'numeric|min:1',
        ]);

        if ($request->tipo === 'maquinas') {
            $modelo = $request->input('modelo_da_maquina');
            $ano = $request->input('ano_da_maquina');
            $veiculo = $request->input('veiculo_maquina');
            $marca = $request->input('marca_da_maquina');
        } else {
            $marca = $request->input('marca_nome');
            $modelo = $request->input('modelo_nome');
            $ano = $request->input('ano');
            $veiculo = $request->input('veiculo');
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
                'observacao' => $request->input('observacao'),
                'situacao' => $request->input('situacao'),
            ]
        );

        VeiculoQuilometragem::create([
            'veiculo_id' => $veiculo->id,
            'quilometragem_atual' => $request->input('quilometragem_atual')
        ]);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD VEICULO | Placa: ' . $veiculo->placa);

        return redirect()->back()->with('success', 'Registro cadastrado com sucesso.');

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
        $obras = CadastroObra::select('id', 'codigo_obra', 'razao_social')->orderByDesc('id')->get();

        $marcas = MarcaMaquina::all();

        $store = Veiculo::find($id);

        $modelos = ModeloMaquina::all();

        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        if (!$id or !$store) {
            return redirect()->route('ativo.veiculo')->with('fail', 'Esse veículo não foi encontrado.');
        }

        return view('pages.ativos.veiculos.form', compact('store', 'obras', 'marcas', 'modelos', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        if ($request->tipo === 'maquinas') {
            $modelo = $request->input('modelo_da_maquina');
            $ano = $request->input('ano_da_maquina');
            $veiculo = $request->input('veiculo_maquina');
            $marca = $request->input('marca_da_maquina');
        } else {
            $marca = $request->input('marca_nome');
            $modelo = $request->input('modelo_nome');
            $ano = $request->input('ano');
            $veiculo = $request->input('veiculo');
        }

        $veiculo->update([
            'obra' => $request->obra,
            'periodo_inicial' => $request->periodo_inicial,
            'periodo_final' => $request->periodo_final,
            'tipo' => $request->tipo,
            'marca' => $marca,
            'modelo' => $modelo,
            'veiculo' => $veiculo,
            'ano' => $ano,
            'valor_fipe' => str_replace('R$ ', '', $request->valor_fipe),
            'codigo_fipe' => $request->codigo_fipe,
            'fipe_mes_referencia' => $request->fipe_mes_referencia,
            'placa' => $request->placa,
            'codigo_da_maquina' => $request->codigo_da_maquina,
            'renavam' => $request->renavam,
            'horimetro_inicial' => $request->horimetro_inicial,
            'observacao' => $request->observacao,
            'situacao' => $request->situacao,
        ]);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT VEICULO | Placa: ' . $veiculo->placa);

        return redirect()->back()->with('success', 'Sucesso');
    }

    public function adicionarMarca(Request $request)
    {
        MarcaMaquina::create([
            'marca' => $request->input('add_marca_da_maquina')
        ]);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD MARCA MÁQUINA: ' . $request->marca);

        return redirect()->back()->withInput();
    }

    public function delete($id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DELETE VEÍCULO: ' . $veiculo->id);

        $veiculo->delete();

        return redirect()->back()->with('success', 'Sucesso');
    }
}
