<?php
namespace crm\controllers;

use crm\core\Request;
use crm\core\View;

class PageController
{
    public function actionIndex()
    {
        $view = \crm\core\View::getInstance();

       return $view->render();
    }



}