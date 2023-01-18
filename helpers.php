<?php
function saudacao()
{
    echo $hora = date("H");
    $saudacao = '';

    if ($hora >= 0 and $hora <= 5) {
        $saudacao = 'boa madrugada';
    } elseif ($hora >= 6 and $hora <= 12) {
        $saudacao = "Bom dia";
    } elseif ($hora >= 12 and $hora <= 18) {
        $saudacao = "Boa Tarde";
    } else {
        $saudacao = "Boa Noite";
    }

    return $saudacao;
}

function resumirTexto(string $texto, int $limite, string $continue = '...'): string
{
    return $texto;
}
