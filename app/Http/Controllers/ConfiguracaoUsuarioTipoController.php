<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracaoUsuarioNiveis as UsuarioTipo;

use RealRashid\SweetAlert\Facades\Alert;

class ConfiguracaoUsuarioTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permite_excluir = 0;
        $lista = UsuarioTipo::orderBy('titulo', 'ASC')->get();
        return view('pages.configuracoes.usuario_tipo.index', compact('lista', 'permite_excluir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.configuracoes.usuario_tipo.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = new UsuarioTipo();
        $tipo->titulo = $request->nome;
        $tipo->permissoes = json_encode(($request->permission) ?? []);
        $tipo->save();

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect('configuracao/usuario_tipo');       
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
    public function edit($id=null)
    {

        $store = UsuarioTipo::find($id);

            if(!$id or !$store):  
                Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
                return redirect('configuracao/usuario_tipo'); 
            endif;

        return view('pages.configuracoes.usuario_tipo.form', compact('store'));
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
        $tipo = UsuarioTipo::find($request->id);
        $tipo->titulo = $request->nome;
        $tipo->permissoes = json_encode(($request->permission) ?? []);
        $tipo->save();

        Alert::success('Muito bem ;)', 'Registro modificado com sucesso.');
        return redirect('configuracao/usuario_tipo');          
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
