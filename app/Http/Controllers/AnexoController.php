<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use Illuminate\Http\Request;

class AnexoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    static function store(Request $request, $input= "image")
    {
        //
        $request->validate([
            'file' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
        ],[
            'file.mimes' => 'O tipo de arquivo que você está tentando enviar não é válido.'
        ]);
    
        $anexo = new Anexo;

        if($request->file($input)) {
            
            $anexo->arquivo = time().'_'.$request->file($input)->getClientOriginalName();
            $anexo->diretorio = $request->file($input)->storeAs('uploads', $anexo->arquivo, 'public');
            $anexo->caminho = '/storage/' . $anexo->diretorio;
            $anexo->tipo = $request->file($input)->extension();
            return $anexo;
        }

        return [];
    }

}
