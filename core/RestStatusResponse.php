<?php
namespace core;

enum RestStatusResponse
{
    case STATUS_404;
    case STATUS_403 ;
    case STATUS_200 ;

    public  function getMessage(array $data = [],string $message = ''):?array
    {
        return match ($this)
        {
            self::STATUS_200 => [
                'status'=>true,
                'message'=>"",
                'data'=>$data
            ],
            self::STATUS_404 => [
                'status'=>false,
                'message'=>"not found",
                'data'=>$data
            ],
            self::STATUS_403 => [
                'status'=>false,
                'message'=>"access denied",
                'data'=>$data
            ],
            default => []
        };
    }

    public static function setStatus($status): ?self
    {
        return match ($status) {
            404,'404' => self::STATUS_404,
            200,'200' => self::STATUS_200,
            403,'403' => self::STATUS_403,
            default => null,
        };
    }
}