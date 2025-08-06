<?php

namespace core;

use controllers\PageController;
use core\HandlerRequest\HandleGet;
use core\Request;

class HandleFabrica
{
    public static function create( PageConfigHelper $configPage)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method)
        {
            case "GET": return (new  HandleGet($configPage))->getHandler();
            case "POST": return;
            case "PUT": return;
            case "PATCH": return;
            case "DELETE": return;

        }
    }
}