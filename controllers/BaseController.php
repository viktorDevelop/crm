<?php

namespace controllers;



use core\View;

/**
 * @property View $view
 */
class BaseController
{
    protected $view;
    public function __construct($arComponents = [])
    {
        /** @var  $view View */
        $view = View::getInstance();
//        echo '<pre>';
//        print_r($arComponents);
        $view->addComponents($arComponents);
        $this->view = $view;


//        var_dump($arComponents);
    }

    public function actionNotFount()
    {
        return 404;
    }
}