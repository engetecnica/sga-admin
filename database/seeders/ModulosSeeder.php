<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modulos = array(
            [
                'id_modulo' => 0,
                'titulo' => 'Configurações',
                'posicao' => 4,
                'url_amigavel' => 'configuracao',
                'icone' => 'mdi mdi-cogs',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL
            ],
            [
                'id_modulo' => 1,
                'titulo' => 'Tipos de Usuário',
                'posicao' => 4,
                'url_amigavel' => 'admin/configuracao/usuario_tipo',
                'icone' => 'mdi mdi-account-child',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' =>  NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 1,
                'titulo' => 'Usuários',
                'posicao' => 5,
                'url_amigavel' => 'admin/configuracao/usuario',
                'icone' => '', 'tipo_de_acao' =>
                'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 1,
                'titulo' => 'SGA Configurações',
                'posicao' => 2,
                'url_amigavel' => 'admin/configuracao/sistema',
                'icone' => '',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 1,
                'titulo' => 'Módulos',
                'posicao' => 3,
                'url_amigavel' => 'admin/configuracao/modulo',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 0,
                'titulo' => 'Cadastros',
                'posicao' => 1,
                'url_amigavel' => 'cadastro',
                'icone' => 'mdi mdi-paperclip',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 6,
                'titulo' => 'Empresas',
                'posicao' => 1,
                'url_amigavel' => 'admin/cadastro/empresa',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 6,
                'titulo' => 'Funcionários',
                'posicao' => 2,
                'url_amigavel' => 'admin/cadastro/funcionario',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 6,
                'titulo' => 'Fornecedores',
                'posicao' => 3,
                'url_amigavel' => 'admin/cadastro/fornecedor',
                'icone' => '',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 6,
                'titulo' => 'Obras',
                'posicao' => 4,
                'url_amigavel' => 'admin/cadastro/obra',
                'icone' => '',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 0,
                'titulo' => 'Ativos',
                'posicao' => 2,
                'url_amigavel' => 'ativo',
                'icone' => 'mdi mdi-wrench',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 11,
                'titulo' => 'Ativo Interno',
                'posicao' => 2,
                'url_amigavel' => 'admin/ativo/interno',
                'icone' => '',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 11,
                'titulo' => 'Ativo Externo',
                'posicao' => 3,
                'url_amigavel' => 'admin/ativo/externo',
                'icone' => '',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 11,
                'titulo' => 'Veículos',
                'posicao' => 4,
                'url_amigavel' => 'admin/ativo/veiculo',
                'icone' => '',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'id_modulo' => 1,
                'titulo' => 'Geral',
                'posicao' => 1,
                'url_amigavel' => 'admin/configuracao/geral',
                'icone' => NULL,
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 11,
                'titulo' => 'Configurações',
                'posicao' => 1, 'url_amigavel' => 'admin/ativo/configuracao',
                'icone' => NULL,
                'tipo_de_acao' =>
                'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 0,
                'titulo' => 'Ferramental',
                'posicao' => 3,
                'url_amigavel' => 'ferramental',
                'icone' => 'mdi mdi-bullseye-arrow',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 17,
                'titulo' => 'Retiradas',
                'posicao' => 1,
                'url_amigavel' => 'admin/ferramental/retirada',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 17,
                'titulo' => 'Requisições',
                'posicao' => 1,
                'url_amigavel' => 'admin/ferramental/requisicao',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 0,
                'titulo' => 'Relatórios',
                'posicao' => 5,
                'url_amigavel' => 'relatorio',
                'icone' => 'mdi mdi-keyboard-settings',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 20,
                'titulo' => 'Veículos',
                'posicao' => 1,
                'url_amigavel' => 'admin/relatorio/veiculos',
                'icone' => NULL,
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 20,
                'titulo' => 'Relatórios Emitidos',
                'posicao' => 2,
                'url_amigavel' => 'admin/relatorio/emitido',
                'icone' => NULL,
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 0,
                'titulo' => 'SGA-E | Ferramentas',
                'posicao' => 5,
                'url_amigavel' => 'ferramenta',
                'icone' => 'mdi mdi-database',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 23,
                'titulo' => 'Desmobilização',
                'posicao' => 1,
                'url_amigavel' => 'admin/ferramenta/desmobilizacao',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'id_modulo' => 23,
                'titulo' => 'Download Backup',
                'posicao' => 2,
                'url_amigavel' => 'admin/ferramenta/backupsql',
                'icone' => NULL, 'tipo_de_acao' => 'other', 'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ]
        );

        

        DB::table('modulos')->insert(
            $modulos
        );
    }
}
