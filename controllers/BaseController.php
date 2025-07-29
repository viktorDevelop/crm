<?php

namespace controllers;
use components\autorizate\form\Autorizate;
use core\Request;
use core\Responce;
use core\View;

/**
 * @property View $view
 */
class BaseController
{
    protected $view;
    public function __construct($arComponents = [])
    {
//        Autorizate::unAuth();;
        /** @var  $view View */
        $view = View::getInstance();
        $view->addComponents($arComponents);
        $this->view = $view;

    }

    public function action403(Request $request)
    {
        return Responce::send([
            'status'=>403,
            'message'=>'доступ запрещен'
        ]);
    }
    public function actionNotFount()
    {
        return 404;
    }
}