<?php

namespace App\Helpers;

use DateTime;

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

    
}
