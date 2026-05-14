<?php
namespace core;

use modules\catalog\CatalogModule;

class Application
{
    public static function run()
    {
        $router = new Router();
        $action = $router->getAction();
        $catalog_mod = new CatalogModule();
        $catalog_mod->{$action}($router->getRequest(),$router->getModel(),$router->getTemplate());
    }
}



