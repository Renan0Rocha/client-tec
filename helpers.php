<?php

/*
function filter_input_fix ($type, $variable_name, $filter = FILTER_DEFAULT)
{
    $checkTypes =[
        INPUT_GET,
        INPUT_POST,
        INPUT_SERVER,
        INPUT_COOKIE
    ];

    if (in_array($type, $checkTypes) || filter_has_var($type, $variable_name)) {
        return filter_input($type, $variable_name, $filter);
    } else if ($type == INPUT_SERVER && isset($_SERVER[$variable_name])) {
        return filter_var($_SERVER[$variable_name], $filter);
    } else if ($type == INPUT_ENV && isset($_ENV[$variable_name])) {
        return filter_var($_ENV[$variable_name], $filter);
    } else {
        var_dump($type) ;
        return NULL;
    }
}
*/

function filtrarString($string): string
{
    // Remove espaços em branco no início e no final da string
    $string = trim($string);

    // Substitui caracteres acentuados por não acentuados
    $string = strtr($string, array(
        'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'ä' => 'a', 'Á' => 'A', 'À' => 'A', 'Ã' => 'A', 'Â' => 'A', 'Ä' => 'A',
        'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'Ë' => 'E',
        'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i', 'Í' => 'I', 'Ì' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'ó' => 'o', 'ò' => 'o', 'õ' => 'o', 'ô' => 'o', 'ö' => 'o', 'Ó' => 'O', 'Ò' => 'O', 'Õ' => 'O', 'Ô' => 'O', 'Ö' => 'O',
        'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U',
        'ç' => 'c', 'Ç' => 'C'
    ));

    // Remove caracteres especiais da string e converte caracteres acentuados para não acentuados
    $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);

    // Adiciona um único traço entre as palavras
    $string = preg_replace('/\s+/', '-', $string);

    // Converte caracteres especiais para UTF-8
    $string = htmlentities($string, ENT_QUOTES, "UTF-8");

    // Remove tags HTML e PHP da string
    $string = strip_tags($string);

    // Translitera a string para remover caracteres acentuados
    $transliterator = Transliterator::create('NFD; [:Nonspacing Mark:] Remove; NFC;');
    $string = $transliterator->transliterate($string);

    // Converte a string de volta para o formato original sem os caracteres especiais
    $string = preg_replace('/&([a-zA-Z])(\'uml|acute|grave|circ|tilde);/', '$1', $string);

    return $string;
}


/* FUNÇÃO COM ERROS DE CONVERÇÃO UTF-8
function slug(string $string): string
{
    $mapa['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúû
    @#$*()_-+={[}]/?¨|;:.,\\\'<>|º°ª';

    $mapa['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuu';

    $slug = strtr(mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8'), mb_convert_encoding($mapa['a'], 'ISO-8859-1', 'UTF-8'), $mapa['b']);
    return mb_convert_encoding($slug, 'ISO-8859-1', 'UTF-8');
}
*/
function dataAtual(): string
{
    $diaMes = date('d');
    $diaSemana = date('w');
    $mes = date('n') - 1;
    $ano = date('y');

    $dayWeek = [
        'Domingo', 'Segunda-Feira', 'Terça-Feira',
        'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'
    ];

    $mounths = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];

    $dataFormatada = $dayWeek[$diaSemana] . ", " . $diaMes . " de " . $mounths[$mes] . " de " . $ano;

    return $dataFormatada;
}


/**
 * Monta url de acordo com o ambiente
 * @param string $url parte da url ex. admin
 * @return string url completa
 */

function url(string $url): string
{

    if (filter_has_var(INPUT_SERVER, "SERVER_NAME")) {
        $servername = filter_input(
            INPUT_SERVER,
            "SERVER_NAME",
            FILTER_UNSAFE_RAW,
            FILTER_NULL_ON_FAILURE
        );
    } else {
        if (isset($_SERVER["SERVER_NAME"]))
            $servername = filter_var(
                $_SERVER["SERVER_NAME"],
                FILTER_UNSAFE_RAW,
                FILTER_NULL_ON_FAILURE
            );
        else
            $servername = null;
    }
    $ambiente = ($servername == "localhost" ? URL_DESENVOLVIMENTO : URL_PRODUCAO);

    if (str_starts_with($url, '/')) {
        return $ambiente . $url;
    }
    return $ambiente . '/' . $url;
}

