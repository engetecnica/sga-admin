<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracaoUsuarioNiveis as UsuarioTipo;
use App\Models\ConfiguracaoModulo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConfiguracaoUsuarioTipoController extends Controller
{

    public function index()
    {
        $permite_excluir = 0;

        $lista = UsuarioTipo::orderBy('titulo', 'ASC')->get();

        return view('pages.configuracoes.usuario_tipo.index', compact('lista', 'permite_excluir'));
    }

    public function create()
    {
        $modulos = ConfiguracaoModulo::get_modulos();

        return view('pages.configuracoes.usuario_tipo.form', compact('modulos'));
    }

    public function store(Request $request)
    {
        $tipo = new UsuarioTipo();
        $tipo->titulo = $request->nome;
        $tipo->permissoes = json_encode(($request->permission) ?? []);
        $tipo->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD TIPO USUARIO: ' . $tipo->titulo);

        return redirect()->route('usuario_tipo')->with('success', 'Um registro foi adicionado com sucesso!');
    }

    public function edit($id=null)
    {
        $modulos = ConfiguracaoModulo::get_modulos();

        $store = UsuarioTipo::find($id);

        if (!$id or !$store) {
            return redirect()->route('usuario_tipo')->with('fail', 'Registro não encontrado!');
        }

        return view('pages.configuracoes.usuario_tipo.form', compact('store', 'modulos'));
    }

    public function update(Request $request, $id)
    {
        $tipo = UsuarioTipo::find($request->id);
        $tipo->titulo = $request->nome;
        $tipo->permissoes = json_encode(($request->permission) ?? []);
        $tipo->save();

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT TIPO USUARIO: ' . $tipo->titulo);

        return redirect()->route('usuario_tipo')->with('success', 'Registro modificado com sucesso.');
    }

}
