<?php
namespace modules\category;

use core\DatabaseOrm;
use models\Category;
use modules\catalog\AStatesCatalog;

class DetailState extends AStatesCatalog
{

    protected function getData(): array | false
    {
       $category_code =  $this->request->getParams('category_code');
       $orm = new DatabaseOrm(Category::class);
       if ($category_code){
            $res =  $orm->findOne(['category_code'=>$category_code])->toArray();
            $this->title = $res['title'] ?? null;
           return  $res;
       }
        return [];
    }
}