<?php

namespace core;

use core\HandlerRequest\HandleGet;
use core\Request;

class HandleFabrica
{
    public static function create($curent_rule = [],Request $request)
    {
        echo '<pre>';
        print_r($curent_rule);
        $method = $_SERVER['REQUEST_METHOD'];
        $component = $curent_rule['handle'];
        $isRest = isset($curent_rule['resource']) ?? null;
        print_r($isRest);
        switch ($method)
        {
            case "GET": return (new  HandleGet($component,$isRest))->getHandler();
            case "POST": return;
            case "PUT": return;
            case "PATCH": return;
            case "DELETE": return;
        }
    }
}