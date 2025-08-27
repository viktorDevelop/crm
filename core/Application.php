<?php
namespace core;

use modules\PageController;

class Application
{
    public static function run($routes)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($routes as  $k => $item)
        {
            if ( preg_match($item['condition'],$uri) )
            {
                $current = $item;
                $rule = preg_replace($item['condition'],$item['rule'],$uri);
            }
        }

        parse_str($rule,$arGetSlug);
//        echo '<pre>';
//        var_dump($arGetSlug);
//        var_dump($current);
        $request = new \core\Request($arGetSlug);
        if ($current)
            echo (new PageController($current,$request))->execute();

    }
}