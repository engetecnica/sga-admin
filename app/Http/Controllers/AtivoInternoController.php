<?php

namespace App\Http\Controllers;

use App\Models\AtivosInterno;
use App\Models\CadastroObra;
use App\Models\MarcaPatrimonio;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AtivoInternoController extends Controller
{

    public function index()
    {
        $ativos = AtivosInterno::all();

        return view('pages.ativos.internos.index', compact('ativos'));
    }


    public function create()
    {
        $obras = CadastroObra::select('id', 'razao_social')->get();
        $marcas = MarcaPatrimonio::all();

        return view('pages.ativos.internos.create', compact('obras', 'marcas'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $data['valor_atribuido'] = str_replace('R$ ', '', $request->valor_atribuido);
        $save = AtivosInterno::create($data);

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

        $data = $request->all();
        $save->update($data);

        return redirect()->route('ativo.interno.index')->with('success', 'Registro atualizado com sucesso.');
    }


    public function destroy(AtivosInterno $ativo)
    {
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

        if ($save) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['fail' => true]);
        }
    }
}
