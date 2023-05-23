<?php

namespace App\Http\Controllers;

use App\Models\{
    Anexo,
    AtivoExterno,
    AtivoExternoEstoque,
    FerramentalRetirada,
    FerramentalRetiradaItens,
    CadastroFuncionario,
    CadastroObra,
    FerramentalRetiradaItem,
    FerramentalRetiradaItemDevolver
};

use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Storage
};

use RealRashid\SweetAlert\Facades\Alert;

use App\Traits\{
    Configuracao,
    FuncoesAdaptadas
};

use Illuminate\Support\Facades\Log;

use App\Helpers\Tratamento;
use DataTables;
use PDF;

class FerramentalRetiradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.ferramental.retirada.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $obras = CadastroObra::all();
        $funcionarios = CadastroFuncionario::all();
        $estoque = AtivoExternoEstoque::getAtivosExternoEstoque();
        return view('pages.ferramental.retirada.form', compact('funcionarios', 'estoque', 'obras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'id_obra' => 'required',
                'id_funcionario' => 'required',
                'id_ativo_externo' => 'required',
                'devolucao_prevista' => 'required'
            ],
            [
                'id_obra.required' => 'Qual obra você deseja efetivar esta retirada?',
                'id_funcionario.required' => 'Você precisa selecionar o funcionário.',
                'id_ativo_externo.required' => 'Nenhum item foi selecionado para retirada.',
                'devolucao_prevista.required' => 'Preencha a data e hora para devolução.'
            ]
        );

        $retirada = new FerramentalRetirada();
        $retirada->id_relacionamento = null;
        $retirada->id_obra = $request->id_obra;
        $retirada->id_usuario = Auth::user()->id ?? 1;
        $retirada->id_funcionario = $request->id_funcionario;
        $retirada->data_devolucao_prevista = $request->devolucao_prevista;
        $retirada->data_devolucao = null;
        $retirada->status = 1;
        $retirada->observacoes = $request->observacoes ?? NULL;
        $retirada->save();

        $id_retirada = $retirada->id;

        if ($id_retirada) {

            if ($request->id_ativo_externo) {
                foreach ($request->id_ativo_externo as $key => $value) {
                    $retirada_item = new FerramentalRetiradaItem();
                    $retirada_item->id_ativo_externo = $value;
                    $retirada_item->id_retirada = $id_retirada;
                    $retirada_item->status = 1;
                    $retirada_item->save();
                }
            }

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | ADD RETIRADA | ID: ' . $id_retirada . ' | DATA: ' . date('Y-m-d H:i:s'));

            Alert::success('Muito bem ;)', 'Sua retirada foi registrada com sucesso!');
            return redirect(route('ferramental.retirada.detalhes', $id_retirada));
        } else {
            Alert::error('Que Pena!', 'Não foi possível registrar sua solicitação, entre em contato com suporte.');
            return redirect(route('ferramental.retirada'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FerramentalRetirada  $ferramentalRetirada
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if (!$id) {
            Alert::error('Atenção', 'Não foi possível localizar esta Retirada.');
            return redirect(route('ferramental.retirada'));
        }

        $detalhes = FerramentalRetirada::getRetiradaItems($id);

        if (!$detalhes) {
            Alert::error('Atenção', 'Não foi possível localizar esta Retirada.');
            return redirect(route('ferramental.retirada'));
        }

        return view('pages.ferramental.retirada.show', compact('detalhes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FerramentalRetirada  $ferramentalRetirada
     * @return \Illuminate\Http\Response
     */
    public function edit(FerramentalRetirada $ferramentalRetirada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FerramentalRetirada  $ferramentalRetirada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FerramentalRetirada $ferramentalRetirada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FerramentalRetirada  $ferramentalRetirada
     * @return \Illuminate\Http\Response
     */
    public function destroy(FerramentalRetirada $ferramentalRetirada)
    {
        //
    }


    /**
     * Termo de Responsabilidade
     * Upload do termo automaticamente via storage
     */

    public function termo(int $id)
    {
        /** Get Detalhes */
        $detalhes = FerramentalRetirada::getRetiradaItems($id);

        /** Nome do Arquivo */
        $termo_responsabilidade = 'termo_retirada_' . date("dmYHis") . '.pdf';

        $termo = FerramentalRetirada::find($id);
        $termo->termo_responsabilidade_gerado = now();
        $termo->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | GEROU TERMO RETIRADA: ' . $termo->termo_responsabilidade_gerado);

        // /** Salvar autenticação (upload do termo) */
        // $autenticar = new Autenticar();
        // $autenticar->id_retirada = $id ?? null;
        // $autenticar->id_usuario = Auth::user()->id ?? 1;
        // $autenticar->id_funcionario = $detalhes->id_funcionario ?? null;
        // $autenticar->termo_responsabilidade = $termo_responsabilidade;
        // $autenticar->save();

        /** Upload do Termo Automatico */
        // $pdf = PDF::loadView('components.termo.termo_retirada', compact('detalhes'));
        // $content = $pdf->download()->getOriginalContent();
        // Storage::put('public/uploads/termos_retirada/' . $termo_responsabilidade, $content);

        /** Gerar PDF e mostra na tela */
        $pdf = PDF::loadView('components.termo.termo_retirada', compact('detalhes'));
        return $pdf->stream($termo_responsabilidade, array("Attachment" => false));
    }


    /** Download do Termo Atual */
    public function termo_download(int $id)
    {

        $termo_responsabilidade = (FerramentalRetirada::getRetiradaItems($id)->anexo->arquivo) ?? null;

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DOWNLOAD TERMO RETIRADA: ' . $termo_responsabilidade);

        if ($termo_responsabilidade === null) {
            Alert::error('Atenção', 'Não foi possível localizar o arquivo solicitado.');
            return redirect(route('ferramental.retirada'));
        }
        return Storage::download('public/uploads/termos_retirada/' . $termo_responsabilidade);
    }

    /**
     * Listagem de Retiradas
     * Via service-side
     */
    public function lista(Request $request)
    {
        if ($request->ajax()) {

            $listaRetirada = FerramentalRetirada::getRetirada();

            return DataTables::of($listaRetirada)

                ->editColumn('created_at', function ($row) {
                    return ($row->created_at) ? Tratamento::FormatarData($row->created_at) : '-';
                })
                ->editColumn('devolucao', function ($row) {
                    return ($row->data_devolucao_prevista) ? Tratamento::FormatarData($row->data_devolucao_prevista) : '-';
                })
                ->editColumn('status', function ($row) {
                    $status_classe = Tratamento::getStatusRetirada($row->status)['classe'];
                    $status_titulo = Tratamento::getStatusRetirada($row->status)['titulo'];
                    $status = "<div class='badge badge-" . $status_classe . "'>" . $status_titulo . "</div>";
                    return $status;
                })
                ->editColumn('acoes', function ($row) {

                    $dropdown = '<div class="dropdown"><div class="btn-group"><button class="btn btn-gradient-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Selecione</button><ul class="dropdown-menu" aria-labelledby="drodownAcoes">';

                    /** Devolver Itens */
                    if ($row->status == "2") {
                        $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.devolver', $row->id) . '"><i class="mdi mdi-redo-variant"></i> Devolver Itens</a></li>';
                    }

                    /** Gerar Termo */
                if ($row->status == "1" && !$row->termo_responsabilidade_gerado) {
                        $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.termo', $row->id) . '"><i class="mdi mdi-access-point-network"></i> Gerar Termo</a></li>';
                    }

                    /** Baixar Termo */
                if ($row->status == "2" or $row->status == "3" && $row->termo_responsabilidade_gerado) {
                        $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.termo', $row->id) . '"><i class="mdi mdi-download"></i> Baixar Termo</a></li>';
                    }


                if ($row->status == "1" && !$row->termo_responsabilidade_gerado) {

                    /** Modificar Retirada */
                    $dropdown .= '<li><a class="dropdown-item" href="#"><i class="mdi mdi-pencil"></i> Modificar Retirada</a></li>';

                    /** Cancelar Retirada */
                    $dropdown .= '<li><a class="dropdown-item" href="#"><i class="mdi mdi-cancel"></i> Cancelar Retirada</a></li>';

                    }

                    $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.detalhes', $row->id) . '"><i class="mdi mdi-minus"></i> Detalhes</a></li> </ul></div>';

                    return $dropdown;
                })
                ->rawColumns(['acoes', 'status'])
                ->make(true);
        }
    }

    /**
     * Devolver Itens
     * getRetiradaItems id_retirada
     */
    public function devolver(int $id)
    {
        if (!$id) {
            Alert::error('Atenção', 'Não foi possível localizar esta Retirada.');
            return redirect(route('ferramental.retirada'));
        }

        $detalhes = FerramentalRetirada::getRetiradaItems($id);

        if (!$detalhes) {
            Alert::error('Atenção', 'Não foi possível localizar esta Retirada.');
            return redirect(route('ferramental.retirada'));
        }

        return view('pages.ferramental.retirada.devolver', compact('detalhes'));
    }

    /**
     * Salvar devolução
     */

    public function devolver_salvar(Request $request)
    {

        if ($request->id_ativo_externo) {
            foreach ($request->id_ativo_externo as $key => $value) {

                dd($request->id_ativo_externo);




                /** Salvar Retirada Item */
                $item = FerramentalRetiradaItemDevolver::find($key);
                $item->status = $value ?? 1;
                $item->save();

                /** Salvar Retirada */
                $retirada = FerramentalRetirada::find($item->id_retirada);
                $retirada->devolucao_observacoes = $request->observacoes ?? null;
                $retirada->data_devolucao = now();
                $retirada->updated_at = now();
                $retirada->status = 2;
                $retirada->save();

                /** Salvar Ativo Externo */
                $estoque = AtivoExternoEstoque::find($item->id_ativo_externo);
                $estoque->status = $status;
                $estoque->save();
            }

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | SALVOU DEVOLUÇÃO: ' . $retirada->devolucao_observacoes);



            echo "Salvou essa porra.";
        }
    }
}
