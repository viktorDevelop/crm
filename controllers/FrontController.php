<?php
namespace controllers;

use core\Request;

class FrontController
{
    protected array $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function actionMain(Request $request)
    {
        $a = $request->get();
        print_r($_GET);
        echo 'tet';
    }

    public function actionPage(Request $request)
    {
        $a = $request->get();
        print_r($_GET);
        echo '<pre>'; print_r($request->getParams());
    }
}