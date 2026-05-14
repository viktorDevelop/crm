<?php
namespace modules\catalog;

use core\DatabaseOrm;
use core\Request;
use core\Template;
use models\Category;

class ListState extends AStatesCatalog
{

    private function getCategoryId($category_code)
    {
        $orm = new DatabaseOrm(Category::class);
        $res =  $orm->findOne(['category_code'=>$category_code])->toArray();
        return $res['id'] ?? null;
    }

    protected function getData():array
    {
        $orm = new DatabaseOrm($this->model);
        if ($this->category_code)
        {
            $catId = $this->getCategoryId($this->category_code);
            return $orm->findAll(['category_id'=>$catId])->toArray();
        }
        return $orm->findAll()->toArray() ?? [];

    }


}