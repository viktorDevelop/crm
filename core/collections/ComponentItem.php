<?php
namespace core\collections;

use core\Views;

class ComponentItem
{
    private array $params;

    public function __construct($params = [])
    {
        $this->view = Views::getInstance();
        $this->params = $params;
    }

    public function render()
    {
        return $this->view->render($this->params['template'],['item'=>[] ]);
    }
}