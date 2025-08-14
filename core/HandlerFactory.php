<?php
namespace core;

use core\handlers\MethodDelete;
use core\handlers\MethodGet;
use core\handlers\MethodPatch;
use core\handlers\MethodPost;

class HandlerFactory
{
    public static function create($object)
    {
        $object = '\\modules\\'.$object.'\\'.ucfirst($object).'Controller';

        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method)
        {
            case 'GET':return (new MethodGet($object))->handle();
            case 'POST':return (new MethodPost($object))->handle();
            case 'PUT':return (new MethodPatch($object))->handle();
            case 'PATCH':return (new MethodPatch($object))->handle();
            case 'DELETE':return (new MethodDelete($object))->handle();
            default: return false;
        }
    }
}
