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
        $detalhes = AtivoExterno::find($id);        
        $ativos = AtivoExternoEstoque::select('obras.razao_social', 'obras.cnpj', 'ativos_externos_estoque.*')->join('obras', 'obras.id', '=', 'ativos_externos_estoque.id_obra')->where('ativos_externos_estoque.id_ativo_externo', $detalhes->id)->get();
        return view('pages.ativos.externos.show', compact('detalhes', 'ativos'));
    }
}
