<?php
namespace modules;

use components\category\CategoryList;
use core\BaseController;

class PageController extends BaseController
{
    public function execute()
    {
        $view = \core\View::getInstance();
        return $view->render($this->typePage,['page'=> [ $this->componentState->render(404) ] ]);
    }
}