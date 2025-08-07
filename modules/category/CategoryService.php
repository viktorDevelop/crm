<?php
namespace modules\category;

use core\Request;

class CategoryService
{
    protected ?Request $request;
    public function __construct(?Request $request = null)
    {
        /** @var Request $request */
        $this->request = $request;
    }

    public function getCategoryIDByCode($alias)
     {
         $category = new Category();
         $category->findBy(['alias'=>$alias]);
         $arRes = [];
         if($data = $category->toArray())
                   $arRes = $data[0]['id'];

         return $arRes;
     }
}