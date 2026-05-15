<?php
namespace modules\catalog;

use core\DatabaseOrm;
use core\Request;
use core\Template;

class CatalogModule implements ICatalog
{
    /**
     * @param Request $request
     * @param $model
     * @param $template
     * @return void
     */
    public function showList(Request $request,$model,$templateName):void
    {

        $state = new ListState($request,$model,$templateName);
        $state->render();
    }

    public function showDetail(Request $request,$model,$templateName):void
    {
        $state = new DetailState($request,$model,$templateName);
        $state->render();
    }

}