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
                'nome' => 'required|min:5',
                'data_de_nascimento' => 'required',
                'cep' => 'required',
                'endereco' => 'required',
                'estado' => 'required',
                'celular' => 'required',
                'cpf' => 'required',
                'email' => 'required',
                'status' => 'required'
            ], 
            [
                'nome.required' => 'É necessário preencher o nome completo',
                'data_de_nascimento.required' => 'A data de nascimento é inválida',
                'cep.required' => 'O CEP é indispensável',
                'estado.required' => 'Selecione o Estado corretamente',
                'endereco.required' => 'Preencha o endereço com número da residência',
                'cidade.required' => 'Preencha a cidade',
                'email.required' => 'Digite o e-mail do cliente',
                'cpf.required' => 'Preencha corretamente o CPF',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );


        $empresa = new CadastroEmpresa();
        $empresa->nome = $request->nome;
        $empresa->data_de_nascimento = $request->data_de_nascimento;
        $empresa->cep = $request->cep;
        $empresa->endereco = $request->endereco;
        $empresa->estado = $request->estado;
        $empresa->cidade = $request->cidade;
        $empresa->cpf = $request->cpf;
        $empresa->celular = $request->celular;
        $empresa->email = $request->email;
        $empresa->status = $request->status;

        $empresa->save();

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect('cadastro/empresa');

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
                return redirect('cadastro/empresa'); 
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
                'nome' => 'required|min:5',
                'data_de_nascimento' => 'required',
                'cep' => 'required',
                'endereco' => 'required',
                'estado' => 'required',
                'celular' => 'required',
                'cpf' => 'required',
                'email' => 'required',
                'status' => 'required'
            ], 
            [
                'nome.required' => 'É necessário preencher o nome completo',
                'data_de_nascimento.required' => 'A data de nascimento é inválida',
                'cep.required' => 'O CEP é indispensável',
                'estado.required' => 'Selecione o Estado corretamente',
                'endereco.required' => 'Preencha o endereço com número da residência',
                'cidade.required' => 'Preencha a cidade',
                'email.required' => 'Digite o e-mail do cliente',
                'cpf.required' => 'Preencha corretamente o CPF',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );


        $empresa = CadastroEmpresa::find($id);
        $empresa->nome = $request->nome;
        $empresa->data_de_nascimento = $request->data_de_nascimento;
        $empresa->cep = $request->cep;
        $empresa->endereco = $request->endereco;
        $empresa->estado = $request->estado;
        $empresa->celular = $request->celular;
        $empresa->cpf = $request->cpf;
        $empresa->email = $request->email;
        $empresa->status = $request->status;

        $empresa->save();

        Alert::success('Muito bem ;)', 'Um registro foi modificado com sucesso!');
        return redirect('cadastro/empresa/editar/'.$id);
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




    /*
    Configurações do Site vincualdo à Empresa
    */
    public function site(request $request){
        

        $user = User::


        $empresa = CadastroEmpresa::find($request->id);

        if($empresa==null):
            Alert::error('Que Pena!', 'Empresa não encontrada ou você não tem permissão para acessar essa empresa.');
            return redirect('cadastro/empresa');
        endif;





    }


}
