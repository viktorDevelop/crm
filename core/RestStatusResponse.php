<?php
namespace core;

enum RestStatusResponse
{
    case STATUS_404;
    case STATUS_403 ;
    case STATUS_200 ;
    case STATUS_400 ;

    public  function getMessage(array $data = [],string $message = ''):?array
    {
        return match ($this)
        {
            self::STATUS_200 => [
                'status'=>true,
                'message'=>$message,
                'data'=>$data
            ],
            self::STATUS_404 => [
                'status'=>false,
                'message'=>$message ?: "not found",
                'data'=>$data
            ],
            self::STATUS_403 => [
                'status'=>false,
                'message'=>$message ?: "access denied",
                'data'=>$data
            ],

            self::STATUS_400 => [
                'status'=>false,
                'message'=>$message ?: "некорректный запрос ",
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
            400,'400' => self::STATUS_400,
            default => null,
        };
    }
}