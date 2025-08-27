<?php
namespace core;

class View
{
    private static $instance;
    protected $arDataPage;
    private function __construct()
    {
    }

    public static function getInstance():View
    {
        if (!isset(self::$instance))
        {
            $cl = __CLASS__;
            self::$instance = new $cl;
        }

        return self::$instance;
    }

    public function setView()
    {

    }

    public function render($tmp,$data = [])
    {
        $this->arDataPage = $data['page'];
        extract($data);
        ob_start();
        $path = $_SERVER['DOCUMENT_ROOT'].'/templates/'.$tmp.'/template.php';
        if (file_exists($path))
        {
            include $path;
        }else{
            echo 'not found view';
        }

        $content = ob_get_contents();
        ob_clean();
        return $content;
    }

    public function includeContent()
    {
        foreach ($this->arDataPage as $k=>$item)
        {
            echo $item;
        }
    }
}
