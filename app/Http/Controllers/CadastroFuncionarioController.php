<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{CadastroEmpresa, CadastroFuncionario, CadastroObra, CadastroFuncao, FuncaoFuncionario};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Traits\Configuracao;

class CadastroFuncionarioController extends Controller
{

    use Configuracao;

    public function index()
    {


        $lista = CadastroFuncionario::select('obras.razao_social', "obras.codigo_obra", 'funcionarios.*')
        ->join('obras', 'obras.id', '=', 'funcionarios.id_obra')
        ->get();

        return view('pages.cadastros.funcionario.index', compact('lista'));
    }

    public function create()
    {
        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        $estados = Configuracao::estados();

        $obras = CadastroObra::where('status', 'Ativo')->get();

        $funcoes = FuncaoFuncionario::all();

        return view('pages.cadastros.funcionario.form', compact('estados', 'obras', 'funcoes', 'empresas'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'matricula' => 'required|min:4|max:30|unique:funcionarios,matricula,NULL,id,deleted_at,NULL',
                'id_obra' => 'required',
                'nome' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'required|cpf|unique:funcionarios,cpf,NULL,id,deleted_at,NULL',
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
                'nome.required' => 'Digite corretamente o nome',
                'data_nascimento.required' => 'Data de Nascimento Inválida',
                'cpf.required' => 'Campo CPF é obrigatório',
                'cpf.cpf' => 'Este CPF não é válido',
                'cpf.unique' => 'Este CPF já está cadastrado',
                'rg.required' => 'Este RG não é válido',
                'id_funcao.required' => 'É necessário selecionar uma função para este Funcionário',
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
        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        $store = CadastroFuncionario::with('funcao')->where('id', $id)->first();

        $estados = Configuracao::estados();

        $obras = CadastroObra::where('status', 'Ativo')->get();

        $funcoes = FuncaoFuncionario::all();

        if (!$id or !$store) {
            return redirect()->route('cadastro.funcionario')->with('fail', 'Esse registro não foi encontrado.');
        }

        return view('pages.cadastros.funcionario.form', compact('store', 'estados', 'obras', 'funcoes', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $funcionario = CadastroFuncionario::find($id);
        $request->validate(
            [
                'matricula' => 'required|min:4|max:30|unique:funcionarios,matricula,null,'.$funcionario->id.',deleted_at,null',
                'id_obra' => 'required',
                'nome' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'required|cpf|unique:funcionarios,cpf,null,'.$funcionario->id.',deleted_at,null',
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
                'matricula.min' => 'A matrícula deve conter no mínimo 4 caracteres',
                'matricula.max' => 'A matrícula deve conter no máximo 30 caracteres',
                'matricula.unique' => 'Esta matrícula já está cadastrada',
                'id_obra.required' => 'É necessário selecionar uma obra para este Funcionário',
                'nome.required' => 'Digite corretamente o nome',
                'data_nascimento.required' => 'Data de Nascimento requerida',
                'cpf.require' => 'Preencha corretamente o campo CPF',
                'cpf.unique' => 'Este CPF já está cadastrado',
                'cpf.cpf' => 'Preencha corretamente o campo CPF',
                'rg.required' => 'Este RG não é válido',
                'id_funcao.required' => 'É necessário selecionar uma função para este Funcionário',
                'cep.required.required' => 'O CEP é requerido',
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

    public function destroy(CadastroFuncionario $id)
    {
        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DELETE FUNCIONÁRIO : ' . $id->nome . ' | CPF : ' . $id->cpf);

        if($id->delete()) {
            return redirect()->route('cadastro.funcionario')->with('success', 'Funcionário excluído com sucesso!');
        } else {
            return redirect()->route('cadastro.funcionario')->with('fail', 'Funcionário excluído com sucesso!');
        }
    }

}
