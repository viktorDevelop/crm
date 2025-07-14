<?php
namespace core;

use services\models\Components;
use services\Page\Pages;
use services\Page\PageService;

class Application
{
    public static function run()
    {
        $oPageService = new PageService();
        $arRoutes = $oPageService->getRoutes();
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
//        print_r($current_rule);
        $request = new Request($arParams);
        if ($current_rule['rest'])
        {
            $oPageService->ApiExecute($arParams,$request);
        }

        if (!$current_rule['rest'])
        {
            $oPageService->getPageSettings($current_rule);
            $oPageService->execute($request);
        }
    }

}
