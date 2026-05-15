<?php
namespace core;

class Request
{
    private $params;
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function getParams($key = '',$default = '')
    {
        if ($this->params){
            if (key_exists($key,$this->params))
                return $this->params[$key];
        }
        if ($default) return $default;

        return  $this->params;
    }

    public function get($name = '')
    {
        if ($name)
            return $_GET[$name];
        return $_GET;
    }

    public function getBody($key='')
    {
        $post = file_get_contents('php://input');
        $arPost = json_decode($post,true);

        if (empty($key))
            return $arPost;
        if ($arPost && $key && key_exists($key,$arPost))
            return $arPost[$key];
        else
            return null;
    }

    public function getFormData($key='')
    {
        $arPost = [];
        $arPost = $_POST;

        if (empty($key))
            return $arPost;
        if ($arPost && $key && key_exists($key,$arPost))
            return $arPost[$key];
        else
            return null;
    }


}