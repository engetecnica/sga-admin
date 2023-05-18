<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;

use App\Models\{
    CadastroObra,
    CadastroUsuariosVinculo
};

use App\Traits\FuncoesAdaptadas;
use RealRashid\SweetAlert\Facades\Alert;



class CustomAuthController extends Controller
{

    use FuncoesAdaptadas;

    public function index()
    {
        if(Auth::check()){
            return redirect()->intended('dashboard');
        }
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {

            /** Verificação de Vínculo de Usuário */
            $usuario_vinculo = CadastroUsuariosVinculo::find(Auth::user()->id)->toArray();
            $request->session()->put("usuario_vinculo", $usuario_vinculo);

            if (!$usuario_vinculo) {

                return redirect('login');
            }

            $id_obra = $usuario_vinculo->id_obra ?? null;

            if ($id_obra == null) {
                $obra_detalhes = [
                    'obra' => [
                        'id' => null,
                        'razao_social' => 'SGA Todas as Obras',
                        'codigo_obra' => 'SGAE-OBRA-ADM'
                    ]
                ];
            } else {
                $obra_detalhes = CadastroObra::find($id_obra);
            }

            $request->session()->put("obra", $obra_detalhes);

            Alert::success('Seja bem vindo ;)', 'Você acabou de fazer o login no sistema!');
            return redirect()->intended('dashboard');

        }


        return redirect()->route('login')->with('error', 'Email ou senha inválidos');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('pages.dashboard.index');
        }

        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('login');
    }

    public function signOut(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
