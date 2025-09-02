<?php
namespace core\handlers;

use components\users\UsersRestService;
use core\Request;

abstract class AbstactHandler
{
    public function __construct($handler,Request $request,$custom = [])
    {
        if ($custom)
        {
            $sHandler = $custom['handler'];
            $action = 'action'.ucfirst($custom['action']);
            if (class_exists($sHandler))
            {
                if (method_exists($sHandler,$custom['action']))
                {
                    $action = 'action'.ucfirst($custom['action']);
                    echo  (new $sHandler)->{$action}($request);
                }
            }
        }else{

            $sHandler = '\\components\\'.$handler.'\\'.ucfirst($handler).'RestService';
            if (class_exists($sHandler))
            {
                echo  (new $sHandler)->{$this->getAction()}($request);
            }
        }


    }

    abstract protected function getAction();
}