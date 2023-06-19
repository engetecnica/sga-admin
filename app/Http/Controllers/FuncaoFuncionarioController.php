<?php

namespace App\Http\Controllers;

use App\Models\CadastroFuncionario;
use App\Models\FuncaoFuncionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FuncaoFuncionarioController extends Controller
{
    public function index()
    {
        $funcoes = FuncaoFuncionario::with('funcionarios')->get();

        return view('pages.cadastros.funcionario.funcoes.index', compact('funcoes'));
    }

    public function create()
    {
        return view('pages.cadastros.funcionario.funcoes.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $save =  FuncaoFuncionario::create($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD FUNCAO FUNCIONARIO: ' . $save->funcao);

        if($save){
            return redirect()->route('cadastro.funcionario.funcoes.index')->with('success', 'Função cadastrada com sucesso!');
        } else {
            return redirect()->route('cadastro.funcionario.funcoes.index')->with('fail', 'Erro ao cadastrar função.');
        }
    }

    public function edit($id)
    {
        $funcao = FuncaoFuncionario::find($id);

        return view('pages.cadastros.funcionario.funcoes.edit', compact('funcao'));
    }

    public function update(Request $request, $id)
    {
        if (! $save = FuncaoFuncionario::find($id)) {
            return redirect()->route('cadastro.funcionario.funcoes.index')->with('fail', 'Registro não encontrado.');
        }

        $data = $request->all();
        $save->update($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | EDIT FUNCAO FUNCIONARIO: ' . $save->funcao);

        return redirect()->route('cadastro.funcionario.funcoes.edit', $id)->with('success', 'Registro atualizado com sucesso.');
    }

    public function destroy(FuncaoFuncionario $funcao)
    {
        $funcionarios = CadastroFuncionario::where('id_funcao', $funcao->id)->count();

        if ($funcionarios > 0) {
            return redirect()->route('cadastro.funcionario.funcoes.index')->with('fail', 'Há funcionários com essa função');
        } else {
            $funcao->delete();
            return redirect()->route('cadastro.funcionario.funcoes.index')->with('success', 'Função deletada com sucesso.');
        }

    }

    public function fastStore(Request $request)
    {
        $data = $request->all();
        $data['status'] = 'Ativo';
        $save = FuncaoFuncionario::create($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD OBRA RÁPIDO: ' . $save->razao_social . ' | CÓDIGO OBRA : ' . $save->codigo_obra);

        if ($save) {
            return redirect()->back()->with('success', 'Um registro foi adicionado com sucesso!');
        } else {
            return redirect()->back()->with('fail', 'Um erro impediu o cadastro.');
        }

    }

    public function storeFuncao(Request $request)
    {
        $data = $request->all();
        $save = FuncaoFuncionario::create($data);

        $userLog = Auth::user()->email;
        Log::channel('main')->info($userLog .' | ADD FUNCAO FUNCIONARIO: ' . $save->funcao);

        if ($save) {
            return response()->json(['success' => true, 'funcao_id' => $save->id, 'funcao' => $save->funcao, 'codigo' => $save->codigo]);
        } else {
            return response()->json(['fail' => true]);
        }
    }
}
