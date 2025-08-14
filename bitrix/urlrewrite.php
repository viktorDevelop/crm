<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

\core\Application::run();;

class BaseController
{
    protected $arComponents = [];
    public function __construct($params = [])
    {
        $arComponents = $params['components'] ?? null;
//        echo '<pre>';
//        print_r($arComponents);
        foreach($arComponents as $k => $items)
        {
            $this->arComponents = [
                'page' => (new $items['componentClass'])->execute()
            ];
        }

    }

    public function template()
    {

       echo \core\Views::getInstance()->render('blog',['page'=>$this->arComponents]);
    }
}

class PageController extends BaseController
{
    public function execute()
    {
        return $this->template();
    }
}


