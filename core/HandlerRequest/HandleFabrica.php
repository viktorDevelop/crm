<?php

namespace core\HandlerRequest;

class HandleFabrica
{
    public static function create($controller,$url_params = [],$arComponents = [],$type = '')
    {
        $method = $_SERVER['REQUEST_METHOD'];
        try {
            if (!class_exists($controller))
            {
                throw new \Exception("Error Processing Request", 1);
            }
            $oController = new $controller;

            $getMethod = new HandelGet($type);
            $postMethod = new HandelPost();
            $putMethod = new HandelPut();
            $getMethod->setNext($postMethod)->setNext($putMethod);
             $action =  $getMethod->handle($method);
            $request = new \core\Request($url_params);
            $oController = new $controller($arComponents);
            if (!method_exists($oController,$action)){
                throw new \Exception("Error Processing Request, method undefined", 1);
            }

              echo  $oController->{$action}($request);
        }catch (\Exception $exception)
        {
            echo $exception->getMessage();
        }

    }
}
