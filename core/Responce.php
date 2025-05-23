<?php
namespace core;

class Responce
{
    public static function send($request = [])
    {
        header('Content-Type: application/json');
        http_response_code(200);
        return json_encode($request);
    }
}
