<?php

namespace components\registration\form;

use core\View;

class Registration
{

    public function render()
    {
        /** @var $view View */
        $view = View::getInstance();
        return $view->render('components/registration/form');
    }
}