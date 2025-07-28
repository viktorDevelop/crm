<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
$routes = include 'bitrix/routes.php';
\core\Application::run($routes);;

openssl_encrypt();
openssl_decrypt();