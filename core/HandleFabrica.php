<?php

namespace core;

use core\HandlerRequest\HandleGet;
use core\Request;

class HandleFabrica
{
    public static function create($curent_rule = [],Request $request)
    {
        echo '<pre>'; print_r($curent_rule);
        $method = $_SERVER['REQUEST_METHOD'];
        $handleObject = $curent_rule['handle'];
        $arComponents = $curent_rule['components'];
        $isRest = isset($curent_rule['handle']) ?? null;
        switch ($method)
        {
            case "GET": return (new  HandleGet($handleObject,$request,$arComponents,$isRest))->getHandler();
            case "POST": return;
            case "PUT": return;
            case "PATCH": return;
            case "DELETE": return;
        }
    }
}