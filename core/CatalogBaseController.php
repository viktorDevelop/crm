<?php
namespace core;

class CatalogBaseController
{
    /**
     * @var null
     */
    private $controller;

    public function __construct($controller = null)
    {
        $this->controller = $controller;
    }

    public function execute()
    {
        $c = new $this->controller;
        $c->view();
    }
}