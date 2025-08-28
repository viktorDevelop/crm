<?php
namespace core\handlers;

use components\users\UsersRestService;
use core\Request;

abstract class AbstactHandler
{
    public function __construct($handler,Request $request)
    {
        $sHandler = '\\components\\'.$handler.'\\'.ucfirst($handler).'RestService';

        if (class_exists($sHandler))
        {
            echo  (new $sHandler)->{$this->getAction()}($request);
        }
    }

    abstract protected function getAction();
}