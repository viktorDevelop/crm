<?php

namespace controllers;

use core\Request;

class PageController extends BaseController
{

    public function execute()
    {
//        echo '<pre>';
//        print_r($this->configPage->components);


       return $this->template();
    }
}