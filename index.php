<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
//$routes = include $_SERVER['DOCUMENT_ROOT'].'/crm/routes.php';

//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
//(new \crm\core\Router($routes));

//\core\Application::run();



class View
{
    private $data = [];
    private static $instance;
    public $title;
    private function __construct() {}

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $cl = __CLASS__;
            self::$instance = new $cl;
        }
        return self::$instance;
    }

    public function __set($k,$v)
    {
        $this->data[$k] = $v;
    }

    /**
     * @param $view
     *
     * @return false|string
     *
     */
    public function render($view ='',$data=[])
    {
        extract($this->data, EXTR_SKIP);
        extract( $data, EXTR_SKIP);
        ob_start();
         $path = $_SERVER['DOCUMENT_ROOT'].'/views/'.$view.'.php';

        if (file_exists($path)) {
            include $path;
        }else{
            echo "404";
        }

        $content = ob_get_contents();
        ob_clean();
        return $content;
    }


    public function include($path, $data = [])
    {
        echo $this->render($path,$data);
    }

    public function page($view,$data = [])
    {
        $this->data[$view.'Data'] = $data;
        $this->data['title'] = $this->title;
        $this->data['page'] = 'home';
    }

}

class Autorization
{
    public function checkAuth()
    {
        return isset($_SESSION['token']) ;
    }

    public function autorizate()
    {
        $token = time().'.'.md5($this->login);
    }
}



class BaseController
{
    public function beforeExecute()
    {

    }

    public function afterExecute()
    {
        $v = View::getInstance();
        echo $v->render('layouts/main');
    }

}

class PageController extends BaseController
{
    public function execute()
    {
        $v = View::getInstance();

        $v->title = 'about Page';
        $arResult = [
            'title' => 'about Page',
            'isAuth' => false,
            'items' => ['Apple', 'Banana', 'Orange']
        ];

        $v->page('about',$arResult);
    }


}

$c = new PageController();
$c->beforeExecute();
$c->execute();;
$c->afterExecute();

