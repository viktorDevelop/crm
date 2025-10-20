<?php
namespace core;

class View
{
    private static $instance;
    protected $pageComponent = [];


    private $data = [];
    private function __construct()
    {
    }

    public function __set(string $name, $value): void
    {
        $this->pageComponent[$name] = $value;
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

    public function render($tmp,$data = [])
    {
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

    public function showComponent($name)
    {
        echo($this->pageComponent[$name]);
    }

    public function showPage()
    {
        echo $this->pageComponent['page_view'];
    }
}