<?php
namespace modules\category\components;

use core\collections\ComponentItem;
use core\collections\ComponentList;
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
    private  $state;
    /**
     * @var array|mixed
     */
    private mixed $arParams;

    public function execute($request = [],$params = [])
    {
        $this->arParams = $params;
        $this->section_code = $request['section_code'] ?? null;
        $this->element_code = $request['element_code'] ?? null;
        $this->setState();
//        echo '<pre>';
//        print_r($request);
//        var_dump($this->state);

        return $this->state->render();
    }

    public function setState()
    {
        if (!$this->section_code)
             $this->state = new ComponentList($this->arParams['sectionList']);
        if ($this->section_code)
            $this->state = new ComponentList($this->arParams['itemList']);
        if ($this->element_code)
            $this->state = new ComponentItem($this->arParams['item']);
    }




}