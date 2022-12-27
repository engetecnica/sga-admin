<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracaoUsuario;
use App\Models\CadastroEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConfiguracaoUsuarioNiveis as Niveis;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;




class ConfiguracaoUsuarioController extends Controller
{
    public function index()
    {
        //
        $permite_excluir = 0;
        $lista = ConfiguracaoUsuario::select("usuarios_niveis.titulo as nivel", "users.*")
                                            ->join(
                                                    "usuarios_niveis", 
                                                    "usuarios_niveis.id", 
                                                    "=", 
                                                    "users.user_level"
                                            )
                                            ->orderBy('name', 'ASC')
                                            ->get();
        
        return view('pages.configuracoes.usuario.index', compact('lista', 'permite_excluir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $usuario_niveis = Niveis::all();
        $empresas = CadastroEmpresa::all();
        return view('pages.configuracoes.usuario.form', compact('usuario_niveis', 'empresas'));
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
                'nome' => 'required',
                'id_empresa' => 'required',
                'password' => 'required|min:5',
                'password_confirm' => 'required|min:5|same:password',
                'email' => 'required|email|unique:users,email',
                'nivel' => 'required'
            ], 
            [
                'nome.required' => 'O nome do usuário deve ser preenchido corretamente',
                'id_empresa.required' => 'Selecione a empresa para vincular.',
                'password.required' => 'É necessário digitar uma senha que contenha no mínimo 5 caracteres',
                'password_confirm.required' => 'A confirmação de senha é necessária',
                'password_confirm.same' => 'As senhas digitadas não são iguais',
                'email.unique' => 'Este e-mail já está registrado'
            ]
        );

        $user = new ConfiguracaoUsuario();
        $user->id_empresa = $request->id_empresa;
        $user->name = $request->nome;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->user_level = $request->nivel;
        $user->save();

        Alert::success('Muito bem ;)', 'Um registro foi adicionado com sucesso!');
        return redirect('configuracao/usuario');       
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
    public function edit($id=null)
    {

        $store = ConfiguracaoUsuario::find($id);
        $usuario_niveis = Niveis::all();
        $empresas = CadastroEmpresa::all();

            if(!$id or !$store):  
                Alert::error('Que Pena!', 'Esse registro não foi encontrado.');
                return redirect('configuracao/usuario'); 
            endif;

            if($id == Auth::user()->id): 
                Alert::error('Que Pena!', 'Você não poderá modificar seu próprio usuário!');
                return redirect('configuracao/usuario');  
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
        $user->user_level = $request->nivel;
        $user->id_empresa = $request->id_empresa;

        if(isset($request->password) && isset($request->password_confirm)){
            if($request->password === $request->password_confirm){
                $user->password = Hash::make($request->password);
            } else {
                Alert::error('Erro', 'As senhas digitadas devem ser iguais.');
                return redirect('configuracao/usuario');
            }
        }

        $user->save();

        Alert::success('Muito bem ;)', 'Registro modificado com sucesso.');
        return redirect('configuracao/usuario');         
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
