<?php

namespace App\Http\Controllers;

use App\Models\FerramentaCobranca;
use Illuminate\Http\Request;

class FerramentaCobrancaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "Inicio do método de cobrança ";
    }


    public function cobranca_automatica()
    {
        $hoje = NOW();
        echo $hoje;
    }
}
