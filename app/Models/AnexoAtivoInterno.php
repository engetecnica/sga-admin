<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnexoAtivoInterno extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'anexo_ativo_internos';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_ativo_interno',
        'id_usuario',
        'titulo',
        'arquivo',
        'descricao',
        'tipo'
    ];

    public function ativoInterno()
    {
        return $this->belongsTo(AtivosInterno::class, 'id_ativo_interno', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
