<?php
namespace core;

class Responce
{
    public static function send($request = [],$status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        return json_encode([
            'status'=>true,
            'response_code'=>$status,
            'data'=>$request
        ]);
    }
}