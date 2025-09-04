<?php
namespace core;

class Request
{
    private array $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function getPostData($key='')
    {
        $arParams = file_get_contents('php://input');
        $arParams = json_decode($arParams,true);
        if (!empty($key))
            return $arParams[$key] ?? null;
        return $arParams;
    }

    public function getParams($key = '')
    {
        if (!empty($key))
            return $this->params[$key] ?? null;
        return $this->params;
    }

    public function getRequestParams($k='')
    {
        if (!empty($k))
            return  $_GET[$k] ?? null;
        return  $_GET;
    }

}