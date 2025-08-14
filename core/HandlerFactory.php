<?php
namespace core;

use core\handlers\MethodGet;

class HandlerFactory
{
    public static function create($object)
    {
        $object = '\\modules\\'.$object.'\\'.ucfirst($object).'Controller';

        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method)
        {
            case 'GET':return (new MethodGet($object))->handle();
            case 'POST':return '';
            case 'PUT':return '';
            case 'PUTCH':return '';
            case 'DELETE':return '';
            default: return false;
        }
    }
}
