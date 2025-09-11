<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';


$view = \core\View::getInstance();

echo $view->render('blog/timeline');