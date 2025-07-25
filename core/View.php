<?php
namespace core;

/**
 *  @method View render($path)
 */
class View
{
    private $data = [];
    private static $instance;
    private $arComponent;

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
    public function render($view ='',$data = [])
    {
        extract($data);

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

    final public function includeComponts()
    {

        foreach ($this->arComponent as $k=>$val)
        {
            $oVal = new $val['component_class']();

            echo $oVal->render();
        }
    }

    final public function addComponents($ar)
    {
        $this->arComponent = $ar;
    }

}