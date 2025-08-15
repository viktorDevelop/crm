<?php
namespace modules\category\components;

use core\Views;
use modules\category\Category;

class CategoryComponent
{
    private $limit = 10;
    private $pagen = false;
    private $showComment = false;
    private $section_code = null;
    private $element_code = null;
    private $arResult = [];

    public function execute($request = [],$params = [])
    {
        $this->limit = $params['limit'] ?? null;
        $this->pagen = $params['pagen'] ?? null;
        $this->showComment = $params['comment'] ?? null;
        $this->section_code = $request['section_code'] ?? null;
        $this->element_code = $request['element_code'] ?? null;
        echo '<pre>';
//        print_r($request);
        var_dump($params);

        $this->getCategoryList($params);
        return Views::getInstance()->render('blog/posts/blocks',['categoryData'=>$this->arResult]);
    }



    protected function getCategoryList($params)
    {
        if ($this->section_code || $this->element_code)
            return ;
        $category = new Category();
        $category->findAll();
        $this->arResult = $category->toArray();
    }

    protected function getPostsByCategory()
    {

    }

    protected function getPostsByCode()
    {

    }

}