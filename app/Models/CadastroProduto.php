<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class CadastroProduto extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "produtos";

    static function associados()
    {
        $produto = CadastroProduto::get();
        foreach($produto as &$key)
        {
            $key->associados = ProdutoAssociar::where('id_produto', $key->id)->get();
        }

        return $produto;
    }
}
