<?php
namespace core;

use core\HandlerRequest\HandleFabrica;
use core\Request;


class Application
{

    public static function run($routes)
    {
        $uri = $_SERVER['REQUEST_URI'];
        foreach ($routes as $k=>$item)
        {
            if (preg_match($item['condition'],$uri))
            {
                $rule = preg_replace($item['condition'],$item['rule'],$uri);
                $curent_rule = $item;
            }
        }
        parse_str($rule,$url_params);
        HandleFabrica::create($curent_rule['handler'],$url_params,$curent_rule['components'],$curent_rule['type']);
    }


}