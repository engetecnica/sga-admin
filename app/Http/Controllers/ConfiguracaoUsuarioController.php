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

class ConfiguracaoUsuarioController extends Controller
{
    public function index()
    {
        $permite_excluir = 0;
        $lista = ConfiguracaoUsuario::select("usuarios_niveis.titulo as nivel", "users.*")
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

        return redirect()->route('usuario')->with('success', 'Um registro foi adicionado com sucesso!');
    }

    public function edit($id = null)
    {
        $store = ConfiguracaoUsuario::with('vinculo')->find($id);
        $usuario_niveis = Niveis::all();
        $empresas = CadastroEmpresa::all();
        $funcionarios = CadastroFuncionario::all();

        if (!$id or !$store) :
            return redirect()->route('usuario')->with('fail', 'Esse registro não foi encontrado.');
        endif;

        if ($id == Auth::user()->id) :
            return redirect()->route('usuario')->with('fail', 'Você não pode modificar seu próprio usuário.');
        endif;

        return view('pages.configuracoes.usuario.form', compact('store', 'usuario_niveis', 'empresas', 'funcionarios'));
    }

    public function update(Request $request, $id)
    {
        $user = ConfiguracaoUsuario::find($id);
        // $user->name = $request->nome;
        // $user->email = $request->email;

        if (Auth::user()->user_level == 1) {
            $user->user_level = $request->nivel;
        }

        if (isset($request->password) && isset($request->password_confirm)) {
            if ($request->password === $request->password_confirm) {
                $user->password = Hash::make($request->password);
            } else {
                return redirect()->route('usuario.adicionar')->with('fail', 'As senhas digitadas devem ser iguais.');
            }
        }

        $user->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT CONFIGURACAO USUARIO: ' . $user->name);

        return redirect()->route('usuario')->with('success', 'Um registro foi modificado com sucesso!');
    }

    public function destroy(ConfiguracaoUsuario $id)
    {
        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog . ' | DELETE USUÁRIO : ' . $id->nome);

        CadastroUsuariosVinculo::where('id_usuario', $id)->delete();


        if ($id->delete()) {
            return redirect()->route('usuario')->with('success', 'Usuário excluído com sucesso!');
        } else {
            return redirect()->route('usuario')->with('fail', 'Usuário excluído com sucesso!');
        }
    }
}
