<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CadastroObra;
use App\Models\CadastroEmpresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Traits\Configuracao;

class CadastroObraController extends Controller
{

    use Configuracao;

    public function index()
    {
        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        $lista = CadastroObra::all();

        return view('pages.cadastros.obra.index', compact('lista', 'empresas'));
    }

    public function create()
    {
        $estados = Configuracao::estados();

        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        return view('pages.cadastros.obra.form', compact('estados', 'empresas'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'id_empresa' => 'required',
                'codigo_obra' => 'required|min:4',
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
        $obra->nome_fantasia = $request->nome_fantasia;
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

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD OBRA : ' . $obra->razao_social . ' | CÓDIGO : ' . $obra->codigo_obra);

        return redirect()->route('cadastro.obra')->with('success', 'Um registro foi adicionado com sucesso!');

    }

    public function edit($id)
    {
        $store = CadastroObra::find($id);

        $estados = Configuracao::estados();

        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        if (!$id or !$store) {
            return redirect()->route('cadastro.obra')->with('fail', 'Esse registro não foi encontrado.');
        }

        return view('pages.cadastros.obra.form', compact('store', 'estados', 'empresas'));
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'id_empresa' => 'required',
                'codigo_obra' => 'required|min:4',
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
        $obra->nome_fantasia = $request->nome_fantasia;
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

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT OBRA : ' . $obra->razao_social . ' | CÓDIGO : ' . $obra->codigo_obra);

        return redirect()->route('cadastro.obra.editar', $id)->with('success', 'Um registro foi modificado com sucesso!');
    }

    public function fastStore(Request $request)
    {
        $data = $request->all();
        $data['status'] = 'Ativo';
        $save = CadastroObra::create($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD OBRA RÁPIDO: ' . $save->razao_social . ' | CÓDIGO OBRA : ' . $save->codigo_obra);

        if ($save) {
            return redirect()->back()->with('success', 'Um registro foi adicionado com sucesso!');
        } else {
            return redirect()->back()->with('fail', 'Um erro impediu o cadastro.');
        }

    }

}
