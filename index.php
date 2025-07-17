<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
//$routes = include $_SERVER['DOCUMENT_ROOT'].'/crm/routes.php';

//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
//(new \crm\core\Router($routes));

//\core\Application::run();


//$blade = new \core\SimpleBlade( '/views',  '/cache');
//
//echo $blade->render('pages/home', [
//    'title' => 'Home Page',
//    'name' => 'John Doe',
//    'isAdmin' => true,
//    'items' => ['Apple', 'Banana', 'Orange']
//]);


class View
{
    private $data = [];
    private static $instance;

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
    public function render($view ='')
    {
//        foreach ($this->data as $key => $value) {
//            $$key = $value;
//        }
        extract($this->data, EXTR_SKIP);
        ob_start();
        $path = $_SERVER['DOCUMENT_ROOT'].'/views/'.$view.'.php';

        if (file_exists($path)) {
            include $path;
        }else{
            echo "404";
        }

        $content = ob_get_contents();
        ob_clean();

        $content = preg_replace(
            '/@section\(\'(.+?)\'\)/',
            '<?php $this->include("$1"); ?>',$content);
        return $content;
    }

    public function include($path)
    {
        echo $this->render($path);
    }

}

$v = View::getInstance();
$v->title = 'ttt title';
echo $v->render('layouts/main');