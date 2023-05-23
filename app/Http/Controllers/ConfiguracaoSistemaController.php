<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ConfiguracaoSistema;
use App\Traits\Configuracao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use RealRashid\SweetAlert\Facades\Alert;


class ConfiguracaoSistemaController extends Controller
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
        $meiosdepagamento = Configuracao::integrador();
        $tiposdepix = Configuracao::tipo_pix();
        $store = ConfiguracaoSistema::find(1);
        return view(
                        'pages.configuracoes.sistema.index',
                            compact(
                                'meiosdepagamento',
                                'tiposdepix',
                                'store'
                            )
                    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
                'titulo' => 'required|min:5',
                'ti_responsavel_nome' => 'required|min:10',
                'ti_responsavel_telefone' => 'required',
                'ti_responsavel_email' => 'required'
            ],
            [
                'titulo.required' => 'É necessário preencher o título da Aplicação',
                'ti_responsavel_nome.required' => 'É necessário preencher o nome do responsável de TI',
                'ti_responsavel_telefone.required' => 'Preencha o telefone do responsável de TI',
                'ti_responsavel_email.required' => 'Por favor, não esqueça do e-mail do responsável de TI'
            ]
        );

        $configuracao = ConfiguracaoSistema::find(1);
        $configuracao->titulo = $request->titulo;
        $configuracao->ti_responsavel_nome = $request->ti_responsavel_nome;
        $configuracao->ti_responsavel_telefone = $request->ti_responsavel_telefone;
        $configuracao->ti_responsavel_email = $request->ti_responsavel_email;
        $configuracao->email = $request->email;
        $configuracao->integrador = ($request->integrador) ?? 'Mercado Pago';

        if(!$configuracao){
            $keys = [];
        } else {
            $keys =
                [
                    'access_token' => $request->access_token,
                    'client_id' => $request->client_id,
                    'client_secret' => $request->client_secret,
                ];
        }

        $configuracao->keys = json_encode($keys);
        $configuracao->pix_nome = $request->pix_nome;
        $configuracao->pix_tipo = $request->pix_tipo;
        $configuracao->pix_chave = $request->pix_chave;

        $configuracao->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD CONFIGURACAO SISTEMA: ' . $configuracao->titulo .' | PIX: ' .  $configuracao->pix_nome);

        Alert::success('Muito bem ;)', 'Registro modificado com sucesso.');
        return redirect(route('sistema'));

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
