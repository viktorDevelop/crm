<?php
namespace modules;

use components\category\CategoryList;
use core\BaseController;

class PageController extends BaseController
{
    public function execute()
    {
         $view = \core\View::getInstance();
         $CategoryList = new CategoryList();
        return $view->render('blog',['page'=> [ $this->componentState->render(404) ] ]);

    }
}