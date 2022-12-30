<?php 

namespace App\Traits;

Trait FuncoesAdaptadas
{
    static function formata_moeda($expressao){
        $expressao = str_replace("R$ ", "", $expressao);
        $expressao = str_replace(",", '.', $expressao);
        return $expressao;
    }

    static function dd(...$data)
    {
        foreach ($data as $dt) {
            echo "<pre>";
            echo print_r($dt, true);
            echo "</pre>";
        }
        exit;
    }

    public function importar_cliente_nome($nome){        
        if(!$nome) return null;
        return mb_strtoupper(str_replace("+", "", $nome));        
    }

    
}