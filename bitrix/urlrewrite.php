<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
$routes = include_once $_SERVER['DOCUMENT_ROOT'].'/medical/routes.php';
$router = new \crm\coreRouter($routes);
