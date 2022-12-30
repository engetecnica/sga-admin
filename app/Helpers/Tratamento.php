<?php

namespace App\Helpers;

class Tratamento
{


    /* Formatação do Número do celular com link para WhatsApp */
    public static function SetURLWhatsApp(string $celular)
    {
        if (!$celular) return "";        
        $URL_WP = "https://api.whatsapp.com/send?phone=55";
        return $URL_WP.preg_replace('/[^0-9]/', '', $celular);
    }

    
}
