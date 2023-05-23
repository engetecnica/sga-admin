<?php

namespace App\Http\Controllers;

use App\Models\AtivoExternoEstoque;
use App\Models\AtivosInterno;
use App\Models\CadastroObra;
use App\Models\MarcaPatrimonio;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Traits\Configuracao;

class AtivoInternoController extends Controller
{

    public function index()
    {
        $ativos = AtivosInterno::orderBy('id', 'DESC')->get();

        return view('pages.ativos.internos.index', compact('ativos'));
    }


    public function create()
    {
        $nextPatrimony = Configuracao::PatrimonioSigla() . Configuracao::PatrimonioAtual();

        $obras = CadastroObra::select('id', 'razao_social')->get();

        $marcas = MarcaPatrimonio::all();

        return view('pages.ativos.internos.create', compact('obras', 'marcas', 'nextPatrimony'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $data['patrimonio'] = Configuracao::PatrimonioSigla() . Configuracao::PatrimonioAtual();
        $data['valor_atribuido'] = str_replace('R$ ', '', $request->valor_atribuido);
        $save = AtivosInterno::create($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | STORE ATIVOS INTERNOS: ' . $save->patrimonio);

        if ($save) {
            return redirect()->route('ativo.interno.index')->with('success', 'Registro cadastrado com sucesso.');
        } else {
            return redirect()->route('ativo.interno.index')->with('fail', 'Um erro impediu o cadastro.');
        }
    }

    public function show($id)
    {

        $data = AtivosInterno::where('id', $id)->first();

        $pdf = Pdf::loadView('pages.ativos.internos.show', ['data' => $data]);

        return $pdf->setPaper('a4', 'landscape')->stream('ativo.pdf');

        // setPaper array(0.0, 0.0, 165.00, 300.00)

        // return view('pages.ativos.internos.show', compact('data'));

    }

    public function edit(AtivosInterno $ativo)
    {
        $obras = CadastroObra::select('id', 'razao_social')->get();

        $marcas = MarcaPatrimonio::all();

        return view('pages.ativos.internos.edit', compact('ativo', 'marcas', 'obras'));
    }


    public function update(Request $request, $ativo)
    {
        if (! $save = AtivosInterno::find($ativo)) {
            return redirect()->route('ativo.interno.index')->with('fail', 'Registro atualizado com sucesso.');
        }

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT ATIVOS INTERNOS: ' . $ativo->patrimonio);

        $data = $request->all();
        $save->update($data);

        return redirect()->route('ativo.interno.index')->with('success', 'Registro atualizado com sucesso.');
    }


    public function destroy(AtivosInterno $ativo)
    {

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DELETE ATIVOS INTERNOS: ' . $ativo->patrimonio);

        if ($ativo->delete()) {
            return redirect()->route('ativo.interno.index')->with('success', 'Registro excluído com sucesso.');
        } else {
            return redirect()->route('ativo.interno.index')->with('fail', 'Um erro ocorreu na tentativa de exclusão');
        }
    }

    public function storeMarca(Request $request)
    {
        $data = $request->all();
        $save = MarcaPatrimonio::create($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD MARCA PATRIMONIO: ' . $save->marca);

        if ($save) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['fail' => true]);
        }
    }
}
