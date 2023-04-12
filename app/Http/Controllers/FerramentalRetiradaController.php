<?php

namespace App\Http\Controllers;

use App\Models\{
    Anexo,
    AtivoExternoEstoque,
    FerramentalRetirada,
    FerramentalRetiradaItens,
    CadastroFuncionario,
    CadastroObra,
    FerramentalRetiradaAutenticacao as Autenticar,
    FerramentalRetiradaAutenticacao,
    FerramentalRetiradaItem
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

use App\Traits\{
    Configuracao,
    FuncoesAdaptadas
};

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
        //
        $lista = FerramentalRetirada::getRetirada();
        return view('pages.ferramental.retirada.index', compact('lista'));
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
                'id_funcionario' => 'required',
                'id_ativo_externo' => 'required',
                'devolucao_prevista' => 'required'
            ],
            [
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

        /** Salvar autenticação (upload do termo) */
        $autenticar = new Autenticar();
        $autenticar->id_retirada = $id ?? null;
        $autenticar->id_usuario = Auth::user()->id ?? 1;
        $autenticar->id_funcionario = $detalhes->id_funcionario ?? null;
        $autenticar->termo_responsabilidade = $termo_responsabilidade;
        $autenticar->save();

        /** Upload do Termo Automatico */
        $pdf = PDF::loadView('components.termo.termo_retirada', compact('detalhes'));
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/uploads/termos_retirada/' . $termo_responsabilidade, $content);

        /** Gerar PDF e mostra na tela */
        $pdf = PDF::loadView('components.termo.termo_retirada', compact('detalhes'));
        return $pdf->stream($termo_responsabilidade, array("Attachment" => false));
    }

    /** Assinatura do Termo */
    public function termo_assinar(int $id)
    {

        $autenticado = FerramentalRetiradaAutenticacao::find($id);
        if (!empty($autenticado)) {
            return 2;
        }

        $detalhes = FerramentalRetirada::getRetiradaItems($id);
        $autenticar = new Autenticar();
        $autenticar->id_retirada = $id ?? null;
        $autenticar->id_usuario = Auth::user()->id ?? 1;
        $autenticar->id_funcionario = $detalhes->id_funcionario ?? null;
        if ($autenticar->save()) {

            /**
             * Marcar itens como "Entregue"
             */
            $entregue = $detalhes->itens ?? false;

            if ($entregue) {

                // Atualiza Retirada
                $retirada = FerramentalRetirada::find($id);
                $retirada->status = 2;
                $retirada->save();

                // Atualiza Item da Retirada
                foreach ($entregue as $ret) {
                    $retirada_item = FerramentalRetiradaItem::find($ret->id_retirada);
                    $retirada_item->status = 2; // Entregue
                    $retirada_item->save();
                }

                // Atualiza Estoque
                foreach ($entregue as $ent) {
                    $estoque = AtivoExternoEstoque::find($ent->id_ativo_externo);
                    $estoque->status = 6; // Em Operação
                    $estoque->save();
                }
            }


            return 1;
        }

        return 0;
    }

    /** Download do Termo Atual */
    public function termo_download(int $id)
    {
        $termo_responsabilidade = (FerramentalRetirada::getRetiradaItems($id)->autenticado->termo_responsabilidade) ?? null;

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
                    if ($row->status == "1" && !$row->termo_responsabilidade) {
                        $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.termo', $row->id) . '"><i class="mdi mdi-access-point-network"></i> Gerar Termo</a></li>';
                    }

                    /** Baixar Termo */
                    if ($row->status == "2" or $row->status == "3" && $row->termo_responsabilidade) {
                        $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.termo', $row->id) . '"><i class="mdi mdi-download"></i> Baixar Termo</a></li>';
                    }

                    /** Modificar Retirada */
                    if ($row->status == "1") {
                        $dropdown .= '<li><a class="dropdown-item" href="#"><i class="mdi mdi-pencil"></i> Modificar Retirada</a></li>';
                    }

                    /** Cancelar Retirada */
                    if ($row->status == "1") {
                        $dropdown .= '<li><a class="dropdown-item" href="#"><i class="mdi mdi-cancel"></i> Cancelar Retirada</a></li>';
                    }

                    $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.detalhes', $row->id) . '"><i class="mdi mdi-minus"></i> Detalhes</a></li> </ul></div>';

                    return $dropdown;
                })
                ->rawColumns(['acoes', 'status'])
                ->make(true);
        }
    }
}