<?php

namespace App\Http\Controllers;

use App\Models\{
    Anexo,
    AtivoExterno,
    AtivoExternoEstoque,
    CadastroEmpresa,
    FerramentalRetirada,
    FerramentalRetiradaItens,
    CadastroFuncionario,
    CadastroObra,
    Config,
    FerramentalRetiradaItem,
    FerramentalRetiradaItemDevolver
};

use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Storage
};

use RealRashid\SweetAlert\Facades\Alert;

use App\Traits\{
    Configuracao,
    FuncoesAdaptadas
};

use Illuminate\Support\Facades\Log;

use App\Helpers\Tratamento;

use PDF;

//Notification mail
use App\Notifications\NotificaRetirada;

//Notification telegram
use App\Notifications\NotificaRetiradaTelegram;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;

use Session;

class FerramentalRetiradaController extends Controller
{

    public function index()
    {
        $retiradas = FerramentalRetirada::with('obra', 'usuario', 'funcionario', 'situacao')->get();

        return view('pages.ferramental.retirada.index', compact('retiradas'));
    }

    public function create()
    {

        if (Session::get('obra')['id']) {
            $obras = CadastroObra::where('id', Session::get('obra')['id'])->where('status', 'Ativo')->get();
            $funcionarios = CadastroFuncionario::where('id_obra', Session::get('obra')['id'])->where('status', 'Ativo')->get();
            $estoques = AtivoExternoEstoque::where('id_obra', Session::get('obra')['id'])->with('ativo_externo', 'obra', 'situacao')->where('status', 4)->get();
        } else {
            $obras = CadastroObra::where('status', 'Ativo')->get();
            $funcionarios = CadastroFuncionario::where('status', 'Ativo')->get();
            $estoques = AtivoExternoEstoque::with('ativo_externo', 'obra', 'situacao')->where('status', 4)->get();
        }

        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();


        return view('pages.ferramental.retirada.form', compact('funcionarios', 'estoques', 'obras', 'empresas'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'id_obra' => 'required',
                'id_funcionario' => 'required',
                'id_ativo_externo' => 'required',
                'devolucao_prevista' => 'required'
            ],
            [
                'id_obra.required' => 'Qual obra você deseja efetivar esta retirada?',
                'id_funcionario.required' => 'Você precisa selecionar o funcionário.',
                'id_ativo_externo.required' => 'Nenhum item foi selecionado para retirada.',
                'devolucao_prevista.required' => 'Preencha a data e hora para devolução.'
            ]
        );

        $retirada = new FerramentalRetirada();
        $retirada->id_relacionamento = null;
        $retirada->id_obra = $request->id_obra;
        $retirada->id_usuario = Auth::user()->id ?? 1;
        $retirada->id_funcionario = $request->id_funcionario;
        $retirada->data_devolucao_prevista = $request->devolucao_prevista;
        $retirada->data_devolucao = null;
        $retirada->status = 1;
        $retirada->observacoes = $request->observacoes ?? NULL;
        $retirada->save();

        $id_retirada = $retirada->id;

        if ($id_retirada) {

            if ($request->id_ativo_externo) {
                foreach ($request->id_ativo_externo as $key => $value) {
                    $retirada_item = new FerramentalRetiradaItem();
                    $retirada_item->id_ativo_externo = $value;
                    $retirada_item->id_retirada = $id_retirada;
                    $retirada_item->status = 1;
                    $retirada_item->save();
                }
            }

            //Registro no Log
            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | ADD RETIRADA | ID: ' . $id_retirada . ' | DATA: ' . date('Y-m-d H:i:s'));

            //Notificação por e-mail no endereço cadastrado nas configurações de notificações
            // $email_config = Config::where('id', 1)->first();
            // $email_config->notify(new NotificaRetirada($email_config->email));

            // Notificação por telegram no canal registrado (API depende de https)
            if (env('APP_ENV') === 'development') {
                Notification::route('telegram', env('TELEGRAM_CHAT_ID'))
                    ->notify(new NotificaRetiradaTelegram('atendimento@codigosdigitais.com.br'));//$email_config->email
            }

            return redirect()->route('ferramental.retirada.detalhes', $id_retirada)->with('success', 'Sua retirada foi registrada com sucesso!');
        } else {
            return redirect()->route('ferramental.retirada')->with('error', 'Não foi possível registrar sua solicitação, entre em contato com suporte.');
        }
    }

