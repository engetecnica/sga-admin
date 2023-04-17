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

        dd($credentials);

        if (Auth::attempt($credentials)) {

            /** Verificação de Vínculo de Usuário */
            $usuario_vinculo = CadastroUsuariosVinculo::find(Auth::user()->id)->toArray();
            $request->session()->put("usuario_vinculo", $usuario_vinculo);

            if (!$usuario_vinculo) {
                Alert::error('Eita!', 'Infelizmente não encontramos suas credenciais e não podemos permitir seu aceso!');
                return redirect()->intended('login');
            }

            $id_obra = $usuario_vinculo->id_obra ?? null;

            if ($id_obra == null) {
                $obra_detalhes = [
                    'obra' => [
                        'id' => null,
                        'razao_social' =>
                        'SGA Todas as Obras',
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

        Alert::error('Urps!', 'Infelizmente os dados digitados não correspondem!');
        return redirect('login');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('pages.dashboard.index');
        }

        Alert::error('Urps!', 'Você não está logado!');
        return redirect('login');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
        Alert::success('Até a Próxima!', 'Logout efetuado com sucesso!');
        return redirect('login');
    }
}