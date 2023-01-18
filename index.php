<?php
//Arquivo index responsável pela inicialização do sistema

//Impede a conersão das váriaveis declaradas para outro tipo de dado
//declare(strict_types = 1);

require_once "system/config.php";
include_once "helpers.php";

$texto = 'texto para resumir';

//echo $total = mb_strlen(str_replace(' ', '', $texto));

echo $total = mb_strlen(trim($texto));
echo '<hr>';

/*
$string = 'texto';
$int = 10;
$float = 10.999;
$bool = true;
$nulo = null;

var_dump($texto);
echo '<hr>';
echo saudacao();
echo "<hr>";
echo resumirTexto($texto, 100, 'contiue');
echo "<hr>";
*/