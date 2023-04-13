<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CadastroObra;
use App\Models\CadastroEmpresa;

use App\Traits\Configuracao;


class CadastroObraController extends Controller
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
        $lista = CadastroObra::all();
        return view('pages.cadastros.obra.index', compact('lista'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estados = Configuracao::estados();
        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();
        return view('pages.cadastros.obra.form', compact('estados', 'empresas'));
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
                'id_empresa' => 'required',
                'codigo_obra' => 'required|min:5',
                'cep' => 'required',
                'endereco' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required',
                'email' => 'required',
                'celular' => 'required',
                'status' => 'required'
            ], 
            [
                'id_empresa.required' => 'Selecione uma Empresa para vincular esta Obra',
                'codigo_obra.required' => 'É necessário digitar um código para esta Obra',
                'cep.required' => 'O CEP é indispensável',
                'endereco.required' => 'Preencha o endereço corretamente',
                'numero.required' => 'Preencha o número da residência',
                'bairro.required' => 'Preencha o Bairro corretamente',
                'cidade.required' => 'Preencha a Cidade corretamente',
                'estado.required' => 'Selecione o Estado corretamente',
                'email.required' => 'Digite o e-mail do responsável pela Obra',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );


        $obra = new CadastroObra();
        $obra->id_empresa = $request->id_empresa;
        $obra->codigo_obra = $request->codigo_obra;
        $obra->razao_social = $request->razao_social;
        $obra->cnpj = $request->cnpj;
        $obra->cep = $request->cep;
        $obra->endereco = $request->endereco;
        $obra->numero = $request->numero;
        $obra->bairro = $request->bairro;
        $obra->cidade = $request->cidade;
        $obra->estado = $request->estado;
        $obra->email = $request->email;
        $obra->celular = $request->celular;
        $obra->status = $request->status;

        $obra->save();

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect(route('cadastro.obra'));

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
        $store = CadastroObra::find($id);
        $estados = Configuracao::estados();
        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

            if(!$id or !$store):  
                Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
                return redirect(route('cadastro.obra')); 
            endif;

            return view('pages.cadastros.obra.form', compact('store', 'estados', 'empresas'));        
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
                'id_empresa' => 'required',
                'codigo_obra' => 'required|min:5',
                //'razao_social' => 'required|min:5',
                //'cnpj' => 'required',
                'cep' => 'required',
                'endereco' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required',
                'email' => 'required',
                'celular' => 'required',
                'status' => 'required'
            ], 
            [
                'id_empresa.required' => 'Selecione uma Empresa para vincular esta Obra',
                'codigo_obra.required' => 'É necessário digitar um código para esta Obra',
                //'razao_social.required' => 'É necessário preencher a Razão Social',
                //'cnpj.required' => 'Este CNPJ não é válido',
                'cep.required' => 'O CEP é indispensável',
                'endereco.required' => 'Preencha o endereço corretamente',
                'numero.required' => 'Preencha o número da residência',
                'bairro.required' => 'Preencha o Bairro corretamente',
                'cidade.required' => 'Preencha a Cidade corretamente',
                'estado.required' => 'Selecione o Estado corretamente',
                'email.required' => 'Digite o e-mail do responsável pela Obra',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );


        $obra = CadastroObra::find($id);

        $obra->id_empresa = $request->id_empresa;
        $obra->codigo_obra = $request->codigo_obra;
        $obra->razao_social = $request->razao_social;
        $obra->cnpj = $request->cnpj;
        $obra->cep = $request->cep;
        $obra->endereco = $request->endereco;
        $obra->numero = $request->numero;
        $obra->bairro = $request->bairro;
        $obra->cidade = $request->cidade;
        $obra->estado = $request->estado;
        $obra->email = $request->email;
        $obra->celular = $request->celular;
        $obra->status = $request->status;
        $obra->save();

        Alert::success('Muito bem ;)', 'Um registro foi modificado com sucesso!');
        return redirect(route('cadastro.obra.editar', $id));
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