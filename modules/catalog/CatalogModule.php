<?php
namespace modules\catalog;

use core\DatabaseOrm;
use core\Request;
use core\Template;

class CatalogModule
{
    /**
     * @param Request $request
     * @param $model
     * @param $template
     * @return void
     */
    public function showList(Request $request,$model,$templateName)
    {

        $state = new ListState($request,$model,$templateName);
        $state->render();
    }

    public function showDetail(Request $request,$model,$templateName)
    {
        $state = new DetailState($request,$model,$templateName);
        $state->render();
    }

}