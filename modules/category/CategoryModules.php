<?php
namespace modules\category;

use core\interefaces\IRest;
use core\Request;
use modules\catalog\AStatesCatalog;
use modules\catalog\ICatalog;

class CategoryModules extends AStatesCatalog implements IRest,ICatalog
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

    protected function getData(): array
    {
        return  [];
    }

    public function showList(Request $request, string $model, string $templateName): void
    {
        // TODO: Implement showList() method.
    }

    public function showDetail(Request $request, string $model, string $templateName): void
    {
        // TODO: Implement showDetail() method.
    }
}