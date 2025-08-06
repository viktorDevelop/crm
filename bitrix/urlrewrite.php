<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

$routes = include '../config/routes.php';

\core\Application::run($routes);



