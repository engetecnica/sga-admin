<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracaoUsuario;
use App\Models\CadastroEmpresa;
use App\Models\CadastroFuncionario;
use App\Models\CadastroUsuariosVinculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ConfiguracaoUsuarioNiveis as Niveis;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class ConfiguracaoUsuarioController extends Controller
{
    public function index()
    {
        //
        $permite_excluir = 0;
        $lista = ConfiguracaoUsuario::select(
            "usuarios_niveis.titulo as nivel",
            "users.*"
        )
            ->join(
                "usuarios_vinculos",
                "usuarios_vinculos.id_usuario",
                "=",
                "users.id",
            )
            ->join(
                "usuarios_niveis",
                "usuarios_niveis.id",
                "=",
            "usuarios_vinculos.id_nivel",
        )->orderBy('name', 'ASC')
        ->get();

        return view('pages.configuracoes.usuario.index', compact('lista', 'permite_excluir'));
    }

    public function create()
    {
        $usuario_niveis = Niveis::all();
        $funcionarios = CadastroFuncionario::all();
        return view('pages.configuracoes.usuario.form', compact('usuario_niveis', 'funcionarios'));
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
                'id_funcionario' => 'required',
                'password' => 'required|min:5',
                'password_confirm' => 'required|min:5|same:password',
                'nivel' => 'required',
                'status' => 'required'
            ],
            [
                'id_funcionario.required' => 'Escolha um funcionário',
                'password.required' => 'É necessário digitar uma senha que contenha no mínimo 5 caracteres',
                'password_confirm.required' => 'A confirmação de senha é necessária',
                'password_confirm.same' => 'As senhas digitadas não são iguais',
                'nivel.required' => 'Escolha um nível de acesso',
                'status.required' => 'Escolha um status'
            ]
        );

        $funcionario = CadastroFuncionario::find($request->id_funcionario);

        $user = new ConfiguracaoUsuario();
        $user->name = $funcionario->nome;
        $user->password = Hash::make($request->password);
        $user->email = $funcionario->email;
        if ($user->save()) {
            $user_vinculo = new CadastroUsuariosVinculo();
            $user_vinculo->id_usuario = $user->id;
            $user_vinculo->id_obra  = $funcionario->id_obra ?? null;
            $user_vinculo->id_funcionario  = $funcionario->id;
            $user_vinculo->id_nivel  = $request->nivel ?? 1;
            $user_vinculo->status = $request->status ?? 1;
            $user_vinculo->save();
        }

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD CONFIGURACAO USUARIO: ' . $user->name .' | -> OBRA: ' .  $user_vinculo->id_obra .' | -> NIVEL: ' . $user_vinculo->id_nivel);

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect(route('usuario'));
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
    public function edit($id = null)
    {

        $store = ConfiguracaoUsuario::find($id);
        $usuario_niveis = Niveis::all();
        $empresas = CadastroEmpresa::all();

        if (!$id or !$store) :
            Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
            return redirect(route('usuario'));
        endif;

        if ($id == Auth::user()->id) :
            Alert::error('Que Pena!', 'Você não poderá modificar seu próprio usuário!');
            return redirect(route('usuario'));
        endif;

        return view('pages.configuracoes.usuario.form', compact('store', 'usuario_niveis', 'empresas'));
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

        $user = ConfiguracaoUsuario::find($id);
        $user->name = $request->nome;
        $user->email = $request->email;

        if (Auth::user()->user_level == 1) {
            $user->user_level = $request->nivel;
        }

        $user->id_empresa = $request->id_empresa;

        if (isset($request->password) && isset($request->password_confirm)) {
            if ($request->password === $request->password_confirm) {
                $user->password = Hash::make($request->password);
            } else {
                Alert::error('Erro', 'As senhas digitadas devem ser iguais.');
                return redirect(route('usuario.adicionar'));
            }
        }

        $user->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT CONFIGURACAO USUARIO: ' . $user->name);

        Alert::success('Muito bem ;)', 'Registro modificado com sucesso.');
        return redirect(route('usuario'));
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
