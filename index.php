<?php
//Arquivo index responsável pela inicialização do sistema

//Impede a conersão das váriaveis declaradas para outro tipo de dado
//declare(strict_types = 1);

require_once "system/config.php";
include_once "helpers.php";

echo filtrarString("Adão \"Negro\" - '2022' "). '<hr>';
echo filtrarString("Avatar 2: O Caminho da Água"). '<hr>';
echo filtrarString("Não! Não Olhe!"). '<hr>';
echo filtrarString("Sonic 2 - O Filme"). '<hr>';
echo filtrarString("NOVA SÉRIE NO DISNEY+!"). '<hr>';
echo filtrarString("100 Melhores Filmes"). '<hr>';
echo filtrarString("teste!@###$%6¨%%¨,*.:/?\|,"). '<hr>';

echo '<hr>';
echo filtrarString("EU QUERO UMA PÍCÃNHÃ!");

