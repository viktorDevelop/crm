<?php
namespace components\autorizate\form;

use core\View;

class Autorizate
{
    public function render()
    {
        /** @var $view View */
        $view = View::getInstance();
        return $view->render('components/Autorizate/form');
    }

}