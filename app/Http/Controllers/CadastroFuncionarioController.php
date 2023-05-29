<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{CadastroFuncionario, CadastroObra, CadastroFuncao, FuncaoFuncionario};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Traits\Configuracao;

class CadastroFuncionarioController extends Controller
{

    use Configuracao;

    public function index()
    {
        $lista = CadastroFuncionario::select('obras.razao_social', 'funcionarios.*')
        ->join('obras', 'obras.id', '=', 'funcionarios.id_obra')
        ->get();

        return view('pages.cadastros.funcionario.index', compact('lista'));
    }

    public function create()
    {
        $estados = Configuracao::estados();

        $obras = CadastroObra::where('status', 'Ativo')->get();

        $funcoes = FuncaoFuncionario::all();

        return view('pages.cadastros.funcionario.form', compact('estados', 'obras', 'funcoes'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'matricula' => 'required|min:4|max:30|unique:funcionarios,matricula',
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

        return redirect()->route('cadastro.funcionario')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $store = CadastroFuncionario::with('funcao')->where('id', $id)->first();

        $estados = Configuracao::estados();

        $obras = CadastroObra::where('status', 'Ativo')->get();

        $funcoes = FuncaoFuncionario::all();

        if (!$id or !$store) {
            return redirect()->route('cadastro.funcionario')->with('fail', 'Esse registro não foi encontrado.');
        }

        return view('pages.cadastros.funcionario.form', compact('store', 'estados', 'obras', 'funcoes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'matricula' => 'required|min:4|max:30|unique:funcionarios,matricula,' . $id,
                'id_obra' => 'required',
                'nome' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'required|cpf|unique:funcionarios,cpf,' . $id . '|cpf',
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

        return redirect()->route('cadastro.funcionario.editar', $id)->with('success', 'Funcionário editado com sucesso!');
    }

}
