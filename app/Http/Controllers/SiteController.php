<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\ProdutoAssociar as Produto;
use App\Models\Aplicativos;

class SiteController extends Controller
{
    //
    public function index()
    {
        $site = Site::find(1);
        $produtos = Produto::select("produtos.titulo", "produtos_configuracoes.*")
                                ->join("produtos", "produtos.id", "=", "produtos_configuracoes.id_produto")
                                ->where(
                                    'produtos_configuracoes.id_empresa', 
                                    $site->id_empresa
                                )
                                ->get();
        $aplicativos = Aplicativos::all();

        return view('site.views.index', compact('site', 'produtos', 'aplicativos'));
    }

    public function comofunciona(){
        echo "Como funciona?";
    }
}