    public function items(int $id)
    {
        if (!$id) {
            return redirect()->route('ferramental.retirada')->with('fail', 'Não foi possível localizar esta Retirada.');
        }
        $detalhes = FerramentalRetirada::getRetiradaItems($id);

        if (!$detalhes) {
            return redirect()->route('ferramental.retirada')->with('fail', 'Não foi possível localizar esta Retirada.');
        }

        return view('pages.ferramental.retirada.items', compact('detalhes'));
    }

    public function show(int $id)
    {
        if (!$id) {
            return redirect()->route('ferramental.retirada')->with('fail', 'Não foi possível localizar esta Retirada.');
        }

        $detalhes = FerramentalRetirada::getRetiradaItems($id);

        if (!$detalhes) {
            return redirect()->route('ferramental.retirada')->with('fail', 'Não foi possível localizar esta Retirada.');
        }

        return view('pages.ferramental.retirada.show', compact('detalhes'));
    }

    public function edit($id)
    {
        $obras = CadastroObra::where('status', 'Ativo')->get();

        $funcionarios = CadastroFuncionario::where('status', 'Ativo')->get();

        $itens = FerramentalRetirada::getRetiradaItems($id);

        $empresas = CadastroEmpresa::where('status', 'Ativo')->get();

        return view('pages.ferramental.retirada.edit', compact('obras', 'itens', 'funcionarios', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'id_obra' => 'required',
                'id_funcionario' => 'required',
                'id_ativo_externo' => 'required',
                'devolucao_prevista' => 'required'
            ],
            [
                'id_obra.required' => 'Qual obra você deseja efetivar esta retirada?',
                'id_funcionario.required' => 'Você precisa selecionar o funcionário.',
                'id_ativo_externo.required' => 'Nenhum item foi selecionado para retirada.',
                'devolucao_prevista.required' => 'Preencha a data e hora para devolução.'
            ]
        );

        $retirada = FerramentalRetirada::find($id);
        $retirada->id_relacionamento = null;
        $retirada->id_obra = $request->id_obra;
        $retirada->id_usuario = Auth::user()->id ?? 1;
        $retirada->id_funcionario = $request->id_funcionario;
        $retirada->data_devolucao_prevista = $request->devolucao_prevista;
        $retirada->data_devolucao = null;
        $retirada->status = 1;
        $retirada->observacoes = $request->observacoes ?? NULL;
        $retirada->update();

        $id_retirada = $retirada->id;

        if ($id_retirada) {

            if ($request->id_ativo_externo) {
                foreach ($request->id_ativo_externo as $key => $value) {
                    FerramentalRetiradaItem::where('id', $value)->delete();
                }
            }

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | EDIT RETIRADA | ID: ' . $id_retirada . ' | DATA: ' . date('Y-m-d H:i:s'));

            return redirect()->route('ferramental.retirada.detalhes', $id_retirada)->with('success', 'Sua retirada foi modificada com sucesso!');
        } else {
            return redirect()->route('ferramental.retirada')->with('fail', 'Não foi possível registrar sua solicitação, entre em contato com suporte.');
        }
    }

