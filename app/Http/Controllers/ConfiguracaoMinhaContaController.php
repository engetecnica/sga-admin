<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConfiguracaoUsuarioNiveis as Niveis;
Use App\Models\User;
use Illuminate\Support\Facades\Hash;


use RealRashid\SweetAlert\Facades\Alert;

class ConfiguracaoMinhaContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        $usuario_niveis = Niveis::all();
        return view('pages.configuracoes.minhaconta.index', compact('usuario_niveis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $id_usuario = Auth::user()->id;

        if($id_usuario)
        {         

            $user = User::find($id_usuario);
            $user->name = $request->nome;

            if (Auth::user()->user_level == 1) {
                $user->user_level = $request->nivel;
            }

            if(isset($request->password) && isset($request->password_confirm)){
                if($request->password === $request->password_confirm){
                    $user->password = Hash::make($request->password);
                } else {
                    Alert::error('Erro', 'As senhas digitadas devem ser iguais.');
                    return redirect(route('minhaconta'));
                }
            }

            $user->save();

            Alert::success('Muito bem ;)', 'Registro modificado com sucesso.');
            return redirect(route('minhaconta'));

        } else {

        }
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
    public function edit($id)
    {
        //
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
        //
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
