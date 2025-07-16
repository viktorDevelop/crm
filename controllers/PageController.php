<?php
namespace controllers;

use core\Request;

class PageController extends FrontController
{
    public function actionExecute(Request $request)
    {
        $sComponents = $this->params['component'];
        $sComponents = explode(',',$sComponents);
        var_dump($this->params);

        $q = "SELECT * FROM ";
        //$c = new CatalogComponent();
        echo 'actionExecute';
    }
}