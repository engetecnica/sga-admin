<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\AtivoConfiguracao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Traits\Configuracao;


class AtivoConfiguracaoController extends Controller
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
        $lista = AtivoConfiguracao::select("ativos_configuracoes.*", "m2.titulo as vinculo")->join("ativos_configuracoes as m2", "m2.id", "=", "ativos_configuracoes.id_relacionamento", "left")->get();
        return view('pages.ativos.configuracoes.index', compact('lista'));
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
        return view('pages.ativos.configuracoes.form', compact('ativo_configuracoes'));
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
                'id_relacionamento' => 'required',
                'titulo' => 'required',
                'status' => 'required'
            ],
            [
                'id_relacionamento.required' => 'É necessário selecionar o Relacionamento desta Categoria',
                'titulo.required' => 'Preencha o Título da sua Categoria',
                'status.required' => 'Selecione o Status'
            ]
        );


        $configuracao = new AtivoConfiguracao();
        $configuracao->id_relacionamento = $request->id_relacionamento;
        $configuracao->titulo = $request->titulo;
        $configuracao->status = $request->status;
        $configuracao->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD RELACIONAMENTO : ' . $configuracao->titulo);

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect(route('ativo.configuracao'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $store = AtivoConfiguracao::find($id);
        $ativo_configuracoes = AtivoConfiguracao::get_ativo_configuracoes();

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
            return redirect(route('ativo.configuracao'));
        endif;

        return view('pages.ativos.configuracoes.form', compact('store', 'ativo_configuracoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(
            [
                'id_relacionamento' => 'required',
                'titulo' => 'required',
                'status' => 'required'
            ],
            [
                'id_relacionamento.required' => 'É necessário selecionar o Relacionamento desta Categoria',
                'titulo.required' => 'Preencha o Título da sua Categoria',
                'status.required' => 'Selecione o Status'
            ]
        );

        $configuracao = AtivoConfiguracao::find($id);
        $configuracao->id_relacionamento = $request->id_relacionamento;
        $configuracao->titulo = $request->titulo;
        $configuracao->status = $request->status;
        $configuracao->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT RELACIONAMENTO : ' . $configuracao->titulo);

        Alert::success('Muito bem ;)', 'Um registro foi modificado com sucesso!');
        return redirect(route('ativo.configuracao.editar', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
