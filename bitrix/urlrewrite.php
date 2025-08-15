<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

\core\Application::run();;

class BaseController
{
    protected $arComponents = [];
    public function __construct($params = [],$getParams)
    {
        $arComponents = $params['components'] ?? null;
        $componentParams = $params['components']['params'] ?? null;
        $this->arComponents['componentClass'] = (new $params['components']['componentClass'])->execute($getParams,$componentParams);
//        echo '<pre>';
//        print_r();


    }

    public function template()
    {

        $view = \core\Views::getInstance();
      echo  $view->render('blog',[
            'page'=> $this->arComponents
        ]);
    }
}

class PageController extends BaseController
{
    public function execute()
    {
        return $this->template();
    }
}