function localhost(): bool
{
    if (filter_has_var(INPUT_SERVER, "SERVER_NAME")) {
        $servername = filter_input(
            INPUT_SERVER,
            "SERVER_NAME",
            FILTER_UNSAFE_RAW,
            FILTER_NULL_ON_FAILURE
        );
    } else {
        if (isset($_SERVER["SERVER_NAME"]))
            $servername = filter_var(
                $_SERVER["SERVER_NAME"],
                FILTER_UNSAFE_RAW,
                FILTER_NULL_ON_FAILURE
            );
        else
            $servername = null;
    }

    if ($servername == 'localhost') {
        return true;
    }
    return false;
}

/**
 * Conta o tempo decorrido de uma data
 * @param string $data
 * @return string
 */

function validarUrl(string $url): bool
{
    if (mb_strlen($url) < 10) {
        return false;
    }
    if (!str_contains($url, '.')) {
        return false;
    }
    if (str_contains($url, 'http://') or str_contains($url, 'https://')) {
        return true;
    }
    return false;
}

function validarUrlComFiltro(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

function validarEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function contarTempo(string $data): string
{
    $agora = strtotime(date('Y-m-d H:i:s'));
    $tempo = strtotime($data);
    $diferenca = $agora - $tempo;

    $segundos = $diferenca;
    $minutos = round($diferenca / 60);
    $horas = round($diferenca / 3600);
    $dias = round($diferenca / 86400);
    $semanas = round($diferenca / 604800);
    $mes = round($diferenca / 2419200);
    $anos = round($diferenca / 29030400);

    if ($segundos <= 60) {
        return 'agora';
    } elseif ($minutos <= 60) {
        return $minutos == 1 ? 'há 1 minuto' : 'há ' . $minutos . ' minutos';
    } elseif ($horas <= 24) {
        return $horas == 1 ? 'há 1 hora' : 'há ' . $horas . ' horas';
    } elseif ($dias <= 7) {
        return $dias == 1 ? 'há 1 dia' : 'há ' . $dias . ' dias';
    } elseif ($semanas <= 4) {
        return $semanas == 1 ? 'há 1 semana' : 'há ' . $semanas . ' semanas';
    } elseif ($mes <= 12) {
        return $mes == 1 ? 'há 1 mês' : 'há ' . $mes . ' meses';
    } else {
        return $anos == 1 ? 'há 1 ano' : 'há ' . $anos . ' anos';
    }
}

function formatarValor(float $valor = null): string
{
    return number_format(($valor ?: 0), 2, ',', '.');
}
function formatarNumero(float $numero = null): string
{
    return number_format(($numero ?: 0), 0, '.', '.');
}
function saudacao()
{
    echo $hora = date("H");
    $saudacao = '';

    if ($hora >= 0 and $hora <= 5) {
        $saudacao = ' boa madrugada';
    } elseif ($hora >= 6 and $hora <= 12) {
        $saudacao = "Bom dia";
    } elseif ($hora >= 12 and $hora <= 18) {
        $saudacao = "Boa Tarde";
    } else {
        $saudacao = "Boa Noite";
    }

    return $saudacao;
}
/**
 * Resume um texto
 * @param string $texto texto para resumir
 * @param int $limite quantidade de caracteres permitidos
 * @param string $continue opcional - o que deve ser exibido ao final do resumo
 * @return string texto resumido
 */
function resumirTexto(string $texto, int $limite, string $continue = '...'): string
{

    $textoLimpo = trim($texto);
    if (mb_strlen($textoLimpo) <= $limite) {
        return $textoLimpo;
    }

    $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ''));

    return $resumirTexto . $continue;
}