    public function destroy($id)
    {
        $retirada = FerramentalRetirada::findOrFail($id);
        $retirada->status = 6;

        $itens = FerramentalRetiradaItem::where('id_retirada', $retirada->id)->get();

        foreach ($itens as $item) {
            $restart = AtivoExternoEstoque::where('id', $item->id_ativo_externo)->first();
            $restart->update(['status' => 4]);

            $item->update(['status' => 6]);
        }



        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | CANCEL RETIRADA | ID: ' . $id . ' | DATA: ' . date('Y-m-d H:i:s'));

        if($retirada->save()){
            return redirect()->route('ferramental.retirada')->with('success', 'Retirada cancelada com sucesso');
        } else {
            return redirect()->route('ferramental.retirada')->with('error', 'Não foi possível cancelar a retirada, entre em contato com suporte!');
        }
    }


    /**
     * Termo de Responsabilidade
     * Upload do termo automaticamente via storage
     */
    public function termo(int $id)
    {
        /** Get Detalhes */
        $detalhes = FerramentalRetirada::getRetiradaItems($id);

        /** Nome do Arquivo */
        $termo_responsabilidade = 'termo_retirada_' . date("dmYHis") . '.pdf';

        $termo = FerramentalRetirada::find($id);
        $termo->termo_responsabilidade_gerado = now();
        $termo->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | GEROU TERMO RETIRADA: ' . $termo->termo_responsabilidade_gerado);

        // /** Salvar autenticação (upload do termo) */
        // $autenticar = new Autenticar();
        // $autenticar->id_retirada = $id ?? null;
        // $autenticar->id_usuario = Auth::user()->id ?? 1;
        // $autenticar->id_funcionario = $detalhes->id_funcionario ?? null;
        // $autenticar->termo_responsabilidade = $termo_responsabilidade;
        // $autenticar->save();

        /** Upload do Termo Automatico */
        // $pdf = PDF::loadView('components.termo.termo_retirada', compact('detalhes'));
        // $content = $pdf->download()->getOriginalContent();
        // Storage::put('public/uploads/termos_retirada/' . $termo_responsabilidade, $content);

        /** Gerar PDF e mostra na tela */
        $pdf = PDF::loadView('components.termo.termo_retirada', compact('detalhes'));
        return $pdf->stream($termo_responsabilidade, array("Attachment" => false));
    }


    /** Download do Termo Atual */
    public function termo_download(int $id)
    {

        $termo_responsabilidade = (FerramentalRetirada::getRetiradaItems($id)->anexo->arquivo) ?? null;

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | DOWNLOAD TERMO RETIRADA: ' . $termo_responsabilidade);

        if ($termo_responsabilidade === null) {
            Alert::error('Atenção', 'Não foi possível localizar o arquivo solicitado.');
            return redirect(route('ferramental.retirada'));
        }
        return Storage::download('public/uploads/termos_retirada/' . $termo_responsabilidade);
    }

    /**
     * Listagem de Retiradas
     * Via service-side
     */
    // public function lista(Request $request)
    // {
    //     if ($request->ajax()) {

    //         $listaRetirada = FerramentalRetirada::getRetirada();

    //         return DataTables::of($listaRetirada)

    //             ->editColumn('created_at', function ($row) {
    //                 return ($row->created_at) ? Tratamento::FormatarData($row->created_at) : '-';
    //             })
    //             ->editColumn('devolucao', function ($row) {
    //                 return ($row->data_devolucao_prevista) ? Tratamento::FormatarData($row->data_devolucao_prevista) : '-';
    //             })
    //             ->editColumn('status', function ($row) {
    //                 $status_classe = Tratamento::getStatusRetirada($row->status)['classe'];
    //                 $status_titulo = Tratamento::getStatusRetirada($row->status)['titulo'];
    //                 $status = "<div class='badge badge-" . $status_classe . "'>" . $status_titulo . "</div>";
    //                 return $status;
    //             })
    //             ->editColumn('acoes', function ($row) {

    //                 $dropdown = '<div class="dropdown"><div class="btn-group"><button class="btn btn-gradient-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Selecione</button><ul class="dropdown-menu" aria-labelledby="drodownAcoes">';

