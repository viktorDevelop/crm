<?php
namespace core;

use core\interfaces\IRest;

enum RestRequestMethod
{
    case GET;
    case POST;
    case PATCH;
    case PUT;
    case DELETE;

    public function execute(IRest $restController)
    {
        return match($this)
        {
            self::GET => $restController->actionShow(),
            self::POST => $restController->actionCreate(),
            self::PATCH, self::PUT => $restController->actionUpdate(),
            self::DELETE => $restController->actionDelete()
        };
    }

    public static function fromString(string $method):?self
    {
        return  match ($method){
            'GET'=>self::GET,
            'POST'=>self::POST,
            'PATCH'=>self::PATCH,
            'PUT'=>self::PUT,
            'DELETE'=>self::DELETE,
            default => null
        };
    }
}