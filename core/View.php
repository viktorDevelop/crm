<?php
namespace core;

class View
{
    private static $instance;
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $cl = __CLASS__;
            self::$instance = new $cl;
        }
        return self::$instance;
    }

    public function render($tmp,$data = [])
    {
        extract($data);
        $path = $_SERVER['DOCUMENT_ROOT'].'/template/'.$tmp.'/template.php';
        if (file_exists($path))
        {
            include $path;
        }else{
            include '404.php';
        }

        $content = ob_get_contents();
        ob_clean();
        return $content;
    }

    public function include($view,$data = [])
    {

        $path = $_SERVER['DOCUMENT_ROOT'].'/template/views/'.$view.'/template.php';
        extract($data);
        ob_start();
        include $path;
        $content = ob_get_contents();
        ob_clean();
        echo $content;
    }



}

