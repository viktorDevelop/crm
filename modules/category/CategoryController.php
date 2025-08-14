<?php
namespace modules\category;

use core\interfaces\Rest;

class CategoryController implements Rest
{
    public function actionFind()
    {
        return 'CategoryController action find';
    }

    public function actionStore()
    {
        return 'CategoryController actionStore';
    }

    public function actionUpdate()
    {
        return 'CategoryController actionUpdate';
    }

    public function actionDelete()
    {
        return 'CategoryController actionDelete';
    }
}