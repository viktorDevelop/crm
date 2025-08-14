<?php
namespace core;
class Views
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance():Views
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
        extract($data);
        ob_start();
        $path = $_SERVER['DOCUMENT_ROOT'].'/views/'.$tmp.'/template.php';
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

    public function includeWidjet($name)
    {
//        echo $name;
    }
}