<?php
namespace modules\category;

use core\DatabaseOrm;
use core\interfaces\IRest;
use core\Request;
use models\Category;
use modules\AModule;
use modules\catalog\AStatesCatalog;
use modules\catalog\ICatalog;


class CategoryModule extends AModule implements IRest,ICatalog
{

    public function actionShow()
    {
        // TODO: Implement actionShow() method.
    }

    public function actionCreate()
    {
        // TODO: Implement actionCreate() method.
    }

    public function actionUpdate()
    {
        // TODO: Implement actionUpdate() method.
    }

    public function actionDelete()
    {
        // TODO: Implement actionDelete() method.
    }

    public function showList(): void
    {
        $this->listState->render();
    }

    public function showDetail(): void
    {
        $this->detailState->render();
    }

    protected function setCurrentStateListClass(): string
    {
         return  ListState::class;
    }

    protected function setCurrentStateDetailClass(): string
    {
        return  DetailState::class;
    }
}