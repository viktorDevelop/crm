<?php
namespace components\category;


class CategoryList
{
    public function render()
    {
        $view = \core\View::getInstance();
       return $view->render('blog/category/list');
    }
}