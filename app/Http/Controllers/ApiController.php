<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CadastroEmpresa;
use RealRashid\SweetAlert\Facades\Alert;


class ApiController extends Controller
{
    //
    public function selecionar_empresa(Request $Request)
    {
        if(Auth::user()->user_level==1){
            $empresa = CadastroEmpresa::find($Request->id_empresa);
            $Request->session()->put(
                'empresa',
                $empresa
            );
            echo "alterado";
        } else {
            echo "erro";
        }
    }
}
