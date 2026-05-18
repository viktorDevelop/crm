<?php
namespace core;


class Application
{
    public static function run()
    {
        $router = new Router();
        $action = $router->getAction();
        $module = $router->getModule();
        $model = $router->getModel();
        if (!$module) return 404;
            $module = "modules\\".strtolower($module)."\\".$module.'Module';
        $moduleHandle = new $module($router->getRequest(),$model,$router->getTemplate());

        if($router->is_rest())
        {
            $RestRequestMethod = RestRequestMethod::fromString($_SERVER['REQUEST_METHOD']??null);
            $RestRequestMethod->execute($moduleHandle);
        }else{
            if (!$action) return 404;
            $moduleHandle->{$action}();
        }

    }
}




