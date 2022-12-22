<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CadastroProduto;


class CadastroProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lista = CadastroProduto::associados();
        return view('pages.cadastros.produto.index', compact('lista'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estados = [];
        return view('pages.cadastros.produto.form', compact('estados'));
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
            ], 
            [
                'titulo.required' => 'É necessário preencher o título (nome) do produto',
                'status.required' => 'Selecione o Status'
            ]
        );


        $produto = new CadastroProduto();
        $produto->titulo = $request->titulo;
        $produto->descricao = $request->descricao;
        $produto->status = $request->status;

        $produto->save();

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect('cadastro/produto');

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
        $store = CadastroProduto::find($id);

            if(!$id or !$store):  
                Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
                return redirect('cadastro/produto'); 
            endif;

            return view('pages.cadastros.produto.form', compact('store'));        
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
                'titulo' => 'required|min:5',
            ], 
            [
                'titulo.required' => 'É necessário preencher o título (nome) do produto',
                'status.required' => 'Selecione o Status'
            ]
        );


        $produto = CadastroProduto::find($id);
        $produto->titulo = $request->titulo;
        $produto->descricao = $request->descricao;
        $produto->status = $request->status;

        $produto->save();

        Alert::success('Muito bem ;)', 'Um registro foi modificado com sucesso!');
        return redirect('cadastro/produto/editar/'.$id);
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
