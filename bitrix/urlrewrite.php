<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

/**
 * @todo
 * сделать показ статической страницы /about
 * rest controller
 */
\core\Application::run();



//$status = \core\RestStatusResponse::setStatus('200');
//$a =  $status->getMessage(['test'], 'ttttt');
//
//send2Log($a);
//
//$res = \core\RestRequestMethod::fromString("GET");
//$res->execute(new \modules\pages\PagesModule(new \core\Request(),\models\Pages::class,'test'));