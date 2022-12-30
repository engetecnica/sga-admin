<?php

namespace App\Http\Controllers;

use App\Models\CadastroCliente;
use App\Models\CadastroEmpresa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Session;

use App\Traits\Configuracao;
use App\Traits\FuncoesAdaptadas;



class CadastroClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Configuracao;
    use FuncoesAdaptadas;

    public function index()
    {
        // Filtro para empresas
        $this->id_empresa = null;
        if (Session::has('empresa')) {
            if (Session::get('empresa')['id'] > 0) {
                $this->id_empresa = Session::get('empresa')['id'];
            }
        }

        $lista = CadastroCliente::select("clientes.*", DB::raw("CONCAT(empresas.nome,' - ', empresas.cpf) AS empresa"))
            ->join('empresas', 'empresas.id', '=', "clientes.id_empresa")
            ->when($this->id_empresa, function ($query) {
                $query->where('clientes.id_empresa', $this->id_empresa);
            })
            ->where('clientes.status', 'Ativo')
            ->get();

        return view('pages.cadastros.cliente.index', compact('lista'));
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
        $empresas = CadastroEmpresa::withTrashed()->where('status', 'Ativo')->get(); // Filtro softDeletes + Status Ativo
        return view('pages.cadastros.cliente.form', compact('empresas', 'estados'));
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


        $cliente = new CadastroCliente();
        $cliente->id_empresa = (isset($request->id_empresa)) ? $request->id_empresa : Session::get('empresa')['id'];
        $cliente->nome = $request->nome;
        $cliente->data_de_nascimento = $request->data_de_nascimento;
        $cliente->cep = $request->cep;
        $cliente->endereco = $request->endereco;
        $cliente->estado = $request->estado;
        $cliente->cidade = $request->cidade;
        $cliente->cpf = $request->cpf;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->status = $request->status;

        $cliente->save();

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect(route('cadastro.cliente'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroCliente  $cadastroCliente
     * @return \Illuminate\Http\Response
     */
    public function show(CadastroCliente $cadastroCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CadastroCliente  $cadastroCliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(Auth::user()->user_level > 1){
            $cliente = CadastroCliente::find($id);
            echo Auth::user()->id_empresa;
            if($cliente->id_empresa != Auth::user()->id_empresa){
                Alert::error('Hey!', 'Este cliente não pertence ao seu Login.');
                return redirect(route('cadastro.cliente'));
            }
        }


        $store = CadastroCliente::find($id);
        $estados = Configuracao::estados();
        $empresas = CadastroEmpresa::withTrashed()->where('status', 'Ativo')->get(); // Filtro softDeletes + Status Ativo

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
            return redirect(route('cadastro.cliente'));
        endif;

        return view('pages.cadastros.cliente.form', compact('store', 'estados', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CadastroCliente  $cadastroCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CadastroCliente $cadastroCliente)
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
                'id_empresa.required' => 'Deve selecionar uma empresa',
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

        $cliente = CadastroCliente::find($request->id);
        $cliente->id_empresa = (isset($request->id_empresa)) ? $request->id_empresa : Session::get('empresa')['id'];
        $cliente->nome = $request->nome;
        $cliente->data_de_nascimento = $request->data_de_nascimento;
        $cliente->cep = $request->cep;
        $cliente->endereco = $request->endereco;
        $cliente->estado = $request->estado;
        $cliente->cidade = $request->cidade;
        $cliente->cpf = $request->cpf;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->status = $request->status;

        $cliente->save();

        Alert::success('Muito bem ;)', 'Um registro foi modificado com sucesso!');
        return redirect(route('cadastro.cliente.editar', $request->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastroCliente  $cadastroCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CadastroCliente $cadastroCliente)
    {
        //
    }
}
