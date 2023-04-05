<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\{AtivoConfiguracao, AtivoExternoEstoque, AtivoExterno};

use App\Traits\Configuracao;


class AtivoExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    use Configuracao;


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
        $ativo_configuracoes = AtivoConfiguracao::get_ativo_configuracoes();
        return view('pages.ativos.externos.form', compact('ativo_configuracoes'));
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


        /* Salvar Ativo */
        $externo = new AtivoExterno();
        $externo->id_ativo_configuracao = $request->id_ativo_configuracao;
        $externo->titulo = $request->titulo;
        $externo->status = $request->status;
        $externo->save();

       

        /* Salvar Ativo Estoque */
        $externo_estoque_quantidade = $request->quantidade;

        if($externo_estoque_quantidade && $externo_estoque_quantidade > 0){

            /*  */
            for($i=1; $i<=$externo_estoque_quantidade; $i++){
                $externo_estoque = new AtivoExternoEstoque();
                $externo_estoque->id_ativo_exerno = $externo->id;
                $externo_estoque->patrimonio = Configuracao::PatrimonioAtual() + $i;
                $externo_estoque->valor = $request->valor;
                $externo_estoque->calibracao = $request->calibracao;
                $externo_estoque->save();
            }



        }
        
        
        /* Salvar Ativo Item */


        /* Salvar Ativo Historico */

        // Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        // return redirect(route('ativo.externo'));
    }

   
}
