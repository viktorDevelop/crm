<?php
namespace core;

class Responce
{
    public static function send($data,$status = 200,$show = false)
    {
        http_response_code($status);
        header('Content-Type:application/json');

        if ($show)
            echo json_encode($data);
        return json_encode($data);

    }

}