<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

$routes = include '../config/routes.php';

\core\Application::run($routes);

/** @var  $view \core\View */
$view = \core\View::getInstance();



//echo $view->render('blog',[
//    'postData'=>$res,
//    'data'=>[]
//]);

