<?php
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace("system\Controlador");

SimpleRouter::get("client-tec/", "siteControl@index");
SimpleRouter::get("client-tec/sobre", "siteControl@sobre");


SimpleRouter::start();
