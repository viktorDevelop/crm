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
        if (!isset(self::$instance))
        {
            $cl = __CLASS__;
            self::$instance = new $cl;
        }
        return self::$instance;
    }


    public function render($view,$data = [])
    {
        if ($data)
        {
            foreach ($data as $k => $item)
            {
                $$k=$item;
            }
        }
        ob_start();
       $file = $_SERVER['DOCUMENT_ROOT'].'/templates/'.$view.'/template.php';
        if (file_exists($file))
        {
            include $file;

            $content_page = ob_get_contents();
            ob_clean();
            return $content_page;
        }

    }
}