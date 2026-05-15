<?php
namespace modules\category;

use core\DatabaseOrm;
use models\Category;
use modules\catalog\AStatesCatalog;

class ListState extends AStatesCatalog
{

    protected function getData(): array
    {
        $orm = new DatabaseOrm(Category::class);
        return $orm->findAll()->toArray() ?? [];
    }
}