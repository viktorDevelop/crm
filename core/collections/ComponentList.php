<?php
namespace core\collections;

use core\Views;
use modules\category\Category;

class ComponentList
{
    private $view ;
    private array $params;
    private array $arResult = [];

    public function __construct($params = [])
    {
//        echo '<pre>';
//        var_dump($params);
        $this->view = Views::getInstance();
        $this->params = $params;
        $this->getData();
    }

    public function render()
    {
         $tmp = $this->params['template'];
        return $this->view->render($tmp,['sectionData'=>$this->arResult]);
    }

    public function getData()
    {
        $cat = new Category();
        $cat->findAll();

        $this->arResult = $cat->toArray();
    }



}