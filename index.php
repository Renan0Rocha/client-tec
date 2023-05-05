<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
//Arquivo index responsável pela inicialização do sistema

//Impede a conersão das váriaveis declaradas para outro tipo de dado
//declare(strict_types = 1);

require_once "system/config.php";
include_once "helpers.php";
include './system/nucleo/mensagem.php';

echo (new Mensagem())->alerta('texto de alerta');

//$msg = new Mensagem();
//echo $msg->sucesso ("Mensagem de sucesso")->renderizar();
//echo (new Mensagem())->erro("Mensagem de erro")->renderizar();
//echo '<hr>';
