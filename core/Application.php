<?php
namespace core;

use modules\catalog\CatalogModule;
use modules\category\CategoryModule;

class Application
{
    public static function run()
    {
        $router = new Router();
        $action = $router->getAction();
        $module = $router->getModule();
        if (!$module) return 404;
        $module = "modules\\".strtolower($module)."\\".$module.'Module';
        $moduleHandle = new $module($router->getRequest(),$router->getModel(),$router->getTemplate());
        $moduleHandle->{$action}();
        if (!$action) return 404;
    }
}



