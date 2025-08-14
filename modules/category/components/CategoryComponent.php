<?php
namespace modules\category\components;

use core\Views;

class CategoryComponent
{
    public function execute()
    {

        return Views::getInstance()->render('blog/posts/blocks',['categoryData'=>'']);
    }
}