<?php
namespace components\category;


use core\BaseComponent;

class CategoryList extends BaseComponent
{

    protected function getData()
    {
         return  [['id'=>1,'title'=>'php']];
    }
}