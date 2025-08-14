<?php
namespace core\handlers;

use core\interfaces\Rest;

class MethodGet extends BaseHandler
{
    protected function getAction()
    {
        $reflectionClass = new \ReflectionClass(Rest::class);
        $methods = $reflectionClass->getMethods();
        echo '<pre>';
        var_dump($methods);
        return 'actionFind';
    }
}
