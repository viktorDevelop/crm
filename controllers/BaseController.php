<?php
namespace controllers;
use core\Request;

abstract class BaseController
{
    public function __construct($arComponents = [])
    {

//        echo '<pre>';
//        print_r($configPage->arComponents);

    }

    public function execute(Request $request)
    {

    }
    public function template()
    {
        /** @var  $view \core\View */
        $view = \core\View::getInstance();

        echo $view->render('blog',[
            'postData'=>[],
            'data'=>[]
        ]);
    }
}