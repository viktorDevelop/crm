<?php
namespace core\helpers\HandlerFactory;

class HandlerFactory {
    public static function create($method, $obj_name) {
        switch ($method) {
            case 'GET': return new GetHandler($obj_name);
            case 'POST': return new PostHandler($obj_name);
            case 'PUT': return new PutHandler($obj_name);
            case 'PATCH': return new PatchHandler($obj_name);
            case 'DELETE': return new DeleteHandler($obj_name);
            default: throw new InvalidArgumentException("Unsupported method: $method");
        }
    }
}
