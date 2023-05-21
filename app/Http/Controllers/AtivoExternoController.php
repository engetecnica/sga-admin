<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\{
    AtivoConfiguracao,
    AtivoExternoEstoque,
    AtivoExterno,
    AtivoExternoEstoqueItem,
    AtivoExternoEstoqueHistorico,
    CadastroObra
};

use App\Traits\{
    Configuracao,
    FuncoesAdaptadas
};

use App\Helpers\Tratamento;

use DataTables;

class AtivoExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    use Configuracao, FuncoesAdaptadas;


    public function index()
    {
        //
        $lista = [];
        return view('pages.ativos.externos.index', compact('lista'));
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
        $ativo_configuracoes = AtivoConfiguracao::get_ativo_configuracoes();
        return view('pages.ativos.externos.form', compact('ativo_configuracoes', 'obras'));
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
                'id_ativo_configuracao' => 'required',
                'titulo' => 'required',
                'quantidade' => 'required',
                'status' => 'required'
            ],
            [
                'id_ativo_configuracao.required' => 'É necessário selecionar uma Categoria',
                'titulo.required' => 'Preencha o Título do Ativo',
                'quantidade.required' => 'A quantidade não pode ser Zero ou Nula',
                'status.required' => 'Selecione o Status'
            ]
        );

        // FuncoesAdaptadas::dv($request->all());

        /* Salvar Ativo */
        $externo = new AtivoExterno();
        $externo->id_ativo_configuracao = $request->id_ativo_configuracao;
        $externo->titulo = $request->titulo;
        $externo->status = $request->status;
        $externo->save();

        /* Salvar Ativo Estoque */
        $externo_estoque_quantidade = $request->quantidade;

        if ($externo_estoque_quantidade && $externo_estoque_quantidade > 0) {

            /* Inclusão de Estoque  */
            for ($i = 1; $i <= $externo_estoque_quantidade; $i++) {

                /* Contagem de Patrimonio diante do Atual */
                $patrimonio = Configuracao::PatrimonioAtual() + $i;

                /* Dados para Salvar no Estoque */
                $externo_estoque = new AtivoExternoEstoque();
                $externo_estoque->id_ativo_externo = $externo->id;
                $externo_estoque->id_obra = $request->id_obra;
                $externo_estoque->patrimonio = Configuracao::PatrimonioSigla() . $patrimonio;
                $externo_estoque->valor = FuncoesAdaptadas::formata_moeda($request->valor) ?? 0;
                $externo_estoque->calibracao = $request->calibracao;
                $externo_estoque->status = 4; // Em Estoque
                $externo_estoque->save();
            }

            /* Inclusão de Estoque - Item */
            $externo_estoque_item = new AtivoExternoEstoqueItem();
            $externo_estoque_item->id_ativo_externo = $externo->id;
            $externo_estoque_item->quantidade_estoque = $externo_estoque_quantidade;
            $externo_estoque_item->quantidade_em_transito = 0;
            $externo_estoque_item->quantidade_em_operacao = 0;
            $externo_estoque_item->quantidade_com_defeito = 0;
            $externo_estoque_item->quantidade_fora_de_operacao = 0;
            $externo_estoque_item->save();
        }


        if ($externo && $externo_estoque && $externo_estoque_item) {
            Alert::success('Muito bem ;)', 'Novos ativos foram inseridos no estoque.');
            return redirect(route('ativo.externo.detalhes', $externo->id));
        }

        Alert::error('Atenção', 'Não foi possível processar os ativos solicitados. Fale com seu supervisor.');
        return redirect(route('ativo.externo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relatorio  $relatorio
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if (!$id) {
            Alert::error('Atenção', 'Não foi possível localizar este Ativo Externo.');
            return redirect(route('ativo.externo'));
        }

        $detalhes = AtivoExterno::select('ativos_configuracoes.titulo AS categoria', 'ativos_externos.*')->join('ativos_configuracoes', 'ativos_configuracoes.id', '=', 'ativos_externos.id_ativo_configuracao')->where('ativos_externos.id', $id)->first();

        if(!$detalhes){
            Alert::error('Atenção', 'Não foi possível localizar este Ativo Externo.');
            return redirect(route('ativo.externo'));
        }

        return view('pages.ativos.externos.show', compact('detalhes'));
    }


    public function searchAtivoID(Request $request, int $id)
    {

        if ($request->ajax()) {
            $ativosPesquisar = AtivoExternoEstoque::select('obras.razao_social', 'obras.cnpj', 'obras.codigo_obra', 'ativos_externos_estoque.*')->join('obras', 'obras.id', '=', 'ativos_externos_estoque.id_obra')->where('ativos_externos_estoque.id_ativo_externo', $id)->get();
            return DataTables::of($ativosPesquisar)
                ->editColumn('id_obra', function ($row) {
                    return '<span class="badge badge-danger">'.$row->codigo_obra . ' - ' . $row->razao_social . '</span>';
                })
                ->editColumn('patrimonio', function ($row) {
                    return '<span class="badge badge-primary">' . $row->patrimonio  . '</span>';
                })
                ->editColumn('valor', function ($row) {
                    return FuncoesAdaptadas::formata_moeda_reverse($row->valor);
                })
                ->editColumn('calibracao', function($row){
                    return $row->calibracao==1 ? "Sim" : "Não";
                })
                ->editColumn('data_descarte', function ($row) {
                    return ($row->data_descarte) ? Tratamento::FormatarData($row->data_descarte) : '-';
                })
                ->editColumn('created_at', function ($row) {
                    return ($row->created_at) ? Tratamento::FormatarData($row->created_at) : '-';
                })
                ->addColumn('status', function ($row) {
                    $status = Tratamento::getStatusEstoque($row->status);
                    return '<span class="badge badge-'. $status['classe'].'">' . $status['titulo'] . '</span>';
                })
                ->rawColumns(['patrimonio', 'id_obra', 'status'])
                ->make(true);
        }

    }

    public function searchAtivoLista(Request $request){

        if ($request->ajax()) {

            $listaAtivos = AtivoExterno::select('ativos_configuracoes.titulo AS categoria', 'ativos_externos.*')->join('ativos_configuracoes', 'ativos_configuracoes.id', '=', 'ativos_externos.id_ativo_configuracao')->orderBy('ativos_externos.titulo', 'ASC')->get();

            return DataTables::of($listaAtivos)

                ->editColumn('created_at', function ($row) {
                    return ($row->created_at) ? Tratamento::FormatarData($row->created_at) : '-';
                })
                ->editColumn('status', function ($row) {
                    return 'Ativo';
                })
                ->editColumn('id_ativo_configuracao', function ($row) {
                    return $row->categoria;
                })
                ->editColumn('acoes', function($row){
                    $btn = '<a href="' . route("ativo.externo.editar", $row->id) . '"><button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar</button></a>';
                    $btn .= '<a href="' . route("ativo.externo.detalhes", $row->id) . '"><button class="badge badge-dark" style="margin-left: 5px" data-toggle="tooltip" data-placement="top" title="Detalhes"><i class="mdi mdi-list"></i> Detalhes</button></a>';
                    return $btn;
                })
                ->rawColumns(['acoes', 'status'])
                ->make(true);
        }

    }
}
