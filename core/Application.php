<?php
namespace core;

use core\handlers\HandlerDelete;
use core\handlers\HandlerGet;
use core\handlers\HandlerPatch;
use core\handlers\HandlerPost;
use core\handlers\HandlerPut;
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
        $request = new \core\Request($arGetSlug);
        if ($current['rest'])
        {
            $app = new Application();
            $app->restHandle($arGetSlug,$request,$current);
            exit();
        }

        if ($current){

            $PageController = new PageController($current,$request);
            $PageController->beforeExecute();
           echo $PageController->execute();
            $PageController->afterExecute();

        }

    }

    private function restHandle($current, Request $request,$custom)
    {
        $handler = $current['handler'] ?? null;

        switch ($request->getMethod())
        {
            case "GET": return new HandlerGet($handler,$request,$custom);
            case "POST": return new HandlerPost($handler,$request,$custom);
            case "PUT": return new HandlerPut($handler,$request,$custom);
            case "PATCH": return new HandlerPatch($handler,$request,$custom);
            case "DELETE": return new HandlerDelete($handler,$request,$custom);
            default : return 'not found';
        }
    }
}