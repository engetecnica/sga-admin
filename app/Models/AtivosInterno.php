<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtivosInterno extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'obra_id',
        'numero_serie',
        'patrimonio',
        'titulo',
        'marca',
        'valor_atribuido',
        'descricao',
        'status'
    ];


    public function obra()
    {
        return $this->belongsTo(CadastroObra::class);
    }

}
