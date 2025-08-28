<?php
namespace core;

use core\handlers\HendlerPost;
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
            $app->restHandle($arGetSlug,$request);
            exit();
        }

        if ($current){

            $PageController = new PageController($current,$request);
            $PageController->beforeExecute();
           echo $PageController->execute();
            $PageController->afterExecute();

        }

    }

    private function restHandle(mixed $current, Request $request)
    {
        $handler = $current['handler'] ?? null;
        switch ($request->getMethod())
        {
            case "GET": return new HendlerGet();
            case "POST": return new HendlerPost($handler,$request);
            case "PUT": return new HendlerPut();
            case "PATCH": return new HendlerPatch();
            case "DELETE": return new HendlerDelete();
            default : return 'not found';
        }
    }
}