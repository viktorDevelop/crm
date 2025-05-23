<?php
namespace crm\controllers;

class FrontController
{
    protected static $templateName;
    public function __construct()
    {
        $this->template = new \crm\core\Template(static::$templateName);
    }
}
