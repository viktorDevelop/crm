<?php
//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
$routes = include $_SERVER['DOCUMENT_ROOT'].'/crm/routes.php';

(new \crm\core\Router($routes));

