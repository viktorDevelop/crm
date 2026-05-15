<?php
namespace modules\category;

use modules\catalog\AStatesCatalog;

class DetailState extends AStatesCatalog
{

    protected function getData(): array
    {
       $category_id =  $this->request->getParams('category_id');
       return [];
    }
}