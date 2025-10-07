<?php
namespace core;

use services\models\Components;
use services\Page\Pages;
use services\Page\PageService;

class Application
{
    public static function run()
    {
        $arRoutes = PageService::getRoutes();
        $uri = $_SERVER['REQUEST_URI'];
        $request_method = $_SERVER['REQUEST_METHOD'];


        foreach ($arRoutes as $k => $route)
        {
            if ( preg_match($route['condition'],$uri) )
            {
                $current_rule = $route;
               $urlParse =  preg_replace($route['condition'],$route['rule'],$uri);
            }
        }
        parse_str($urlParse,$arParams);
        echo '<pre>';
        print_r($arParams);
        print_r($current_rule);

        $components = new Components();
        $components->model->find($current_rule['id']);
        $res = $components->model->toArray();

        print_r($res);
    }


}
