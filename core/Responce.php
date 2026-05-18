<?php
namespace core;

class Responce
{

    public static function send(int $status,$data = [],$message = '')
    {

        $RestStatusResponse = RestStatusResponse::setStatus($status);
        $res = $RestStatusResponse->getMessage($data,$message);
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($res);
    }
}