    //                 /** Devolver Itens */
    //                 if ($row->status == "2" || $row->status == "5" && $row->termo_responsabilidade_gerado) {
    //                     $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.devolver', $row->id) . '"><i class="mdi mdi-redo-variant"></i> Devolver Itens</a></li>';
    //                 }

    //                 /** Gerar Termo */
    //             if ($row->status == "1" && !$row->termo_responsabilidade_gerado) {
    //                     $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.termo', $row->id) . '"><i class="mdi mdi-access-point-network"></i> Gerar Termo</a></li>';
    //                 }

    //                 /** Baixar Termo */
    //             if ($row->status == "2" or $row->status == "3" && $row->termo_responsabilidade_gerado) {
    //                     $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.termo', $row->id) . '"><i class="mdi mdi-download"></i> Baixar Termo</a></li>';
    //                 }

    //             if ($row->status == "1" && !$row->termo_responsabilidade_gerado) {

    //                 /** Modificar Retirada */
    //                 $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.editar', $row->id) . '"><i class="mdi mdi-pencil"></i> Modificar Retirada</a></li>';

    //                 /** Cancelar Retirada */
    //                 $dropdown .= '<li><form action="' . route('ferramental.retirada.destroy', $row->id) . '" method="POST">'.csrf_field().'<input type="hidden" name="_method" value="DELETE"><button type="submit" class="dropdown-item" onclick="return confirm(\'Deseja realmente cancelar a retirada?\')"><i class="mdi mdi-cancel"></i> Cancelar Retirada</button></form></li>';

    //             }

    //                 $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.detalhes', $row->id) . '"><i class="mdi mdi-minus"></i> Detalhes</a></li> ';

    //                 /** Ver Termo */
    //             if ($row->status == "3" or $row->status == "4" && $row->termo_responsabilidade_gerado) {
    //                 $dropdown .= '<li><a class="dropdown-item" href="' . route('ferramental.retirada.termo', $row->id) . '"><i class="mdi mdi-printer"></i> Ver Termo</a></li></ul></div>';
    //             }

    //                 return $dropdown;
    //             })
    //             ->rawColumns(['acoes', 'status'])
    //             ->make(true);
    //     }
    // }

    /**
     * Devolver Itens
     * getRetiradaItems id_retirada
     */
    public function devolver(int $id)
    {
        if (!$id) {
            Alert::error('Atenção', 'Não foi possível localizar esta Retirada.');
            return redirect(route('ferramental.retirada'));
        }

        $detalhes = FerramentalRetirada::getRetiradaItems($id);

        if (!$detalhes) {
            Alert::error('Atenção', 'Não foi possível localizar esta Retirada.');
            return redirect(route('ferramental.retirada'));
        }

        return view('pages.ferramental.retirada.devolver', compact('detalhes'));
    }

    /**
     * Salvar devolução
     */

    public function devolver_salvar(Request $request)
    {

        if ($request->id_ativo_externo) {

            $status_retirada = null;

            foreach ($request->id_ativo_externo as $key => $value) {

                if($value == 2) {
                    $status_retirada = 2;
                } else {
                    $status_retirada = $value;
                }

                /** Salvar Retirada Item */
                $item = FerramentalRetiradaItemDevolver::find($key);
                $item->status = $value ?? 1;
                $item->save();

                /** Salvar Ativo Externo */
                $estoque = AtivoExternoEstoque::find($item->id_ativo_externo);
                $estoque->status = 4; // em estoque
                $estoque->save();
            }

            /** Salvar Retirada */
            $retirada = FerramentalRetirada::find($item->id_retirada);
            $retirada->devolucao_observacoes = $request->observacoes ?? null;
            $retirada->data_devolucao = now();
            $retirada->updated_at = now();
            $retirada->status = $status_retirada;
            $retirada->save();

            $userLog = Auth::user()->email;
            Log::channel('main')->info($userLog .' | SALVOU DEVOLUÇÃO: ' . $retirada->devolucao_observacoes);

            return redirect()->back()->with('success', 'Retirada salva com sucesso!');
        }
    }
}
