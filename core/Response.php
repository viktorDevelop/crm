<?php
namespace core;



class Response
{

    private  function result($data,$message = '',$status = 200)
    {
        $res = new \stdClass();
        $res->status = $status == 200;
        $res->code = $status;
        $res->data = $data;
        $res->message = $message;
        return $res;
    }
    public static function send($data,$message = '',$status = 200)
    {
        http_response_code($status);
        header('Content-Type:application/json');
        $res = new Response();
        echo json_encode($res->result($data,$message,$status));
        exit();
    }

    public static  function badRequest($message)
    {
        http_response_code(500);
        $res = new Response();
        self::send($res->result($message,500));

    }

    public static function permitionDenide($message)
    {
        self::send([
            'status'=>403,
            'error'=>$message
        ]);
    }



}