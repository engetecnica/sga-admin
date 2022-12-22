<?php

namespace App\Traits;


/* 
 * Estrutura de configurações extras que não necessitam do banco de dados
 * @acoes_permitidas
 * @integrador
 * @tipo_pix
 */

Trait Configuracao
{



    /* Ações Permitidas */
    static function acoes_permitidas()
    {
        return [
            'Visualizar' => 'view',
            'Adicionar' => 'add',
            'Editar' => 'edit',
            'Excluir' => 'delete',
            'Outros' => 'other'
        ];
    }

    /* Integradores de Pagamento */
    static function integrador()
    {
        return [
            'Cielo', 
            'Rede', 
            'Stone Pagamentos',
            'Mercado Pago'
        ];
    }

    /* Configurações para Tipos de Pix */
    static function tipo_pix()
    {
        return [
            'Celular',
            'CPF',
            'CNPJ',
            'E-mail', 
            'Chave Aleatória'
        ];
    }


    /* Estados */
    static function estados()
    {
        return [
                'AC' => 'Acre',
                'AL' => 'Alagoas',
                'AP' => 'Amapá',
                'AM' => 'Amazonas',
                'BA' => 'Bahia',
                'CE' => 'Ceará',
                'DF' => 'Distrito Federal',
                'ES' => 'Espírito Santo',
                'GO' => 'Goiás',
                'MA' => 'Maranhão',
                'MT' => 'Mato Grosso',
                'MS' => 'Mato Grosso do Sul',
                'MG' => 'Minas Gerais',
                'PA' => 'Pará',
                'PB' => 'Paraíba',
                'PR' => 'Paraná',
                'PE' => 'Pernambuco',
                'PI' => 'Piauí',
                'RJ' => 'Rio de Janeiro',
                'RN' => 'Rio Grande do Norte',
                'RS' => 'Rio Grande do Sul',
                'RO' => 'Rondônia',
                'RR' => 'Roraima',
                'SC' => 'Santa Catarina',
                'SP' => 'São Paulo',
                'SE' => 'Sergipe',
                'TO' => 'Tocantins'
        ];
            
    }

}

