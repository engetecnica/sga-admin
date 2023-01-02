<?php

namespace App\Http\Controllers;

use App\Models\{FerramentaMensagem, CadastroCliente};

use App\Helpers\Tratamento;

use App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Session;

class FerramentaMensagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = FerramentaMensagem::select(
            DB::raw(
                "CONCAT(clientes.nome,' - ', clientes.cpf) AS cliente_nome"
            ),
            DB::raw(
                "CONCAT(empresas.nome,' - ', empresas.cpf) AS empresa_nome"
            ),
            'ferramentas_mensagem.*',
            'clientes.celular'
        )
            ->join('clientes', 'clientes.id', '=', 'ferramentas_mensagem.id_cliente')
            ->join('empresas', 'empresas.id', '=', 'clientes.id_empresa')
            ->get();


        return view('pages.ferramentas.mensagem.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Filtro para empresas
        $this->id_empresa = null;
        if (Session::has('empresa')) {
            if (Session::get('empresa')['id'] > 0) {
                $this->id_empresa = Session::get('empresa')['id'];
            }
        }

        $clientes = CadastroCliente::select("clientes.*", DB::raw("CONCAT(empresas.nome,' - ', empresas.cpf) AS empresa"))
            ->join('empresas', 'empresas.id', '=', "clientes.id_empresa")
            ->when($this->id_empresa, function ($query) {
                $query->where('clientes.id_empresa', $this->id_empresa);
            })
            ->where('clientes.status', 'Ativo')
            ->orderBy('clientes.nome', 'ASC')
            ->get();

        return view('pages.ferramentas.mensagem.form', compact('clientes'));
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
                'mensagem' => 'required',
                'titulo' => 'required'
            ],
            [
                'mensagem.required' => 'É necessário preencher a mensagem para enviar',
                'titulo.required' => 'Preencha o título da mensagem'
            ]
        );

        $mensagem = new FerramentaMensagem();
        $mensagem->titulo = $request->titulo;
        $mensagem->mensagem = $request->mensagem;
        $mensagem->id_cliente = ($request->input('id_cliente') == -1) ? '0' : $request->input('id_cliente');

        if ($mensagem->id_cliente > 0) {
            $cliente_celular = Tratamento::FormatarTelefone(CadastroCliente::select('celular')->find($request->id_cliente));
            if (ApiController::enviar_mensagem($cliente_celular, $mensagem->mensagem)) {
                $mensagem->tipo = "mensagem";
                $mensagem->whatsapp = $cliente_celular;
                $mensagem->status = 'Enviado';
                $mensagem->save();

                Alert::success('Muito bem ;)', 'Sua mensagem foi enviada com sucesso!');
                return redirect(route('ferramenta.mensagem'));
            }
        } else {

            // Filtro para empresas
            $this->id_empresa = null;
            if (Session::has('empresa')) {
                if (Session::get('empresa')['id'] > 0) {
                    $this->id_empresa = Session::get('empresa')['id'];
                }
            }

            $clientes = CadastroCliente::select("clientes.*", DB::raw("CONCAT(empresas.nome,' - ', empresas.cpf) AS empresa"))
                ->join('empresas', 'empresas.id', '=', "clientes.id_empresa")
                ->when($this->id_empresa, function ($query) {
                    $query->where('clientes.id_empresa', $this->id_empresa);
                })
                ->where('clientes.status', 'Ativo')
                ->orderBy('clientes.nome', 'ASC')
                ->get();

            foreach ($clientes as $cliente) {
                if (!$cliente->celular == "") {
                    $cliente_celular = Tratamento::FormatarTelefone($cliente->celular);
                    if (ApiController::enviar_mensagem($cliente_celular, $mensagem->mensagem)) {
                        $mensagem->id_cliente = $cliente->id;
                        $mensagem->tipo = "mensagem";
                        $mensagem->whatsapp = $cliente_celular;
                        $mensagem->status = 'Enviado';
                        $mensagem->save();
                    }
                }
            }

            Alert::success('Muito bem ;)', 'Sua mensagem foi enviada com sucesso!');
            return redirect(route('ferramenta.mensagem'));
        }
    }
}
