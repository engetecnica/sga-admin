<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    AtivoConfiguracao,
    AtivoExternoEstoque,
    AtivoExterno,
    AtivoExternoEstoqueItem,
    AtivoExternoEstoqueHistorico,
    AtivosExternosStatus,
    CadastroEmpresa,
    CadastroObra
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Traits\{
    Configuracao,
    FuncoesAdaptadas
};

use App\Helpers\Tratamento;

use Yajra\DataTables\DataTables;

class AtivoExternoController extends Controller
{

    use Configuracao, FuncoesAdaptadas;

    public function index()
    {
        $ativos = AtivoExterno::with('configuracao')->get();

        return view('pages.ativos.externos.index', compact('ativos'));
    }

    public function create()
    {
        $obras = CadastroObra::all();

        $empresas = CadastroEmpresa::all();

        $ativo_configuracoes = AtivoConfiguracao::with('relacionamento')->where('status', 'Ativo')->get();

        return view('pages.ativos.externos.create', compact('ativo_configuracoes', 'obras', 'empresas'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'id_ativo_configuracao' => 'required',
                'titulo' => 'required',
                'quantidade' => 'required|min:1',
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
        $save_externo = $externo->save();

        /* Inclusão de Estoque - Item */
        $externo_estoque_item = new AtivoExternoEstoqueItem();
        $externo_estoque_item->id_ativo_externo = $externo->id;
        $externo_estoque_item->quantidade_estoque = $request->quantidade;
        $externo_estoque_item->quantidade_em_transito = 0;
        $externo_estoque_item->quantidade_em_operacao = 0;
        $externo_estoque_item->quantidade_com_defeito = 0;
        $externo_estoque_item->quantidade_fora_de_operacao = 0;
        $save_externo_estoque = $externo_estoque_item->save();

        /* Salvar Ativo Estoque */
        $externo_estoque_quantidade = $request->quantidade;

        /* Inclusão de Estoque  */
        for ($i = 1; $i <= $externo_estoque_quantidade; $i++) {

            /* Contagem de Patrimonio diante do Atual */
            $patrimonio = Configuracao::PatrimonioAtual();

            /* Dados para Salvar no Estoque */
            $externo_estoque = new AtivoExternoEstoque();
            $externo_estoque->id_ativo_externo = $externo->id;
            $externo_estoque->id_obra = $request->id_obra;
            $externo_estoque->patrimonio = Configuracao::PatrimonioSigla() . $patrimonio;
            $externo_estoque->valor = str_replace('R$ ', '', $request->valor) ?? 0;
            $externo_estoque->calibracao = $request->calibracao;
            $externo_estoque->status = 4; // Em Estoque
            $externo_estoque->save();
        }

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD ATIVO EXTERNO: ' . $externo_estoque->patrimonio);

        if($save_externo && $save_externo_estoque){
            return redirect()->route('ativo.externo.detalhes', $externo->id)->with('success', 'Novos ativos foram inseridos no estoque.');
        } else {
            return redirect()->route('ativo.externo')->with('fail', 'Não foi possível processar os ativos solicitados. Fale com seu supervisor.');
        }

    }

    public function show($id)
    {

        $detalhes = AtivoExterno::with('categoria')->find($id);
        $itens = AtivoExternoEstoque::with('obra', 'situacao')->where('id_ativo_externo', $id)->get();

        return view('pages.ativos.externos.show', compact('detalhes', 'itens'));
    }

    public function insert(AtivoExterno $ativo)
    {
        $obras = CadastroObra::all();

        $empresas = CadastroEmpresa::all();

        $ativo_configuracoes = AtivoConfiguracao::where('id_relacionamento', '>', 0)->get();

        return view('pages.ativos.externos.insert', compact('ativo_configuracoes', 'obras', 'ativo', 'empresas'));
    }

    public function insertStore(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'id_ativo_configuracao' => 'required',
                'titulo' => 'required',
                'quantidade' => 'required|min:1',
                'status' => 'required'
            ],
            [
                'id_ativo_configuracao.required' => 'É necessário selecionar uma Categoria',
                'titulo.required' => 'Preencha o Título do Ativo',
                'quantidade.required' => 'A quantidade não pode ser Zero ou Nula',
                'status.required' => 'Selecione o Status'
            ]
        );

        /* Salvar Ativo Estoque */
        $externo_estoque_quantidade = $request->quantidade;

        /* Inclusão de Estoque  */
        for ($i = 1; $i <= $externo_estoque_quantidade; $i++) {

            /* Contagem de Patrimonio diante do Atual */
            $patrimonio = Configuracao::PatrimonioAtual();

            /* Dados para Salvar no Estoque */
            $externo_estoque = new AtivoExternoEstoque();
            $externo_estoque->id_ativo_externo = $request->id_ativo_externo;
            $externo_estoque->id_obra = $request->id_obra;
            $externo_estoque->patrimonio = Configuracao::PatrimonioSigla() . $patrimonio;
            $externo_estoque->valor = str_replace('R$ ', '', $request->valor) ?? 0;
            $externo_estoque->calibracao = $request->calibracao;
            $externo_estoque->status = 4; // Em Estoque
            $externo_estoque->save();
        }

        $save = AtivoExternoEstoqueItem::where('id_ativo_externo', $request->id_ativo_externo)->increment('quantidade_estoque', $request->quantidade);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD ATIVO EXTERNO: ' . $externo_estoque->patrimonio);

        if($save){
            return redirect()->route('ativo.externo.detalhes', $request->id_ativo_externo)->with('success', 'Novos ativos foram inseridos no estoque.');
        } else {
            return redirect()->route('ativo.externo')->with('fail', 'Não foi possível processar os ativos solicitados. Fale com seu supervisor.');
        }
    }

