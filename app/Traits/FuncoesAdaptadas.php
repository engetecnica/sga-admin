<?php 

namespace App\Traits;

Trait FuncoesAdaptadas
{
    static function formata_moeda($expressao){
        $expressao = str_replace("R$ ", "", $expressao);
        $expressao = str_replace(",", '.', $expressao);
        return $expressao;
    }
}