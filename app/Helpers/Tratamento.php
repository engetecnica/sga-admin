<?php

namespace App\Helpers;

use DateTime;
use App\Models\AtivoExernoStatus;
use App\Models\FerramentalRetiradaStatus;

class Tratamento
{


    /* Formatação do Número do celular com link para WhatsApp */
    public static function SetURLWhatsApp(string $celular)
    {
        if (!$celular) return "";        
        $URL_WP = "https://api.whatsapp.com/send?phone=55";
        return $URL_WP.preg_replace('/[^0-9]/', '', $celular);
    }

    /* Formatar Telefone */
    public static function FormatarTelefone(string $celular)
    {
        if (!$celular) return "";
        return preg_replace('/[^0-9]/', '', $celular);
    }

    /* Formatar data com strtotime() */
    public static function FormatarData($data)
    {
        if (!$data) return date("d/m/Y - H:i");
        return date("d/m/Y - H:i", strtotime($data));
    }

    /* Saudação */
    public static function SaudacaoHorario()
    {
        $hora = date("H", strtotime(NOW()));

        if (
            $hora >= 6 && $hora <= 12
        ) {
            return "Bom dia";
        } elseif (
            $hora > 12 && $hora <= 18
        ) {
            return "Boa tarde";
        } else {
            return "Boa noite";
        }

        return "Não foi possível identificar.";
    }

    /* Get Status do Estoque */
    public static function getStatusEstoque($status){
        $pesquisaStatus = AtivoExernoStatus::find($status)->toArray();
        if($pesquisaStatus){
            return $pesquisaStatus;
        }

        return null;
    }

    /* Get Status do Retirada */
    public static function getStatusRetirada($status)
    {
        $pesquisaStatus = FerramentalRetiradaStatus::find($status)->toArray();
        if ($pesquisaStatus) {
            return $pesquisaStatus;
        }

        return null;
    }
    
}
