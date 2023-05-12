<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
//Arquivo index responsável pela inicialização do sistema

//Impede a conersão das váriaveis declaradas para outro tipo de dado
//declare(strict_types = 1);

require_once "system/config.php";
include_once "./system/nucleo/helpers.php";
include './system/nucleo/mensagem.php';
include './system/nucleo/controlador.php';

use system\nucleo\Controlador;

$controlador = new Controlador();
echo '<hr>';
var_dump($controlador);