    public function edit($id)
    {

        $estoques = AtivoExternoEstoque::with('obra', 'situacao', 'ativo_externo')->where('id_ativo_externo', $id)->get();
        $obras = CadastroObra::all();
        $categorias = AtivoConfiguracao::where('id_relacionamento', '>', 0)->get();
        $situacoes = AtivosExternosStatus::all();

        $empresas = CadastroEmpresa::all();

        return view('pages.ativos.externos.edit', compact('estoques', 'obras', 'categorias', 'situacoes', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        if (! $save = AtivoExternoEstoque::find($id)) {
            return redirect()->route('ativo.externo.index')->with('fail', 'Problemas para localizar o ativo.');
        }

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT ATIVOS INTERNOS: ' . $save->patrimonio);

        $data = $request->all();
        $atualiza['id_obra'] = $request->id_obra;
        $atualiza['valor'] = str_replace('R$ ', '', $request->valor) ?? 0;
        $atualiza['calibracao'] = $request->calibracao;
        $atualiza['status'] = $request->status;
        $save->update($atualiza);

        return redirect()->route('ativo.externo.editar', $request->id_ativo_externo)->with('success', 'Registro atualizado com sucesso.');


    }

    public function searchAtivoID(Request $request, int $id)
    {

        if ($request->ajax()) {
            $ativosPesquisar = AtivoExternoEstoque::select('obras.razao_social', 'obras.cnpj', 'obras.codigo_obra', 'ativos_externos_estoque.*')
                ->join('obras', 'obras.id', '=', 'ativos_externos_estoque.id_obra')
                ->where('ativos_externos_estoque.id_ativo_externo', $id)
                ->get();

            return DataTables::of($ativosPesquisar)
                ->editColumn('id_obra', function ($row) {
                    return '<span class="badge badge-danger">'.$row->codigo_obra . ' - ' . $row->razao_social . '</span>';
                })
                ->editColumn('patrimonio', function ($row) {
                    return '<span class="badge badge-primary">' . $row->patrimonio  . '</span>';
                })
                ->editColumn('valor', function ($row) {
                    return 'R$ '. $row->valor;
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

            $listaAtivos = AtivoExterno::select('ativos_configuracoes.titulo AS categoria', 'ativos_externos.*')
                ->join('ativos_configuracoes', 'ativos_configuracoes.id', '=', 'ativos_externos.id_ativo_configuracao')
                ->orderBy('ativos_externos.titulo', 'ASC')
                ->get();

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
