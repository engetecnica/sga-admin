<?php

namespace App\Http\Controllers;

use App\Exports\FuncionariosExport;
use App\Models\CadastroEmpresa;
use App\Models\CadastroFuncionario;
use App\Models\CadastroObra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class RelatorioFuncionarioController extends Controller
{
    public function index()
    {
        $empresas = CadastroEmpresa::all();
        return view('pages.relatorios.funcionario.index', compact('empresas'));
    }

    public function gerar(Request $request)
    {
        $tipo_arquivo = $request->tipo_arquivo;
        $periodo = $request->periodo;
        $inicio = $request->inicio;
        $fim = $request->fim;
        $empresa = $request->empresa;
        $obra = $request->obra;

        $funcionarios = CadastroFuncionario::query();

        if ($periodo == 'hoje') {
            $funcionarios->whereDate('created_at', today());
        } elseif ($periodo == 'ontem') {
            $funcionarios->whereDate('created_at', yesterday());
        } elseif ($periodo == 'outro') {
            $funcionarios->whereDate('created_at', '>=', $inicio)
                ->whereDate('created_at', '<=', $fim);
        }

        if (!empty($empresa) && !empty($obra)) {
            $funcionarios->whereHas('obra', function ($query) use ($empresa) {
                $query->where('id_empresa', $empresa);
            })->whereIn('id_obra', (array) $obra);
        } elseif (!empty($empresa)) {
            $obras = CadastroObra::where('id_empresa', $empresa)->pluck('id');
            $funcionarios->whereIn('id_obra', $obras);
        }


        $funcionarios = $funcionarios->get();

        $data_de_geracao = now()->format('d/m/Y H:i:s');

        if ($tipo_arquivo == 'pdf') {
            $pdf = PDF::loadView('pages.relatorios.funcionario.pdf', compact('funcionarios', 'data_de_geracao'));
            $pdf->getDOMPdf()->set_option('isPhpEnabled', true);
            return $pdf->stream('funcionarios.pdf');
        } elseif ($tipo_arquivo == 'xls') {
            return Excel::download(new FuncionariosExport($periodo, $inicio, $fim, $empresa, $obra), 'funcionarios.xlsx');
        } else {
            return redirect()->back();
        }
    }

    public function select(Request $request)
    {
        $obras = CadastroObra::where('id_empresa', $request->empresa_id)->pluck('razao_social', 'id');
        return response()->json($obras);
    }
}
