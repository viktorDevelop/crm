<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
$routes = include 'routes.php';
\core\Application::run($routes);;


