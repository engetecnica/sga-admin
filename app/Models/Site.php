<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $table = "sites_configuracoes";

    protected $fillable = [
        'id_empresa',
        'id_usuario',
        'titulo',
        'url_principal',
        'email',
        'whatsapp',
        'logo',
        'rodape',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
}
