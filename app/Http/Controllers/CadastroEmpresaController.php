<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CadastroEmpresa;

use App\Traits\Configuracao;


class CadastroEmpresaController extends Controller
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
        $lista = CadastroEmpresa::all();
        return view('pages.cadastros.empresa.index', compact('lista'));        
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
        return view('pages.cadastros.empresa.form', compact('estados'));
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
                'razao_social' => 'required|min:5',
                'cnpj' => 'required',
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
                'razao_social.required' => 'É necessário preencher a Razão Social',
                'cnpj.required' => 'Este CNPJ não é válido',
                'cep.required' => 'O CEP é indispensável',
                'endereco.required' => 'Preencha o endereço corretamente',
                'numero.required' => 'Preencha o número da residência',
                'bairro.required' => 'Preencha o Bairro corretamente',
                'cidade.required' => 'Preencha a Cidade corretamente',
                'estado.required' => 'Selecione o Estado corretamente',
                'email.required' => 'Digite o e-mail do cliente',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );


        $empresa = new CadastroEmpresa();
        $empresa->razao_social = $request->razao_social;
        $empresa->cnpj = $request->cnpj;
        $empresa->cep = $request->cep;
        $empresa->endereco = $request->endereco;
        $empresa->numero = $request->numero;
        $empresa->bairro = $request->bairro;
        $empresa->cidade = $request->cidade;
        $empresa->estado = $request->estado;
        $empresa->email = $request->email;
        $empresa->celular = $request->celular;
        $empresa->status = $request->status;

        $empresa->save();

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect(route('cadastro.empresa'));

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
        $store = CadastroEmpresa::find($id);
        $estados = Configuracao::estados();

            if(!$id or !$store):  
                Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
                return redirect(route('cadastro.empresa')); 
            endif;

            return view('pages.cadastros.empresa.form', compact('store', 'estados'));        
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
                'razao_social' => 'required|min:5',
                'cnpj' => 'required',
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
                'razao_social.required' => 'É necessário preencher a Razão Social',
                'cnpj.required' => 'Este CNPJ não é válido',
                'cep.required' => 'O CEP é indispensável',
                'endereco.required' => 'Preencha o endereço corretamente',
                'numero.required' => 'Preencha o número da residência',
                'bairro.required' => 'Preencha o Bairro corretamente',
                'cidade.required' => 'Preencha a Cidade corretamente',
                'estado.required' => 'Selecione o Estado corretamente',
                'email.required' => 'Digite o e-mail do cliente',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );

        $empresa = CadastroEmpresa::find($id);
        $empresa->razao_social = $request->razao_social;
        $empresa->cnpj = $request->cnpj;
        $empresa->cep = $request->cep;
        $empresa->endereco = $request->endereco;
        $empresa->numero = $request->numero;
        $empresa->bairro = $request->bairro;
        $empresa->cidade = $request->cidade;
        $empresa->estado = $request->estado;
        $empresa->email = $request->email;
        $empresa->celular = $request->celular;
        $empresa->status = $request->status;
        $empresa->save();

        Alert::success('Muito bem ;)', 'Um registro foi modificado com sucesso!');
        return redirect(route('cadastro.empresa.editar', $id));
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
