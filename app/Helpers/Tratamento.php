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

    /* Formatar Float */
    public static function formatFloat($number)
    {

        //condição de recebimento de dados
        $number = isset($number) ? str_replace(',', '.', str_replace('.', '', $number)) : 0;

        //Caso receba um número formata. Se for zero retorna 0,00
        $formatted = number_format(floatval($number), 2, ',', '.');

        return $formatted;
    }

    public static function datetimeBr($date)
    {
        //verifica se esta recebendo a data
        $date = isset($date) ? $date : 'now';

        //formata a data
        $formatted = date('d/m/Y \à\s H:i', strtotime($date));

        return $formatted;
    }

    public static function dateBr($date)
    {
        //verifica se esta recebendo a data
        $date = isset($date) ? $date : 'now';

        //formata a data
        $formatted = date('d/m/Y', strtotime($date));

        return $formatted;
    }

    public static function calculateDepreciationPercentage($original_value, $new_value)
    {
        //preparando o valor original (valor_fipe)
        $original_value = floatval(str_replace(array('.', ','), '', $original_value));

        //preparando o valor atual (valor_atual_fipe)
        $new_value = round(str_replace(',', '.', preg_replace('/\./', '', $new_value)), 0);

        //calculando a porcentagem
        $value = (($original_value - $new_value) / $original_value) * 100;

        return round($value, 0);
    }

    public static function calculateDepreciationValue($original_value, $new_value)
    {
        //preparando o valor original (valor_fipe)
        $original_value = floatval(str_replace(array('.', ','), '', $original_value));

        //preparando o valor atual (valor_atual_fipe)
        $new_value = round(str_replace(',', '.', preg_replace('/\./', '', $new_value)), 0);

        //calculando a o valor de depreciação e formatando
        $formatted = number_format(floatval($original_value - $new_value), 2, ',', '.');

        return $formatted;
    }

}
