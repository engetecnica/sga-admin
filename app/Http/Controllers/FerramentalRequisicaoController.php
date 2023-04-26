<?php

namespace App\Http\Controllers;

use App\Models\{
    FerramentalRequisicao,
    CadastroObra,
    CadastroFuncionario
};

use Illuminate\Http\Request;


class FerramentalRequisicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.ferramental.requisicao.index');
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
        return view('pages.ferramental.requisicao.form', compact('obras'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FerramentalRequisicao  $ferramentalRequisicao
     * @return \Illuminate\Http\Response
     */
    public function show(FerramentalRequisicao $ferramentalRequisicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FerramentalRequisicao  $ferramentalRequisicao
     * @return \Illuminate\Http\Response
     */
    public function edit(FerramentalRequisicao $ferramentalRequisicao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FerramentalRequisicao  $ferramentalRequisicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FerramentalRequisicao $ferramentalRequisicao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FerramentalRequisicao  $ferramentalRequisicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(FerramentalRequisicao $ferramentalRequisicao)
    {
        //
    }
}
