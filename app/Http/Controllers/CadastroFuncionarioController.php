<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\{CadastroFuncionario, CadastroObra, CadastroFuncao};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Traits\Configuracao;


class CadastroFuncionarioController extends Controller
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
        $lista = CadastroFuncionario::select('obras.razao_social', 'funcionarios.*')->join('obras', 'obras.id', '=', 'funcionarios.id_obra')->get();

       // dd($lista);
        return view('pages.cadastros.funcionario.index', compact('lista'));
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
        $obras = CadastroObra::where('status', 'Ativo')->get();
        $funcoes = CadastroFuncao::all();
        return view('pages.cadastros.funcionario.form', compact('estados', 'obras', 'funcoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'matricula' => 'required|unique:funcionarios|min:4|max:30',
                'id_obra' => 'required',
                'nome' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'required|unique:funcionarios|cpf',
                'rg' => 'required',
                'id_funcao' => 'required',
                'cep' => 'required',
                'endereco' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required',
                //'email' => 'required',
                'celular' => 'required',
                'status' => 'required'
            ],
            [
                'matricula.required' => 'Digite corretamente a matrícula',
                'id_obra.required' => 'É necessário selecionar uma obra para este Funcionário',
                'nome' => 'Digite corretamente o nome',
                'data_nascimento' => 'Data de Nascimento Inválida',
                'cpf' => 'Preencha corretamente o campo CPF',
                'rg' => 'Este RG não é válido',
                'id_funcao' => 'É necessário selecionar uma função para este Funcionário',
                'cep.required' => 'O CEP é indispensável',
                'endereco.required' => 'Preencha o endereço corretamente',
                'numero.required' => 'Preencha o número da residência',
                'bairro.required' => 'Preencha o Bairro corretamente',
                'cidade.required' => 'Preencha a Cidade corretamente',
                'estado.required' => 'Selecione o Estado corretamente',
                //'email.required' => 'Digite o e-mail do cliente',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );


        $funcionario = new CadastroFuncionario();
        $funcionario->matricula = $request->matricula;
        $funcionario->id_obra = $request->id_obra;
        $funcionario->nome = $request->nome;
        $funcionario->data_nascimento = $request->data_nascimento;
        $funcionario->cpf = $request->cpf;
        $funcionario->rg = $request->rg;
        $funcionario->id_funcao = $request->id_funcao;

        $funcionario->cep = $request->cep;
        $funcionario->endereco = $request->endereco;
        $funcionario->numero = $request->numero;
        $funcionario->bairro = $request->bairro;
        $funcionario->cidade = $request->cidade;
        $funcionario->estado = $request->estado;
        $funcionario->email = $request->email ?? null;
        $funcionario->celular = $request->celular;
        $funcionario->status = $request->status;

        $funcionario->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD FUNCIONÁRIO : ' . $funcionario->nome . ' | CPF : ' . $funcionario->cpf);

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect(route('cadastro.funcionario'));
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
        $store = CadastroFuncionario::find($id);
        $estados = Configuracao::estados();
        $obras = CadastroObra::where('status', 'Ativo')->get();
        $funcoes = CadastroFuncao::all();

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
            return redirect(route('cadastro.funcionario'));
        endif;

        return view('pages.cadastros.funcionario.form', compact('store', 'estados', 'obras', 'funcoes'));
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
                'matricula' => 'required|unique:funcionarios|min:4|max:30',
                'id_obra' => 'required',
                'nome' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'required|unique:funcionarios|cpf',
                'rg' => 'required',
                'id_funcao' => 'required',
                'cep' => 'required',
                'endereco' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required',
                //'email' => 'required',
                'celular' => 'required',
                'status' => 'required'
            ],
            [
                'matricula.required' => 'Digite corretamente a matrícula',
                'id_obra.required' => 'É necessário selecionar uma obra para este Funcionário',
                'nome' => 'Digite corretamente o nome',
                'data_nascimento' => 'Data de Nascimento Inválida',
                'cpf.require' => 'Preencha corretamente o campo CPF',
                'cpf.unique' => 'Este CPF já está cadastrado',
                'cpf.cpf' => 'Preencha corretamente o campo CPF',
                'rg' => 'Este RG não é válido',
                'id_funcao' => 'É necessário selecionar uma função para este Funcionário',
                'cep.required' => 'O CEP é indispensável',
                'endereco.required' => 'Preencha o endereço corretamente',
                'numero.required' => 'Preencha o número da residência',
                'bairro.required' => 'Preencha o Bairro corretamente',
                'cidade.required' => 'Preencha a Cidade corretamente',
                'estado.required' => 'Selecione o Estado corretamente',
                //'email.required' => 'Digite o e-mail do cliente',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );

        $funcionario = CadastroFuncionario::find($id);
        $funcionario->matricula = $request->matricula;
        $funcionario->id_obra = $request->id_obra;
        $funcionario->nome = $request->nome;
        $funcionario->data_nascimento = $request->data_nascimento;
        $funcionario->cpf = $request->cpf;
        $funcionario->rg = $request->rg;
        $funcionario->id_funcao = $request->id_funcao;

        $funcionario->cep = $request->cep;
        $funcionario->endereco = $request->endereco;
        $funcionario->numero = $request->numero;
        $funcionario->bairro = $request->bairro;
        $funcionario->cidade = $request->cidade;
        $funcionario->estado = $request->estado;
        $funcionario->email = $request->email ?? null;
        $funcionario->celular = $request->celular;
        $funcionario->status = $request->status;
        $funcionario->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT FUNCIONÁRIO : ' . $funcionario->nome . ' | CPF : ' . $funcionario->cpf);

        Alert::success('Muito bem ;)', 'Um registro foi modificado com sucesso!');
        return redirect(route('cadastro.funcionario.editar', $id));
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
