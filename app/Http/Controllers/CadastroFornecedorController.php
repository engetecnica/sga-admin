<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CadastroFornecedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Traits\Configuracao;


class CadastroFornecedorController extends Controller
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
        $lista = CadastroFornecedor::all();
        return view('pages.cadastros.fornecedor.index', compact('lista'));
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
        return view('pages.cadastros.fornecedor.form', compact('estados'));
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
                'nome_fantasia' => 'required',
                'cnpj' => 'required|cnpj|unique:fornecedores,cnpj',
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
                'nome_fantasia.required' => 'É necessário preencher o Nome Fantasia',
                'cnpj.required' => 'Este CNPJ não é válido',
                'cnpj.unique' => 'Este CNPJ já está cadastrado',
                'cnpj.cnpj' => 'Este CNPJ não é válido',
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


        $fornecedor = new CadastroFornecedor();
        $fornecedor->razao_social = $request->razao_social;
        $fornecedor->nome_fantasia = $request->nome_fantasia;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->cep = $request->cep;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->numero = $request->numero;
        $fornecedor->bairro = $request->bairro;
        $fornecedor->cidade = $request->cidade;
        $fornecedor->estado = $request->estado;
        $fornecedor->email = $request->email;
        $fornecedor->celular = $request->celular;
        $fornecedor->status = $request->status;

        $fornecedor->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD FORNECEDOR : ' . $fornecedor->razao_social);

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect(route('cadastro.fornecedor'));

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
        $store = CadastroFornecedor::find($id);
        $estados = Configuracao::estados();

            if(!$id or !$store):
                Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
                return redirect(route('cadastro.fornecedor'));
            endif;

            return view('pages.cadastros.fornecedor.form', compact('store', 'estados'));
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
                'nome_fantasia' => 'required',
                'cnpj' => 'required|cnpj|unique:fornecedores,cnpj',
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
                'nome_fantasia.required' => 'É necessário preencher o Nome Fantasia',
                'cnpj.required' => 'Este CNPJ não é válido',
                'cnpj.unique' => 'Este CNPJ já está cadastrado',
                'cnpj.cnpj' => 'Este CNPJ não é válido',
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

        $fornecedor = CadastroFornecedor::find($id);
        $fornecedor->razao_social = $request->razao_social;
        $fornecedor->nome_fantasia = $request->nome_fantasia;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->cep = $request->cep;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->numero = $request->numero;
        $fornecedor->bairro = $request->bairro;
        $fornecedor->cidade = $request->cidade;
        $fornecedor->estado = $request->estado;
        $fornecedor->email = $request->email;
        $fornecedor->celular = $request->celular;
        $fornecedor->status = $request->status;
        $fornecedor->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT FORNECEDOR : ' . $fornecedor->razao_social);

        Alert::success('Muito bem ;)', 'Um registro foi modificado com sucesso!');
        return redirect(route('cadastro.fornecedor.editar', $id));
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
