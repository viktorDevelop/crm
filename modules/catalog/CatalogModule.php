<?php
namespace modules\catalog;

use core\DatabaseOrm;
use core\Request;
use core\Template;
use modules\AModule;

class CatalogModule extends AModule implements ICatalog
{
    /**
     * @param Request $request
     * @param $model
     * @param $template
     * @return void
     */


    public function showList():void
    {
        $this->listState->render();
    }

    public function showDetail():void
    {
        $this->detailState->render();
    }

    protected function setCurrentStateListClass(): string
    {
       return ListState::class;
    }

    protected function setCurrentStateDetailClass(): string
    {
        return DetailState::class;
    }
}