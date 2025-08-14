<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

\core\Application::run();;

class BaseController
{
    public function __construct($params = [])
    {
        $arComponents = $params['components'] ?? null;
        foreach($arComponents as $k => $items)
        {

        }

    }

    public function template()
    {
        echo 'view blog';
    }
}

class PageController extends BaseController
{
    public function execute()
    {
        return $this->template();
    }
}


