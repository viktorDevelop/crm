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
        $view->addComponents($arComponents);
        $this->view = $view;

    }

    public function actionNotFount()
    {
        return 404;
    }
}